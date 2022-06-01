<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $user = Auth::user();
        if($user == null)
        {
            return view('home');
        }
        elseif(($user->id == 1) && ($user->role_id == null))
        {
            return redirect()->route('role.create')
            ->with('success','Ingresaste como gerente, crea rol gerente y añadelo a tu usuario');
        }elseif ($user->id != null) {
            return view('home');
        }
    }
}
