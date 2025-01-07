<?php

namespace Tests\Feature\Controllers;

use App\Models\Account;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventControllerTest extends TestCase
{
    protected $seeders = [
        \AccountSeeder::class,
    ];
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAddEvent()
    {
        $account = Account::find(1);
        $token = $this->getAccessToken($account);
        $params = [
            'title' => 'Test Title',
            'description' => 'Test Description',
            'event_date' => '2024-01-01',
        ];

        $response = $this->withToken($token, 'Bearer')
            ->json('POST', '/api/event', $params);

        $response->assertStatus(200);

        $event = Event::find($account->id_account);
        $this->assertEquals($params['title'], $event->title);
        $this->assertEquals($params['description'], $event->description);
        $this->assertEquals($params['event_date'], $event->event_date);
    }

    public function testUpdateEvent()
    {
        $account = Account::find(1);

        $event = [
            'id_account' => $account->id_account,
            'title' => 'Test Title',
            'description' => 'Test Description',
            'event_date' => '2024-01-01',
        ];
        $event = Event::create($event);

        $token = $this->getAccessToken($account);

        $params = [
            'title' => 'Test Title after',
            'description' => 'Test Description after',
            'event_date' => '2024-01-02',
        ];

        $response = $this->withToken($token, 'Bearer')
            ->json('PATCH', '/api/event/', $params);

        $response->assertStatus(200);

        $this->assertEquals($params['title'], $event->refresh()->title);
        $this->assertEquals($params['description'], $event->refresh()->description);
        $this->assertEquals($params['event_date'], $event->refresh()->event_date);
    }
}
