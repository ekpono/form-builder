<?php

namespace Shopceed\FormBuilder\Models;

use Shopceed\FormBuilder\Helpers\FormBuilderHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = ['store_id', 'user_id', 'name', 'type', 'category', 'data', 'snapshot', 'google_sheet_id'];

    protected $casts = ['store_id' => 'integer', 'data' => 'array', 'snapshot' => 'array'];

    const TYPE_PRODUCTS = 'products';

    const TYPE_COMPANY = 'company';

    const CAT_PRE_REVIEW = 'pre_review';

    const CAT_REVIEW = 'review';

    const CAT_REVIEW_FOLLOW_UP = 'review_follow_up';

    public static function boot()
    {
        parent::boot();

        self::creating(FormBuilderHelper::onCreated());
    }
    public function store()
    {
        return $this->belongsTo(config('form-builder.store_model'));
    }

    public function user()
    {
        return $this->belongsTo(config('form-builder.user_model'));
    }

    public static function getTypes(): array
    {
        return [
            self::TYPE_PRODUCTS,
            self::TYPE_COMPANY,
        ];
    }

    public static function getCategories(): array
    {
        return [
//            self::CAT_PRE_REVIEW,
            self::CAT_REVIEW,
            //            TODO: Not implemented on the first stage
            //            Template::CAT_REVIEW_FOLLOW_UP,
            //            Template::CAT_POST_REVIEW_FOLLOW_UP,
        ];
    }
}
