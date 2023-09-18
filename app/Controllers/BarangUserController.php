<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\DetailModel;

class BarangUserController extends BaseController
{
    protected $baranguser;
    protected $detail;
    protected $validation;


    function __construct()
    {
        helper('form');
        helper('number');
        $this->validation = \Config\Services::validation();
        $this->baranguser = new BarangModel();
        $this->detail = new DetailModel();
    }

    public function index()
    {
        $data['details'] = $this->detail->findAll();
        $username = session()->get('username'); // Mengambil username dari session

        // Mengambil status pemesanan hanya untuk akun yang sedang login
        $data['barangusers'] = $this->baranguser->where('username', $username)->findAll();

        return view('baranguser_view', $data);
    }
    public function create()
    {
        $data = $this->request->getPost();
        $rules = [
            'nama' => 'required',
            'jumlah' => 'required|integer',
            'keterangan' => 'required',
            'tanggal' => 'required'
        ];
        // Set pesan kesalahan untuk setiap aturan
        $messages = [
            'nama' => [
                'required' => 'Nama harus diisi.'
            ],
            'jumlah' => [
                'required' => 'Jumlah harus diisi.',
                'integer' => 'Jumlah harus berupa angka.'
            ],
            'keterangan' => [
                'required' => 'Keterangan harus diisi.'
            ],
            'tanggal' => [
                'required' => 'Tanggal harus diisi.'
            ]
        ];

        $validate = $this->validation->setRules($rules, $messages)->run($data);

        if ($validate) {
            $userModel = new \App\Models\UserModel();
            $loggedInUsername = session()->get('username');

            // Ambil Username dari UserModel username yang diambil adalah username yang sedang login
            $user = $userModel->where('username', $loggedInUsername)->first();

            if ($user) {
                // Mengambil id user sesuai (username) yang sedang login
                $id_user = $user['id'];

                $dataForm = [
                    'nama' => $this->request->getPost('nama'),
                    'jumlah' => $this->request->getPost('jumlah'),
                    'keterangan' => $this->request->getPost('keterangan'),
                    'tanggal' => $this->request->getPost('tanggal'),
                    'status' => false,
                    'username' => $loggedInUsername, // Set the username from the logged-in user
                    'id_user' => $id_user, // id diambil dari userid yang sedang login
                ];

                // Masukkan data ke tabel 'atk'
                $this->baranguser->insert($dataForm);

                // Setelah data dimasukkan ke 'atk', kita akan membuat relasi dengan tabel 'detail'
                $lastInsertedId = $this->baranguser->getInsertID(); // Dapatkan ID dari data yang baru saja dimasukkan

                // Buat relasi dengan tabel 'detail'
                $detailModel = new \App\Models\DetailModel();
                $detailData = [
                    'id_user' => $id_user, // Sesuai dengan user yang sedang login
                    'id_atk' => $lastInsertedId, // ID dari data yang baru saja dimasukkan ke 'atk'
                    'tanggal' => $this->request->getPost('tanggal'),
                ];
                $detailModel->insert($detailData);

                return redirect()->to('baranguser')->with('success', 'Data Berhasil Ditambah.');
            } else {
                return redirect('baranguser')->with('failed', 'Gagal Ditambah.');
            }
        } else {

            // Jika validasi gagal, ambil pesan kesalahan
            $validationErrors = $this->validation->getErrors();

            // Kirim pesan kesalahan ke tampilan
            return redirect('baranguser')->with('validationErrors', $validationErrors);

            // Mengambil barang sesuai dengan session pengguna yang sedang masuk
            $loggedInUsername = session()->get('username');
            $userModel = new \App\Models\UserModel();
            $user = $userModel->where('username', $loggedInUsername)->first();

            if ($user) {
                // Mengambil barang sesuai dengan ID pengguna yang sedang masuk
                $id_user = $user['id'];
                $data['barangusers'] = $this->baranguser->where('id_user', $id_user)->findAll();
            } else {
                $data['barangusers'] = []; // Jika pengguna tidak ditemukan, beri tahu bahwa tidak ada barang yang tersedia.
            }

            return view('/baranguser_view', $data);
        }
    }

    public function edit($id)
    {
        $data = $this->request->getPost();
        $rules = [
            'nama' => 'required',
            'jumlah' => 'required|integer',
            'keterangan' => 'required',
            'tanggal' => 'required'
        ];
        // Set pesan kesalahan untuk setiap aturan
        $messages = [
            'nama' => [
                'required' => 'Nama harus diisi.'
            ],
            'jumlah' => [
                'required' => 'Jumlah harus diisi.',
                'integer' => 'Jumlah harus berupa angka.'
            ],
            'keterangan' => [
                'required' => 'Keterangan harus diisi.'
            ],
            'tanggal' => [
                'required' => 'Tanggal harus diisi.'
            ]
        ];

        $validate = $this->validation->setRules($rules, $messages)->run($data);

        if ($validate) {
            $dataForm = [
                'nama' => $this->request->getPost('nama'),
                'jumlah' => $this->request->getPost('jumlah'),
                'keterangan' => $this->request->getPost('keterangan'),
                'tanggal' => $this->request->getPost('tanggal'),
                'status' => false,
            ];

            $this->baranguser->update($id, $dataForm);

            return redirect('baranguser')->with('success', 'Data Berhasil Diubah');
        } else {
            // Jika validasi gagal, ambil pesan kesalahan
            $validationErrors = $this->validation->getErrors();

            // Kirim pesan kesalahan ke tampilan
            return redirect('baranguser')->with('validationErrors', $validationErrors);

            // Mengambil barang sesuai dengan session pengguna yang sedang masuk
            $loggedInUsername = session()->get('username');
            $userModel = new \App\Models\UserModel();
            $user = $userModel->where('username', $loggedInUsername)->first();

            if ($user) {
                // Mengambil barang sesuai dengan ID pengguna yang sedang masuk
                $id_user = $user['id'];
                $data['barangusers'] = $this->baranguser->where('id_user', $id_user)->findAll();
            } else {
                $data['barangusers'] = []; // Jika pengguna tidak ditemukan, beri tahu bahwa tidak ada barang yang tersedia.
            }

            return view('/baranguser_view', $data);
        }
    }

    public function delete($id)
    {
        // Temukan data barang berdasarkan ID
        $baranguser = $this->baranguser->find($id);

        if (!$baranguser) {
            return redirect('baranguser')->with('error', 'Data Barang tidak ditemukan.');
        }

        // Hapus entri detail yang sesuai dengan id_atk yang sesuai
        $this->detail->where('id_atk', $baranguser['id'])->delete();

        // Hapus data barang dari tabel 'atk'
        $this->baranguser->delete($id);

        return redirect('baranguser')->with('success', 'Data Berhasil Dihapus');
    }
}
