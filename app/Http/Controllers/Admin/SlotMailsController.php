<?php

namespace App\Http\Controllers\Admin;

use View;
use Response;
use Carbon\Carbon;
use App\SlotMailGroups;
use App\SlotMailContents;
use Chumper\Zipper\Zipper;
use Illuminate\Http\Request;
use App\ContenidoPredefinido;
use App\Helpers\StorageHelper;
use App\Repositories\SlotMailsRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Http\Requests\Admin\CUCustomMailsRequest;
//use Chumper\Zipper\Facades\Zipper;
use App\Repositories\Criteria\CustomMailsCriteria;
use App\Http\Controllers\Admin\CrudAdminController;
use Illuminate\Support\Facades\Redirect;


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
        $this->data['url_contenido_clonar'] = route('slot-mail-contents.clonar', ['slot' => '_ID_']);        
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
            $collection = $this->repository->with([
                'updater', 
                'contenidos' => function ($q) {
                    $q->with('grupo')->orderBy('slot_mail_group_id')->orderBy('order');
                },
                'grupos' => function ($q) {
                    $q->with('contenidos')->orderBy('order');
                }
            ])->paginate($request->get('per_page'))->toArray();        

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

        $this->data['selectedItem']->load('tarjetaSusp');
        $footerObj = json_decode(json_decode($this->data['selectedItem']->footer));
        $id_footer = $footerObj->footer;
        $footerhtml = ContenidoPredefinido::where('id', $id_footer)->get()[0]->contenido;
        //
        $legalesGenericoObj = json_decode(json_decode($this->data['selectedItem']->legales));
        $legales_id = $legalesGenericoObj->legales;
        $legaleshtml = ContenidoPredefinido::where('id', $legales_id)->get()[0]->contenido;
        //
        $id_redes = $footerObj->redes;
        $redeshtml = ContenidoPredefinido::where('id', $id_redes)->get()[0]->contenido;

        data_set($this->data, 'info', (object)[
            'redeshtml' => ($redeshtml),
            'footerhtml' => ($footerhtml)
        ]);
        
       // dd($this->data['selectedItem']);
        
        $this->data['selectedItem']['contenidos'] = SlotMailContents::where('slot_mail_id', $id)->get();

        foreach($this->data['selectedItem']['contenidos'] as $contenido){
            $legalesObj         = json_decode(json_decode($contenido->legales));
            $legales_custom     = $legalesObj->legales_custom;

            
        
            $contenido['legaleshtml'] = $legaleshtml;
            $contenido['legales_custom'] = $legales_custom;

            //

            $arrContenidoDecode = (array)json_decode($contenido->contenido);
            
            foreach ($arrContenidoDecode as $itemContenido) {
                if($itemContenido->id == 'contenido_predefinido'){
                    //dd(ContenidoPredefinido::where('id', $itemContenido->predefinido)->get()[0]->contenido);
                  $itemContenido->contenidohtml = ContenidoPredefinido::where('id', $itemContenido->predefinido)->get()[0]->contenido;
                }
            }

            $contenido->contenido = json_encode($arrContenidoDecode);
        }


        $this->data['selectedItem']->contenido = json_encode($arrContenidoDecode);
        $this->data['url_export'] = route('slot-mails.export-html',['id' => $id, 'hijo' => null]);

        
        return view($this->viewPrefix.'show')->with('data', $this->data);

    }

    protected function htmlMadre() {
        
        $footerObj = json_decode(json_decode($this->data['selectedItem']->footer));
        $id_footer = $footerObj->footer;
        $footerhtml = ContenidoPredefinido::where('id', $id_footer)->get()[0]->contenido;
        //
        $id_redes = $footerObj->redes;
        $redeshtml = ContenidoPredefinido::where('id', $id_redes)->get()[0]->contenido;

        $legalesObj         = json_decode(json_decode($this->data['selectedItem']->legales));
        $legales_id         = $legalesObj->legales;    
        $legaleshtml        = ContenidoPredefinido::where('id', $legales_id)->get()[0]->contenido;
        $legales_custom = '';

        data_set($this->data, 'info', (object)[
            'redeshtml' => ($redeshtml),
            'footerhtml' => ($footerhtml),
            'legaleshtml' => ($legaleshtml),
            'legales_custom' => ($legales_custom),
        ]);     
        
        $exportMadre = false;
        $arrContenidoDecode = [];        

        $html = View::make("admin.slot_mails.templates.pieza_madre", [
            'export' => true,
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

        return $html;
    }

    protected function htmlHijo($hijo,$pieza='contenido') {
        //
        //$legales_id         = $legalesObj->legales;        //
        $dataVista = [
            'export' => true
        ];
        
        if ($pieza === 'contenido') {
            $arrContenidoDecode = (array)json_decode($hijo->contenido);
            foreach ($arrContenidoDecode as $itemContenido) {
                if($itemContenido->id == 'contenido_predefinido'){
                    $itemContenido->contenidohtml = ContenidoPredefinido::where('id', $itemContenido->predefinido)->get()[0]->contenido;
                }
               
            }
            $dataVista['contenido'] = $arrContenidoDecode;
            //'contenido' => json_decode($this->data['selectedItem']->contenido),
            //$this->data['selectedItem']->contenido = json_encode($arrContenidoDecode);
    
        } else {
            $legalesObj         = json_decode(json_decode($hijo->legales));
            $legales_custom     = $legalesObj->legales_custom;
            $dataVista['contenido'] = $legalesObj->legales_custom;
    
        }
        
        $html = View::make("admin.slot_mails.templates.inc.$pieza", $dataVista)->render();
    


        return $html;
    }

    public function exportHtml($id, $parte){
        parent::show($id);
        
        
        if ($parte === 'madre') {
            $html = $this->htmlMadre();
            $headers = [
                'Content-type'        => 'text/csv',
                'Content-Disposition' => 'attachment; filename="'.str_slug($this->data['selectedItem']->nombre).'.html"',
            ];
    
    
            return \Response::make($html, 200, $headers);
        } else if ($parte === 'contenido' || $parte === 'todo') {
            $hijos = $this->data['selectedItem']->contenidos;
            
            $carpetaZip = 'tmp/';
            $nombreZip = time() . '_' . $this->data['selectedItem']->id.'_'.str_slug($this->data['selectedItem']->nombre) . '.zip';
            
            $pathZip = public_path($carpetaZip.$nombreZip);
            
            //$ziper = Zipper::make($pathZip);
            $ziper = new Zipper();
            $ziper->make($pathZip);
            foreach($hijos as $hijo) {
                $html = $this->htmlHijo($hijo,'contenido');
                $ziper->addString('cont_'.str_slug($hijo->nombre) . '.html',$html);

                $html = $this->htmlHijo($hijo,'legales');
                $ziper->addString('legales_'.str_slug($hijo->nombre) . '.html',$html);

            }

            if ($parte === 'todo') {
                $html = $this->htmlMadre();
                $ziper->addString(str_slug($this->data['selectedItem']->nombre).'.html',$html);

            }
            
            $ziper->close();            
            $response = response()->download($pathZip);
            
            StorageHelper::eliminar($carpetaZip.$nombreZip,'uploads_local');
            
            return $response;
        }


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
        
        $legalesDefault = ContenidoPredefinido::where('tipo', 'legales')->where('seccion', 's')->where('default',true)->first();
        $footerDefault = ContenidoPredefinido::where('tipo', 'footer')->where('seccion', 's')->where('default',true)->first();
        $redesDefault = ContenidoPredefinido::where('tipo', 'redes')->where('seccion', 's')->where('default',true)->first();

        data_set($this->data,'info',[
            'tipo_footer' => ContenidoPredefinido::where('tipo', 'footer')->where('seccion', 's')->get(),
            'tipo_redes' => ContenidoPredefinido::where('tipo', 'redes')->where('seccion', 's')->get(),
            'tipo_contenido' => ContenidoPredefinido::where('tipo', 'contenido')->where('seccion', 's')->get(),
            'tipo_legales' => ContenidoPredefinido::where('tipo', 'legales')->where('seccion', 's')->get(),
            'templates' => config('constantes.templates',[]),
            'legales_id' => $legalesDefault ? $legalesDefault->id : null,
            'footer_id' => $footerDefault ? $footerDefault->id : null,
            'redes_id' => $redesDefault ? $redesDefault->id : null,
            'tarj_susps' => ContenidoPredefinido::where('tipo', 'suspenso')->where('seccion', 's')->get()
        ]);
        
        
        
        $templateDefault['footer'] = $footerDefault ? '"{\"footer\":\"'.$footerDefault->id.'\",\"redes\":\"'.$redesDefault->id.'\"}"' : null;
      

        $templateDefault['legales'] = '"{\"legales\":\"'.($legalesDefault ? $legalesDefault->id : 0).'\"}"';

        data_set($this->data, 'selectedItem', [
                'id' => 0,
                'template' => $template,
                'publicidad' => $templateDefault['publicidad'],
                'saldo' => $templateDefault['saldo'],
                'contenido' => $templateDefault['contenido'],
                'footer' => $templateDefault['footer'],
                'legales' => $templateDefault['legales'],
                'tipo_footer' => null,
                'tarjeta_susp_id' => null
        ]);

        
        //echo json_encode($templateDefault['contenido']);
        return view($this->viewPrefix.'cu')->with('data',$this->data);
    }

    public function store(CUCustomMailsRequest $request)
    {
        
        try {
            \DB::beginTransaction();;
            
            $model = $this->_store($request, true);
            $uploadPath = env('AMAZON_S3_FOLDER'). '/slot_mail_' .$model->id;

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
        $this->data['selectedItem']->load('grupos.contenidos');
       // $tipo_footer = ContenidoPredefinido::get();

        $footerObj = json_decode(json_decode($this->data['selectedItem']->footer));

        $footer_id = $footerObj->footer;        //
        $id_redes = $footerObj->redes;
        
        if($this->data['selectedItem']->legales){
            $legalesObj         = json_decode(json_decode($this->data['selectedItem']->legales));
            $legales_id         = $legalesObj->legales;    
        }else{
            $legales_id = 0;
        }
       
        data_set($this->data,'info',[
            'link_create' => route('slot-mail-contents.create', ['slot' => $id,'grupo' => '_GRUPOID_']),
            'tipo_footer' => ContenidoPredefinido::where('tipo', 'footer')->where('seccion', 's')->get(),
            'tipo_redes' => ContenidoPredefinido::where('tipo', 'redes')->where('seccion', 's')->get(),
            'tipo_contenido' => ContenidoPredefinido::where('tipo', 'contenido')->where('seccion', 's')->get(),
            'tipo_legales' => ContenidoPredefinido::where('tipo', 'legales')->where('seccion', 's')->get(),
            'redes_id' => $id_redes,
            'footer_id' => $footer_id,
            'legales_id' => $legales_id,
            'templates' => config('constantes.templates',[]),
            'tarj_susps' => ContenidoPredefinido::where('tipo', 'suspenso')->where('seccion', 's')->get()

        ]);

        $this->data['url_contenido_delete'] = route('slot-mail-contents.destroy', ['slot' => '_ID_']);
        $this->data['url_contenido_edit'] = route('slot-mail-contents.edit', ['slot' => '_ID_','grupo' => '_GRUPOID_']);
        $this->data['url_save_grupo'] = route('slot-mails.store-grupo', [$id]);
        $this->data['url_cambiar_valor_grupo'] = route('slot-mails.cambiar-valor-grupo', ['_ID_']);

        $arrContenidoDecode = (array)json_decode($this->data['selectedItem']->contenido);
        
        foreach ($arrContenidoDecode as $itemContenido) {
            if($itemContenido->id == 'contenido_predefinido'){
                $itemContenido->contenidohtml = ContenidoPredefinido::where('id', $itemContenido->predefinido)->get()[0]->contenido;
            }
           
        }

       
        

           
       
        
        $this->data['selectedItem']['contenidos'] = SlotMailContents::where('slot_mail_id', $id)->get();

        $this->data['selectedItem']->contenido = json_encode($arrContenidoDecode);

        return view($this->viewPrefix.'cu')->with('data',$this->data);
        
    }


    public function storeGrupo($id,Request $request)
    {
        
        try {
            \DB::beginTransaction();;

            $grupo = new SlotMailGroups();
            $grupo->fill($request->only(['nombre','tipo']));
            $grupo->slot_mail_id = $id;
            $grupo->order = SlotMailGroups::whereSlotMailId($id)->count() + 1;
            $grupo->save();

            \DB::commit();  
          
            return $this->sendResponse(['url_redirect'=> route('slot-mail-contents.create', ['slot' => $id, 'grupo' => $grupo->id])],trans('admin.success'));        
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e->getMessage());
            throw $e;
        }

        
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
    
    public function clonar($id, Request $request)//padre
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

            //foreach 
            $contenidos = SlotMailContents::where('slot_mail_id', $model->id)->pluck('id')->toArray();

            foreach ($contenidos as $index=>$idHijo) {
               $this->clonarInterno($idHijo, $clonado->id);
            }
            

            \DB::commit();
            return $this->sendResponse($clonado,trans('admin.success'));        
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e->getMessage());
            throw $e;
        }
    }    

    public function clonarInterno($id, $padreId = null, Request $request = null)//hijo
    {
        try {
            \DB::beginTransaction();;
            
            $model = SlotMailContents::find($id);

            if (empty($model)) {
                return $this->sendError('No existe el registro',500);
            }
    
            $clonado = $model->replicate();
            $clonado->nombre.= ' (clonado)';
            if ($padreId){
                $clonado->slot_mail_id = $padreId;
            }
            $clonado->save();

            $uploadPathAnterior = env('AMAZON_S3_FOLDER'). '/slot_mail_' .$model->slot_mail_id;
            $uploadPathNuevo = env('AMAZON_S3_FOLDER'). '/slot_mail_' .$clonado->slot_mail_id;

            if (StorageHelper::existe($uploadPathAnterior)) {
                foreach(StorageHelper::archivos($uploadPathAnterior) as $asset) {
                    $nuevoAsset = str_replace($uploadPathAnterior, $uploadPathNuevo, $asset);
                    if (!StorageHelper::existe($nuevoAsset)) {
                        StorageHelper::copiar($asset,$nuevoAsset);
                    }                    
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

    public function cambiarValorGrupo($grupoId, Request $request)
    {
        logger($grupoId);
        $model = SlotMailGroups::find($grupoId);
        logger($model);
        $model->fill([$request->get('campo') => $request->get('valor')]);
        $model->save();
        return $this->sendResponse($model,trans('admin.success')); 
    }

    protected function _destroy($model)
    {
        if (empty($model)) {
            throw new Exception(trans('admin.not_found'), 1);
        }

        $model->contenidos()->delete();

        $model->delete();
    }    
}
