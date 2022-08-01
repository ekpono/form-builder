<?php

namespace Shopceed\FormBuilder\Models;

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

    const CAT_POST_REVIEW_FOLLOW_UP = 'post_review_follow_up';

    public function store()
    {
        return $this->belongsTo(config('ramaroo.store_model'));
    }

    public function user()
    {
        return $this->belongsTo(config('ramaroo.user_model'));
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
            Template::CAT_PRE_REVIEW,
            Template::CAT_REVIEW,
            //            TODO: Not implemented on the first stage
            //            Template::CAT_REVIEW_FOLLOW_UP,
            //            Template::CAT_POST_REVIEW_FOLLOW_UP,
        ];
    }
}
