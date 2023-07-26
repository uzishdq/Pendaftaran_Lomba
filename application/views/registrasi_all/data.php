<?= $this->session->flashdata('pesan'); ?>

    <div class="tabs m-3">
        <ul class="nav nav-tabs justify-content-center" id="teamTab" role="tablist">
            <li class="nav-item" role="presentation">
                <?php
                if ($event) :
                    foreach ($event as $e) :
                        ?>
                    <a class="nav-link active" id="doctor-tab" data-toggle="tab" href="#doctor" role="tab" aria-controls="doctor" aria-selected="true"><?= $e['NAMA_EVENT']; ?></a>
                <?php endforeach; ?>
                <?php else : ?>
                    <a class="nav-link active" id="doctor-tab" data-toggle="tab" href="#" role="tab" aria-controls="doctor" aria-selected="true">Tidak Ada Event</a>
                <?php endif; ?>
            </li>
        </ul>
    </div>

    <p>
        <?php
            if ($registerAll) :
                foreach ($registerAll as $ra) :
            ?>
            <p><?= $ra['NAMA_EVENT']; ?></p>
            <?php endforeach; ?>
            <?php else : ?>
                    <p>Tidak Ada Data</p>
            <?php endif; ?>
    </p>

<div class="tab-content" id="teamTab">
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
                            <td><?= $e['BIAYA_EVENT']; ?></td>
                            <td><?= $e['BANK_EVENT']; ?></td>
                            <td><?= $e['STATUS_EVENT']; ?></td>
                            <th>
                                <a href="<?= base_url('event/edit/') . $e['ID_EVENT'] ?>" class="btn btn-circle btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('Yakin ingin hapus? <?= $e['NAMA_EVENT']; ?>')" href="<?= base_url('event/delete/') . $e['ID_EVENT'] ?>" class="btn btn-circle btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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