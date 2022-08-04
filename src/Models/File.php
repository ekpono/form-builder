<?php

namespace Shopceed\FormBuilder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class File extends Model
{
    use HasFactory;

    protected $fillable = ['store_id', 'user_id', 'extension', 'disk', 'path', 'content_type', 'catalog'];

    protected $casts = [
        'store_id' => 'integer', 'user_id' => 'integer', 'extension' => 'string', 'path' => 'string', 'disk' => 'string',
        'content_type' => 'string', 'catalog' => 'string',
    ];
}
