<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Iva
 * 
 * @property int $id
 * @property float $porcentage
 * @property Carbon $start
 * @property Carbon $end_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Iva extends Model
{
	use SoftDeletes;
	protected $table = 'iva';

	protected $casts = [
		'porcentage' => 'float'
	];

	protected $dates = [
		'start',
		'end_date'
	];

	protected $fillable = [
		'porcentage',
		'start'
	];
}
