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

    const STATUS_PROCESSING = 'processing';

    const STATUS_ON_HOLD = 'on_hold';

    const STATUS_IN_AUTOMATION = 'in_automation';

    const STATUS_PENDING_INPUT = 'pending_input';

    const STATUS_SUSPENDED = 'suspended';

    const STATUS_REVIEWED = 'reviewed';

    const STATUS_REVIEWED_PARTIALLY = 'reviewed_partially';

    const FLOW_STATUS_PENDING_INPUT_PRE_REVIEW = 'pending_input_pre_review';

    const FLOW_STATUS_PENDING_INPUT_REVIEW = 'pending_input_review';

    const FLOW_STATUS_PENDING_INPUT_FOLLOW_UP_REVIEW = 'pending_input_follow_up_review';

    const FLOW_STATUS_PENDING_INPUT_POST_REVIEW = 'pending_input_post_review';

    public function store(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Store::class);
    }


}
