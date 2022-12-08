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
        $data['data'] = $this->model->orderBy('created_at', 'DESC')->findAll();
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

            // barchart
            $barchart = model('Barchart')->orderBy('id','DESC')->first();
            $bulan_sekarang = date('M Y');
            switch ($field['id_kategori']) {
                case 1:
                    if ($barchart['bulan'] == $bulan_sekarang) {
                        $plus_hoaks = $barchart['hoaks'] + 1;
                    } else {
                        $plus_hoaks = 1;
                    }
                    break;
                case 2:
                    if ($barchart['bulan'] == $bulan_sekarang) {
                        $plus_fakta = $barchart['fakta'] + 1;
                    } else {
                        $plus_fakta = 1;
                    }
                    break;
                case 3:
                    if ($barchart['bulan'] == $bulan_sekarang) {
                        $plus_disinformasi = $barchart['disinformasi'] + 1;
                    } else {
                        $plus_disinformasi = 1;
                    }
                    break;
                case 4:
                    if ($barchart['bulan'] == $bulan_sekarang) {
                        $plus_hatespeech = $barchart['hate_speech'] + 1;
                    } else {
                        $plus_hatespeech = 1;
                    }
                    break;
                default:
                    break;
            }
            if ($barchart['bulan'] == $bulan_sekarang) { // belum ganti bulan
                $field_barchart = [
                    'hoaks'         => $plus_hoaks ?? $barchart['hoaks'],
                    'fakta'         => $plus_fakta ?? $barchart['fakta'],
                    'disinformasi'  => $plus_disinformasi ?? $barchart['disinformasi'],
                    'hate_speech'   => $plus_hatespeech ?? $barchart['hate_speech'],
                ];
                $this->barchart->update($barchart['id'], $field_barchart);
            } else {
                $field_barchart = [
                    'bulan'         => $bulan_sekarang,
                    'hoaks'         => $plus_hoaks ?? 0,
                    'fakta'         => $plus_fakta ?? 0,
                    'disinformasi'  => $plus_disinformasi ?? 0,
                    'hate_speech'   => $plus_hatespeech ?? 0,
                ];
                $this->barchart->insert($field_barchart);
            }
            
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

            // Ubah kategori
            if ($field['id_kategori'] != $data['id_kategori']) {
                // barchart by bulan
                $barchart = model('Barchart')->where('bulan',date('M Y', strtotime($data['created_at'])))->first();
                switch ($field['id_kategori']) {
                    case 1: // ubah hoaks
                        // +1
                        $plus_hoaks = $barchart['hoaks'] + 1;
                        // -1
                        if ($data['id_kategori'] == 2) { // fakta
                            $min_fakta = $barchart['fakta'] - 1;
                        } elseif ($data['id_kategori'] == 3) { // disinformasi
                            $min_disinformasi = $barchart['disinformasi'] - 1;
                        } elseif ($data['id_kategori'] == 4) { // hate speech
                            $min_hatespeech = $barchart['hate_speech'] - 1;
                        }
                        break;
                    case 2: // ubah fakta
                        // +1
                        $plus_fakta = $barchart['fakta'] + 1;
                        // -1
                        if ($data['id_kategori'] == 1) { // hoaks
                            $min_hoaks = $barchart['hoaks'] - 1;
                        } elseif ($data['id_kategori'] == 3) { // disinformasi
                            $min_disinformasi = $barchart['disinformasi'] - 1;
                        } elseif ($data['id_kategori'] == 4) { // hate speech
                            $min_hatespeech = $barchart['hate_speech'] - 1;
                        }
                        break;
                    case 3: // ubah disinformasi
                        // +1
                        $plus_disinformasi = $barchart['disinformasi'] + 1;
                        // -1
                        if ($data['id_kategori'] == 2) { // fakta
                            $min_fakta = $barchart['fakta'] - 1;
                        } elseif ($data['id_kategori'] == 1) { // hoaks
                            $min_hoaks = $barchart['hoaks'] - 1;
                        } elseif ($data['id_kategori'] == 4) { // hate speech
                            $min_hatespeech = $barchart['hate_speech'] - 1;
                        }
                        break;
                    case 4: // ubah hatespeech
                      // +1
                      $plus_hatespeech = $barchart['hate_speech'] + 1;
                      // -1
                      if ($data['id_kategori'] == 2) { // fakta
                          $min_fakta = $barchart['fakta'] - 1;
                      } elseif ($data['id_kategori'] == 3) { // disinformasi
                          $min_disinformasi = $barchart['disinformasi'] - 1;
                      } elseif ($data['id_kategori'] == 1) { // hate speech
                          $min_hoaks = $barchart['hoaks'] - 1;
                      }
                        break;
                    default:
                        break;
                }
                $field_barchart = [
                    // 'bulan'         => date('M Y', strtotime($data['created_at'])),
                    'hoaks'         => $plus_hoaks ?? $min_hoaks ?? $barchart['hoaks'],
                    'fakta'         => $plus_fakta ?? $min_fakta ?? $barchart['fakta'],
                    'disinformasi'  => $plus_disinformasi ?? $min_disinformasi ?? $barchart['disinformasi'],
                    'hate_speech'   => $plus_hatespeech ?? $min_hatespeech ?? $barchart['hate_speech'],
                ];
                // dd($field_barchart);
                $this->barchart->update($barchart['id'], $field_barchart);
            }    
            
            // die;
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

        // barchart
        $barchart = model('Barchart')->where('bulan',date('M Y', strtotime($data['created_at'])))->first();
        switch ($data['id_kategori']) {
            case 1:
                $min_hoaks = $barchart['hoaks'] - 1;
                break;
            case 2:
                $min_fakta = $barchart['fakta'] - 1;
                break;
            case 3:
                $min_disinformasi = $barchart['disinformasi'] - 1;
                break;
            case 4:
                $min_hatespeech = $barchart['hate_speech'] - 1;
                break;
            default:
                break;
        }
        $field_barchart = [
            'hoaks'         => $min_hoaks ?? $barchart['hoaks'],
            'fakta'         => $min_fakta ?? $barchart['fakta'],
            'disinformasi'  => $min_disinformasi ?? $barchart['disinformasi'],
            'hate_speech'   => $min_hatespeech ?? $barchart['hate_speech'],
        ];
        $this->barchart->update($barchart['id'], $field_barchart);

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
