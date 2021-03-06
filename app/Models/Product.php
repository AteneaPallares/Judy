<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Product
 * 
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $stock
 * @property string|null $cost
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|DetailsOrder[] $details_orders
 * @property Collection|DetailsSale[] $details_sales
 *
 * @package App\Models
 */
class Product extends Model
{
	use  HasFactory,SoftDeletes;
   
	protected $table = 'product';

	protected $casts = [
		'stock' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'stock',
		'img',
		'cost'
	];

	public function details_orders()
	{
		return $this->hasMany(DetailsOrder::class, 'id_product');
	}

	public function details_sales()
	{
		return $this->hasMany(DetailsSale::class, 'id_product');
	}
}
