<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'id_event';
    protected $fillable = [
        'id_account',
        'title',
        'description',
        'event_date'
    ];
}
