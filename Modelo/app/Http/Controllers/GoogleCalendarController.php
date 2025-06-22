<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

class GoogleCalendarController extends Controller
{
    $client = new Google_Client();
    $client->setAuthConfig(storage_path('app/google/credentials.json'));
    $client->addScope(Google_Service_Calendar::CALENDAR);
    $client->setAccessType('offline');
    $client->setSubject('tucuenta@gmail.com'); // cuenta del doctor o consultorio

    $service = new Google_Service_Calendar($client);

    $event = new Google_Service_Calendar_Event([
        'summary' => 'Cita médica con '.$cita->paciente->nombre,
        'location' => 'Consultorio Coral Kids',
        'description' => 'Consulta pediátrica',
        'start' => [
            'dateTime' => $cita->fecha.'T'.$cita->hora.':00',
            'timeZone' => 'America/Lima',
        ],
        'end' => [
            'dateTime' => Carbon::parse($cita->fecha.' '.$cita->hora)->addMinutes(30)->format('Y-m-d\TH:i:s'),
            'timeZone' => 'America/Lima',
        ],
        'attendees' => [
            ['email' => $cita->paciente->email],
        ],
        'reminders' => [
            'useDefault' => false,
            'overrides' => [
                ['method' => 'email', 'minutes' => 24 * 60], // 24h antes
                ['method' => 'popup', 'minutes' => 10],
            ],
        ],
    ]);

    $calendarId = 'primary';
    $service->events->insert($calendarId, $event);
}