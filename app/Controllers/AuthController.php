<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $user;

    function __construct()
    {
        helper('form');
        $this->user = new UserModel();
    }

    public function login()
    {
        if ($this->request->getPost()) {
            $username = $this->request->getVar('username');
            $password = md5($this->request->getVar('password'));
    
            $dataUser = $this->user->where('username', $username)->first();
    
            if ($dataUser) {
                if ($password === $dataUser['password']) {
                    if ($dataUser['is_aktif'] == 1) {
                        session()->set([
                            'username' => $dataUser['username'],
                            'password' => $dataUser['password'],
                            'role' => $dataUser['role'],
                            'isLoggedIn' => false
                        ]);
                        session()->setFlashdata('success', 'Anda Berhasil Login.');
                        return redirect()->to(base_url('/'));
                    } else {
                        if ($dataUser['is_aktif'] == 0) {
                            session()->setFlashdata('failed', 'Akun Anda tidak aktif. Silakan hubungi administrator 08220490991.');
                        } else {
                            session()->setFlashdata('failed', 'Ada masalah lain, silakan hubungi administrator 08220490991.');
                        }
                        return redirect()->back();
                    }
                } else {
                    session()->setFlashdata('failed', 'Username atau Password Salah');
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('failed', 'Username atau Password Salah');
                return redirect()->back();
            }
        } else {
            return view('login_view');
        }
    }

    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'username' => 'required',
                'email' => 'required|valid_email',
                'password' => 'required|exact_length[6]'
            ];

            $messages = [
                'username.required' => 'Username harus diisi.',
                'email.required' => 'Email harus diisi.',
                'email.valid_email' => 'Format email tidak valid.',
                'password.required' => 'Password harus diisi.',
                'password.min_length' => 'Password harus memiliki 6 karakter.'
            ];

            if (!$this->validate($rules, $messages)) {
                session()->setFlashdata('failed', 'Registrasi gagal. Password harus memiliki 6 karakter tidak boleh lebih dan tidak boleh kurang, atau terjadi kesalahan email tidak valid');
                return redirect()->back()->withInput();
            }

            $username = $this->request->getPost('username');
            $email = md5($this->request->getPost('email'));
            $password = md5($this->request->getPost('password'));
            $role = 'user';
            $is_aktif = 0;

            // Validasi apakah username sudah ada dalam database
            $existingUser = $this->user->where('username', $username)->first();
            if ($existingUser) {
                session()->setFlashdata('failed', 'Username sudah digunakan. Silakan pilih username lain.');
                return redirect()->back();
            }

            // Buat data array untuk disimpan ke database
            $data = [
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'role' => $role,
                'is_aktif' => $is_aktif,
            ];

            // Simpan data ke dalam database
            $this->user->insert($data);

            // Set session dan redirect ke halaman login setelah registrasi berhasil
            session()->setFlashdata('success', 'Registrasi berhasil. Silakan login dengan akun yang sudah dibuat.');
            return redirect()->to('login');
        } else {
            return view('register_view');
        }
    }    

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
