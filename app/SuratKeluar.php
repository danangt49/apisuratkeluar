<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $table = 'suratkeluars';
    
    protected $fillable = [
        'no_surat', 'perihal_surat', 'nama_kegiatan', 'tanggal_surat_keluar', 'tujuan',
    ];
}
