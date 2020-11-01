<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Album;
use App\Photos;

class AlbumsController extends Controller
{
    public function Index(){
        $albums = Album::with('Photos')->get();
        return view ('areas', ['albums' => $albums]);
    }
    public function Admin(){
        $albums = Album::with('Photos')->get();
        return view ('albums.adminalbum', ['albums' => $albums]);
    }
    public function Store(Request $request){
    //    $this->validate($request, [
    //        'albumName' => 'required',
    //        //archivos de menos de 2Mb
    //        'coverPhoto' => 'image|max:1999'
    //    ]);

    //tomar nombre del archivo con extension
    $fileNameWithExt = $request->file('coverPhoto')->getClientOriginalName();
    //return $fileNameWithExt;

    //tomar solo el nombre del archivo
    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

    //tomar extension
    $extension = $request->file('coverPhoto')->getClientOriginalExtension();

    //Nombre del archivo con extension, nombre unico para la base de datos
    $finalFileName = $fileName.'_'.time().'.'.$extension;

    $path = $request->file('coverPhoto')->storeAs('public/album_covers',$finalFileName);

        $album = New Album;
        $album -> albumName = $request->input('albumName');
        $album -> albumDescription = $request->input('albumDescription');
        $album -> coverPhoto = $finalFileName;

        $album->save();

    return redirect('/album/admin')->with('msg', 'Album creado correctamente');
    }

    public function Show($id){
    $album = Album::with('Photos')->find($id);
    return view ('albums.showAlbum', ['album' => $album]);
    }

    public function Delete($id){
    $album = Album::with('Photos')->find($id);
    return view ('albums.deleteAlbum', ['album' => $album]);
    }

    public function Add($id){
    $album = Album::with('Photos')->find($id);
    return view ('albums.addPhotos', ['album' => $album]);
    }

    public function Remove(Request $request){
    $id = $request->input('id');
    if(DB::table('albums')->where('id', $id)->exists() == true){
       DB::table('albums')->where('id',$id)->delete();}
    return redirect('/album/admin')->with('msg', 'Album eliminado correctamente');
    }
}
