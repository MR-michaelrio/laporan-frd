<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\laporanfinal;
use App\Models\Regu;
use App\Models\anggota;
use App\Models\Laporan_Final;
class LaporanFinalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laporan = Laporan_Final::all();
        return view('laporanfinal.index', compact('laporan'));
    }

    public function laporanfinal()
    {
        $regu = Regu::where('nama_regu','!=','null')->get();
        $anggota = anggota::where('role','=','102')->get();
        return view('laporanfinal.laporan',compact('regu','anggota'));
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
        $tanggal = $request->input('tanggal');
        $jam = $request->input('jam');
        $menit = $request->input('menit');
        
        $date = \DateTime::createFromFormat('d-m-Y', $tanggal);
        $formatted_date = $date->format('d-m-Y');
        
        $tanggal_kejadian = $formatted_date . ' ' . str_pad($jam, 2, '0', STR_PAD_LEFT) . ':' . str_pad($menit, 2, '0', STR_PAD_LEFT) . ':00';
        
        $nama_petugas = $request->input('nama_petugas');
        $regu = $request->input('regu');
        $kejadian = $request->input('kejadian');
        
        $petugas_piket = $request->input('petugas_piket');
        $petugas_piket_string = !empty($petugas_piket) ? implode(', ', $petugas_piket) : '';
        
        // Assuming you have a "Laporan" model with a corresponding migration
        $laporan = new Laporan_Final();
        $laporan->nama_petugas = $nama_petugas;
        $laporan->regu = $regu;
        $laporan->petugas_piket = $petugas_piket_string;
        $laporan->kejadian = $kejadian;
        $laporan->tanggal = $tanggal_kejadian;
        $laporan->save();
        
        $encodedKejadian = urlencode($kejadian);

        $redirectUrl = 'http://101.255.4.222:3000/send-whatsapp-message?tanggal_kejadian=' . $tanggal_kejadian . '&regu=' . $regu . '&petugas_piket=' . $petugas_piket_string . '&nama_petugas=' . $nama_petugas . '&kejadian=' . $encodedKejadian;
        
        return redirect($redirectUrl);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Laporan_Final::find($id);
        $laporan = Laporan_Final::where('id_laporan',$id)->get();
        return view('laporanfinal.show', compact('data','laporan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
