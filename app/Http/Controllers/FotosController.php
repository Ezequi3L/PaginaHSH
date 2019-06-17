<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Foto;

class FotosController extends Controller
{

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
        return redirect()->route('upload',[$id])->with('alert-success', 'Foto subida con exito');
      }
      else return redirect()->route('upload',[$id])->withErrors('El archivo seleccionado debe ser una imagen');
    }
    else return redirect()->route('upload',[$id])->withErrors('No hay ningún archivo seleccionado');
  }


  public function BajaFoto($id){
    return view('BorrarFoto',['title' => 'Borrar foto', 'id' => $id]);
  }

  public function destroy(Foto $id){
    $resId=$id->residencia_id;
    $id->delete();
    return redirect()->route('BajaFoto',[$resId])->with('alert-success', 'Foto Borrada con exito');

  }




}
 ?>
