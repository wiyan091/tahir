<?php

namespace App\Controllers;

use App\Models\BarangModel;

class BarangController extends BaseController
{
    protected $barang;
    protected $validation;

    function __construct()
    {
        helper('number');
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->barang = new BarangModel();
    }

    public function index()
    {
        $data['barangs'] = $this->barang->findAll();
        return view('/barang_view', $data);
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
        $validate = $this->validation->setRules($rules)->run($data);

        if ($validate) {
            
            // username akan di ambil dari user/ admin yang login
            $loggedInUsername = session()->get('username');

            $dataForm = [
                'nama' => $this->request->getPost('nama'),
                'jumlah' => $this->request->getPost('jumlah'),
                'keterangan' => $this->request->getPost('keterangan'),
                'tanggal' => $this->request->getPost('tanggal'),
                'status' => false,
                'username' => $loggedInUsername, // Set the username from the logged-in user
            ];

            $this->barang->insert($dataForm);

            return redirect('barang')->with('success', 'Data Berhasil Ditambah. (<a href="' . base_url() . '.">Lihat</a>)');
        } else {
            $data['errors'] = $this->validation->getErrors();
            $data['barangs'] = $this->barang->findAll();
            return view('/barang_view', $data);
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
        $validate = $this->validation->setRules($rules)->run($data);

        if ($validate) {
            $dataForm = [
                'nama' => $this->request->getPost('nama'),
                'jumlah' => $this->request->getPost('jumlah'),
                'keterangan' => $this->request->getPost('keterangan'),
                'tanggal' => $this->request->getPost('tanggal'),
                'status' => $this->request->getPost('status'),
            ];

            $this->barang->update($id, $dataForm);

            return redirect('barang')->with('success', 'Data Berhasil Diubah');
        } else {
            $data['errors'] = $this->validation->getErrors();
            $data['barangs'] = $this->barang->findAll();
            return view('/barang_view', $data);
        }
    }

    public function delete($id)
    {
        $this->barang->find($id);
        $this->barang->delete($id);

        return redirect('barang')->with('success', 'Data Berhasil Dihapus');
    }
}
