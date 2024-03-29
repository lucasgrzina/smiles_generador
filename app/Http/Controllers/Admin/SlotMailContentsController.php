<?php

namespace App\Http\Controllers\Admin;

use View;
use Response;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\ContenidoPredefinido;
use App\SlotMails;
use App\SlotMailGroups;
use App\Helpers\StorageHelper;
use App\Repositories\SlotMailContentsRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Http\Requests\Admin\CUSlotMailContentsRequest;
use App\Repositories\Criteria\CustomMailsCriteria;
use App\Http\Controllers\Admin\CrudAdminController;

class SlotMailContentsController extends CrudAdminController
{
    protected $routePrefix = 'slot-mail-contents';
    protected $viewPrefix  = 'admin.slot_mail_contents.';
    protected $actionPerms = 'piezas';

    public function __construct(SlotMailContentsRepository $repo)
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

        $slot_mail_id   = request()->get('slot',false);
        $grupo_id       = request()->get('grupo',false);
        $tipo_contenido = SlotMailGroups::find($grupo_id);

        if (!$slot_mail_id || !$grupo_id) {
            return redirect()->route('slot-mails.index');
        }

        $slot = SlotMails::where('id', $slot_mail_id)->first();

        if ($tipo_contenido->tipo == 'P'){
            //  $templateDefault['contenido'] = 'sabias_que';
            $slot->template = 'predefinidos';
             
        }
        //return $slot->template;
        $templateDefault = config('constantes.default_'.$slot->template,[]);

        $footerObj = json_decode(json_decode($slot->footer));
        $footer_id = $footerObj->footer;        //
        $id_redes = $footerObj->redes;

        $legalesDefault = ContenidoPredefinido::where('tipo', 'legales')->where('seccion', 's')->where('default',true)->first();
        $footerDefault = ContenidoPredefinido::find($footer_id);
        $redesDefault = ContenidoPredefinido::find($id_redes);


        

        data_set($this->data,'info',[
            'tipo_footer' => ContenidoPredefinido::where('tipo', 'footer')->where('seccion', 's')->get(),
            'tipo_redes' => ContenidoPredefinido::where('tipo', 'redes')->where('seccion', 's')->get(),
            'tipo_contenido' => ContenidoPredefinido::where('tipo', 'contenido')->where('seccion', 's')->get(),
            'tipo_legales' => ContenidoPredefinido::where('tipo', 'legales')->where('seccion', 's')->get(),
            'templates' => config('constantes.templates',[]),
            'legales_id' => $legalesDefault ? $legalesDefault->id : null,
            'footer_id' => $footerDefault ? $footerDefault->id : null,
            'redes_id' => $redesDefault ? $redesDefault->id : null
        ]);
      
        
        $templateDefault['legales'] = '"{\"legales\":\"'.($legalesDefault ? $legalesDefault->id : 0).'\",\"legales_custom\":\"\"}"';
        

        

        
        
        

        data_set($this->data, 'selectedItem', [
                'id' => 0,
                'slot_mail_id' => $slot_mail_id,
                'slot_mail_group_id' => $grupo_id,
                'nombre_slot' => $slot->nombre,
                'fecha_envio' => $slot->fecha_envio,
                'template' => $slot->template,
                'publicidad' => $templateDefault['publicidad'],
                'saldo' => $templateDefault['saldo'],
                'contenido' => $templateDefault['contenido'],
                'legales' => $templateDefault['legales'],
                'tipo_footer' => null
        ]);



        $this->data['selectedItem']['footerpm'] = ([
            'footer' => $footerDefault ? ['id' => $footerDefault->id, 'nombre' => $footerDefault->nombre] : null,
            'redes' => $redesDefault ? ['id' => $redesDefault->id, 'nombre' => $redesDefault->nombre] : null
        ]);
        
        $this->data['url_index'] = route('slot-mails.edit',[$slot_mail_id]);
        //echo json_encode($templateDefault['contenido']);

        
        
         

