<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    public function index()
    {
        $packages = DB::table('packages')->Simplepaginate(10);
        return view('package.index',compact('packages'));
    }

    public function create()
    {   
        $user = Auth::user()->role_id;
        if ($user == 1) {
            $package = new Package();
            return view('package.create',compact('package'));
        
        }else {
            return redirect()->route('home')->with('success','No Puedes ingresar, solo gerente');
        }

        
    }

    public function store(Request $request)
    {
        Package::create($request->all());
        return redirect()->route('package.index')
            ->with('success', 'Paquete creado satisfactoriamente.');
    }

    public function show($id)
    {
        $package = Package::find($id);
        return view('package.show',compact('package'));
    }

    public function edit($id)
    {
        $user = Auth::user()->role_id;
        if ($user == 1) {
            return redirect()->route('package.index')
            ->with('success', 'Usted no es un gerente');
        }else {
            return redirect()->route('home')->with('success','No Puedes ingresar, solo gerente');
        }
        
    }

    public function update(Request $request, Package $package)
    {
        
        $package->update($request->all());
        return redirect()->route('package.index')
            ->with('success', 'Paquete actualizado');
    }

    public function destroy($id)
    {
        Package::find($id)->delete();
        return redirect()->route('package.index')
            ->with('success', 'Paquete eliminado!');
    }
}
