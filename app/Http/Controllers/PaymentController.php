<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    
    public function index()
    {
        $ser = Auth::user()->role_id;
        if($ser == 1 or $ser == 3)
        {
            $payments = Payment::all();
            return view('payment.index',compact('payments'));
        }
        else{
            return redirect()->route('home')
            ->with('success', 'NO AUTORIZADO');
        }
        
    }

    public function create()
    {
        $ser = Auth::user()->role_id;
        if($ser == 1 or $ser == 3)
        {
            $payment = new Payment();
        $events=Event::where('status',1)->pluck('nombre','id');
        return view('payment.create',compact('payment','events'));
        }
        else{
            return redirect()->route('home')
            ->with('success', 'NO AUTORIZADO');
        }
        
    }

    public function store(Request $request)
    {
        $ser = Auth::user()->role_id;
        if($ser == 1 or $ser == 3)
        {
            Payment::create($request->all());
        return redirect()->route('payment.index')
            ->with('success', 'Abono creado satisfactoriamente.');
        }
        else{
            return redirect()->route('home')
            ->with('success', 'NO AUTORIZADO');
        }
        
    }

    public function show($id)
    {
        $ser = Auth::user()->role_id;
        if($ser == 1 or $ser == 3)
        {
            $payment = Payment::find($id);
        return view('payment.show',compact('payment'));
        }
        else{
            return redirect()->route('home')
            ->with('success', 'NO AUTORIZADO');
        }
        
    }

    public function edit($id)
    {
        $ser = Auth::user()->role_id;
        if($ser == 1 or $ser == 3)
        {
            $payment = Payment::find($id);
        $events=Event::where('status',1)->pluck('nombre','id');
        return view('payment.edit',compact('payment','events'));
        }
        else{
            return redirect()->route('home')
            ->with('success', 'NO AUTORIZADO');
        }
        
    }

    public function update(Request $request, Payment $payment)
    {
        $ser = Auth::user()->role_id;
        if($ser == 1 or $ser == 3)
        {
            $payment->update($request->all());
        return redirect()->route('payment.index')
            ->with('success', 'Abono actualizado satisfactoriamente');
        }
        else{
            return redirect()->route('home')
            ->with('success', 'NO AUTORIZADO');
        }
        
    }

    public function destroy($id)
    {
        $ser = Auth::user()->role_id;
        if($ser == 1 or $ser == 3)
        {
            Payment::find($id)->delete();
        return redirect()->route('payment.index')
            ->with('success', 'Abono eliminado satisfactoriamente');
        }
        else{
            return redirect()->route('home')
            ->with('success', 'NO AUTORIZADO');
        }
        
    }

}
