<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Edit Tingkatan Event
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('tingkatan_event') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?= form_open('', [], ['ID_TINGKAT_EVENT' => $tingkat['ID_TINGKAT_EVENT']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right">Nama Jenis</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('NAMA_TINGKAT_EVENT', $tingkat['NAMA_TINGKAT_EVENT']); ?>" name="NAMA_TINGKAT_EVENT" id="NAMA_TINGKAT_EVENT" type="text" class="form-control" placeholder="Nama Jenis...">
                        <?= form_error('NAMA_TINGKAT_EVENT', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>