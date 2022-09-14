<?php

namespace Shopceed\FormBuilder\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ramsey\Uuid\Uuid;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class FormAnswer extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';

    public $incrementing = false;

    protected $fillable = ['form_uuid', 'order_uuid', 'answers', 'order_items', 'params', 'finished_at', 'uuid'];

    protected $casts = ['form_uuid' => 'string', 'order_uuid' => 'string', 'answers' => 'array', 'order_items' => 'array', 'params' => AsArrayObject::class];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Uuid::uuid4();
            }
        });
    }

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
