<?php

namespace BenditaFome\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Coupon
 * @package BenditaFome\Models
 */
class Coupon extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'code',
        'value',
    ];

    public function order()
    {
        return $this->hasOne(Order::class);
    }

}
