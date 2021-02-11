<?php

namespace App\Http\Controllers\Front;

use App\Tags;
use App\Banners;
use App\Ofertas;
use App\Contactos;

use App\Contenidos;
use App\Materiales;
use App\ContenidosTags;
use App\Entrenamientos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Front\SubirFotoRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\Front\GuardarContactoRequest;

class FrontController extends AppBaseController
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

    public function materiales()
    {
        $materiales = Contenidos::get();

        foreach ($materiales as $material) {
            $listTags = ContenidosTags::where('contenido_id', '=', $material->id)->get();
            $tagInContenido = [];
            
            foreach ($listTags as $tag) {
                $tagSelected = Tags::where('id', '=' ,$tag->tag_id)->get();
                array_push($tagInContenido, $tagSelected[0]);
            }
            $material['tags'] = $tagInContenido;
        }
        
        return view('front.materiales', ['materiales' => $materiales]);
    }



    protected function obtenerEstadisticasActuales ($sucursalId) {
        $sql = "SELECT s.id, SUM(cantidad_dispositivos) cantidad_dispositivos, SUM(ventas_cant.cantidad) cantidad_office
            FROM ventas v
            INNER JOIN sucursales s ON v.sucursal_id = s.id
            INNER JOIN (
                SELECT venta_id, SUM(cantidad) cantidad 
                FROM ventas_productos
                GROUP BY venta_id
            ) ventas_cant ON ventas_cant.venta_id = v.id	
            WHERE s.id = {$sucursalId}   
            AND v.deleted_at IS NULL 
            GROUP BY s.id";

        $data = \DB::select($sql);

        if (count($data) > 0) {
            return [
                'cantidad_dispositivos' => (int)$data[0]->cantidad_dispositivos,
                'cantidad_office' => (int)$data[0]->cantidad_office
            ];            
        } else {
            return [
                'cantidad_dispositivos' => 0,
                'cantidad_office' => 0
            ];
        }
        
    }

}
