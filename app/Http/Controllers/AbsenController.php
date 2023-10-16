<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use App\Models\Absensi;
use App\Models\anggota;
use Illuminate\Support\Str;
use PDF;
use Illuminate\Support\Facades\File;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $absen = Absen::all();
        return view('absensi.index', compact('absen'));
    }

    public function index2()
    {
        $anggota = anggota::all()->where('role','!=','anggota');
        $ag = anggota::all();
        return view('absensi.absen', compact('anggota','ag'));
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
    
    public function store2(Request $request)
    {
        // Generate a unique random ID for 'Absen'
        $id_absen = rand(100000, 999999);
        while (Absen::where('id_absen', $id_absen)->exists()) {
            $id_absen = rand(100000, 999999);
        }
        
        // Create the 'Absen' record
        $absen = Absen::create([
            'id_absen' => $id_absen,
            'tanggal_absen' => $request->tanggal_absen,
            'id_anggota' => $request->petugas,
            'catatan' => $request->catatan
        ]);
        
        // Process attendance for each member
        $ag = Anggota::all();
        foreach ($ag as $a) {
            $hadirKey = 'absenshadir.' . $a->id_anggota;
            $selectedValue = $request->input($hadirKey);
        
            // Check if "Lain" is selected and "Lain Text" is provided; otherwise, default to "Hadir" or "Tidak Hadir"
            if ($selectedValue === 'lain' && $request->has("lainText.{$a->id_anggota}")) {
                $absenshadir = $request->input("lainText.{$a->id_anggota}");
            } else {
                $absenshadir = $selectedValue === 'hadir' ? 'hadir' : 'tidak hadir';
            }
        
            // Create the 'Absensi' record
            Absensi::create([
                'id_absen' => $absen->id_absen,
                'id_anggota' => $a->id_anggota,
                'absenshadir' => $absenshadir
            ]);
        }
        return redirect()->route('absen.pdf',$absen->id_absen);    
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Absensi::all()->where('id_absen','==', $id);
        $tanggal = Absen::find($id);
        
        return view('absensi.show',compact('data','tanggal'));
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
        $absensi = Absensi::where('id_absen',$id)->get();
        $absen = Absen::find($id);
        if ($absen) {
            foreach ($absensi as $absensiItem) {
                $absensiItem->delete();
            }
        
            if (!empty($absen->pdf)) {
                $filePath = public_path($absen->pdf);
        
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
        
            $absen->delete();
        }

        return redirect()->route('absen.index');
    }

    public function generatePDF($id)
    {
        $data = absensi::where('id_absen',$id)->get();
        $data2 = Absen::where('id_absen',$id)->get();
        $absen = Absen::find($id);
        $pdf = PDF::loadView('absensi.pdf', compact('data','data2'));
        $pdfContent = $pdf->output();
        $publicPath = public_path('pdf');
        if (!is_dir($publicPath)) {
            mkdir($publicPath, 0755, true);
        }
        $pdfFileName = $id . '.pdf';
        $pdfFilePath = $publicPath . '/' . $pdfFileName;
        $pdf->save($pdfFilePath);
        $absen->update(['pdf' => 'pdf/' . $pdfFileName]);

        // return redirect()->route('absen.index');
        return redirect("http://localhost:3000/file-message?namafile=".$pdfFileName);
    }
}
