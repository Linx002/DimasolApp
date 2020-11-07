<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Photos;

class PhotosController extends Controller
{
    public function Add($album_id){
        return view('albums.addPhotos')->with('album_id',$album_id);
    }

    public function Store(Request $request){
        //tomar nombre del archivo con extension
        $fileNameWithExt = $request->file('Photo')->getClientOriginalName();

        //tomar solo el nombre del archivo
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

        //tomar extension
        $extension = $request->file('Photo')->getClientOriginalExtension();

        //Nombre del archivo con extension, nombre unico para la base de datos
        $finalFileName = $fileName.'_'.time().'.'.$extension;

        $path = $request->file('Photo')->storeAs('public/photos/'.$request->input('album_id'),$finalFileName);

            $photo = New Photos;
            $photo -> album_id = $request->input('album_id');
            $photo -> photoTitle = $request->input('photoTitle');
            $photo -> photoDescription = $request->input('photoDescription');
            $photo -> photosize = $request->file('Photo')->getSize();
            $photo -> photo = $finalFileName;

            $photo->save();

        return redirect('/album/'.$request->input('album_id'))->with('msg', 'Fotos agregadas correctamente');
    }

    public function Delete($id){
        $photo = Photos::find($id);

        if(Storage::delete('public/photos/'.$photo->album_id.'/'.$photo->photo)){
            $photo->delete();

            return redirect('/album/admin')->with('msg', 'Foto eliminada correctamente');
        }
    }
}
