<?php

namespace Shopceed\FormBuilder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['store_id', 'external_id', 'name', 'data', 'payload'];

    protected $casts = ['data' => 'array', 'payload' => 'array'];
}