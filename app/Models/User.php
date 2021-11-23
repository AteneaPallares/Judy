<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
   
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
}
