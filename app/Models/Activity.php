<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Activity extends \Spatie\Activitylog\Models\Activity
{
    public function causer(): MorphTo
    {
        return $this->morphTo()->withoutGlobalScope(SoftDeletingScope::class);
    }
}
