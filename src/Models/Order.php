<?php

namespace Shopceed\FormBuilder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @property $data array
 * @property $limits array
 * @property $payload array
 */
class Order extends Model
{
    use HasFactory, Notifiable;

    const STATUS_NEW = 'new';

    public function store(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function lineItems()
    {
        return $this->hasMany(OrderLineItem::class, 'external_id', 'external_id');
    }

    public function getDataAttribute()
    {
        $items = [];
        $data = json_decode($this->attributes['data'], true);
        foreach ($data['line_items'] as $item) {
            $setImage = false;
            if (class_exists('App\Models\Product')) {
                $product = \App\Models\Product::query()->where('external_id', $item['external_product_id'])->first();
                if ($product) {
                    $item['image'] = $product->main_image_url;
                    $setImage = true;
                }
            }

            if (! $setImage) {
                $item['image'] = 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';
            }

            array_push($items, $item);
        }

        $data['line_items'] = $items;

        return json_encode($data);
    }

}
