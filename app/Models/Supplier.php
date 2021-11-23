<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Supplier
 * 
 * @property int $id
 * @property string $name
 * @property string|null $enterprise
 * @property string|null $phone
 * @property string|null $email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 */
class Supplier extends Model
{
	use SoftDeletes;
	protected $table = 'supplier';

	protected $fillable = [
		'name',
		'enterprise',
		'phone',
		'email'
	];

	public function orders()
	{
		return $this->hasMany(Order::class, 'id_supplier');
	}
}