        return view($this->viewPrefix.'cu')->with('data',$this->data);
    }

    public function store(CUSlotMailContentsRequest $request)
    {
        
        
        try {
            \DB::beginTransaction();
            
            $model = $this->_store($request, true);
            //$uploadPath = env('AMAZON_S3_FOLDER'). '/slot_mail_' .$model->id;

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
         
        $id_slot = $this->data['selectedItem']->slot_mail_id;
        
        $slot = SlotMails::where('id', $id_slot)->first();
       

        $footerObj = json_decode(json_decode($slot->footer));
        $footer_id = $footerObj->footer;        //
        $id_redes = $footerObj->redes;

       // dd($slot->footer);
       //$this->data['selectedItem']->footerpm = $slot->footer;

       $legalesDefault = ContenidoPredefinido::where('tipo', 'legales')->where('seccion', 's')->where('default',true)->first();
       $footerDefault = ContenidoPredefinido::find($footer_id);
       $redesDefault = ContenidoPredefinido::find($id_redes);

       $this->data['selectedItem']['footerpm'] = [
        'footer' => $footerDefault ? ['id' => $footerDefault->id, 'nombre' => $footerDefault->nombre] : null,
        'redes' => $redesDefault ? ['id' => $redesDefault->id, 'nombre' => $redesDefault->nombre] : null
        ];



        $legalesObj         = json_decode(json_decode($this->data['selectedItem']->legales));
        //dd($legalesObj);
        $legales_id         = isset($legalesObj->legales) ? $legalesObj->legales : null;        //
        $legales_custom     = $legalesObj->legales_custom;

        $this->data['selectedItem']['nombre_slot'] = $slot->nombre;
        $this->data['selectedItem']['template'] = $slot->template;
        $this->data['selectedItem']['fecha_envio'] = $slot->fecha_envio;
        $this->data['selectedItem']['publicidad'] = $slot->publicidad;
        $this->data['selectedItem']['saldo'] = $slot->saldo;
       
        data_set($this->data,'info',[
            'tipo_footer' => ContenidoPredefinido::where('tipo', 'footer')->where('seccion', 's')->get(),
            'tipo_redes' => ContenidoPredefinido::where('tipo', 'redes')->where('seccion', 's')->get(),
            'tipo_contenido' => ContenidoPredefinido::where('tipo', 'contenido')->where('seccion', 's')->get(),
            'tipo_legales' => ContenidoPredefinido::where('tipo', 'legales')->where('seccion', 's')->get(),
            'redes_id' => $id_redes,
            'footer_id' => $footer_id,
            'legales_id' => $legales_id,
            'legales_custom' => $legales_custom,
            'templates' => config('constantes.templates',[])
        ]);

  
        $arrContenidoDecode = (array)json_decode($this->data['selectedItem']->contenido);
        
        foreach ($arrContenidoDecode as $itemContenido) {
            if($itemContenido->id == 'contenido_predefinido'){
                $itemContenido->contenidohtml = ContenidoPredefinido::where('id', $itemContenido->predefinido)->get()[0]->contenido;
            }
           
        }

       
       
        
        $this->data['selectedItem']->contenido = json_encode($arrContenidoDecode);
        //$footerFooterCP = ContenidoPredefinido::find($footer_id);
        //$footerRedesCP = ContenidoPredefinido::find($id_redes);

     
        $this->data['url_index'] = route('slot-mails.edit',[$id_slot]);
        return view($this->viewPrefix.'cu')->with('data',$this->data);
    }

    public function update($id, CUSlotMailContentsRequest $request)
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

            $uploadPathAnterior = env('AMAZON_S3_FOLDER'). '/slot_mail_' .$model->slot_mail_id;
            $uploadPathNuevo = env('AMAZON_S3_FOLDER'). '/slot_mail_' .$clonado->slot_mail_id;
            
            if (StorageHelper::existe($uploadPathAnterior)) {
                foreach(StorageHelper::archivos($uploadPathAnterior) as $asset) {
                    $nuevoAsset = str_replace($uploadPathAnterior, $uploadPathNuevo, $asset);
                    //StorageHelper::copiar($asset,$nuevoAsset);
                }
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
