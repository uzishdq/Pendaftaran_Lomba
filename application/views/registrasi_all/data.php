<?= $this->session->flashdata('pesan'); ?>

<div class="tabs m-3">
    <ul class="nav nav-tabs justify-content-center" id="teamTab" role="tablist">
        <?php
        if ($event) :
            foreach ($event as $e) :
        ?>
                <li class="nav-item" role="presentation">
                    <a class="nav-link inline" onclick="showTable('<?= $e['ID_EVENT']; ?>')" data-toggle="tab" href="#"><?= $e['NAMA_EVENT']; ?></a>
                <?php endforeach; ?>
            <?php else : ?>
                <a class="nav-link active" id="doctor-tab" data-toggle="tab" href="#" role="tab" aria-selected="true">Tidak Ada Event</a>
                </li>
            <?php endif; ?>
    </ul>
</div>

<?php
if ($registerAll) :
    foreach ($registerAll as $e) :
        $table_id = $e['ID_EVENT']; // Ganti 'ID_TABLE' dengan nama kolom yang berisi id tabel dari SQL
?>
        <div class="table-container" id="<?= $table_id ?>">
            <div class="card shadow-sm border-bottom-primary">
                <div class="card-header bg-white py-3">
                    <div class="row">
                        <div class="col">
                            <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                                Pendaftaran <?= $e['NAMA_EVENT']; ?>
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
                                        <td><?= $e['STATUS_EVENT']; ?></td>
                                        <th>
                                            <a href="<?= base_url('registrasi_all/toggle/') . $e['ID_REGISTRASI'] ?>" class="btn btn-circle btn-sm <?= $e['STATUS_REGISTRASI'] ? 'btn-secondary' : 'btn-success' ?>" title="<?= $e['STATUS_REGISTRASI'] ? 'Tolak' : 'Terima' ?>"><i class="fa fa-fw fa-power-off"></i></a>
                                            <!-- <a href="<?= base_url('event/edit/') . $e['ID_EVENT'] ?>" class="btn btn-circle btn-warning btn-sm"><i class="fa fa-edit"></i></a> -->
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
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <h2>Data Tidak Ada</h2>
<?php endif; ?>


<script>
    function showTable(tableId) {
        // Semua div yang berisi tabel memiliki class "table-container"
        var tableContainers = document.getElementsByClassName("table-container");

        // Sembunyikan semua tabel terlebih dahulu
        for (var i = 0; i < tableContainers.length; i++) {
            tableContainers[i].style.display = "none";
        }

        // Tampilkan tabel yang dipilih
        var selectedTableDiv = document.getElementById(tableId);
        if (selectedTableDiv) {
            selectedTableDiv.style.display = "block";
        }
    }
</script>

<style>
    /* CSS untuk menyembunyikan semua tabel dengan class "table-container" */
    .table-container {
        display: none;
    }
</style>