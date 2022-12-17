<?php

namespace App\Models;

use CodeIgniter\Model;

class Subscriber extends Model
{
    protected $table         = 'subscriber';
    protected $allowedFields = [
        'nama',
        'email',
        'status',
        'unsubscribe_at',
    ];
    protected $useTimestamps = true;

}
