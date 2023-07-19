<?php

namespace App\Repositories;


use App\Configuraciones;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AlertasRepository
 * @package App\Repositories
 * @version November 13, 2020, 10:07 am -03
 *
 * @method Alertas findWithoutFail($id, $columns = ['*'])
 * @method Alertas find($id, $columns = ['*'])
 * @method Alertas first($columns = ['*'])
*/
class ConfiguracionesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'clave' => 'like'
    ];

    public function getCredencialesS3() {
        return \Cache::rememberForever('config:S3', function () {
            return $this->model->newQuery()->whereIn('clave',['AMAZON_S3_KEY','AMAZON_S3_SECRET'])->pluck('valor','clave')->toArray();
        });
    }

    public function setCredencialesS3($data) {
        $this->model->newQuery()->where('clave','AMAZON_S3_KEY')->update([
            'valor' => $data['AMAZON_S3_KEY'],
        ]);
        $this->model->newQuery()->where('clave','AMAZON_S3_SECRET')->update([
            'valor' => $data['AMAZON_S3_SECRET'],
        ]);        
        \Cache::forget('config:S3');
    }

    

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Configuraciones::class;
    }
}
