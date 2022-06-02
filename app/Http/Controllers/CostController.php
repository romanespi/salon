<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Event;
use Illuminate\Http\Request;

class CostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $costs = Cost::all();
        return view('cost.index',compact('costs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cost = new Cost();
        $events=Event::where('status',1)->pluck('nombre','id');
        return view('cost.create',compact('cost','events'));
    }

    public function store(Request $request)
    {
        Cost::create($request->all());
        return redirect()->route('cost.index')
            ->with('success', 'Costo creado satisfactoriamente.');
    }

    public function show($id)
    {
        $cost = Cost::find($id);
        return view('cost.show',compact('cost'));
    }

    public function edit($id)
    {
        $cost = Cost::find($id);
        $events=Event::where('status',1)->pluck('nombre','id');
        return view('cost.edit',compact('cost','events'));
    }

    public function update(Request $request, Cost $cost)
    {
        $cost->update($request->all());
        return redirect()->route('cost.index')
            ->with('success', 'Costo actualizado satisfactoriamente');
    }

    public function destroy($id)
    {
        Cost::find($id)->delete();
        return redirect()->route('cost.index')
            ->with('success', 'Costo eliminado satisfactoriamente');
    }

}
