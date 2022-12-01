<?php

namespace App\Http\Controllers;

use App\Cartucho;
use Illuminate\Http\Request;
use DB;
use App\RegistroConsumoToner;
class CartuchoController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try{
        DB::transaction(function() use($request){
          $cartucho=new Cartucho();
          $cartucho->modelo=$request->input('modelo');
          $cartucho->cantidad=$request->input('cantidad');
          $cartucho->cantidadSugerida=$request->input('cantidadSugerida');
          $cartucho->save();
        });
        return response()->json(['ok'=>1]);
      }catch(\Exception $e){
        return response()->json(['error'=>$e->getMessage()]);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cartucho  $cartucho
     * @return \Illuminate\Http\Response
     */
    public function show(Cartucho $cartucho)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cartucho  $cartucho
     * @return \Illuminate\Http\Response
     */
    public function edit(Cartucho $cartucho)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cartucho  $cartucho
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $cartucho=Cartucho::find($request->input('id_cartucho'));
      $relacion=new RegistroConsumoToner();
      $cantidadActual=$cartucho->cantidad;
      try{
        DB::transaction(function() use($request,$cartucho){
          $cartucho->cantidad=$request->input('cantidad');
          $cartucho->cantidadSugerida=$request->input('cantidadSugerida');
          $cartucho->save();
        });
        if(!is_null($request->input('relacion')) && $request->input('relacion')>=1){
          DB::transaction(function() use($request,$relacion,$cartucho,$cantidadActual){
            $relacion->id_impresora_ubicacion=$request->input('relacion');
            $relacion->id_toner=$request->input('id_cartucho');
            $relacion->cantidad = $cantidadActual - $request->input('cantidad');
            $relacion->save();
          });
        }
        return response()->json(["ok"=>1]);
      }catch(\Exception $e){
        return response()->json(["error"=>$e->getMessage()]);
      }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cartucho  $cartucho
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cartucho $cartucho)
    {
        //
    }
}
