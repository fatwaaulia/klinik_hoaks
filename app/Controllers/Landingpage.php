<?php

namespace App\Controllers;

class Landingpage extends BaseController
{
    public function __construct()
    {
        $this->model = model('App\Models\User');
    }

    public function home()
    {
        $data['content'] = view('landingpage/home');
        return view('landingpage/header',$data);
    }

    public function pengaduanKlarifikasi()
    {
        $data['title'] = 'Klarifikasi Pengaduan';
        $data['val']     = service('validation');

        $data['content'] = view('landingpage/pengaduan_klarifikasi',$data);
        return view('landingpage/header',$data);
    }

    public function kategori($id)
    {
        $kategori = model('Kategori')->where('slug', $id)->first();
        $data['title'] = 'Kategori '. $kategori['nama'];
        $data['val']     = service('validation');

        $data['content'] = view('landingpage/kategori',$data);
        return view('landingpage/header',$data);
    }

    public function pencarian()
    {
        $data['title'] = 'Pencarian';
        $data['val']     = service('validation');

        $data['content'] = view('landingpage/pencarian',$data);
        return view('landingpage/header',$data);
    }

    public function lacakTiket()
    {
        $data['title'] = 'Lacak Tiket';
        $data['val']     = service('validation');

        $data['content'] = view('landingpage/lacak_tiket',$data);
        return view('landingpage/header',$data);
    }

    public function subscribe()
    {
        $data['title'] = 'Subscribe';
        $data['val']     = service('validation');

        $data['content'] = view('landingpage/subscribe',$data);
        return view('landingpage/header',$data);
    }
}
