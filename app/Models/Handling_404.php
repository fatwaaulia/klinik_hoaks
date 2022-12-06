<?php

namespace App\Models;

use CodeIgniter\Model;

class Handling_404 extends Model
{
    protected $table = 'handling_404';
    protected $allowedFields = [
        'ip_address',
        'url',
    ];
    protected $useTimestamps = true;
}
