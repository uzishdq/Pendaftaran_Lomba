<?php
if ($team) :
    // Ambil informasi kontak person dari data team pertama
    $contact_person = reset($team); // Mengambil elemen pertama dari array $team
?>
    <div class="card p-2 shadow-sm border-bottom-primary">
        <div class="card-header bg-white">
        <div class="row">
                    <div class="col">
                    <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                Data Anggota Tim <?= strtoupper($contact_person['NAMA_TEAM']); ?>
            </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('registrasi_all') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="text">
                                Kembali
                            </span>
                        </a>
                    </div>
                </div>

            
        </div>
        <div class="card-body mt-2">
            <div class="row">
                <div class="col-md-11">
                    <p>Kontak Person</p>
                    <table class="table">
                        <tr>
                            <th>Nama </th>
                            <td><?= $contact_person['NAMA_CONTACT_PERSON']; ?></td>
                        </tr>
                        <tr>
                            <th>No Telp</th>
                            <td><?= $contact_person['NO_TELP_CONTACT_PERSON']; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= $contact_person['EMAIL_CONTACT_PERSON']; ?></td>
                        </tr>
                        <tr>
                            <th>Tim</th>
                            <td><?= strtoupper($contact_person['NAMA_TEAM']); ?></td>
                        </tr>
                        <tr>
                            <th>Provinsi</th>
                            <td><?= strtoupper($contact_person['PROVINSI']); ?></td>
                        </tr>
                        <tr>
                            <th>Kota</th>
                            <td><?= $contact_person['KOTA']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <?php
        foreach ($team as $t) :
        ?>
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
            <td colspan="8" class="text-center">Belum ada data tim</td>
        </tr>
    <?php endif; ?>
    </div>