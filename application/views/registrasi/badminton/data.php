<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Registrasi Badminton
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('registrasi_badminton/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Tambah Data
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
                    <th>Event</th>
                    <th>Nama Team</th>
                    <th>Jumlah Peserta</th>
                    <th>Asal Sekolah</th>
                    <th>Tingkat</th>
                    <th>Bukti Bayar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($registrasi) :
                    $no = 1;
                    foreach ($registrasi as $r) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $r['nama_event']; ?></td>
                            <td><?= $r['nama_team']; ?></td>
                            <td><?= $r['peserta']; ?></td>
                            <td><?= $r['sekolah']; ?></td>
                            <td><?= $r['tingkat']; ?></td>
                            <td><a href="<?= base_url('uploads/'). $r['file'] ?>"><?= $r['file']; ?></a></td>
                            <th>
                                <a href="<?= base_url('registrasi_badminton/edit/') . $r['id_registrasi'] ?>" class="btn btn-circle btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('registrasi_badminton/delete/') . $r['id_registrasi'] ?>" class="btn btn-circle btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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