<?php

namespace App\Models;

use CodeIgniter\Model;

class Berita extends Model
{
    protected $table         = 'berita';
    protected $allowedFields = [
        'id_kategori',
        'id_platform',
        'nama',
        'slug',
        'img',
        'sumber',
    ];
    protected $useTimestamps = true;

    public function password_hash($password = null)
    {
        return hash('SHA512', 'S3cuR1ty'. $password. 'Sys73m');
    }

}
