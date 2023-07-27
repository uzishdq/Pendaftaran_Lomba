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
                    <th>Nama Team</th>
                    <th>Asal Sekolah</th>
                    <th></th>
                    <th>Nama Team</th>
                    <th>Asal Sekolah</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($jadwal) :
                    foreach ($jadwal as $j) :
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $j['NAMA_TEAM']; ?></td>
                            <td><?= $j['SEKOLAH']; ?></td>
                            <td>VS</td>
                            <td><?= $j['NAMA_TEAM']; ?></td>
                            <td><?= $j['SEKOLAH']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>