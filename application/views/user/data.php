<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm mb-4 border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data User
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('user/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-user-plus"></i>
                    </span>
                    <span class="text">
                        Tambah User
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped dt-responsive nowrap" id="dataTable">
            <thead>
                <tr>
                    <th width="30">No.</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>No. telp</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($users) :
                    foreach ($users as $user) :
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <img width="30" src="<?= base_url() ?>assets/img/avatar/<?= $user['FOTO'] ?>" alt="<?= $user['NAMA_USER']; ?>" class="img-thumbnail rounded-circle">
                            </td>
                            <td><?= $user['NAMA_USER']; ?></td>
                            <td><?= $user['USERNAME']; ?></td>
                            <td><?= $user['EMAIL_USER']; ?></td>
                            <td><?= $user['NO_TELP']; ?></td>
                            <td><?= $user['ROLE']; ?></td>
                            <td>
                                <a href="<?= base_url('user/toggle/') . $user['ID_USER'] ?>" class="btn btn-circle btn-sm <?= $user['IS_ACTIVE'] ? 'btn-secondary' : 'btn-success' ?>" title="<?= $user['IS_ACTIVE'] ? 'Nonaktifkan User' : 'Aktifkan User' ?>"><i class="fa fa-fw fa-power-off"></i></a>
                                <a href="<?= base_url('user/edit/') . $user['ID_USER'] ?>" class="btn btn-circle btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i></a>
                                <a onclick="return confirm('Yakin ingin hapus? <?= $user['NAMA_USER']; ?>')" href="<?= base_url('user/delete/') . $e['ID_USER'] ?>" class="btn btn-circle btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach;
                else : ?>
                    <tr>
                        <td colspan="8" class="text-center">Silahkan tambahkan user baru</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>