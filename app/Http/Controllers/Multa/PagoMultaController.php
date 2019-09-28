<?php

namespace App\Http\Controllers\Multa;

use App\Multa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class MultaController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function view()
    {
       return view('layout.multas.pagoMulta');
    }
}
