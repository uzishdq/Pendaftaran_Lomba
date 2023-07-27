<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Jenis Event
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