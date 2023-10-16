<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\anggota;
use App\Models\Regu;
class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anggota = anggota::all()->where('role','!=','anggota');
        return view('anggota.agt101&102',compact('anggota'));
    }

    public function index2()
    {
        $anggota = anggota::all();
        return view('anggota.agt',compact('anggota'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regu = Regu::all();
        return view('anggota.create', compact('regu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        anggota::create(array_filter($request->all(), function($value) {
            return !is_null($value);
        }));
        
        return redirect()->route('agt.index2');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = anggota::findorFail($id);
        $regu = Regu::all();
        return view('anggota.edit', compact('data','regu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $agt = anggota::find($id);

        $agt->update([
            'nama'=>$request->nama,
            'instansi'=>$request->instansi,
            'id_regu'=>$request->regu,
            'role'=>$request->role
        ]);
        // echo $agt;
        return redirect()->route('agt.index2');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agt = anggota::find($id);
        $agt->delete();
        return redirect()->route('agt.index2');
    }
}
