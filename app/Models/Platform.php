<?php

namespace App\Models;

use CodeIgniter\Model;

class Platform extends Model
{
    protected $table = 'platform';
    protected $allowedFields = [
        'nama',
    ];
    protected $useTimestamps = true;
}
