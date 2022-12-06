<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table         = 'user';
    protected $allowedFields = [
        'id_role',
        'nama',
        'username',
        'email',
        'password',
        'img',
        'jenis_kelamin',
        'alamat',
        'telp',
        'token',
        'activated_at',
    ];
    protected $useTimestamps = true;

    public function password_hash($password = null)
    {
        return hash('SHA512', 'S3cuR1ty'. $password. 'Sys73m');
    }

}
