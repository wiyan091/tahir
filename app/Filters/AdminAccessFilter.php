<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminAccessFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek peran pengguna
        $role = session()->get('role');

        if ($role !== 'admin') {
            // Jika pengguna bukan admin, alihkan mereka atau tampilkan pesan kesalahan
            return redirect()->to('login');
            // Atau tampilkan pesan:
            //return view('access_denied');
        }

        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu melakukan apa-apa setelah permintaan selesai
    }
}
