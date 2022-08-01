<?php

namespace Shopceed\FormBuilder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shopceed\FormBuilder\Events\StoreCreated;

/**
 * @property int workspace_id
 * @property int identity_id
 * @property string domain
 * @property string currency_code
 * @property bool has_sms
 */
class Store extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['workspace_id', 'identity_id', 'domain', 'currency_code', 'has_sms', 'settings'];

    protected $casts = ['settings' => 'array'];

    protected $dispatchesEvents = [
        'created' => StoreCreated::class,
    ];

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }

    public function identity(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Identity::class);
    }

    public function orders()
    {
        return $this->hasMany(Store::class);
    }
}
