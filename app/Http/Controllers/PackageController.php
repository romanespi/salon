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
        $package = new Package();
        return view('package.create',compact('package'));
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
        $user = Auth::user();
        if($user->role_id == null)
        {
            return redirect()->route('package.index')
            ->with('success', 'Usted no es un gerente');
        }else
        {
            $package = Package::find($id);
            return view('package.edit',compact('package'));    
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
