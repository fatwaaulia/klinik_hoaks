<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pemberitahuan extends BaseController
{
    public function __construct()
    {
        $this->model = model('App\Models\Pemberitahuan');
        $this->name = 'pemberitahuan'; // title, nama folder view. | spasi menggunakan garis bawah(_)
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data['data'] = $this->model->orderBy('id', 'DESC')->findAll();
        $data['name'] = $this->name;
        $data['route'] = $this->route;
        $data['title'] = 'Data ' . ucwords(str_replace('_', ' ', $this->name));

        $data['content'] = view($this->name.'/index',$data);
        $data['sidebar'] = view('dashboard/sidebar',$data);
        return view('dashboard/header',$data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        $data['route'] = $this->route;
        $data['title'] = 'Tambah ' . ucwords(str_replace('_', ' ', $this->name));
        $data['val']     = service('validation');

        $data['content']   = view($this->name.'/new',$data);
        $data['sidebar'] = view('dashboard/sidebar',$data);
        return view('dashboard/header',$data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $informasi = model('Informasi')->orderBy('id','DESC')->findAll(7);
        foreach ($informasi as $key => $v) {
            $kategori = model('Kategori')->where('id',$v['id_kategori'])->first();
            $info[] = '"' . $kategori['nama'] .', '. $v['nama'].'",';
        }

        $field = [
            'info_1' => rtrim(str_replace('"','', $info[0]), ','),
            'info_2' => rtrim(str_replace('"','', $info[1]), ','),
            'info_3' => rtrim(str_replace('"','', $info[2]), ','),
            'info_4' => rtrim(str_replace('"','', $info[3]), ','),
            'info_5' => rtrim(str_replace('"','', $info[4]), ','),
            'info_6' => rtrim(str_replace('"','', $info[5]), ','),
            'info_7' => rtrim(str_replace('"','', $info[6]), ','),
        ];

        // die;
        $subs = model('Subscriber')->findAll();
        foreach ($subs as $v) {
            // Kirim email
            $toEmail  = $v['email'];
            $toName   = $v['nama'];
            $subject  = 'Informasi Terkini';
            
            $informasi = model('Informasi')->orderBy('id','DESC')->findAll(7);
            foreach ($informasi as $key => $v) {
                $kategori = model('Kategori')->where('id',$v['id_kategori'])->first();
                $info[] = '"' . $kategori['nama'] .', '. $v['nama'].'",';
            }

            $data['name'] = $toName;
            $data['text'] = 'Informasi terkini <br>'. 
                            '1. '. rtrim(str_replace('"','', $info[0]), ',').'<br>'.
                            '2. '. rtrim(str_replace('"','', $info[1]), ',').'<br>'.
                            '3. '. rtrim(str_replace('"','', $info[2]), ',').'<br>'.
                            '4. '. rtrim(str_replace('"','', $info[3]), ',').'<br>'.
                            '5. '. rtrim(str_replace('"','', $info[4]), ',').'<br>'.
                            '6. '. rtrim(str_replace('"','', $info[5]), ',').'<br>'.
                            '7. '. rtrim(str_replace('"','', $info[6]), ',').'<br>';
            $data['text_2'] = 'Jika Anda ingin berhenti berlangganan, silakan klik tombol berikut: <a href='. base_url().'/subscriber/delete/'. $toEmail .'>
                                <button style="color:#fff;background:#3b7ddd;border:1px solid transparent;padding:0.375rem 0.75rem;font-size:14px;border-radius:0.25rem;">
                                    Unsubscribe
                                </button></a>';
            $data['button_link'] = '';
            $data['button_name'] = '';
            $message = view('auth/email_template', $data);

            // echo $message;
            // die;

            $email = service('email');
            $email->setFrom($email->fromEmail, $email->fromName);
            $email->setTo($toEmail);
            $email->setSubject($subject);
            $email->setMessage($message);

            if ($email->send()) {
                $this->model->insert($field);
                return redirect()->to($this->route)
                ->with('message',
                "<script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Berhasil kirim pemberitahuan',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    })
                </script>");
            } else {
                return redirect()->to($this->route)
                ->with('message',
                "<script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Permintaan gagal diproses, silakan coba lagi!',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    })
                </script>");
            }
        }
        
    }
}
