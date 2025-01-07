<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Services\EventService;
use Illuminate\Http\Request;
use Mockery\Exception;

class EventController extends Controller
{
    public function addEvent(Request $request)
    {
        $eventService = new EventService();

        $validate = $eventService->validateEventParams($request->all());

        if ($validate->fails()) {
            throw new Exception('Invalid request parameters.');
        }

        $idAccount = $request->id_account;
        $account = Account::find($idAccount);

        if (!$account) {
            throw new Exception('Account not found.');
        }

        $createData = [
            'id_account' => $idAccount,
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date
        ];

        return $eventService->addEvent($createData);
    }

    public function updateEvent(Request $request)
    {
        $eventService = new EventService();

        $validate = $eventService->validateEventParams($request->all());

        if ($validate->fails()) {
            throw new Exception('Invalid request parameters.');
        }

        $idAccount = $request->id_account;
        $account = Account::find($idAccount);

        if (!$account) {
            throw new Exception('Account not found.');
        }

        $updateData = [
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date
        ];

        return $eventService->updateEvent($updateData, $idAccount);
    }
}
