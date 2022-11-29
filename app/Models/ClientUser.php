<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ClientUser extends Model
{

    protected $table = 'client_user';
    public $timestamps = true;


    protected $guarded = array('id');
//    public function getActivitylogOptions(): LogOptions
//    {
//        return LogOptions::defaults()
//            ->logUnguarded();
//        // Chain fluent methods for configuration options
//    }

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


}
