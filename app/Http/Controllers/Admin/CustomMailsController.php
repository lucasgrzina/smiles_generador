<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\CrudAdminController;
use App\Http\Requests\Admin\CUCustomMailsRequest;
use App\Repositories\CustomMailsRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\ContenidoPredefinido;

class CustomMailsController extends CrudAdminController
{
    protected $routePrefix = 'custom-mails';
    protected $viewPrefix  = 'admin.custom_mails.';
    protected $actionPerms = 'custom-mails';

    public function __construct(CustomMailsRepository $repo)
    {
        $this->repository = $repo;

        $this->middleware('permission:ver-'.$this->actionPerms, ['only' => ['index','filter','show']]);        
        $this->middleware('permission:editar-'.$this->actionPerms, ['only' => ['create','store','edit','update','destroy']]);          
    }

    public function index()
    {
        parent::index();

        return view($this->viewPrefix.'index')->with('data',$this->data);
    }

    public function getPredefinido(){
        return 'resdkfhskdjfh ';
    }
    public function filter(Request $request)
    {
        try
        {
            $this->repository->pushCriteria(new RequestCriteria($request));
            $collection = $this->repository->with('updater')->paginate($request->get('per_page'))->toArray();        

            $this->data = [
                'list' => $collection['data'],
                'paging' => array_only($collection,['total','current_page','last_page'])
            ];   

        }
        catch (\Exception $ex) 
        {
            return $this->sendError($ex->getMessage(),500);
        } 

        return $this->sendResponse($this->data, trans('admin.success'));
    }

    public function show($id)
    {
        parent::show($id);

        $footerObj = json_decode(json_decode($this->data['selectedItem']->footer));
        $id_footer = $footerObj->footer;
        $footerhtml = ContenidoPredefinido::where('id', $id_footer)->get()[0]->contenido;
        //
        $id_redes = $footerObj->redes;
        $redeshtml = ContenidoPredefinido::where('id', $id_redes)->get()[0]->contenido;
        data_set($this->data, 'info', (object)[
            'redeshtml' => ($redeshtml),
            'footerhtml' => ($footerhtml),
        ]);

        return view($this->viewPrefix.'show')->with('data', $this->data);
    }

    public function create()
    {
        parent::create();

        data_set($this->data,'info',[
            'tipo_footer' => ContenidoPredefinido::where('tipo', 'footer')->get(),
            'tipo_redes' => ContenidoPredefinido::where('tipo', 'redes')->get(),
            'tipo_contenido' => ContenidoPredefinido::where('tipo', 'contenido')->get()
        ]);

        data_set($this->data, 'selectedItem', [
                'id' => 0,
                'template' => null,
                'contenido' => '',
                'footer' => '',
                'tipo_footer' => null
        ]);

        return view($this->viewPrefix.'cu')->with('data',$this->data);
    }

    public function store(CUCustomMailsRequest $request)
    {
        $model = $this->_store($request);
        return $this->sendResponse($model,trans('admin.success'));        
    }

    public function edit($id)
    {
        parent::edit($id);

       // $tipo_footer = ContenidoPredefinido::get();
        $footerObj = json_decode(json_decode($this->data['selectedItem']->footer));
        $footer_id = $footerObj->footer;        //
        $id_redes = $footerObj->redes;
       
        data_set($this->data,'info',[
            'tipo_footer' => ContenidoPredefinido::where('tipo', 'footer')->get(),
            'tipo_redes' => ContenidoPredefinido::where('tipo', 'redes')->get(),
            'tipo_contenido' => ContenidoPredefinido::where('tipo', 'contenido')->get(),
            'redes_id' => $id_redes,
            'footer_id' => $footer_id,
        ]);

  
      //  $this->data['selectedItem']['footer'] = json_encode($objFooter);

        return view($this->viewPrefix.'cu')->with('data',$this->data);
    }

    public function update($id, CUCustomMailsRequest $request)
    {
        $model = $this->_update($id, $request);

        return $this->sendResponse($model,trans('admin.success'));
    }
}
