<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable = [
        'job',
    ];

    public function job() {
        return $this->belongsTo('App\Job');
    }
}
