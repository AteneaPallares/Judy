<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Client
 * 
 * @property int $id
 * @property string $name
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Client extends Model
{
	use HasFactory,SoftDeletes;
	
	protected $table = 'client';

	protected $fillable = [
		'name',
		'address',
		'phone',
		'email'
	];
	public function sales()
	{
		return $this->hasMany(Sale::class, 'id_client');
	}
}
