<?php
$idUser = $this->session->userdata('login_session')['user'];
$id = $atribut['ID_ATRIBUT']
?>
<div class="card shadow-sm mb-4 border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Jadwal Pertandingan <?= $atribut['NAMA_ATRIBUT']; ?>
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('jadwal') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-arrow-left"></i>
                    </span>
                    <span class="text">
                        Kembali
                    </span>
                </a>
            </div>
        </div>
        <div class="card-body pb-2">
            <form action="<?= base_url('jadwal/edit/' . $id) ?>" id="myFormEditJawdal" method="post" enctype="multipart/form-data">
                <input hidden value="<?= set_value('ID_EVENT', $atribut['ID_EVENT']); ?>" name="ID_EVENT" type="text"">
                        <input hidden value=" <?= set_value('ID_USER', $idUser); ?>" name="ID_USER" type="text"">
                        <div class=" row form-group">
                <label class="col-md-4 text-md-right" for="NAMA_ATRIBUT">Nama Atribut</label>
                <div class="col-md-6">
                    <input value="<?= set_value('NAMA_ATRIBUT', $atribut['NAMA_ATRIBUT']); ?>" type="text" id="NAMA_ATRIBUT" name="NAMA_ATRIBUT" class="form-control" placeholder="Pertandingan...">
                    <?= form_error('NAMA_ATRIBUT', '<span class="text-danger small">', '</span>'); ?>
                </div>
        </div>
        <div class="row form-group">
            <label class="col-md-4 text-md-right" for="TINGKAT_ATRIBUT">Tingkat</label>
            <div class="col-md-6">
                <select name="TINGKAT_ATRIBUT" id="TINGKAT_ATRIBUT" class="custom-select">
                    <option value="<?= $atribut['TINGKAT_ATRIBUT']; ?>" selected><?= $atribut['TINGKAT_ATRIBUT']; ?></option>
                    <option value="SD" id="SD" name="TINGKAT_ATRIBUT">SD</option>
                    <option value="SMP" id="SMP" name="TINGKAT_ATRIBUT">SMP</option>
                    <option value="SMA" id="SMA" name="TINGKAT_ATRIBUT">SMA</option>
                </select>
            </div>
        </div>
        <hr>
        <div class="row form-group">
            <label class="col-md-4 text-md-right" for="FOTO_ATRIBUT">Gambar Jadwal </label>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-9">
                        <input type="file" name="FOTO_ATRIBUT" id="FOTO_ATRIBUT" accept="image/gif, image/jpeg, image/png">
                        <input hidden type="text" value="<?= $atribut['FOTO_ATRIBUT']; ?>" name="OLD_FOTO_ATRIBUT" id="OLD_FOTO_ATRIBUT">
                        <br>
                        <small>Max ukuran file 10MB <a href="https://compresspng.com/" target="_blank">Convert Disini</a></small>
                        <?= form_error('FOTO_ATRIBUT', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row form-group justify-content-end">
            <div class="col-md-8">
                <button type="submit" class="btn btn-primary btn-icon-split">
                    <span class="icon"><i class="fa fa-save"></i></span>
                    <span class="text">Simpan</span>
                </button>
                <button type="reset" class="btn btn-secondary">
                    Reset
                </button>
            </div>
        </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('myFormEditJawdal').addEventListener('submit', function(event) {
        var fileInput = document.getElementById('FOTO_ATRIBUT');
        var fileSize = fileInput.files[0].size; // Ukuran file dalam byte
        var maxSize = 10 * 1024 * 1024; // 10 MB dalam byte

        if (fileSize > maxSize) {
            alert('Ukuran file melebihi batas maksimum (10 MB).');
            event.preventDefault(); // Mencegah pengiriman form jika validasi tidak lolos
        }
    });
</script>