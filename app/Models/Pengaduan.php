<?php

namespace App\Models;

use CodeIgniter\Model;

class Pengaduan extends Model
{
    protected $table         = 'pengaduan';
    protected $allowedFields = [
        'id_berita',
        'kode',
        'nama',
        'telp',
        'email',
        'deskripsi',
        'img',
        'sumber',
    ];
    protected $useTimestamps = true;

}
