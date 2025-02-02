<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\Rutina;
use App\Models\Ejercicio;
use App\Models\Evento;
use App\Models\User;
use App\Models\ClaseUser;
use App\Models\Cliente;
use App\Models\RutinaCliente;

class RutinasController extends Controller
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
    public function rutinas()
    {
        $rutinas = Rutina::all();
        $ejercicios = Ejercicio::all();
        return view('rutinas.listRutinas', compact('rutinas','ejercicios'));
    }

    public function crearRutina(Request $request)
    {
        DB::beginTransaction();
        $nombre = $request->nombre;

        $icono = $request->icono_rutina == null ? 'fas fa-dumbbell' : $request->icono_rutina;

        $ejerciciosRutina = new \stdClass();
        for ($i=1; $i<8 ; $i++) {
            $param_ejercicios = 'ejercicios_dia'.$i;
            $param_repeticiones = 'repeticiones_dia'.$i;

            $ejercicios_dia = $request->$param_ejercicios;
            $repeticiones_dia = $request->$param_repeticiones;

            $cantEjercicios = count($ejercicios_dia);

            $seriesDelDia = array();
            for ($j=0; $j < $cantEjercicios; $j++) {
                $ejercicio = $ejercicios_dia[$j];
                $serie = $repeticiones_dia[$j];

                if (!$ejercicio==null && !$serie==null) {
                    array_push($seriesDelDia, array('ejercicio_id' => $ejercicios_dia[$j], 'repeticiones' => $repeticiones_dia[$j]));
                }
            }
            $ejerciciosRutina->$i = $seriesDelDia;
        }

        try {
            Rutina::create([ 'nombre' => $request->nombre, 'ejercicios' => json_encode($ejerciciosRutina), 'icono' => $icono ]);
            DB::commit();
            return redirect()->route('rutinas')->with('success','La rutina se creó correctamente!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('rutinas')->with('failed','Ocurrió un problema al crear la rutina.');
        }
    }

    public function detalleRutina($id)
    {
        DB::beginTransaction();
        $rutina_id = $id;

        try {
            $rutina = Rutina::where('id',$rutina_id)->firstOrFail();
            $ejercicios = Ejercicio::all();
        } catch (Exception $e) {
            return redirect()->back();
        }

        return view('rutinas.detalleRutina', compact('rutina','ejercicios'));
    }

    public function editarRutina(Request $request, $id)
    {
        DB::beginTransaction();

        $nombre = $request->nombre;
        $icono = $request->icono_rutina == null ? 'fas fa-dumbbell' : $request->icono_rutina;

        $ejerciciosRutina = new \stdClass();
        for ($i=1; $i<8 ; $i++) {
            $param_ejercicios = 'ejercicios_dia'.$i;
            $param_repeticiones = 'repeticiones_dia'.$i;

            $ejercicios_dia = $request->$param_ejercicios;
            $repeticiones_dia = $request->$param_repeticiones;

            $ejercicios_dia = $ejercicios_dia==null ? [] : $ejercicios_dia;

            $cantEjercicios = count($ejercicios_dia);

            $seriesDelDia = array();
            for ($j=0; $j < $cantEjercicios; $j++) {
                $ejercicio = $ejercicios_dia[$j];
                $serie = $repeticiones_dia[$j];

                if (!$ejercicio==null && !$serie==null) {
                    array_push($seriesDelDia, array('ejercicio_id' => $ejercicios_dia[$j], 'repeticiones' => $repeticiones_dia[$j]));
                }
            }
            $ejerciciosRutina->$i = $seriesDelDia;
        }

        try {
            Rutina::where('id',$id)->update([ 'nombre'=>$nombre, 'ejercicios' => json_encode($ejerciciosRutina), 'icono' => $icono ]);
            $rutina = Rutina::where('id',$id)->firstOrFail();
            $ejercicios = Ejercicio::all();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back();
        }
        return redirect()->route('rutinas')->with('success','La rutina se edito correctamente!');
        //return view('rutinas.detalleRutina')->with('rutina',$rutina)->with('ejercicios',$ejercicios)->with('success','La rutina se edito correctamente!');
        //return view('rutinas.detalleRutina', compact('rutina','ejercicios'))->with('success','La rutina se edito correctamente!');
    }

    public function eliminarRutina(Request $request, $id){
        try {
            Rutina::where('id', $id)->delete();
            RutinaCliente::where('id_rutina', $id)->delete();
        } catch (Exception $e) {
            return 'error';
        }
    }

    public function rutinaCliente()
    {
        $clientes = Cliente::all();
        $rutinas = Rutina::all();
        return view('rutinas.rutinaCliente')->with('rutinas', $rutinas)->with('clientes', $clientes);
    }
    public function agregarClienteRutina(Request $request)
    {
        $clienterutina = RutinaCliente::where('id_rutina',$request->rutina)->get();
        if ( count($clienterutina) == 0 )
        {
            RutinaCliente::create([ 'id_rutina' => $request->rutina , 'id_clientes' => json_encode([$request->cliente]) , 'cant_inscriptos' => 1]);
            return redirect()->route('rutinaCliente')->with('success','El cliente se agrego correctamente!');
        }
        else
        {
            $arrayusers = json_decode(($clienterutina[0])->id_clientes);
            if(in_array($request->cliente ,$arrayusers))
            {
                return redirect()->route('rutinaCliente')->with('failed','El cliente ya esta en la rutina!');
            }
            else
            {
                array_push($arrayusers, $request->cliente);
                RutinaCliente::where('id_rutina',$request->rutina)->update([ 'id_rutina' => $request->rutina , 'id_clientes' => json_encode($arrayusers) , 'cant_inscriptos' => (($clienterutina[0])->cant_inscriptos+1)  ]);
                return redirect()->route('rutinaCliente')->with('success','El cliente se agrego correctamente!');
            }
        }
    }

}