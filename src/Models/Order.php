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

    public function store(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
