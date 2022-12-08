<?php

namespace App\Models;

use CodeIgniter\Model;

class Barchart extends Model
{
    protected $table = 'barchart';
    protected $allowedFields = [
        'bulan',
        'hoaks',
        'fakta',
        'disinformasi',
        'hate_speech',
    ];
    protected $useTimestamps = true;
}
