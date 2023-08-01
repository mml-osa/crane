<?php

namespace App\Console\Commands\Traits;

use Illuminate\Console\Command;

use Ramsey\Uuid\Uuid;

trait uuidGenerator
{
    public function getIncrementing()
    { return false; }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }
}
