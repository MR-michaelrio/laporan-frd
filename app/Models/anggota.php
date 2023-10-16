<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anggota extends Model
{
    use HasFactory;
    protected $table = "anggota";
    protected $primaryKey = "id_anggota";

    protected $fillable = ['id_anggota', 'nama', 'instansi', 'id_regu', 'role'];

    public function Absensi(){
        return $this->belongsTo(Absensi::class,'id_anggota', 'id_anggota');
    }
    public function Regu(){
        return $this->belongsTo(Regu::class,'id_regu', 'id_regu');
    }
}
