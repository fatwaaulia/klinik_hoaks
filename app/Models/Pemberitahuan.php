<?php

namespace App\Models;

use CodeIgniter\Model;

class Pemberitahuan extends Model
{
    protected $table = 'pemberitahuan';
    protected $allowedFields = [
        'info_1',
        'info_2',
        'info_3',
        'info_4',
        'info_5',
        'info_6',
        'info_7',
    ];
    protected $useTimestamps = true;
}
