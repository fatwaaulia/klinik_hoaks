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

    public function joinKategori($id_kategori)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('berita a');
        $builder->select('a.*,b.nama as nama_kategori');
        $builder->join('kategori b', 'b.id = a.id_kategori AND b.id ='.$id_kategori);
        return $builder->get();
    }

}
