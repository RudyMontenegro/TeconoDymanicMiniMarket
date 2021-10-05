<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $date = Carbon::now();

        $limite_semana =  $date->addDay(7)->format('Y-m-d');
        $limite_mes =  $date->addMonth(2)->format('Y-m-d');
        $hoy = Carbon::now();

        $semana = DB::table('productos')
                    ->select('*')
                    ->where('fecha_vencimiento','>=',$hoy)
                    ->where('fecha_vencimiento','<=',$limite_semana)
                    ->where('bandera','=',2)
                    ->get();

                    
        $mes = DB::table('productos')
                    ->select('*')
                    ->where('fecha_vencimiento','>=',$hoy)
                    ->where('fecha_vencimiento','<=',$limite_mes)
                    ->where('bandera','=',3)
                    ->get();
                    
        $stock = DB::table('productos')
                    ->select('*')
                    ->where('cantidad','<',5)
                    ->get();

            return view('home',compact('stock','semana','mes'));
        
    }
}
