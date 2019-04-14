<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contacto;
use App\Correo;
use App\Telefono;
use App\Direccion;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use File;
use Session;


class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contactos = DB::table('contactos')
        ->paginate(6);
        //$contactos = Contacto::all();
        return view('indexContacto',compact('contactos'));
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
        //
        //echo "si llega";
        $contacto = new Contacto();
        $contacto->nombre = $request->input('nombre');
        $contacto->apellido_p = $request->input('ap');
        $contacto->apellido_m = $request->input('am');
        $contacto->fnac = $request->input('fnac');
        $contacto->alias = $request->input('alias');
        $contacto->save();

        $Ulcontact = DB::table('contactos')
                ->orderBy('id', 'desc')
                ->first();
        
        //echo $Ulcontact->id;
            
            $telefonos = $request->input('tel');
            $etTel = $request->input('ettel');
            $length = count($telefonos);
            if($length>0){
                    for($i=0;$i<$length;$i++){
                        if($telefonos[$i] != ""){
                            DB::table('telefonos')
                            ->insert([
                            'etiqueta'=>$etTel[$i],
                            'telefono'=>$telefonos[$i],
                            'contactos_id'=>$Ulcontact->id,
                        ]);
                        }
                    }
                }

        
        
        if( $request->input('correo') != ""){
            //echo ($request->input('correo'));
            $correos =$request->input('correo');
            $correoArr = explode(",", $correos);
            //print_r($correoArr);
            $length = count($correoArr);
            if($length>0){
                for($i=0;$i<$length;$i++){
                    DB::table('correos')
                    ->insert([
                        'correo'=>$correoArr[$i],
                        'contactos_id'=>$Ulcontact->id,
                    ]);
                    }
                }

        }

        if( $request->input('direccion') != ""){
            //echo ($request->input('correo'));
            $direcciones =$request->input('direccion');
            $direccionArr = explode(",", $direcciones);
            //print_r($direccionArr);
            $length = count($direccionArr);
            if($length>0){
                for($i=0;$i<$length;$i++){
                    DB::table('direcciones')
                    ->insert([
                        'direccion'=>$direccionArr[$i],
                        'contactos_id'=>$Ulcontact->id,
                    ]);
                    }
                }
        }

        if($request->hasFile('foto')){
            echo "trae foto";
            $ruta="/imgs/users";
            $destinopath=public_path().$ruta;
            $file = $request->file('foto');
            $name = time('T').$file->getClientOriginalName();
            $subir=$file->move($destinopath,$name);
            $imagen=DB::table('contactos')
                    ->where('id', $Ulcontact->id)
                    ->update(['imagen' => $name]);

        }
        
        Session::flash('message','Contacto Agregado');
        return redirect()->route('contacto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $idContacto=$id;

        $contacto = DB::table('contactos')->where('id', $idContacto)
        ->first();

        $correos = DB::select("select * from correos where contactos_id = $idContacto ");
        $dirs = DB::select("select * from direcciones where contactos_id = $idContacto ");

        $telefonos = DB::select("select * from telefonos where contactos_id = $idContacto ");


        return view('edit',compact('contacto','correos','dirs','telefonos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

    }

    public function contactoUpdate(Request $request)
    {
        //
        $id = $request->input('idContacto');
        $contacto = contacto::find($id);
        $contacto->nombre = $request->input('nombre');
        $contacto->apellido_p = $request->input('ap');
        $contacto->apellido_m = $request->input('am');
        $contacto->fnac = $request->input('fnac');
        $contacto->alias = $request->input('alias');
        $contacto->save();

        $Ulcontact = $id;
        
        //echo $Ulcontact->id;
        
            $telefonos = $request->input('tel');
            $etTel = $request->input('ettel');
            $length = count($telefonos);
            if($length>0){
                    for($i=0;$i<$length;$i++){
                        if($telefonos[$i] != ""){
                            DB::table('telefonos')
                            ->insert([
                            'etiqueta'=>$etTel[$i],
                            'telefono'=>$telefonos[$i],
                            'contactos_id'=>$Ulcontact,
                        ]);
                        }
                    }
                }
        
        
        
        if( $request->input('correo') != ""){
            //echo ($request->input('correo'));
            $correos =$request->input('correo');
            $correoArr = explode(",", $correos);
            //print_r($correoArr);
            $length = count($correoArr);
            if($length>0){
                for($i=0;$i<$length;$i++){
                    DB::table('correos')
                    ->insert([
                        'correo'=>$correoArr[$i],
                        'contactos_id'=>$Ulcontact,
                    ]);
                    }
                }

        }

        if( $request->input('direccion') != ""){
            //echo ($request->input('correo'));
            $direcciones =$request->input('direccion');
            $direccionArr = explode(",", $direcciones);
            //print_r($direccionArr);
            $length = count($direccionArr);
            if($length>0){
                for($i=0;$i<$length;$i++){
                    DB::table('direcciones')
                    ->insert([
                        'direccion'=>$direccionArr[$i],
                        'contactos_id'=>$Ulcontact,
                    ]);
                    }
                }
        }

        if($request->hasFile('foto')){
            echo "trae foto";
            $ruta="/imgs/users";
            $destinopath=public_path().$ruta;
            $file = $request->file('foto');
            $name = time('T').$file->getClientOriginalName();
            $subir=$file->move($destinopath,$name);
            $imagen=DB::table('contactos')
                    ->where('id', $Ulcontact)
                    ->update(['imagen' => $name]);

        }
        
        Session::flash('message','Contacto Actualizado');
        return redirect()->route('contacto.index');
        $propiedades->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        echo "si llega";
        $contacto = Contacto::find($id);
        $contacto->delete();

        Session::flash('message','Contacto Eliminado');

        return redirect()->route('contacto.index');
    }

    public function elicontacto($id) {

        DB::table('correos')->where('contactos_id', $id)->delete();
        DB::table('direcciones')->where('contactos_id', $id)->delete();
        DB::table('telefonos')->where('contactos_id', $id)->delete();

        $contacto = Contacto::find($id);

        //eliminamos y redirigimos

        $contacto->delete();

        Session::flash('message','Contacto Borrado Correctamente');

        return redirect()->route('contacto.index');

    }

    public function elicorreo($id) {

        
        $Ulcorreo = DB::table('correos')
                ->where('id',$id)
                ->first();
        $idContacto = $Ulcorreo->contactos_id;
        

        DB::table('correos')->where('id', $id)->delete();
     

        Session::flash('message','Correo Borrado Correctamente');

        return redirect()->route('contacto.edit',['id' => $idContacto]);

    }

    public function elidir($id) {

        
        $Ulcorreo = DB::table('direcciones')
                ->where('id',$id)
                ->first();
        $idContacto = $Ulcorreo->contactos_id;
        

        DB::table('direcciones')->where('id', $id)->delete();
     

        Session::flash('message','Dirección Borrada Correctamente');

        return redirect()->route('contacto.edit',['id' => $idContacto]);

    }

    public function elitel($id) {

        
        $Ulcorreo = DB::table('telefonos')
                ->where('id',$id)
                ->first();
        $idContacto = $Ulcorreo->contactos_id;
        

        DB::table('telefonos')->where('id', $id)->delete();
     

        Session::flash('message','Telefono Borrado Correctamente');

        return redirect()->route('contacto.edit',['id' => $idContacto]);

    }
}
