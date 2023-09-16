<?php

    namespace App\Filters;

    use CodeIgniter\HTTP\RequestInterface;
    use CodeIgniter\HTTP\ResponseInterface;
    use CodeIgniter\Filters\FilterInterface;

    class Auth implements FilterInterface
    {
        public function before(RequestInterface $request, $arguments = null)
        {
            // memastikan apa sudah login atau belum kalau belum akan di arahkan ke menu login (/index.php/login)
            if (!session()->has('isLoggedIn')) {
                return redirect()->to(site_url('login'));
            }
        }

        //--------------------------------------------------------------------

        public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
        {
            // Do something here
        }
    }