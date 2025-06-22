<?php

namespace App\Services;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

class GoogleCalendarService
{
    protected $calendarId = 'primary'; // o el ID de un calendario compartido

    public function createEvent(array $data)
    {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('app/google/calendar-credentials.json'));
        $client->addScope(Google_Service_Calendar::CALENDAR);
        $client->setAccessType('offline');

        $service = new Google_Service_Calendar($client);

        $event = new Google_Service_Calendar_Event([
            'summary'     => 'Cita médica con ' . $data['paciente'],
            'location'    => 'Consultorio Coral Kids',
            'description' => $data['motivo'],
            'start' => [
                'dateTime' => $data['fecha'].'T'.$data['hora'],
                'timeZone' => 'America/Lima',
            ],
            'end' => [
                'dateTime' => \Carbon\Carbon::parse($data['fecha'].' '.$data['hora'])->addMinutes(30)->format('Y-m-d\TH:i:s'),
                'timeZone' => 'America/Lima',
            ],
            'attendees' => [
                ['email' => $data['email']],
            ],
            'reminders' => [
                'useDefault' => false,
                'overrides' => [
                    ['method' => 'email', 'minutes' => 24 * 60], // 24h antes
                    ['method' => 'popup', 'minutes' => 10],
                ],
            ],
        ]);

        return $service->events->insert($this->calendarId, $event);
    }
}