<?php

namespace App\Models;

use CodeIgniter\Model;

class Linechart extends Model
{
    protected $table = 'linechart';
    protected $allowedFields = [
        'bulan',
        'hoaks',
        'fakta',
        'disinformasi',
        'hate_speech',
    ];
    protected $useTimestamps = true;
}
