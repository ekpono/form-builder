<?php

namespace Shopceed\FormBuilder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property $type string
 * @property $category string
 * @property $data array
 */
class Template extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['store_id', 'user_id', 'form_id',  'name', 'type', 'category', 'data'];

    protected $casts = ['store_id' => 'integer', 'data' => 'array'];

    const TYPE_EMAIL = 'email';

    const TYPE_SMS = 'sms';

    const CAT_PRE_REVIEW = 'pre_review';

    const CAT_REVIEW = 'review';

    const CAT_REVIEW_FOLLOW_UP = 'review_follow_up';

    const CAT_POST_REVIEW_FOLLOW_UP = 'post_review_follow_up';

    public static function getTypes(): array
    {
        return [
            self::TYPE_EMAIL,
            self::TYPE_SMS,
        ];
    }

    public static function getCategories(): array
    {
        return [
            self::CAT_PRE_REVIEW,
            self::CAT_REVIEW,
            self::CAT_REVIEW_FOLLOW_UP,
            self::CAT_POST_REVIEW_FOLLOW_UP,
        ];
    }
}
