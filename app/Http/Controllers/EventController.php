<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Package;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Json;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$events = DB::table('events')->Simplepaginate(10);
        $user = Auth::user();
        if($user->role_id == 1)
        {
            $events = Event::all();
            return view('event.index',compact('events'));
        }elseif($user->role_id == 2)
        {
            $events = Event::with('user')->where('user_id',$user->id)->get();
            return view('event.index',compact('events'));    
        }elseif($user->role_id == 3)
        {
            //$events = Event::where('status',1)->where('etapa',1)->get();
            //return $events;
            $events = Event::all();
            return view('event.index',compact('events'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {       
            $user = Auth::user()->name;
            $packages = Package::where('status',1)->pluck('nombre','id');
            $event=new Event();
            return view('event.create',compact('event','packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $request->validate([
                'nombre'=>'required',
                'descripcion'=>'required',
                'fecha'=>'required',
                'hora'=>'required',
                'precio'=>'nullable',
                'status'=>'nullable',
                'etapa' => 'nullable | in:1,2,3',
                'user_id'=>'nullable',
                'autorizado'=>'nullable',
                'package_id'=>'required',
                'observaciones' => 'nullable',
            ]);
            
            $usuario = Auth::user()->id;
            $event = new Event();
            $event->nombre = $request->nombre;
            $event->descripcion = $request->descripcion;
            $event->fecha = $request->fecha;
            $event->hora = $request->hora;
            $event->precio = 0;
            $event->status = 0;
            $event->etapa = 1;
            $event->observaciones = '';
            $event->package_id = $request->package_id;
            $event->user_id = $usuario;
            $event->autorizado = '';
            $event->save();
        
        return redirect()->route('event.index')
        ->with('success', 'Evento creado satisfactoriamente.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        $photos = Photo::where('event_id',$id)->get();
        return view('event.show',compact('event','photos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        $user = Auth::user();
        $packages = Package::where('status',1)->pluck('nombre','id');
        $events = Event::where('id',$id)->first();

        if(($events->status == 0) && ($user->role_id == 2))
        {
            return view('event.edit',compact('event','packages'));
        }elseif(($events->status == 0) && ($user->role_id == 1))
        {
            return view('event.edit',compact('event','packages'));
        }elseif(($events->status == 1) && ($user->role_id == 1))
        {
            return view('event.edit',compact('event','packages'));
        }
        elseif(($events->status == 1) && ($user->role_id == 2))
        {
            return view('event.edit',compact('event','packages'));
        }elseif($events->etapa == 2 && $user->role_id == 3){
            return view('event.edit',compact('event','packages'));
        }
        else{
            return redirect()->route('event.index')
            ->with('success', 'No se puede editar un evento confirmado.');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {

        
        $estado = $event->status;
        $role = Auth::user();
        if($role->role_id == 1)
        {
            $request->validate([
                'nombre'=>'required',
                'descripcion'=>'required',
                'fecha'=>'required',
                'hora'=>'required',
                'precio'=>'nullable',
                'status'=>'nullable',
                'user_id'=>'nullable',
                'package_id'=>'required',
                'observaciones' => 'nullable',
            ]);

            $usero = User::where('id',$role->id)->first();
            $event->etapa = $request->etapa;
            $event->observaciones = $request->observaciones;
            $event->autorizado = $role->name;
            $event->precio = $request->precio;
            $event->status = $request->status;
            $foto = Photo::where('event_id',$event->id)->first();
            if((($estado == 1) or ($request->status == 1)))
            {
                if($imagen = $request->file('file')) {
                    $rutaGuardarImg = 'imagen/';
                    $imagenProducto = date('YmdHis'). "." . $imagen->getClientOriginalExtension();
                    $imagen->move($rutaGuardarImg, $imagenProducto);
                    $event->photos()->create([
                        'url' => $imagenProducto,
                        'usuario' => $usero->id,
                    ]);            
                }
            }else{
                return redirect()->route('event.index')
                    ->with('success', 'Necesita estar el evento confirmado para subir una foto.');
            }
            
            $event->save();
            return redirect()->route('event.index')
                    ->with('success', 'Evento creado satisfactoriamente.');
            
        }elseif($role->id == 3)
        {
            $usero = User::where('id',$role->id)->first();
            $foto = Photo::where('event_id',$event->id)->first();
                if($imagen = $request->file('file')) {
                    $rutaGuardarImg = 'imagen/';
                    $imagenProducto = date('YmdHis'). "." . $imagen->getClientOriginalExtension();
                    $imagen->move($rutaGuardarImg, $imagenProducto);
                    $event->photos()->create([
                        'url' => $imagenProducto,
                        'usuario' => $usero->id,
                    ]);
                return redirect()->route('event.index')
                    ->with('success', 'Evento creado satisfactoriamente.');       
                }
        }
        else{
            $request->validate([
                'nombre'=>'required',
                'descripcion'=>'required',
                'fecha'=>'required',
                'hora'=>'required',
                'user_id'=>'nullable',
                'package_id'=>'required',
            ]);
            $usero = User::where('id',$role->id)->first();
            $usuario = Auth::user()->id;
            $event->nombre = $request->nombre;
            $event->descripcion = $request->descripcion;
            $event->fecha = $request->fecha;
            $event->hora = $request->hora;
            $event->user_id = $usuario;
            $event->package_id = $request->package_id;

            $foto = Photo::where('event_id',$event->id)->first();
            if(($estado == 1))
            {
                if($imagen = $request->file('file')) {
                    $rutaGuardarImg = 'imagen/';
                    $imagenProducto = date('YmdHis'). "." . $imagen->getClientOriginalExtension();
                    $imagen->move($rutaGuardarImg, $imagenProducto);
                    $event->photos()->create([
                        'url' => $imagenProducto,
                        'usuario' => $usero->id,
                    ]);
                    $event->save();
                return redirect()->route('event.index')
                    ->with('success', 'Evento creado satisfactoriamente.');       
                }
            }else{
                $event->save();
                return redirect()->route('event.index')
                    ->with('success', 'Evento creado satisfactoriamente, no puedes subir imagenes sin evento confirmado');
            }
            return redirect()->route('event.index')
                    ->with('success',' no puedes editar evento confirmado');
            
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $event = Event::where('id',$id)->where('user_id',$user->id)->first();
        if(($user->id == $event->user_id) && ($event->status == 0))
        {
            Event::find($id)->delete();
            return redirect()->route('event.index')->with('success','Evento eliminado correctamente');
        }else{
            return redirect()->route('event.index')->with('success','No puedes eliminar evento');
        }
        
        
    }
}
