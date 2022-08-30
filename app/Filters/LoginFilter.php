<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('logged_in_admin') == true) {
            return redirect()->to(base_url('http://localhost:8080/home-admin'));
        }

        if (session()->get('logged_in_pegawai') == true) {
            return redirect()->to(base_url('http://localhost:8080/home-pegawai'));
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
