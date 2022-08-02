<?php

namespace Shopceed\FormBuilder\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Shopceed\FormBuilder\Models\Store;

class Identity extends Model
{
    use HasFactory;

    const PROVIDER_SHOPIFY = 'shopify';

    const PROVIDER_WOOCOMMERCE = 'woocommerce';

    protected $fillable = ['user_id', 'provider', 'domain', 'data'];

    protected $casts = [
        'user_id' => 'integer',
        'data' => 'array',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function store(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Store::class);
    }
}
