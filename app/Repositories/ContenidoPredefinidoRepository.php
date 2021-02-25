<?php

namespace App\Repositories;

use App\ContenidoPredefinido;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContenidoPredefinidoRepository
 * @package App\Repositories
 * @version February 19, 2021, 9:28 am -03
 *
 * @method ContenidoPredefinido findWithoutFail($id, $columns = ['*'])
 * @method ContenidoPredefinido find($id, $columns = ['*'])
 * @method ContenidoPredefinido first($columns = ['*'])
*/
class ContenidoPredefinidoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'tipo',
        'imagen',
        'contenido'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContenidoPredefinido::class;
    }
}
