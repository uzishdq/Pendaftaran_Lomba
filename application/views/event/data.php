<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Event
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('event/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Tambah Event
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Event</th>
                    <th>Deskripsi</th>
                    <th>Kategori</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Akhir</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($event) :
                    $no = 1;
                    foreach ($event as $e) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $e['nama_event']; ?></td>
                            <td><?= $e['deskripsi']; ?></td>
                            <td><?= $e['nama_jenis']; ?></td>
                            <td><?= $e['tanggal_mulai']; ?></td>
                            <td><?= $e['tanggal_akhir']; ?></td>
                            <th>
                                <a href="<?= base_url('event/edit/') . $e['id_event'] ?>" class="btn btn-circle btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('event/delete/') . $e['id_event'] ?>" class="btn btn-circle btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </th>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>