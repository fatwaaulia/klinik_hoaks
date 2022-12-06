<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class User extends BaseController
{
    public function __construct()
    {
        $this->model = model('App\Models\User');
        $this->name = 'user'; // title, nama folder view. | spasi menggunakan garis bawah(_)
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
            'id_role'       => 'required',
            'nama'          => 'required',
            'username'      => 'required|is_unique[user.username]',
            'email'         => 'required|valid_email|is_unique[user.email]',
            'password'      => 'required|min_length[8]',
            'passconf'      => 'required|min_length[8]|matches[password]',
            'jenis_kelamin' => 'required',
            'img'           => 'max_size[img,1024]|ext_in[img,png,jpg,jpeg]',
            'alamat'        => 'max_length[255]',
            'telp'          => 'required|numeric|min_length[10]|max_length[15]|is_unique[user.telp]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }else {
            $img = $this->request->getFile('img');
            if ($img != '') {
                $file_name = $img->getRandomName();
                $this->image->withFile($img)
                    ->save('assets/img/'.$this->name.'/'.$file_name, 60);
            } else {
                $file_name = '';
            }

            $field = [
                'id_role'       => $this->request->getVar('id_role', $this->filter),
                'nama'          => $this->request->getVar('nama', $this->filter),
                'username'      => $this->request->getVar('username', $this->filter),
                'email'         => $this->request->getVar('email', FILTER_SANITIZE_EMAIL),
                'password'      => $this->model->password_hash($this->request->getVar('password')),
                'jenis_kelamin' => $this->request->getVar('jenis_kelamin', $this->filter),
                'img'           => $file_name,
                'alamat'        => $this->request->getVar('alamat', $this->filter),
                'telp'          => $this->request->getVar('telp', $this->filter),
            ];
            
            // dd($field);
            $this->model->insert($field);
            return redirect()->to($this->route)
                ->with('message',
                "<script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Tambah data berhasil',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    })
                </script>");
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

        $password = $this->request->getVar('password');
        $passconf = $this->request->getVar('passconf');
        if ($password == '' && $passconf == '') {
            $matches = 'string';
        } elseif ($password == '' || $passconf == '') {
            $matches = 'required|min_length[8]|matches[password]'; 
        } elseif ($password != '' && $passconf != '') {
            $matches = 'required|min_length[8]|matches[password]';
        }
        $rules = [
            'id_role'       => 'required',
            'nama'          => 'required',
            'username'      => 'required|is_unique[user.username,id,'.$decode.']',
            'email'         => 'required|is_unique[user.email,id,'.$decode.']',
            'passconf'      => $matches,
            'jenis_kelamin' => 'required',
            'img'           => 'max_size[img,1024]|ext_in[img,png,jpg,jpeg]',
            'alamat'        => 'max_length[255]',
            'telp'          => 'required|numeric|min_length[10]|max_length[15]|is_unique[user.telp,id,'.$decode.']',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }else {
            $img = $this->request->getFile('img');
            if ($img != '') {
                $file_name = $img->getRandomName();
                $this->image->withFile($img)
                    ->save('assets/img/'.$this->name.'/'.$file_name, 60);
                $file = 'assets/img/'.$this->name.'/'.$data['img'];
                if (is_file($file)) unlink($file);
            } else {
                $file_name = $data['img'];
            }

            $field = [
                'id_role'       => $this->request->getVar('id_role', $this->filter),
                'nama'          => $this->request->getVar('nama', $this->filter),
                'username'      => $this->request->getVar('username', $this->filter),
                'email'         => $this->request->getVar('email', FILTER_SANITIZE_EMAIL),
                'password'      => $password != '' ? $this->model->password_hash($password) : $data['password'],
                'jenis_kelamin' => $this->request->getVar('jenis_kelamin', $this->filter),
                'img'           => $file_name,
                'alamat'        => $this->request->getVar('alamat', $this->filter),
                'telp'          => $this->request->getVar('telp', $this->filter),
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

    public function deleteImg($id = null)
    {
        $decode = model('Env')->decode($id);
        $data = $this->model->find($decode);

        $file = 'assets/img/'.$this->name.'/'.$data['img'];
        if (is_file($file)) unlink($file);

        // die;
        $this->model->update($decode, ['img'=>'']);
        return redirect()->to($this->route .'/edit/'.$id)
            ->with('message',
            "<script>
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Foto profil dihapus',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                })
            </script>");
    }

    // PROFILE
    public function profile()
    {
        $id = $this->user_session['id'];
        $data['data'] = $this->model->find($id);
        $data['name'] = $this->name;
        $data['route'] = $this->route;
        $data['title'] = 'Profil - ' . $data['data']['nama'];
        $data['val']     = service('validation');

        $data['content']   = view($this->name.'/profile',$data);
        $data['sidebar'] = view('dashboard/sidebar',$data);
        return view('dashboard/header',$data);
    }

    public function updateProfile()
    {
        $id = $this->user_session['id'];
        $data = $this->model->find($id);

        $rules = [
            'nama'          => 'required',
            'username'      => 'required|is_unique[user.username,id,'.$id.']',
            'jenis_kelamin' => 'required',
            'img'           => 'max_size[img,1024]|ext_in[img,png,jpg,jpeg]',
            'alamat'        => 'required|max_length[255]',
            'telp'          => 'required|numeric|min_length[10]|max_length[15]|is_unique[user.telp,id,'.$id.']',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }else {
            $img = $this->request->getFile('img');
            if ($img != '') {
                $file_name = $img->getRandomName();
                $this->image->withFile($img)
                    ->save('assets/img/'.$this->name.'/'.$file_name, 60);
                $file = 'assets/img/'.$this->name.'/'.$data['img'];
                if (is_file($file)) unlink($file);
            } else {
                $file_name = $data['img'];
            }

            $field = [
                'nama'          => $this->request->getVar('nama', $this->filter),
                'username'      => $this->request->getVar('username', $this->filter),
                'jenis_kelamin' => $this->request->getVar('jenis_kelamin', $this->filter),
                'img'           => $file_name,
                'alamat'        => $this->request->getVar('alamat', $this->filter),
                'telp'          => $this->request->getVar('telp', $this->filter),
            ];
            
            // dd($field);
            $this->model->update($id, $field);
            return redirect()->to($this->route)
                ->with('message',
                "<script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Edit profil berhasil',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    })
                </script>");
        }
    }

    public function updatePassword($id = null)
    {
        $id = $this->user_session['id'];
        $data = $this->model->find($id);

        $oldpass = $this->request->getVar('oldpass');
        $password = $this->request->getVar('password');
        $passconf = $this->request->getVar('passconf');

        if (!empty($oldpass && $password && $passconf) 
            && strlen($password) >= 8
            && strlen($passconf) >= 8 ) {
            // Tidak ada yang kosong dan >= 8
            if (($data['password'] == $this->model->password_hash($oldpass)) && ($password == $passconf)) {
                // True
                $field = [
                    'password'   => $this->model->password_hash($password),
                ];
                $this->model->update($id, $field);
                session()->remove(['isLogin', 'user']);
                return redirect()->to(base_url('login'))
                ->with('message',
                "<script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Ubah password berhasil, silahkan login kembali',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    })
                </script>");
            } else {
                // False
                return redirect()->to($this->route)
                ->with('message',
                "<script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Password saat ini salah!',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    })
                </script>");
            }
        } else {
            // Tidak memenuhi ketentuan
            return redirect()->to($this->route)
                ->with('message',
                "<script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Password setidaknya harus berisi 8 karakter!',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    })
                </script>");
        }
    }

    public function deleteProfileImg()
    {
        $id = $this->user_session['id'];
        $data = $this->model->find($id);

        $file = 'assets/img/'.$this->name.'/'.$data['img'];
        if (is_file($file)) unlink($file);

        // die;
        $this->model->update($id, ['img'=>'']);
        return redirect()->to($this->route)
            ->with('message',
            "<script>
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Foto profil dihapus',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                })
            </script>");
    }
}
