<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends Controller
{   
    public function dashboard()
    {
        // USER SESSION
        $userSession = session()->get('user');
        $data['user'] = model('User')->where('id', $userSession['id'])->first();

        $data['title'] = 'Dashboard';

        if ($data['user']['id_role'] == '1') {
            $data['content'] = view('dashboard/superadmin',$data);
        } elseif ($data['user']['id_role'] == '2') {
            $data['content'] = view('dashboard/admin',$data);
        } elseif ($data['user']['id_role'] == '3') {
            $data['content'] = view('dashboard/started',$data);
        }
        $data['sidebar'] = view('dashboard/sidebar',$data);
        return view('dashboard/header',$data);
    }
}
