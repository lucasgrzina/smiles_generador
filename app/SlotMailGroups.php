<?php

namespace App;

use App\Traits\UploadableTrait;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Yajra\Auditable\AuditableTrait;
//use Dimsav\Translatable\Translatable;

/**
 * Class SlotMailContents
 * @package App
 * @version February 17, 2021, 12:46 pm -03
 *
 * @property string nombre
 * @property boolean publicidad
 * @property string template
 */
class SlotMailGroups extends Model
{
    //use SoftDeletes;

    //use AuditableTrait;
    //use Translatable;
    //use UploadableTrait;

    public $table = 'slot_mail_groups';
    
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
    //public $targetDir = 'slot_mail_contents';


    
    
    //protected $dates = ['deleted_at'];

    
    public $fillable = [
        'nombre',
        'slot_mail_id',
        'tipo',
        'order',
        //'enabled'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nombre' => 'string',
        'slot_mail_id' => 'integer',
        'tipo' => 'string',
        'order' => 'integer',
        //'enabled' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required'
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

    public function contenidos()
    {
        
        return $this->hasMany('App\SlotMailContents', 'slot_mail_group_id');
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
