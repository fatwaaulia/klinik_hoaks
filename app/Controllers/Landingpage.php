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
    public function subscribe()
    {
        $data['title'] = 'Subscribe';
        $data['val']     = service('validation');

        $data['content'] = view('landingpage/subscribe',$data);
        return view('landingpage/header',$data);
    }
    public function createSubscribe()
    {
        $rules = [
            'nama'          => 'required',
            'email'         => 'required|valid_email|is_unique[user.email]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }else {
            $berita = model('Berita')->orderBy('created_at', 'DESC')->first();
            $field = [
                'id_role'       => '3',
                'nama'          => $this->request->getVar('nama', $this->filter),
                'email'         => $this->request->getVar('email', FILTER_SANITIZE_EMAIL),
            ];
            
            // Kirim email
            $toEmail  = $field['email'];
            $toName   = $field['nama'];
            $subject  = 'Berhasil Subscribe';
            
            $data['name'] = $toName;
            $data['text'] = 'Terima kasih telah mengikuti ' . getenv('app.name') . '. kamu akan mendapat informasi terkini. 
                            <br> baca: <a href="'.base_url().'">'.$berita['nama'].'</a>';
            $data['button_link'] = base_url().'/delete-subscribe/'. $toEmail;
            $data['button_name'] = 'Unsubscribe';
            $message = view('auth/email_template', $data);

            $email = service('email');
            $email->setFrom($email->fromEmail, $email->fromName);
            $email->setTo($toEmail);
            $email->setSubject($subject);
            $email->setMessage($message);

            // print_r($message);
            // die;
            if ($email->send()) {
                $this->model->insert($field);
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
    public function deleteSubscribe($id)
    {
        $user = model('User')->where('email',$id)->first();
        
        // Kirim email
        $toEmail  = $user['email'];
        $toName   = $user['nama'];
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
            $this->model->delete($user['id']);
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
    }
}
