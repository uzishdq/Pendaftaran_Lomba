<?php $idUser = $this->session->userdata('login_session')['user']; ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Tambah Event
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('event') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <form action="<?= base_url('event/add') ?>" id="myFormAddEvent" method="post" enctype="multipart/form-data">
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="ID_TINGKAT_EVENT">Tingkatan Event</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <select name="ID_TINGKAT_EVENT" id="ID_TINGKAT_EVENT" class="custom-select">
                                    <option value="" selected disabled>Pilih Tingakatn Event</option>
                                    <?php foreach ($tingkat as $t) : ?>
                                        <option <?= set_select('ID_TINGKAT_EVENT', $t['ID_TINGKAT_EVENT']) ?> value="<?= $t['ID_TINGKAT_EVENT'] ?>"><?= $t['NAMA_TINGKAT_EVENT'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="input-group-append">
                                    <a class="btn btn-primary" href="<?= base_url('tingkatan_event/add'); ?>"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                            <?= form_error('ID_TINGKAT_EVENT', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="NAMA_EVENT">Nama Event</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input hidden value=" <?= set_value('ID_USER', $idUser); ?>" name="ID_USER" type="text"">
                                <input value=" <?= set_value('NAMA_EVENT'); ?>" name="NAMA_EVENT" id="NAMA_EVENT" type="text" class="form-control" placeholder="Nama Event...">
                            </div>
                            <?= form_error('NAMA_EVENT', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="ID_JENIS_EVENT">Kategori Event</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <select name="ID_JENIS_EVENT" id="ID_JENIS_EVENT" class="custom-select">
                                    <option value="" selected disabled>Pilih Kategori Event</option>
                                    <?php foreach ($jenis as $j) : ?>
                                        <option <?= set_select('ID_JENIS_EVENT', $j['ID_JENIS_EVENT']) ?> value="<?= $j['ID_JENIS_EVENT'] ?>"><?= $j['NAMA_JENIS_EVENT'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="input-group-append">
                                    <a class="btn btn-primary" href="<?= base_url('jenis_event/add'); ?>"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                            <?= form_error('ID_JENIS_EVENT', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="TGL_MULAI_EVENT">Tanggal Mulai</label>
                        <div class="col-md-9">
                            <input value="<?= set_value('TGL_MULAI_EVENT', date('Y-m-d')); ?>" name="TGL_MULAI_EVENT" id="TGL_MULAI_EVENT" type="date" class="form-control" placeholder="Tanggal Mulai...">
                            <?= form_error('TGL_MULAI_EVENT', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="TGL_AKHIR_EVENT">Tanggal Akhir</label>
                        <div class="col-md-9">
                            <input value="<?= set_value('TGL_AKHIR_EVENT', date('Y-m-d')); ?>" name="TGL_AKHIR_EVENT" id="TGL_AKHIR_EVENT" type="date" class="form-control" placeholder="Tanggal Akhir...">
                            <?= form_error('TGL_AKHIR_EVENT', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="BIAYA_EVENT">Biaya Pendaftaran</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                </div>
                                <input value="<?= set_value('BIAYA_EVENT'); ?>" name="BIAYA_EVENT" id="BIAYA_EVENT" oninput="formatRupiah(this)" type="text" class="form-control" placeholder="Biaya Pendaftaran...">
                            </div>
                            <?= form_error('BIAYA_EVENT', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="BANK_EVENT">Bank</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                </div>
                                <input value="<?= set_value('BANK_EVENT'); ?>" name="BANK_EVENT" id="BANK_EVENT" type="text" class="form-control" placeholder="BCA 082304.... a/n Permadi">
                            </div>
                            <?= form_error('BANK_EVENT', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="STATUS_EVENT">Status Event</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <select name="STATUS_EVENT" id="STATUS_EVENT" class="custom-select">
                                    <option value="" selected disabled>Pilih Status Event...</option>
                                    <option value="dibuka">Dibuka</option>
                                    <option value="berjalan">Sedang Berjalan</option>
                                    <option value="ditutup">Ditutup</option>
                                </select>
                            </div>
                            <?= form_error('STATUS_EVENT', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="FOTO_EVENT">Logo Event</label>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-9">
                                    <input type="file" name="FOTO_EVENT" id="FOTO_EVENT" accept="image/gif, image/jpeg, image/png" required>
                                    <br>
                                    <small>Max ukuran file 10MB <a href="https://compresspng.com/" target="_blank">Convert Disini</a></small>
                                    <?= form_error('FOTO_EVENT', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-9 offset-md-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function formatRupiah(input) {
        // Menghilangkan semua karakter kecuali angka
        var value = input.value.replace(/\D/g, "");

        // Mengubah angka menjadi format rupiah
        var formattedValue = new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0,
        }).format(value);

        // Menampilkan nilai yang telah diformat kembali ke input
        input.value = formattedValue;
    }
    document.getElementById('myFormAddEvent').addEventListener('submit', function(event) {
        var fileInput = document.getElementById('FOTO_EVENT');
        var fileSize = fileInput.files[0].size; // Ukuran file dalam byte
        var maxSize = 10 * 1024 * 1024; // 10 MB dalam byte

        if (fileSize > maxSize) {
            alert('Ukuran file melebihi batas maksimum (10 MB).');
            event.preventDefault(); // Mencegah pengiriman form jika validasi tidak lolos
        }
    });
</script>