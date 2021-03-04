<?php

namespace App;

use App\Traits\UploadableTrait;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Yajra\Auditable\AuditableTrait;
//use Dimsav\Translatable\Translatable;

/**
 * Class ContenidoPredefinido
 * @package App
 * @version February 19, 2021, 9:28 am -03
 *
 * @property string nombre
 * @property string tipo
 * @property string imagen
 * @property string contenido
 */
class ContenidoPredefinido extends Model
{
    use SoftDeletes;

    use AuditableTrait;
    //use Translatable;
    use UploadableTrait;

    public $table = 'contenido_predefinidos';
    
    /**
     * Translatable
     */

    //public $translatedAttributes = ['name'];

    /**
     * Uploadable
     *
     * files, targetDir, tmpDir, disk
     */

    public $files = ['imagen'];
    public $targetDir = 'contenido-predefinidos';


    
    
    protected $dates = ['deleted_at'];

    
    public $fillable = [
        'nombre',
        'tipo',
        'imagen',
        'contenido',
        'default',
        //'enabled'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nombre' => 'string',
        'tipo' => 'string',
        'imagen' => 'string',
        'contenido' => 'string',
        'default' => 'boolean',
        //'enabled' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'tipo' => 'required',
        //'enabled' => 'boolean'
    ];

    /**
     * Appends Attributes
     *
     * @var array
     */
    //protected $appends = ['the_file_url'];

    /*public function getTheFileUrlAttribute($value) 
    {
        return \FUHelper::fullUrl($this->targetDir,$this->the_file);
    }*/   


    protected $appends = ['imagen_url'];

    public function getImagenUrlAttribute($value) 
    {
        return $this->imagen ? \FUHelper::fullUrl($this->targetDir,$this->imagen) : null;
    }

    protected static function boot()
    {
        parent::boot();

        /*static::deleted(function ($model) 
        {
            $model->deleteTranslations();
            $model->name = $model->id . '_' . $model->name;
            $model->save();
        });*/        
    }    

}
