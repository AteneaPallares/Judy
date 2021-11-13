<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sale
 * 
 * @property int $id
 * @property int $id_employee
 * @property int $id_client
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|DetailsSale[] $details_sales
 *
 * @package App\Models
 */
class Sale extends Model
{
	protected $table = 'sales';

	protected $casts = [
		'id_employee' => 'int',
		'id_client' => 'int'
	];

	protected $fillable = [
		'id_employee',
		'id_client'
	];

	public function details_sales()
	{
		return $this->hasMany(DetailsSale::class, 'id_sales');
	}
}
