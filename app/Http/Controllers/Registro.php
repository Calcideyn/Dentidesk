<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingreso;
use App\Models\Egreso;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class Registro extends Controller
{

    public function index()
    {
        $ingresos = Ingreso::all();
        $egresos = Egreso::all();
        $total_ingresos = Ingreso::select(DB::raw('MONTH(fecha_ingreso) as mes'), DB::raw('SUM(monto_ingreso) as total'))
            ->groupBy('mes')
            ->get();
        $total_egresos = Egreso::select(DB::raw('MONTH(fecha_egreso) as mes'), DB::raw('SUM(monto_egreso) as total'))
            ->groupBy('mes')
            ->get();

        $total_ingresos_json = collect(json_decode($total_ingresos, true));
        $total_egresos_json = collect(json_decode($total_egresos, true));
        $union_ingreso_egreso = $total_ingresos_json->merge($total_egresos_json);
        $meses_total = $union_ingreso_egreso->pluck('mes')->unique();
        $meses_unicos = $meses_total->all();
        return view('index', compact(['ingresos', 'egresos', 'total_ingresos', 'total_egresos', 'meses_unicos']));


    }
    public function create(Request $request)
    {
        if ($request->Tipo_Movimiento == 1) {
            $ingreso = new Ingreso();
            $ingreso->fecha_ingreso = $request->Fecha;
            $ingreso->descripcion_ingreso = $request->Descripcion;
            $ingreso->monto_ingreso = $request->Monto;
            $ingreso->save();
            Alert::success(session('success', 'El Ingreso se realizo correctamente'));
        } elseif ($request->Tipo_Movimiento == 2) {
            $egresos = new Egreso();
            $egresos->fecha_egreso = $request->Fecha;
            $egresos->descripcion_egreso = $request->Descripcion;
            $egresos->monto_egreso = $request->Monto;
            $egresos->save();
            Alert::success(session('success', 'El Egreso se realizo correctamente'));

        }
        return redirect('/');
    }

}