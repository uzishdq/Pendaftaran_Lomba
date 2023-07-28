<?= $this->session->flashdata('pesan'); ?>

<?php
$no = 1;
if ($event) :
    $idUser = $this->session->userdata('login_session')['user'];
    foreach ($event as $e) :
?>
        <div class="card shadow-sm mb-4 border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Jadwal Pertandingan <?= $e['NAMA_EVENT']; ?>
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
                    <form action="<?= base_url('jadwal/add') ?>" method="post" enctype="multipart/form-data">
                        <input hidden value="<?= set_value('ID_EVENT', $e['ID_EVENT']); ?>" name="ID_EVENT" type="text"">
                        <input hidden value=" <?= set_value('ID_USER', $idUser); ?>" name="ID_USER" type="text"">
                        <div class=" row form-group">
                        <label class="col-md-4 text-md-right" for="NAMA_ATRIBUT">Nama Atribut</label>
                        <div class="col-md-6">
                            <input required type="text" id="NAMA_ATRIBUT" name="NAMA_ATRIBUT" class="form-control" placeholder="Pertandingan...">
                            <?= form_error('NAMA_ATRIBUT', '<span class="text-danger small">', '</span>'); ?>
                        </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="TINGKAT_ATRIBUT">Tingkat</label>
                    <div class="col-md-6">
                        <select name="TINGKAT_ATRIBUT" id="TINGKAT_ATRIBUT" class="custom-select">
                            <option value="" selected disabled>Pilih Tingkat...</option>
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
                                <input type="file" name="FOTO_ATRIBUT" id="FOTO_ATRIBUT" accept="image/gif, image/jpeg, image/png" required>
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
        </div>
    <?php endforeach;
else : ?>
    <div class="card shadow-sm mb-4 border-bottom-primary">
        <div class="card-header bg-white py-3">
            <div class="row">
                <div class="col">
                    <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                        Tidak Ada
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
        </div>
    </div>
<?php endif; ?>