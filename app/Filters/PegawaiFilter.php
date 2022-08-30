<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class PegawaiFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (is_null(session()->get('logged_in_pegawai'))) {
            return redirect()->to('http://localhost:8080/login');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
