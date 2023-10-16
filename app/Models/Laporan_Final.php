<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan_Final extends Model
{
    use HasFactory;
    protected $table = 'Laporan_Final';

    protected $primaryKey = 'id_laporan';

    protected $fillable = ['id_laporan', 'nama_petugas', 'kejadian', 'tanggal', 'id_anggota', 'id_regu'];
}
