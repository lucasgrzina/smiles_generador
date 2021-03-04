<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\CrudAdminController;
use App\Http\Requests\Admin\CUContenidoPredefinidoRequest;
use App\Repositories\ContenidoPredefinidoRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\ContenidoPredefinido;

class ContenidoPredefinidoController extends CrudAdminController
{
    protected $routePrefix = 'contenido-predefinidos';
    protected $viewPrefix  = 'admin.contenido_predefinidos.';
    protected $actionPerms = 'contenido-predefinidos';

    public function __construct(ContenidoPredefinidoRepository $repo)
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

        //$this->data['selectedItem']->load('xxx');

        return view($this->viewPrefix.'show')->with('data', $this->data);
    }

    public function create()
    {
        parent::create();

        data_set($this->data, 'selectedItem', [
                'id' => 0
        ]);

        return view($this->viewPrefix.'cu')->with('data',$this->data);
    }

    public function store(CUContenidoPredefinidoRequest $request)
    {
        if ($request['default'] == 1){
           // \Log::info('Es destacado');
            ContenidoPredefinido::where('tipo', $request['tipo'])
            ->where('default', 1)
            ->update(['default' => 0]);
        }
        
        $model = $this->_store($request);
        return $this->sendResponse($model,trans('admin.success'));        
    }

    public function edit($id)
    {
        parent::edit($id);

        return view($this->viewPrefix.'cu')->with('data',$this->data);
    }

    public function update($id, CUContenidoPredefinidoRequest $request)
    {
        if ($request['default'] == 1){
           // \Log::info('Es destacado');
            ContenidoPredefinido::where('tipo', $request['tipo'])
            ->where('default', 1)
            ->update(['default' => 0]);
        }

        $model = $this->_update($id, $request);

        return $this->sendResponse($model,trans('admin.success'));
    }
}
