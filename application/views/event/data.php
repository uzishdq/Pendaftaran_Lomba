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
                    <th>Kategori</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Akhir</th>
                    <th>Biaya Pendaftaran</th>
                    <th>Bank</th>
                    <th>Status Event</th>
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
                            <td><?= $e['NAMA_EVENT']; ?></td>
                            <td><?= $e['NAMA_JENIS_EVENT']; ?></td>
                            <td><?= $e['TGL_MULAI_EVENT']; ?></td>
                            <td><?= $e['TGL_AKHIR_EVENT']; ?></td>
                            <td>Rp. <?= number_format($e['BIAYA_EVENT'], 0, ',', '.'); ?></td>
                            <td><?= $e['BANK_EVENT']; ?></td>
                            <td><?= $e['STATUS_EVENT']; ?></td>
                            <th>
                                <a href="<?= base_url('event/edit/') . $e['ID_EVENT'] ?>" class="btn btn-circle btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <?php if (is_admin()) : ?>
                                    <a onclick="return confirm('Yakin ingin hapus? <?= $e['NAMA_EVENT']; ?>')" href="<?= base_url('event/delete/') . $e['ID_EVENT'] ?>" class="btn btn-circle btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                <?php endif; ?>
                            </th>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="9" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>