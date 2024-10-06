<?php

namespace App\Http\Controllers;

use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;


class Calendario extends Controller
{
    public function crearEvento(Request $request)
    {

        try {
            $validator = $request->validate([
                'name' => 'required|string',
                'startDateTime' => 'required|date',
                'endDateTime' => 'required|date|after:startDateTime',
            ]);

            $event = Event::create([
                'name' => $validator['name'],
                'startDateTime' => Carbon::parse($validator['startDateTime']),
                'endDateTime' => Carbon::parse($validator['endDateTime'])
            ]);

            return response()->json([
                'evento' => $event
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Error de validación de los datos para registrar su evento ',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error de al registrar el evento ',
                'message' => $e->getMessage()
            ]);
        }
    }
}
