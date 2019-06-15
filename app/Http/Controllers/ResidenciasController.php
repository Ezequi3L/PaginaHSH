<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Residencia;
use App\Foto;

class ResidenciasController extends Controller
{

    public function ResForm(){
      return view('ResForm', ['title' => "Agregar una residencia"]);
    }

    public function ResList(){
      $title = "HSH - Listado de Residencias";
      $resultado = Residencia::all();
      return view('ResList', compact('title','resultado'));
    }

    public function store(){

    	$data = request()->all();

    	if (empty($data['desc'])) {
    		return redirect()->route('crearResidencia')->withErrors('El campo descripción es obligatorio');
    	}
    	Residencia::create([
    		'descripcion' => $data['desc'],
    		'ubicacion_id' => $data['ubicacion'],
    		//'foto_id' => $data['']
    		]);
    	return redirect()->route('inicio');
    }

     public function ViewRes($id){
      return view('viewRes', [
        'title' => 'Detalles de la residencia',
        'id' => $id,
        ]);
    }

    public function EditRes($id){
      return view('editRes', [
        'title' => 'Modificar la residencia',
        'id' => $id,
        ]);
    }

     public function update(Residencia $residencia){
        $data = request()->validate([
            'descripcion' => '',
            'ubicacion_id' => 'required'
            ], [
            'ubicacion_id.required' => 'El campo ubicacion es obligatorio'
            ]);

        if(empty($data['descripcion'])) {
            $data['descripcion'] = $residencia->descripcion;
        }

        $residencia->update($data);
        return redirect()->route('viewRes', [$residencia]);
    }


    public function UploadFoto($id){
      return view('uploadFoto',['title' => 'Subir Foto', 'id' => $id]);


    }

    public function fotoExitosa($id){
       
      if (request()->hasFile('foto')) {
       
        $extensiones = ["jpg","jpeg","png","gif","ico","bmp"];
        $fileExt = request('foto')->getClientOriginalExtension();

        if (in_array($fileExt, $extensiones)) {
          request()->foto->store('public');
          Foto::create(['src' => '/storage/app/'.request()->foto->store('public'), 'residencia_id' => $id]);
          return redirect()->route('upload',[$id]);
        }
        else return redirect()->route('upload',[$id])->withErrors('El archivo seleccionado debe ser una imagen');
      }
      else return redirect()->route('upload',[$id])->withErrors('No hay ningún archivo seleccionado');        
    }

    function destroy(Residencia $residencia){

      $residencia->dada_de_baja = true;
      $residencia->update();
      return redirect()->route('listarResidencias');
    }

}
