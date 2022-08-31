<?php

namespace Shopceed\FormBuilder\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderLineItem extends Model
{
    use SoftDeletes;

    /**
     * The 'type' of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var string[]
     */
    protected $casts = [
        'data' => 'json',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'store_id',
        'linked_order',
        'linked_product',
        'external_id',
        'product_id',
        'name',
        'quantity',
        'total',
        'price',
        'data',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @return BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'linked_order');
    }

    /**
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'linked_product');
    }

    /**
     * @return BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}