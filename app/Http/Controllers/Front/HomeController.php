<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Front\SubirFotoRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class HomeController extends AppBaseController
{
    use FileUploadTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth:admin');
    }

    

    public function index()
    {
        return view('front.home', []);
    }


    
}
