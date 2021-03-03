<?php

namespace App;

use App\Traits\UploadableTrait;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Yajra\Auditable\AuditableTrait;
//use Dimsav\Translatable\Translatable;

/**
 * Class CustomMails
 * @package App
 * @version February 17, 2021, 12:46 pm -03
 *
 * @property string nombre
 * @property boolean publicidad
 * @property string template
 */
class CustomMails extends Model
{
    use SoftDeletes;

    use AuditableTrait;
    //use Translatable;
    //use UploadableTrait;

    public $table = 'custom_mails';
    
    /**
     * Translatable
     */

    //public $translatedAttributes = ['name'];

    /**
     * Uploadable
     *
     * files, targetDir, tmpDir, disk
     */

    //public $files = ['the_file'];
    //public $targetDir = 'custom_mails';


    
    
    protected $dates = ['deleted_at'];

    
    public $fillable = [
        'nombre',
        'publicidad',
        'saldo',
        'template',
        'contenido',
        'footer',
        'legales',
        //'enabled'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nombre' => 'string',
        'publicidad' => 'boolean',
        'saldo' => 'boolean',
        'template' => 'string',
        'contenido' => 'string',
        'footer' => 'text',
        'legales' => 'text',
        //'enabled' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'publicidad' => 'boolean',
        'saldo' => 'boolean',
        'template' => 'required',
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
