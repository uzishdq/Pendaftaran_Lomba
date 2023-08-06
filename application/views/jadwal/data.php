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
                    <th>Tingkat</th>
                    <th>Jenis Event</th>
                    <th>Nama Event</th>
                    <th>Jadwal Pertandingan</th>
                    <th>Ket</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $role = $this->session->userdata('login_session')['role'];
                if ($atribut) :
                    foreach ($atribut as $e) :
                        if ($e['NAMA_TINGKAT_EVENT'] == $role || $role == "ADMIN") :
                ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $e['NAMA_TINGKAT_EVENT']; ?></td>
                                <td><?= $e['NAMA_JENIS_EVENT']; ?></td>
                                <td><?= $e['NAMA_EVENT']; ?></td>
                                <td><a href="<?= base_url('/assets/file/pertandingan/') . $e['FOTO_ATRIBUT'] ?>" target="_blank">Jadwal</a></td>
                                <td><?= $e['NAMA_ATRIBUT']; ?></td>
                                <td>
                                    <a href="jadwal/edit/<?= $e['ID_ATRIBUT'] ?>" class="btn btn-circle btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i></a>
                                    <a onclick="return confirm('Yakin ingin menghapus data?')" href="<?= base_url('jadwal/delete/') . $e['ID_ATRIBUT'] ?>" class="btn btn-circle btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach;

                else : ?>
                    <tr>
                        <td colspan="8" class="text-center"> Data Kosong. Silahkan tambahkan Jadwal Pertandingan</td>
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
                    <th>Nama Event</th>
                    <th>Jenis Event</th>
                    <th>Tingkat Event</th>
                    <th>Tim 1</th>
                    <th>Tim 2</th>
                    <th>Sekolah 1</th>
                    <th>Sekolah 2</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jadwal as $j) : ?>
                    <tr>
                        <td><?= $j['Nama_Event']; ?></td>
                        <td><?= $j['Jenis_Event']; ?></td>
                        <td><?= $j['Tingkat_Event']; ?></td>
                        <td><?= $j['Tim_Peserta_1']; ?></td>
                        <td><?= $j['Tim_Peserta_2']; ?></td>
                        <td><?= $j['Sekolah_1']; ?></td>
                        <td><?= $j['Sekolah_2']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>