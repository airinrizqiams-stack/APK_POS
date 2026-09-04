<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $table = 'jenis'; // Kunci nama tabel agar sesuai dengan database
    protected $fillable = ['nama_jenis']; // Daftarkan kolom yang boleh diisi
}
