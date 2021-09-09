<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function clases()
    {
        return view('clases');
    }
    public function cargarClase(Request $request)
    {
        // $randColor = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        $randColor = "fc-event-solid-primary";
        return Evento::create([ 'title' => $request->title , 'day' => $request->daysOfWeek , 'start' => $request->startTime, 'end' => $request->endTime , 'color' => $randColor]);
    }

    public function clasesCargadas()
    {
        $query = Evento::all();
        $responseQuery = array();
        foreach ($query as $clase) {
            array_push($responseQuery, ["id" => strval($clase->id) , "title" => $clase->title, "startTime" => $clase->start, "endTime" => $clase->end, "daysOfWeek" => $clase->day, "className" => $clase->color]);
        }
        return response()->json($responseQuery);
        /*return response()->json([["id" => "2312" , "title" => "my event", "start" => "2021-09-09T09:00:00", "end" => "2021-09-09T10:00:00"],["id" => "2311" , "title" => "my event1", "startTime" => "9:00:00", "endTime" => "10:00", "daysOfWeek" => "6", "color" => "yellow"]]);*/
    }

    public function landing()
    {
        return 'landing';
    }

    public function welcome()
    {
        return view('test');
    }

    public function perfil()
    {
        return view('perfil');
    }
    public function modificar()
    {
        return view('modificar');
    }
}
