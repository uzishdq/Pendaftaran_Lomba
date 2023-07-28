<div class="card p-2 shadow-sm border-bottom-primary">
    <?php
    if ($team) :
        foreach ($team as $t) :
    ?>
            <div class="card-header bg-white">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Anggota Team <?= strtoupper($t['NAMA_TEAM']); ?>
                </h4>
            </div>
            <div class="card-body mt-2">
                <div class="row">
                    <div class="col-md-11">
                        <p>Contact Person</p>
                        <table class="table">
                            <tr>
                                <th>Nama </th>
                                <td><?= $t['NAMA_CONTACT_PERSON']; ?></td>
                            </tr>
                            <tr>
                                <th>No Telp</th>
                                <td><?= $t['NO_TELP_CONTACT_PERSON']; ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?= $t['EMAIL_CONTACT_PERSON']; ?></td>
                            </tr>
                            <tr>
                                <th>Team</th>
                                <td><?= strtoupper($t['NAMA_TEAM']); ?></td>
                            </tr>
                            <tr>
                                <th>Provinsi</th>
                                <td><?= strtoupper($t['PROVINSI']); ?></td>
                            </tr>
                            <tr>
                                <th>Kota</th>
                                <td><?= $t['KOTA']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-body mt-2">
                <div class="row">
                    <div class="col-md-2 mb-4 mb-md-0">
                        <div class="w-100"> <!-- Ubah w-50 menjadi w-100 -->
                            <img src="<?= base_url('/') . $t['FOTO_PESERTA'] ?>" alt="<?= $t['NAMA_PESERTA']; ?>" class="img-thumbnail rounded mb-2 img-fluid">
                        </div>
                    </div>
                    <div class="col-md-10">
                        <table class="table">
                            <tr>
                                <th>Nama Peserta</th>
                                <td><?= $t['NAMA_PESERTA']; ?></td>
                            </tr>
                            <tr>
                                <th>Sekolah</th>
                                <td><?= $t['SEKOLAH']; ?></td>
                            </tr>
                            <tr>
                                <th>Tingkat</th>
                                <td><?= $t['TINGKAT']; ?></td>
                            </tr>
                            <tr>
                                <th>Kartu Pelajar</th>
                                <td><a href="<?= base_url('/') . $t['KARTU_PELAJAR'] ?>" target="_blank">Kartu Pelajar</a></td>
                            </tr>
                            <tr>
                                <th>Raport</th>
                                <td><a href="<?= base_url('/') . $t['RAPORT_PELAJAR'] ?>" target="_blank">Raport</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        <?php endforeach;
    else : ?>
        <tr>
            <td colspan="8" class="text-center">Silahkan tambahkan user baru</td>
        </tr>
    <?php endif; ?>


</div>