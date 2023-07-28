<?= $this->session->flashdata('pesan'); ?>

<div class="tabs m-3">
    <ul class="nav nav-tabs justify-content-center" id="teamTab" role="tablist">
        <?php
        if ($jenisEvent) :
            foreach ($jenisEvent as $je) :
        ?>
                <li class="nav-item" role="presentation">
                    <a class="nav-link inline" onclick="showTable('<?= $je['ID_JENIS_EVENT']; ?>')" data-toggle="tab" href="#"><?= $je['NAMA_JENIS_EVENT']; ?></a>
                <?php endforeach; ?>
            <?php else : ?>
                <a class="nav-link active" data-toggle="tab" href="#" role="tab" aria-selected="true">Tidak Ada Event</a>
                </li>
            <?php endif; ?>
    </ul>
</div>

<?php
if ($jenisEvent) :
    foreach ($jenisEvent as $je) :
?>
        <div class="table-container" id="<?= $je['ID_JENIS_EVENT']; ?>">
            <div class="card shadow-sm border-bottom-primary">
                <div class="card-header bg-white py-3">
                    <div class="row">
                        <div class="col">
                            <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                                Pendaftaran <?= $je['NAMA_JENIS_EVENT']; ?>
                            </h4>
                        </div>
                        <div class="col-auto">
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
                                <th>Status Event</th>
                                <th>Bukti Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $foundEvent = false;
                            if ($registerAll) :
                                foreach ($registerAll as $e) :
                                    if ($e['ID_JENIS_EVENT'] == $je['ID_JENIS_EVENT']) {
                                        $foundEvent = true;
                            ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $e['ID_REGISTRASI']; ?></td>
                                            <td><?= $e['NAMA_EVENT']; ?></td>
                                            <td><?= $e['NAMA_TEAM']; ?></td>
                                            <td><?= $e['JUMLAH_PESERTA']; ?></td>
                                            <td><?= $e['STATUS_EVENT']; ?></td>
                                            <td><a href="<?= base_url('/') . $e['BUKTI_BAYAR'] ?>" target="_blank">Bukti Registrasi</a></td>
                                            <th>
                                                <a href="<?= base_url('registrasi_all/toggle/') . $e['ID_REGISTRASI'] ?>" class="btn btn-circle btn-sm <?= $e['STATUS_REGISTRASI'] ? 'btn-secondary' : 'btn-success' ?>" title="<?= $e['STATUS_REGISTRASI'] ? 'Tolak' : 'Terima' ?>"><i class="fa fa-fw fa-power-off"></i></a>
                                                <!-- <a href="<?= base_url('event/edit/') . $e['ID_EVENT'] ?>" class="btn btn-circle btn-warning btn-sm"><i class="fa fa-edit"></i></a> -->
                                                <a onclick="return confirm('Yakin ingin hapus? <?= $e['NAMA_EVENT']; ?>')" href="<?= base_url('event/delete/') . $e['ID_EVENT'] ?>" class="btn btn-circle btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                            </th>
                                        </tr>
                                <?php
                                    }
                                endforeach;
                            endif;

                            if (!$foundEvent) :
                                ?>
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
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <div class="card shadow-sm mb-4 border-bottom-primary">
        <div class="card-header bg-white py-3">
            <div class="row">
                <div class="col">
                    <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                        Tidak Ada Data
                    </h4>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


<script>
    function showTable(idJenisEvent) {
        var tableContainers = document.getElementsByClassName('table-container');
        for (var i = 0; i < tableContainers.length; i++) {
            if (tableContainers[i].id === idJenisEvent) {
                tableContainers[i].style.display = 'block';
            } else {
                tableContainers[i].style.display = 'none';
            }
        }
    }
</script>