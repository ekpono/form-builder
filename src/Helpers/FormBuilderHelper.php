<?php

namespace Shopceed\FormBuilder\Helpers;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class FormBuilderHelper
{
    /**
     * Set default values when new form builder is created
     *
     * @return Closure
     */
    public static function onCreated()
    {
        return static function (Model $model) {
            $model->uuid = Uuid::uuid4();
        };
    }
}
