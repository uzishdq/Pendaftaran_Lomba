<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm mb-4 border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Upload Jadwal Pertandingan
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('jadwal/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-sitemap"></i>
                    </span>
                    <span class="text">
                        Upload
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped" id="dataTable">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>Nama Atribut</th>
                    <th> Event</th>
                    <th>Jadwal Pertandingan</th>
                    <th>Tingkat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($atribut) :
                    foreach ($atribut as $e) :
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $e['NAMA_ATRIBUT']; ?></td>
                            <td><?= $e['NAMA_EVENT']; ?></td>
                            <td><a href="<?= base_url('/') . $e['FOTO_ATRIBUT'] ?>" target="_blank">Jadwal</a></td>
                            <td><?= $e['TINGKAT_ATRIBUT']; ?></td>
                            <td>
                                <a href="<?= base_url('jadwal/edit/') . $e['ID_ATRIBUT'] ?>" class="btn btn-circle btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i></a>
                                <a onclick="return confirm('Yakin ingin menghapus data?')" href="<?= base_url('jadwal/delete/') . $e['ID_ATRIBUT'] ?>" class="btn btn-circle btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach;
                else : ?>
                    <tr>
                        <td colspan="8" class="text-center">Silahkan tambahkan Event</td>
                    </tr>
                <?php endif; ?>

            </tbody>
        </table>
    </div>
</div>

<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Pertandingan
                </h4>
            </div>
            <div class="col-auto">
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped" id="dataTable">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>Nama Team / Asal Sekolah</th>
                    <th>VS</th>
                    <th>Nama Team / Asal Sekolah</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $previous_team = null;
                $previous_sekole = null;

                if ($jadwal) :
                    foreach ($jadwal as $index => $j) :
                        $current_team = $j['NAMA_TEAM'];
                        $current_sekole = $j['SEKOLAH'];

                        if ($current_team != $previous_team || $current_sekole != $previous_sekole) :
                ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $j['NAMA_TEAM'] . ' - ' . $j['SEKOLAH']; ?></td>
                                <td>VS</td>
                                <td><?= $previous_team ? $previous_team . ' - ' . $previous_sekole : ''; ?></td>
                            </tr>
                    <?php
                        endif;
                        $previous_team = $current_team;
                        $previous_sekole = $current_sekole;
                    endforeach;
                else :
                    ?>
                    <tr>
                        <td colspan="4" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>

            </tbody>
        </table>
    </div>

</div>