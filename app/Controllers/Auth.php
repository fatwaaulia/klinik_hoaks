<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->model = model('App\Models\User');
    }

    public function login()
    {
        if (session()->isLogin) return redirect()->to(base_url() . '/dashboard');
        $data['title'] = 'Login';
        $data['val'] = service('validation');

        $data['content'] = view('auth/login', $data);
        return view('dashboard/header', $data);
        
    }

    public function loginProcess()
    {
        $rules = [
            'email'     => 'required|valid_email',
            'password'  => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        } else {
            $where = [
                'email'         => $this->request->getVar('email', FILTER_SANITIZE_EMAIL),
                'password'      => $this->model->password_hash($this->request->getVar('password')),
            ];
            
            $user = $this->model->where($where)->first();
            $cek = $this->model->getWhere($where)->getNumRows();
            if ($cek > 0) {
                // SUDAH AKTIVASI
                if ($user['activated_at'] != '') {
                    $session = [
                        'isLogin' => true,
                        'user'    => $user,
                    ];
                    session()->set($session);
                    return redirect()->to(base_url() . '/dashboard');
                }else {
                    // BELUM AKTIVASI
                    // AKTIVASI VIA EMAIL
                    $where = [
                        'email' => $this->request->getVar('email', FILTER_SANITIZE_EMAIL)
                    ];
                    
                    $user = $this->model->where($where)->first();
                    if ($user['email']) :
                        for (;;) {
                            $get_token = model('Env')->random();
                            $cek_token = $this->model->getWhere(['token' => $get_token])->getNumRows();
                            if ($cek_token == 0) {
                                $this->model->update($user['id'], ['token' => $get_token]);
                                break;
                            }
                        }

                        $toEmail   = $user['email'];
                        $toName    = $user['nama'];
                        $subject   = 'Aktivasi Akun';
                        
                        $data['name'] = $toName;
                        $data['text'] = 'Terima kasih telah bergabung ' . getenv('app.name') . '. Silakan aktivasi akun dan Anda bisa login.';
                        $data['button_link'] = base_url() . '/account-activation/' . $get_token;
                        $data['button_name'] = 'Aktivasi Sekarang';
                        $message = view('auth/email_template', $data);

                        $email = service('email');
                        $email->setFrom($email->fromEmail, $email->fromName);
                        $email->setTo($toEmail);
                        $email->setSubject($subject);
                        $email->setMessage($message);

                        // die;
                        if ($email->send()) {
                            return redirect()->to(base_url() . '/login')
                            ->with('message',
                            "<script>
                                Swal.fire({
                                position: 'top-end',
                                icon: 'info',
                                title: 'Periksa email Anda dan aktivasi akun!',
                                })
                            </script>");
                        } else {
                            // $data = $email->printDebugger(['headers']);
                            // print_r($data);
                            // die;
                            return redirect()->to(base_url() . '/register')
                            ->with('message',
                            "<script>
                                Swal.fire({
                                position: 'top-end',
                                icon: 'info',
                                title: 'Permintaan gagal diproses, silakan coba lagi!',
                                })
                            </script>");
                        }
                    endif;
                }

            } else {
                return redirect()->to(base_url() . '/login')
                ->with('message',
                "<script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Email atau password salah!',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    })
                </script>");
            }
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url() . '/login');
    }

    public function register()
    {
        if (session()->isLogin) return redirect()->to(base_url() . '/dashboard');
        $data['title'] = 'Register';
        $data['val'] = service('validation');

        $data['content'] = view('auth/register', $data);
        return view('dashboard/header', $data);
    }
    public function registerProcess()
    {   
        $rules = [
            'nama'          => 'required',
            'email'         => 'required|valid_email|is_unique[user.email]',
            'password'      => 'required|min_length[8]',
            'passconf'      => 'required|min_length[8]|matches[password]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }else {
            $field = [
                'id_role'       => '3',
                'nama'          => $this->request->getVar('nama', $this->filter),
                'email'         => $this->request->getVar('email', FILTER_SANITIZE_EMAIL),
                'password'      => $this->model->password_hash($this->request->getVar('password')),
            ];
            
            // dd($field);
            $this->model->insert($field);
            
            // AKTIVASI VIA EMAIL
            $user = $this->model->where('email', $field['email'])->first();
            if ($user['email']) :
                for (;;) {
                    $get_token = model('Env')->random();
                    $cek_token = $this->model->getWhere(['token' => $get_token])->getNumRows();
                    if ($cek_token == 0) {
                        $this->model->update($user['id'], ['token' => $get_token]);
                        break;
                    }
                }

                $toEmail  = $user['email'];
                $toName   = $user['nama'];
                $subject  = 'Aktivasi Akun';
                
                $data['name'] = $toName;
                $data['text'] = 'Terima kasih telah bergabung ' . getenv('app.name') . '. Silakan aktivasi akun dan Anda bisa login.';
                $data['button_link'] = base_url() . '/account-activation/' . $get_token;
                $data['button_name'] = 'Aktivasi Sekarang';
                $message = view('auth/email_template', $data);

                $email = service('email');
                $email->setFrom($email->fromEmail, $email->fromName);
                $email->setTo($toEmail);
                $email->setSubject($subject);
                $email->setMessage($message);

                // die;
                if ($email->send()) {
                    return redirect()->to(base_url() . '/register')
                    ->with('message',
                    "<script>
                        Swal.fire({
                        position: 'top-end',
                        icon: 'info',
                        title: 'Periksa email Anda dan aktivasi akun!',
                        })
                    </script>");
                } else {
                    // $data = $email->printDebugger(['headers']);
                    // print_r($data);
                    // die;
                    return redirect()->to(base_url() . '/register')
                    ->with('message',
                    "<script>
                        Swal.fire({
                        position: 'top-end',
                        icon: 'info',
                        title: 'Permintaan gagal diproses, silakan coba lagi!',
                        })
                    </script>");
                }
            endif;
        }
    }

    public function accountActivation($token)
    {
        $user = $this->model->where('token', $token)->first();
        if (!$user) {
            $data['title'] = '404';
            $data['error_msg'] = 'KODE KEDALUWARSA, SILAHKAN AKTIVASI ULANG!';
            $data['content'] = view('errors/e404',$data);
            return view('dashboard/header',$data);
        } else {
            $toEmail  = $user['email'];
            $toName   = $user['nama'];
            $subject  = 'Berhasil Aktivasi Akun';
            
            $data['name'] = $toName;
            $data['text'] = 'Selamat! Akun ' . getenv('app.name') . ' Anda telah aktif. Sekarang Anda bisa login.';
            $data['button_link'] = base_url('login');
            $data['button_name'] = 'Login';
            $message = view('auth/email_template', $data);

            $email = service('email');
            $email->setFrom($email->fromEmail, $email->fromName);
            $email->setTo($toEmail);
            $email->setSubject($subject);
            $email->setMessage($message);
            $email->send();

            $data = [
                'activated_at' => date('Y-m-d H:i:s'),
                'token' => '',
            ];
            $this->model->update($user['id'], $data);

            return redirect()->to(base_url() . '/login')
            ->with('message',
            "<script>
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Aktivasi akun berhasil, silahkan login',
                })
            </script>");
        }
    }

    // FORGOT PASSWORD
    public function forgotPassword()
    {
        if (session()->isLogin) return redirect()->to(base_url() . '/dashboard');
        $data['title'] = 'Lupa Password';
        $data['val'] = service('validation');

        $data['content'] = view('auth/lupa_password', $data);
        return view('dashboard/header', $data);
    }

    public function forgotPasswordProcess()
    {
        if (!$this->validate(['email' => 'required|valid_email'])) {
            return redirect()->to(base_url() . '/forgot-password')
                ->withInput();
        } else {
            $where = [
                'email' => $this->request->getVar('email', FILTER_SANITIZE_EMAIL)
            ];
            $cek = $this->model->getWhere($where)->getNumRows();
            $user = $this->model->where($where)->first();
            if ($cek > 0) {
                for (;;) {
                    $get_token = model('Env')->random();
                    $cek_token = $this->model->getWhere(['token' => $get_token])->getNumRows();
                    if ($cek_token == 0) {
                        $this->model->update($user['id'], ['token' => $get_token]);
                        break;
                    }
                }

                $toEmail    = $user['email'];
                $toName     = $user['nama'];
                $subject    = 'Permintaan Reset Password';

                $data['name'] = $toName;
                $data['text'] = 'Kata sandi Anda dapat diatur ulang dengan klik tombol di bawah. Jika Anda tidak meminta kata sandi baru, abaikan email ini.';
                $data['button_link'] = base_url() . '/reset-password/'. $get_token;
                $data['button_name'] = 'Reset Password';
                $message = view('auth/email_template', $data);

                // echo $message;
                // die;

                $email = service('email');
                $email->setFrom($email->fromEmail, $email->fromName);   
                $email->setTo($toEmail);
                $email->setSubject($subject);
                $email->setMessage($message);

                if ($email->send()) {
                    // BERHASIL KIRIM EMAIL
                    return redirect()->to(base_url() . '/forgot-password')
                    ->with('message',
                    "<script>
                        Swal.fire({
                        position: 'top-end',
                        icon: 'info',
                        title: 'Permintaan telah dikirim, silahkan periksa email Anda!',
                        })
                    </script>");
                } else {
                    // $data = $email->printDebugger(['headers']);
                    // print_r($data);
                    // die;
                    // GAGAL KIRIM EMAIL
                    return redirect()->to(base_url() . '/forgot-password')
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
            // EMAIL TIDAK DITEMUKAN
            return redirect()->to(base_url() . '/forgot-password')
                ->with('message',
                "<script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Email tidak ditemukan!',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    })
                </script>");
            }
        }
    }

    public function resetPassword($token = null)
    {
        if (session()->isLogin) return redirect()->to(base_url() . '/dashboard');
        $data['title'] = 'Reset Password';
        $data['val'] = service('validation');

        $cek = $this->model->getWhere(['token' => $token])->getNumRows();
        if ($cek > 0) {
            $data['user'] = $this->model->where('token', $token)->first();
            $data['content'] = view('auth/reset_password', $data);
            return view('dashboard/header', $data);
        } else {
            $data['error_msg'] = 'KODE KADALUARSA ATAU TIDAK DITEMUKAN!';
            $data['title'] = '404';
            $data['content'] = view('errors/e404',$data);
            return view('dashboard/header',$data);
        }
    }

    public function resetPasswordProcess($token = null)
    {
        $rules = [
            'password'      => 'required|min_length[8]',
            'passconf'      => 'required|min_length[8]|matches[password]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        } else {
            $user = $this->model->where('token', $token)->first();
            $data = [
                'password' => $this->model->password_hash($this->request->getVar('password')),
                'token'    => '',
            ];
            $this->model->update($user['id'], $data);
            return redirect()->to(base_url() . '/login')
            ->with('message',
            "<script>
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Reset password berhasil, silahkan login',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                })
            </script>");
        }
    }

    public function template() 
    {
        $data['name'] = 'Pengguna';
        $data['text'] = 'Terima kasih telah bergabung ' . getenv('app.name') . '.';
        $data['button_link'] = base_url();
        $data['button_name'] = 'Kembali';

        return view('auth/email_template', $data);
    }

}
