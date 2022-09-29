<?php

namespace App\Http\Controllers\Admin;

use View;
use Response;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\ContenidoPredefinido;
use App\Helpers\StorageHelper;
use App\Repositories\SlotMailsRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Http\Requests\Admin\CUCustomMailsRequest;
use App\Repositories\Criteria\CustomMailsCriteria;
use App\Http\Controllers\Admin\CrudAdminController;

class SlotMailsController extends CrudAdminController
{
    protected $routePrefix = 'slot-mails';
    protected $viewPrefix  = 'admin.slot_mails.';
    protected $actionPerms = 'piezas-slots';

    public function __construct(SlotMailsRepository $repo)
    {
        $this->repository = $repo;

        $this->middleware('permission:ver-'.$this->actionPerms, ['only' => ['index','filter','show']]);        
        $this->middleware('permission:editar-'.$this->actionPerms, ['only' => ['create','store','edit','update','destroy']]);          
    }

    public function index()
    {
        parent::index();
        $this->data['filters']['template'] = null;
        $this->data['filters']['export_xls'] = true;
        $this->data['url_clonar'] = route($this->routePrefix.'.clonar',['_ID_']);
        $this->data['url_contenido_delete'] = route('slot-mail-contents.destroy', ['slot' => '_ID_']);
        $this->data['url_contenido_create'] = route('slot-mail-contents.create', ['slot' => '_ID_']);
        $this->data['url_contenido_edit'] = route('slot-mail-contents.edit', ['slot' => '_ID_']);
        return view($this->viewPrefix.'index')->with('data',$this->data);
    }

    public function getPredefinido(){
        return 'resdkfhskdjfh ';
    }
    public function filter(Request $request)
    {
        try
        {
            $this->repository->pushCriteria(new CustomMailsCriteria($request));
            $this->repository->pushCriteria(new RequestCriteria($request));
            $collection = $this->repository->with(['updater', 'contenidos'])->paginate($request->get('per_page'))->toArray();        

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
            'footerhtml' => ($footerhtml)
        ]);
        
        $arrContenidoDecode = (array)json_decode($this->data['selectedItem']->contenido);
        
        foreach ($arrContenidoDecode as $itemContenido) {
            if($itemContenido->id == 'contenido_predefinido'){
                $itemContenido->contenidohtml = ContenidoPredefinido::where('id', $itemContenido->predefinido)->get()[0]->contenido;
            }
           
        }
        
        $this->data['selectedItem']->contenido = json_encode($arrContenidoDecode);
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

        $arrContenidoDecode = (array)json_decode($this->data['selectedItem']->contenido);
        
        foreach ($arrContenidoDecode as $itemContenido) {
            if($itemContenido->id == 'contenido_predefinido'){
                $itemContenido->contenidohtml = ContenidoPredefinido::where('id', $itemContenido->predefinido)->get()[0]->contenido;
            }
           
        }
        
        $this->data['selectedItem']->contenido = json_encode($arrContenidoDecode);

     
        $html = View::make("admin.custom_mails.templates.".$this->data['selectedItem']->template)
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

        $template = request()->get('template',false);

        if (!$template) {
            return redirect()->route($this->routePrefix.'.index');
        }

        $templateDefault = config('constantes.default_'.$template,[]);

        data_set($this->data,'info',[
            'tipo_footer' => ContenidoPredefinido::where('tipo', 'footer')->get(),
            'tipo_redes' => ContenidoPredefinido::where('tipo', 'redes')->get(),
            'tipo_contenido' => ContenidoPredefinido::where('tipo', 'contenido')->get(),
            'tipo_legales' => ContenidoPredefinido::where('tipo', 'legales')->get(),
            'templates' => config('constantes.templates',[]),
            'legales_id' => json_decode(json_decode($templateDefault['legales']))->legales,
            'footer_id' => json_decode(json_decode($templateDefault['footer']))->footer,
            'redes_id' => json_decode(json_decode($templateDefault['footer']))->redes,
        ]);
      

