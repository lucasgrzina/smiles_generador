<?php

namespace App;


use Yajra\Auditable\AuditableTrait;
use Illuminate\Notifications\Notifiable;
use App\Notifications\NotificacionRegistro;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\MailRequestPasswordToken;
use App\Notifications\NotificacionRegistroConfirmado;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Registrado extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    use AuditableTrait;

    protected $guard = 'web';
    public $table = 'registrados';

    protected $dates = ['deleted_at', 'last_login_at'];

    public $fillable = [
        'nombre',
        'apellido',
        'email',
        'pais_id',
        'password',
        'confirmado',
        'cliente_intcomex',
        'empresa',
        'telefono_fijo',
        'telefono_celular',
        'enabled',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'enabled' => 'boolean',
        'confirmado' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:100',
        'apellido' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:registrados,email,{:id},id',
        'password' => 'required_if:id,0|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/'
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = \Hash::make($password);
    }

    public function sendPasswordResetNotification($clave)
    {
        try {
            $this->notify(new MailRequestPasswordToken($clave,$this));
        } catch (\Exception $e) {
            \Log::error('*******SEND EMAIL ERROR: ' . $e->getMessage());
        }
    }

    public function enviarNotificacionRegistro()
    {
        try {
            $this->notify(new NotificacionRegistro($this));
        } catch (\Exception $e) {
            \Log::error('*******SEND EMAIL ERROR: ' . $e->getMessage());
        }
    }
    public function enviarNotificacionRegistroConfirmado()
    {
        try {
            $this->notify(new NotificacionRegistroConfirmado($this));
        } catch (\Exception $e) {
            \Log::error('*******SEND EMAIL ERROR: ' . $e->getMessage());
        }
    }
    /*public function setUsuarioAttribute($value)
    {
        $this->attributes['usuario'] = $this->attributes['email'];
    }*/

    public function pais()
    {
        return $this->belongsTo('App\Paises', 'pais_id');
    } 


    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($model) {
            $model->email = $model->id . '_' . $model->email;
            //$model->usuario = $model->id . '_' . $model->usuario;
            $model->save();
        });
    }
}
