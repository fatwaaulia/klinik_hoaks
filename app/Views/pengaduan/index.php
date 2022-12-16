<section>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h5 class="my-4 fw-500"><?= isset($title) ? $title : '' ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= session()->getFlashdata('message') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-3">

                <table class="table-default table-striped display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Status</th>
                            <th>Tiket</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Isi Laporan</th>
                            <th>Sumber</th>
                            <th>Tanggal</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $key => $v) : ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td>
                                <?php if($v['id_informasi']) { ?>
                                    <span class="text-success">Selesai diproses</span>
                                <?php } else { ?>
                                    <span class="text-danger">belum diproses</span>
                                <?php } ?>
                            </td>
                            <td><?= $v['kode'] ?></td>
                            <td><?= $v['nama'] ?></td>
                            <td><?= $v['email'] ?></td>
                            <td><?= $v['telp'] ?></td>
                            <td><?= mb_strimwidth($v['deskripsi'], 0, 40, "..."); ?></td>
                            <td><?= $v['sumber'] ?></td>
                            <td><?= date('d-m-Y H:i:s', strtotime($v['created_at'])) ?></td>
                            <td>
                                <a href="<?= $route.'/edit/'.model('Env')->encode($v['id']) ?>">
                                    <i class="fa-regular fa-pen-to-square fa-lg me-2"></i>
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#hapus_data<?= model('Env')->encode($v['id']) ?>">
                                    <i class="fa-regular fa-trash-can fa-lg text-danger"></i>
                                </a>
                                <!-- Modal -->
                                <div class="modal fade" id="hapus_data<?= model('Env')->encode($v['id']) ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="ws-normal mb-2"><b>Nama:</b> <?= $v['nama'] ?></div>
                                                <div class="ws-normal"><b>Email:</b> <?= $v['email'] ?></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="<?= $route.'/delete/'.model('Env')->encode($v['id']) ?>" method="post">
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>
</section>
