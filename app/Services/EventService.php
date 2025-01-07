<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Support\Facades\Validator;

class EventService
{
    public function validateEventParams($requestData)
    {
        $rule = [
            'id_account' => 'required | int',
            'title' => 'required | string',
            'description' => 'required | string',
            'event_date' => 'required | date',
        ];

        return Validator::make($requestData, $rule);
    }

    public function addEvent($params)
    {
        return Event::create($params);
    }

    public function updateEvent($params, $idAccount)
    {
        return Event::where('id_account', '=', $idAccount)
            ->update($params);
    }

    public function deleteEvent($idEvent)
    {
        return Event::where('id_event', '=', $idEvent)->delete();
    }
}
