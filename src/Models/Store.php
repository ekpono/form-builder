<?php

namespace Shopceed\FormBuilder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
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

    protected $appends = ['brand_logo'];

    public function orders()
    {
        return $this->hasMany(Store::class);
    }

    public function getBrandLogoAttribute()
    {
        $logo = File::where(['catalog' => 'brand_logo', 'store_id' => $this->id])
            ->first();

        if ($logo) {
            return Storage::disk('s3')->url($logo->path);
        }

        return null;
    }
}
