<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photo = Photo::find($id);
        return view('photo.show',compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $photo = Photo::find($id);
        $foto = Photo::where('id',$photo->id)->first();

        $event = Event::where('id',$foto->event_id)->first();

        $user1 = User::where('id',$foto->usuario)->first();

        if(($user->role_id == 1) && (($user1->role_id == 3 or $user1->role_id == 1) && ($event->status == 1)))
        {
            
        return view('photo.edit',compact('photo'));
        }
        elseif(($user->id == $foto->usuario) && ($event->status == 1))
        {
        return view('photo.edit',compact('photo'));
        }
        else{
            return redirect()->route('event.index')
            ->with('success', 'Imagen no te pertenece');
        }
        
    }

    public function update(Request $request, Photo $photo)
    {
        
        $request->validate([
            'usuario' => 'nullable'
        ]);
        $imagen = $request->file('file');
        $rutaGuardarImg = 'imagen/';
        $imagenProducto = date('YmdHis'). "." . $imagen->getClientOriginalExtension();
        $imagen->move($rutaGuardarImg, $imagenProducto);
        $photo->update([
            'url' => $imagenProducto,
        ]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth()->user();
        $foto = Photo::where('id',$id)->first();

        $event = Event::where('id',$foto->event_id)->first();

        if(($user->id == $foto->usuario) && ($event->status == 1))
        {
            Photo::find($id)->delete();
            return redirect()->route('event.index')
            ->with('success', 'Foto eliminado satisfactoriamente');
        }else{
            return redirect()->route('event.index')
            ->with('success', 'No puedes eliminar fotografia');
        }
        
        
    }
}
