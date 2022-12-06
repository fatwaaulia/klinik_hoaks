<?php

namespace App\Models;

use CodeIgniter\Model;

class Env extends Model
{
   public function encode($id = null)
    {
        $v = (double)$id*7421952535.24;
        $encode = base64_encode($v);
        return str_replace('=','',$encode);
    }
    public function decode($id = null)
    {
        $v = base64_decode($id);
        $decode = (double)$v/7421952535.24;
        return str_replace('=','',$decode);
    }

    public function random()
    {
        $char = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $random = substr(str_shuffle($char), 0, 32);
        return $random;
    }

}
