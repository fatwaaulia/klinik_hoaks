<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Subscriber extends BaseController
{
    public function __construct()
    {
        $this->model = model('App\Models\Subscriber');
        $this->name = 'subscriber'; // title, nama folder view. | spasi menggunakan garis bawah(_)
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data['data'] = $this->model->where('unsubscribe_at',NULL)->findAll();
        $data['title'] = 'Data Subscriber';

        $data['content'] = view('subscriber/subscriber',$data);
        $data['sidebar'] = view('dashboard/sidebar',$data);
        return view('dashboard/header',$data);
    }

    public function unsubscriber()
    {
        $data['data'] = $this->model->where('unsubscribe_at !=',NULL)->findAll();
        $data['title'] = 'Data Unsubscriber';

        $data['content'] = view('subscriber/unsubscriber',$data);
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
        $rules = [
            'nama' => 'required',
            'email' => 'required|valid_email',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }else {
            $email = $this->request->getVar('email', FILTER_SANITIZE_EMAIL); 
            $data_by_email = $this->model->where('email',$email)->first();
            $id = $data['id']??0;

            if ($data_by_email) { 
                $field = [
                    'nama'           => $this->request->getVar('nama', $this->filter),
                    'email'          => $this->request->getVar('email', FILTER_SANITIZE_EMAIL),
                    'status'         => 'true',
                    'unsubscribe_at' => '',
                ];
            } else {
                $field = [
                    'nama'   => $this->request->getVar('nama', $this->filter),
                    'email'  => $this->request->getVar('email', FILTER_SANITIZE_EMAIL),
                    'status' => 'true',
                ];
            }
            
            // Kirim email
            $toEmail  = $field['email'];
            $toName   = $field['nama'];
            $subject  = 'Berhasil Subscribe';
            
            $data['name'] = $toName;
            $data['text'] = 'Terima kasih telah mengikuti ' . getenv('app.name') . '. kamu akan mendapat informasi terkini.';
            $data['button_link'] = base_url().'/subscriber/delete/'. $toEmail;
            $data['button_name'] = 'Unsubscribe';
            $message = view('auth/email_template', $data);

            // echo $message;
            // die;

            $email = service('email');
            $email->setFrom($email->fromEmail, $email->fromName);
            $email->setTo($toEmail);
            $email->setSubject($subject);
            $email->setMessage($message);

            // print_r($message);
            // die;
            if ($email->send()) {
                if ($data_by_email) {
                    $this->model->update($id, $field);
                } else {
                    $this->model->insert($field);
                }
                return redirect()->to(base_url() . '/subscribe')
                ->with('message',
                "<script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Berhasil subscribe!',
                    })
                </script>");
            } else {
                // $data = $email->printDebugger(['headers']);
                // print_r($data);
                // die;
                return redirect()->to(base_url() . '/subscribe')
                ->with('message',
                "<script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Permintaan gagal diproses, silakan coba lagi!',
                    })
                </script>");
            }
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $decode = model('Env')->decode($id);
        $data['data'] = $this->model->find($decode);
        $data['name'] = $this->name;
        $data['route'] = $this->route;
        $data['title'] = 'Edit ' . ucwords(str_replace('_', ' ', $this->name));
        $data['val']     = service('validation');
        
        $data['content']   = view($this->name.'/edit',$data);
        $data['sidebar'] = view('dashboard/sidebar',$data);
        return view('dashboard/header',$data);

    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $subscribe = model('Subscriber')->where('email',$id)->first();
        if ($subscribe) {
            // Kirim email
            $toEmail  = $subscribe['email'];
            $toName   = $subscribe['nama'];
            $subject  = 'Berhenti Subscribe';
            
            $data['name'] = $toName;
            $data['text'] = 'Yahh, kamu telah berhenti mengikuti ' . getenv('app.name') . '. jika kamu masih tertarik mendapatkan informasi terkini, silahkan subscribe ulang.';
            $data['button_link'] = base_url('subscribe');
            $data['button_name'] = 'Subscribe';
            $message = view('auth/email_template', $data);

            $email = service('email');
            $email->setFrom($email->fromEmail, $email->fromName);
            $email->setTo($toEmail);
            $email->setSubject($subject);
            $email->setMessage($message);

            // print_r($message);
            // die;
            if ($email->send()) {
                $field = [
                    'status'         => 'false',
                    'unsubscribe_at' => date('Y-m-d H:i:s'),
                ];
                $this->model->update($subscribe['id'], $field);
                return redirect()->to(base_url())
                ->with('message',
                "<script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Berhasil unsubscribe!',
                    })
                </script>");
            } else {
                // $data = $email->printDebugger(['headers']);
                // print_r($data);
                // die;
                return redirect()->to(base_url())
                ->with('message',
                "<script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Permintaan gagal diproses, silakan coba lagi!',
                    })
                </script>");
            }
        } else {
            $data['title'] = '404';
            $data['error_msg'] = 'GAGAL, SUBSCRIBER TIDAK DITEMUKAN!';
        
            $field = [
                'ip_address' => getHostByName(getHostName()),
                'url'        => current_url(),
            ];
            model('Handling_404')->insert($field);
    
            $data['content'] = view('errors/e404',$data);
            return view('dashboard/header',$data);
        }
    }
}