        data_set($this->data, 'selectedItem', [
                'id' => 0,
                'template' => $template,
                'publicidad' => $templateDefault['publicidad'],
                'saldo' => $templateDefault['saldo'],
                'contenido' => $templateDefault['contenido'],
                'footer' => $templateDefault['footer'],
                'legales' => $templateDefault['legales'],
                'tipo_footer' => null
        ]);

        
        //echo json_encode($templateDefault['contenido']);
        return view($this->viewPrefix.'cu')->with('data',$this->data);
    }

    public function store(CUCustomMailsRequest $request)
    {
        

        try {
            \DB::beginTransaction();;
            
            $model = $this->_store($request, true);
            $uploadPath = env('AMAZON_S3_FOLDER'). '/' .$model->id;

            if (!StorageHelper::existe($uploadPath)) {
                StorageHelper::crearDirectorio($uploadPath);
            }

            \DB::commit();
            return $this->sendResponse($model,trans('admin.success'));        
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e->getMessage());
            throw $e;
        }

        
    }

    public function edit($id)
    {
        parent::edit($id);

       // $tipo_footer = ContenidoPredefinido::get();

        $footerObj = json_decode(json_decode($this->data['selectedItem']->footer));
        $footer_id = $footerObj->footer;        //
        $id_redes = $footerObj->redes;

        
       
        data_set($this->data,'info',[
            'link_create' => route('slot-mail-contents.create', ['slot' => $id]),
            'tipo_footer' => ContenidoPredefinido::where('tipo', 'footer')->get(),
            'tipo_redes' => ContenidoPredefinido::where('tipo', 'redes')->get(),
            'tipo_contenido' => ContenidoPredefinido::where('tipo', 'contenido')->get(),
            'tipo_legales' => ContenidoPredefinido::where('tipo', 'legales')->get(),
            'redes_id' => $id_redes,
            'footer_id' => $footer_id,
            'templates' => config('constantes.templates',[])
        ]);

  
        $arrContenidoDecode = (array)json_decode($this->data['selectedItem']->contenido);
        
        foreach ($arrContenidoDecode as $itemContenido) {
            if($itemContenido->id == 'contenido_predefinido'){
                $itemContenido->contenidohtml = ContenidoPredefinido::where('id', $itemContenido->predefinido)->get()[0]->contenido;
            }
           
        }

       
       
        
        $this->data['selectedItem']->contenido = json_encode($arrContenidoDecode);

        return view($this->viewPrefix.'cu')->with('data',$this->data);
    }

    public function update($id, CUCustomMailsRequest $request)
    {
        $model = $this->_update($id, $request);

        return $this->sendResponse($model,trans('admin.success'));
    }

    public function export($type = 'xlsx',Request $request)
    {
        $request->merge(['page' => 1,'per_page' => 99999]);

        $this->repository->pushCriteria(new CustomMailsCriteria($request));
        $this->repository->pushCriteria(new RequestCriteria($request));
        $data = $this->repository->with('updater')->all()->toArray();        

        $header = [
            'nombre' => 'Nombre',
            'template' => 'Template',
            'fecha_envio' => 'Fecha de envío'
        ];

        $format = [
            'fecha_envio' => function($value) {
                return Carbon::parse($value)->format('d/m/Y');
            },

            'template' => function($value) {
                $templates = config('constantes.templates',[]);
                return $templates[$value];
            }
        ];

        return $this->_exportXls($data,$header,$format,'piezas');
    }  
    
    public function clonar($id, Request $request)
    {
        try {
            \DB::beginTransaction();;
            
            $model = $this->repository->findWithoutFail($id);

            if (empty($model)) {
                return $this->sendError('No existe el registro',500);
            }
    
            $clonado = $model->replicate();
            $clonado->nombre.= ' (clonado)';
            $clonado->save();



            $uploadPathAnterior = env('AMAZON_S3_FOLDER'). '/' .$model->id;
            $uploadPathNuevo = env('AMAZON_S3_FOLDER'). '/' .$clonado->id;
            //$clonado->contenido = str_replace($uploadPathAnterior,$uploadPathNuevo, $clonado->contenido);
            if (StorageHelper::existe($uploadPathAnterior)) {
                //StorageHelper::crearDirectorio($uploadPathNuevo);
                foreach(StorageHelper::archivos($uploadPathAnterior) as $asset) {
                    $nuevoAsset = str_replace($uploadPathAnterior, $uploadPathNuevo, $asset);
                    StorageHelper::copiar($asset,$nuevoAsset);
                }
                //throw new \Exception('No existe la carpeta con assets en S3');
                $nuevoContenido = [];
                foreach((array)json_decode($model->contenido) as $jsonItem) {
                    $jsonItem->input = str_ireplace($uploadPathAnterior,$uploadPathNuevo,$jsonItem->input);
                    $nuevoContenido[] = $jsonItem;
                }
                $clonado->contenido = json_encode($nuevoContenido);
                $clonado->save();
    
            } else {
                throw new \Exception('No existe la carpeta con assets en S3');
            }

            \DB::commit();
            return $this->sendResponse($clonado,trans('admin.success'));        
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e->getMessage());
            throw $e;
        }
    }    
}
