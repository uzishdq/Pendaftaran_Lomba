<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Edit Event
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
                <?= form_open('', [], ['id_event' => $event['ID_EVENT']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="NAMA_EVENT">Nama Event</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('NAMA_EVENT', $event['NAMA_EVENT']); ?>" name="NAMA_EVENT" id="NAMA_EVENT" type="text" class="form-control" placeholder="Nama Event...">
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
                                    <option <?= $event['ID_JENIS_EVENT'] == $j['ID_JENIS_EVENT'] ? 'selected' : ''; ?> <?= set_select('ID_JENIS_EVENT', $j['ID_JENIS_EVENT']) ?> value="<?= $j['ID_JENIS_EVENT'] ?>"><?= $j['NAMA_JENIS_EVENT'] ?></option>
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
                            <input value="<?= set_value('BIAYA_EVENT', $event['BIAYA_EVENT']); ?>" name="BIAYA_EVENT" id="BIAYA_EVENT" type="number" class="form-control" placeholder="Biaya Pendaftaran...">
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
                            <input value="<?= set_value('BANK_EVENT', $event['BANK_EVENT']); ?>" name="BANK_EVENT" id="BANK_EVENT" type="text" class="form-control" placeholder="BCA 082304.... a/n Permadi">
                        </div>
                        <?= form_error('BANK_EVENT', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="STATUS_EVENT">Status Event</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="STATUS_EVENT" id="STATUS_EVENT" class="custom-select">
                                <option value="<?= $event['STATUS_EVENT']; ?>" selected><?= $event['STATUS_EVENT']; ?></option>
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
                                <input type="file" value="<?= $event['FOTO_EVENT']; ?>" name="FOTO_EVENT" id="FOTO_EVENT">
                                <input hidden type="text" value="<?= $event['FOTO_EVENT']; ?>" name="OLD_FOTO_EVENT" id="OLD_FOTO_EVENT">
        
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
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>