<?php

namespace BenditaFome\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Product extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
    ];

    /**
     * Get a category this Product belong
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
