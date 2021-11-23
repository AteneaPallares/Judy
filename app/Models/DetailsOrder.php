<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class DetailsOrder
 * 
 * @property int $id
 * @property float $quantity
 * @property int $price
 * @property int $id_order
 * @property int $id_product
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Order $order
 * @property Product $product
 *
 * @package App\Models
 */
class DetailsOrder extends Model
{
	use SoftDeletes;
	protected $table = 'details_order';

	protected $casts = [
		'quantity' => 'float',
		'price' => 'int',
		'id_order' => 'int',
		'id_product' => 'int'
	];

	protected $fillable = [
		'quantity',
		'price',
		'id_order',
		'id_product'
	];

	public function order()
	{
		return $this->belongsTo(Order::class, 'id_order');
	}

	public function product()
	{
		return $this->belongsTo(Product::class, 'id_product');
	}
}
