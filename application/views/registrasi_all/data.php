<?= $this->session->flashdata('pesan'); ?>

<div class="tabs m-3">
    <ul class="nav nav-tabs justify-content-center" id="teamTab" role="tablist">
        <?php
        if ($event) :
            foreach ($event as $e) :
        ?>
                <li class="nav-item" role="presentation">
                    <a class="nav-link inline" id="doctor-tab" data-toggle="tab" href="#doctor" role="tab" aria-controls="doctor" aria-selected="true"><?= $e['NAMA_EVENT']; ?></a>
                <?php endforeach; ?>
            <?php else : ?>
                <a class="nav-link active" id="doctor-tab" data-toggle="tab" href="#" role="tab" aria-controls="doctor" aria-selected="true">Tidak Ada Event</a>
                </li>
            <?php endif; ?>
    </ul>
</div>

<!-- <p>
    <?php
    if ($registerAll) :
        foreach ($registerAll as $ra) :
    ?>
<p><?= $ra['NAMA_EVENT']; ?></p>
<?php endforeach; ?>
<?php else : ?>
    <p>Tidak Ada Data</p>
<?php endif; ?>
</p> -->

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
                        <th>No Registrasi</th>
                        <th>Nama Event</th>
                        <th>Nama Team</th>
                        <th>Jumlah Peserta</th>
                        <th>Bukti Bayar</th>
                        <th>Nama Pengurus</th>
                        <th>Status Event</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($registerAll) :
                        $no = 1;
                        foreach ($registerAll as $e) :
                    ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $e['ID_REGISTRASI']; ?></td>
                                <td><?= $e['NAMA_EVENT']; ?></td>
                                <td><?= $e['NAMA_TEAM']; ?></td>
                                <td><?= $e['JUMLAH_PESERTA']; ?></td>
                                <td><?= $e['BUKTI_BAYAR']; ?></td>
                                <td><?= $e['NAMA_CONTACT_PERSON']; ?></td>
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