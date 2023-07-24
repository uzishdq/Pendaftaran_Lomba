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
                <?= form_open('', [], ['id_event' => $event['id_event']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nama_event">Nama Event</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-user"></i></span>
                            </div>
                            <input value="<?= set_value('nama_event', $event['nama_event']); ?>" name="nama_event" id="nama_event" type="text" class="form-control" placeholder="Nama Event...">
                        </div>
                        <?= form_error('nama_event', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="deskripsi">Deskripsi Event</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-book"></i></span>
                            </div>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" placeholder="Deskripsi..."><?= set_value('deskripsi', $event['deskripsi']); ?></textarea>
                        </div>
                        <?= form_error('deskripsi', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="jenis_id">Kategori Event</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="jenis_id" id="jenis_id" class="custom-select">
                                <option value="" selected disabled>Pilih Kategori Event</option>
                                <?php foreach ($jenis as $j) : ?>
                                    <option <?= $event['jenis_id'] == $j['id_jenis'] ? 'selected' : ''; ?> <?= set_select('jenis_id', $j['id_jenis']) ?> value="<?= $j['id_jenis'] ?>"><?= $j['nama_jenis'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('jenis/add'); ?>"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('jenis_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="tanggal_mulai">Tanggal Mulai</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('tanggal_mulai', date('Y-m-d')); ?>" name="tanggal_mulai" id="tanggal_mulai" type="date" class="form-control" placeholder="Tanggal Mulai...">
                        <?= form_error('tanggal_masuk', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="tanggal_akhir">Tanggal Akhir</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('tanggal_akhir', date('Y-m-d')); ?>" name="tanggal_akhir" id="tanggal_akhir" type="date" class="form-control" placeholder="Tanggal Akhir...">
                        <?= form_error('tanggal_masuk', '<small class="text-danger">', '</small>'); ?>
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