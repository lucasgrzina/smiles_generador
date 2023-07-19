<?php

namespace App\Http\Controllers\Admin;


use Carbon\Carbon;
use App\Configuraciones;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ConfiguracionesRepository;


class ConfigS3Controller extends AppBaseController
{
    protected $configRepo;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ConfiguracionesRepository $configRepo)
    {
        $this->configRepo = $configRepo;
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'selectedItem' => array_merge([
                'id' => 0,
                'AMAZON_S3_KEY' => null,
                'AMAZON_S3_SECRET' => null
            ],$this->configRepo->getCredencialesS3()),
            'perms' => auth()->user()->getAllPermissions()->pluck('name'),
            'roles' => auth()->user()->getRoleNames(),
            'url_save' => route('configuraciones.s3.guardar'),
            'url_index' => route('configuraciones.s3')            
        ];
        return view('admin.configuraciones.s3',['data' => $data]);
    }

 
    public function guardar (Request $request) {
        $data = $request->all();
        $this->configRepo->setCredencialesS3($request->only(['AMAZON_S3_KEY','AMAZON_S3_SECRET']));
        return $this->sendResponse($data,trans('admin.success'));        
    }

    
    public function unauthorized()
    {
        return view('admin.unauthorized');
    }    

    
}
