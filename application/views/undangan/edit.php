<?php
$id = $undangan['ID_UNDANGAN']
?>
<div class="card shadow-sm mb-4 border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Jadwal Pertandingan <?= $undangan['NAMA_UNDANGAN']; ?>
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('undangan') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
            <form action="<?= base_url('undangan/edit/' . $id) ?>" id="myFormEditUndangan" method="post" enctype="multipart/form-data">
                <input hidden value="<?= set_value('ID_UNDANGAN', $undangan['ID_UNDANGAN']); ?>" name="ID_UNDANGAN" type="text"">
                <div class=" row form-group">
                <label class="col-md-4 text-md-right" for="NAMA_UNDANGAN">Nama Undangan</label>
                <div class="col-md-6">
                    <input value="<?= set_value('NAMA_UNDANGAN', $undangan['NAMA_UNDANGAN']); ?>" type="text" id="NAMA_UNDANGAN" name="NAMA_UNDANGAN" class="form-control" placeholder="Pertandingan...">
                    <?= form_error('NAMA_UNDANGAN', '<span class="text-danger small">', '</span>'); ?>
                </div>
        </div>
        <div class=" row form-group">
            <label class="col-md-4 text-md-right" for="TGL_UNDANGAN">Tanggal</label>
            <div class="col-md-6">
                <input value="<?= set_value('TGL_UNDANGAN', $undangan['TGL_UNDANGAN']); ?>" name="TGL_UNDANGAN" id="TGL_UNDANGAN" type="date" class="form-control" placeholder="Tanggal ...">
                <?= form_error('TGL_UNDANGAN', '<span class="text-danger small">', '</span>'); ?>
            </div>
        </div>
        <hr>
        <div class="row form-group">
            <label class="col-md-4 text-md-right" for="FILE_UNDANGAN">File Undangan</label>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-9">
                        <input type="file" name="FILE_UNDANGAN" id="FILE_UNDANGAN" accept="application/pdf">
                        <input hidden type="text" value="<?= $undangan['FILE_UNDANGAN']; ?>" name="OLD_FILE_UNDANGAN" id="OLD_FILE_UNDANGAN">
                        <br>
                        <small>Max ukuran file 10MB <b>PDF</b> </small>
                        <?= form_error('FILE_UNDANGAN', '<small class="text-danger">', '</small>'); ?>
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
    document.getElementById('myFormEditUndangan').addEventListener('submit', function(event) {
        var fileInput = document.getElementById('FOTO_ATRIBUT');
        var fileSize = fileInput.files[0].size; // Ukuran file dalam byte
        var maxSize = 10 * 1024 * 1024; // 10 MB dalam byte

        if (fileSize > maxSize) {
            alert('Ukuran file melebihi batas maksimum (10 MB).');
            event.preventDefault(); // Mencegah pengiriman form jika validasi tidak lolos
        }
    });
</script>