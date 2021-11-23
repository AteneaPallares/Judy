<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;
   
    protected $casts = [
		'id_role' => 'int'
	];

	protected $dates = [
		'birthdate',
		'startwork',
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'address',
		'phone',
		'img',
		'gender',
		'status',
		'birthdate',
		'email_verified_at',
		'password',
		'id_role',
		'remember_token'
	];
	public function getStatusAttribute($value)
    {
		if($value==0){
			return "Activo";
		}
		if($value==1){
			return "Despedido";
		}
		if($value==2){
			return "Retirado";
		}
    }
	public function setStatusAttribute($value)
    {
		if($value=="Activo"){
			$this->attributes['status'] = 0;
		}
		if($value=="Despedido"){
			$this->attributes['status'] = 1;
		}
		if($value=="Retirado"){
			$this->attributes['status'] = 2;
		}
    }
	public function role()
	{
		return $this->belongsTo(Role::class, 'id_role');
	}
    public function getrole()
    {
        $val=$this->role()->first();
		return $val->name;
    }

	public function orders()
	{
		return $this->hasMany(Order::class, 'id_employee');
	}
	public function sales()
	{
		return $this->hasMany(Sale::class, 'id_employee');
	}
}
