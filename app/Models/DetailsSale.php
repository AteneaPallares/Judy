<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class DetailsSale
 * 
 * @property int $id
 * @property float $cost
 * @property int $quantiy
 * @property int $id_sales
 * @property int $id_product
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Product $product
 * @property Sale $sale
 *
 * @package App\Models
 */
class DetailsSale extends Model
{
	use SoftDeletes;
	protected $table = 'details_sales';

	protected $casts = [
		'cost' => 'float',
		'quantiy' => 'int',
		'id_sales' => 'int',
		'id_product' => 'int'
	];

	protected $fillable = [
		'cost',
		'quantiy',
		'id_sales',
		'id_product'
	];

	public function product()
	{
		return $this->belongsTo(Product::class, 'id_product');
	}

	public function sale()
	{
		return $this->belongsTo(Sale::class, 'id_sales');
	}
}
