<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        if($user->role_id == 1 or $user->role_id == 3)
        {
            $events = Event::all();
            return view('event.index',compact('events'));
        }elseif($user->role_id == 2)
        {
            $events = Event::all();
            if($events == null)
            {
                $events = Event::all();
                return view('event.index',compact('events'));
            }
            else
            {
                $events = Event::where('user_id',$user->id)
                ->get();
                return view('event.index',compact('events'));
            }
            

            
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
            $event->obervaciones = '';
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
        return view('event.show',compact('event'));
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
            return redirect()->route('event.index')
            ->with('success', 'No se puede editar un evento confirmado.');
        }else{
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
        $role = Auth::user()->role_id;
        if($role == 1)
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
            ]);
            
            $event->precio = $request->precio;
            $event->status = $request->status; 
            $event->save();
        }else{
            $request->validate([
                'nombre'=>'required',
                'descripcion'=>'required',
                'fecha'=>'required',
                'hora'=>'required',
                'precio'=>'nullable',
                'status'=>'nullable',
                'user_id'=>'nullable',
                'package_id'=>'required',
            ]);
            
            $usuario = Auth::user()->id;
            $event->nombre = $request->nombre;
            $event->descripcion = $request->descripcion;
            $event->fecha = $request->fecha;
            $event->hora = $request->hora;
            $event->precio = 0;
            $event->status = 0;
            $event->user_id = $usuario;
            $event->package_id = $request->package_id;
    
            $event->save();
        }
        return redirect()->route('event.index')
        ->with('success', 'Evento creado satisfactoriamente.');
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
