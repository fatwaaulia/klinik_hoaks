<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Berita extends BaseController
{
    public function __construct()
    {
        $this->model = model('App\Models\Berita');
        $this->name = 'berita'; // title, nama folder view. | spasi menggunakan garis bawah(_)
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
            'id_kategori'   => 'required',
            'id_platform'   => 'required',
            'nama'          => 'required|is_unique[berita.nama]',
            'img'           => 'max_size[img,1024]|ext_in[img,png,jpg,jpeg]',
            'sumber'        => 'required',
            'img'           => 'max_size[img,1024]|ext_in[img,png,jpg,jpeg]',
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
                'id_kategori'   => $this->request->getVar('id_kategori', $this->filter),
                'id_platform'   => $this->request->getVar('id_platform', $this->filter),
                'nama'          => $this->request->getVar('nama', $this->filter),
                'slug'          => model('Env')->slug($this->request->getVar('nama', $this->filter)),
                'sumber'        => $this->request->getVar('sumber', $this->filter),
                'img'           => $file_name,
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
        if ($data['img']) {
            $uploaded = '';
        } else {
            $uploaded = 'uploaded[img]';
        }

        $rules = [
            'id_kategori'   => 'required',
            'id_platform'   => 'required',
            'nama'          => 'required|is_unique[berita.nama,id,'.$decode.']',
            'img'           => 'max_size[img,1024]|ext_in[img,png,jpg,jpeg]',
            'sumber'        => 'required',
            'img'           => 'max_size[img,1024]|ext_in[img,png,jpg,jpeg]',
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
                'id_kategori'   => $this->request->getVar('id_kategori', $this->filter),
                'id_platform'   => $this->request->getVar('id_platform', $this->filter),
                'nama'          => $this->request->getVar('nama', $this->filter),
                'slug'          => model('Env')->slug($this->request->getVar('nama', $this->filter)),
                'sumber'        => $this->request->getVar('sumber', $this->filter),
                'img'           => $file_name,
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
