<?php

namespace App\Traits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait UtilityTrait
{
    public static function bootUtilityTrait()
    {
        static::deleting(function (Model $model) {           
            if (Auth::check()) {
                $model->deleted_by_id = Auth::id();
                $model->save();
            }
        });
    }

   
}
