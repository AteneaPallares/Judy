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
 * Class Order
 * 
 * @property int $id
 * @property int $id_employee
 * @property int $id_supplier
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Supplier $supplier
 * @property Collection|DetailsOrder[] $details_orders
 *
 * @package App\Models
 */
class Order extends Model
{
	use SoftDeletes;
	protected $table = 'order';

	protected $casts = [
		'id_employee' => 'int',
		'id_supplier' => 'int'
	];

	protected $fillable = [
		'id_employee',
		'id_supplier'
	];

	public function employee()
	{
		return $this->belongsTo(User::class, 'id_employee');
	}

	public function supplier()
	{
		return $this->belongsTo(Supplier::class, 'id_supplier');
	}

	public function details_orders()
	{
		return $this->hasMany(DetailsOrder::class, 'id_order');
	}
}
