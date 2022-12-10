<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pengaduan extends BaseController
{
    public function __construct()
    {
        $this->model = model('App\Models\Pengaduan');
        $this->name = 'pengaduan'; // title, nama folder view. | spasi menggunakan garis bawah(_)
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data['data'] = $this->model->findAll();
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
        $rules = [
            'nama'          => 'required',
            'telp'          => 'required|numeric|min_length[10]|max_length[15]',
            'email'         => 'required|valid_email',
            'deskripsi'     => 'required',
            'img'           => 'max_size[img,1024]|ext_in[img,png,jpg,jpeg]',
            'sumber'        => 'required',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }else {
            for (;;) {
                $get_tiket = model('Env')->randomNumeric();
                $cek_tiket = $this->model->getWhere(['kode' => $get_tiket])->getNumRows();
                if ($cek_tiket == 0) {
                    break;
                }
            }
            
            $img = $this->request->getFile('img');
            if ($img != '') {
                $file_name = $img->getRandomName();
                $this->image->withFile($img)
                    ->save('assets/img/'.$this->name.'/'.$file_name, 60);
            } else {
                $file_name = '';
            }

            $field = [
                'kode'          => $get_tiket,
                'nama'          => $this->request->getVar('nama', $this->filter),
                'telp'          => $this->request->getVar('telp', $this->filter),
                'email'         => $this->request->getVar('email', FILTER_SANITIZE_EMAIL),
                'deskripsi'     => $this->request->getVar('deskripsi', $this->filter),
                'img'           => $file_name,
                'sumber'        => $this->request->getVar('sumber', $this->filter),
            ];

            // Kirim email
            $toEmail  = $field['email'];
            $toName   = $field['nama'];
            $subject  = 'Permohonan Klarifikasi Informasi';
            
            $data['name'] = $toName;
            $data['text'] = 'Terima kasih telah melakukan permohonan klarifikasi informasi. 
                            <br> Anda mendapatkan nomor tiket : '. $get_tiket.
                            '<br> <br> Silahkan cek klarifikasi melalui link berikut : <a href="'.base_url(). '/pengaduan/tracking/' . $get_tiket . '">'.base_url(). '/pengaduan/tracking/' . $get_tiket.'</a>';
            $data['button_link'] = '';
            $data['button_name'] = '';
            $message = view('auth/email_template', $data);

            $email = service('email');
            $email->setFrom($email->fromEmail, $email->fromName);
            $email->setTo($toEmail);
            $email->setSubject($subject);
            $email->setMessage($message);

            if ($email->send()) {
                $this->model->insert($field);
                return redirect()->to(base_url('pengaduan/klarifikasi'))
                ->with('message',
                "<script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Pengaduan berhasil dikirim',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    })
                </script>");
            } else {
                return redirect()->to(base_url('pengaduan/klarifikasi'))
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
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $decode = model('Env')->decode($id);
        $data = $this->model->find($decode);

        $rules = [
            'id_berita'       => 'required',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }else {
            $field = [
                'id_berita'       => $this->request->getVar('id_berita', $this->filter),
            ];
            
            // dd($field);
            $this->model->update($decode, $field);
            return redirect()->to($this->route)
                ->with('message',
                "<script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Edit data berhasil',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    })
                </script>");
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $decode = model('Env')->decode($id);
        $data = $this->model->find($decode);

        $file = 'assets/img/'.$this->name.'/'.$data['img'];
        if (is_file($file)) unlink($file);

        // die;
        $this->model->delete($decode);
        return redirect()->to($this->route)
            ->with('message',
            "<script>
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Hapus data berhasil',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                })
            </script>");
    }
}
