<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\CrudAdminController;
use App\Http\Requests\Admin\CUCustomMailsRequest;
use App\Repositories\CustomMailsRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use View;
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

        $legalesObj         = json_decode(json_decode($this->data['selectedItem']->legales));
        $legales_id         = $legalesObj->legales;        //
        $legales_custom     = $legalesObj->legales_custom;
        if ($legales_id){
            $legaleshtml        = ContenidoPredefinido::where('id', $legales_id)->get()[0]->contenido;
        }else{
             $legaleshtml = '';
        }
        

        data_set($this->data, 'info', (object)[
            'redeshtml' => ($redeshtml),
            'footerhtml' => ($footerhtml),
            'legaleshtml' => ($legaleshtml),
            'legales_custom' => ($legales_custom),
        ]);

        $this->data['url_export'] = route('custom-mails.export-html',['id' => $id]);

        return view($this->viewPrefix.'show')->with('data', $this->data);

    }

    public function exportHtml($id){
        parent::show($id);

        $footerObj = json_decode(json_decode($this->data['selectedItem']->footer));
        $id_footer = $footerObj->footer;
        $footerhtml = ContenidoPredefinido::where('id', $id_footer)->get()[0]->contenido;
        //
        $id_redes = $footerObj->redes;
        $redeshtml = ContenidoPredefinido::where('id', $id_redes)->get()[0]->contenido;

        $legalesObj         = json_decode(json_decode($this->data['selectedItem']->legales));
        $legales_id         = $legalesObj->legales;        //
        $legales_custom     = $legalesObj->legales_custom;
        if ($legales_id){
            $legaleshtml        = ContenidoPredefinido::where('id', $legales_id)->get()[0]->contenido;
        }else{
             $legaleshtml = '';
        }
        

        data_set($this->data, 'info', (object)[
            'redeshtml' => ($redeshtml),
            'footerhtml' => ($footerhtml),
            'legaleshtml' => ($legaleshtml),
            'legales_custom' => ($legales_custom),
        ]);

     
        $html = View::make("admin.custom_mails.templates.diario")
        ->with([
            'data' => $this->data, 
            'publicidad' => $this->data['selectedItem']->publicidad,
            'saldo' => $this->data['selectedItem']->saldo,
            'contenido' => json_decode($this->data['selectedItem']->contenido),
            'footer' => $this->data['info']->footerhtml,
            'redes' => $this->data['info']->redeshtml,
            'legaleshtml' => $this->data['info']->legaleshtml,
            'legales_custom' => $this->data['info']->legales_custom,
        ])
        ->render();

        $headers = [
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$this->data['selectedItem']->nombre.'.html"',
        ];

        return \Response::make($html, 200, $headers);

       // return $html->download('mail.html');

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
                'legales' => '',
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

        $legalesObj         = json_decode(json_decode($this->data['selectedItem']->legales));
        $legales_id         = $legalesObj->legales;        //
        $legales_custom     = $legalesObj->legales_custom;
       
        data_set($this->data,'info',[
            'tipo_footer' => ContenidoPredefinido::where('tipo', 'footer')->get(),
            'tipo_redes' => ContenidoPredefinido::where('tipo', 'redes')->get(),
            'tipo_contenido' => ContenidoPredefinido::where('tipo', 'contenido')->get(),
            'tipo_legales' => ContenidoPredefinido::where('tipo', 'legales')->get(),
            'redes_id' => $id_redes,
            'footer_id' => $footer_id,
            'legales_id' => $legales_id,
            'legales_custom' => $legales_custom,
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
