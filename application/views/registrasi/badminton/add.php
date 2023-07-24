<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Tambah Data
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('registrasi_badminton') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?php echo form_open_multipart('registrasi_badminton/add'); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="event_id">Nama Event</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="event_id" id="disabledSelect" class="custom-select">
                                <?php foreach ($event as $e) : ?>
                                    <?php
                                    // Check if the event name is "Futsal" and get its id
                                    $selected = $e['nama_event'] == 'Badminton' ? $e['id_event'] : '';
                                    ?>
                                    <?php if ($e['nama_event'] == 'Badminton') : ?>
                                        <option <?= set_select('event_id', $e['id_event'], $selected === $e['id_event']) ?> value="<?= $e['id_event'] ?>"><?= $e['nama_event'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?= form_error('event_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nama_team">Nama Team</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-users"></i></span>
                            </div>
                            <input value="<?= set_value('nama_team'); ?>" name="nama_team" id="nama_team" type="text" class="form-control" placeholder="Nama Team...">
                        </div>
                        <?= form_error('nama_team', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="peserta">Jumlah Peserta</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-users"></i></span>
                            </div>
                            <input value="<?= set_value('peserta'); ?>" name="peserta" id="peserta" type="text" class="form-control" placeholder="Jumlah Peserta...">
                        </div>
                        <?= form_error('peserta', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="sekolah">Asal Sekolah</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                            </div>
                            <input value="<?= set_value('sekolah'); ?>" name="sekolah" id="sekolah" type="text" class="form-control" placeholder="Asal Sekolah...">
                        </div>
                        <?= form_error('sekolah', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="tingkat">Tingkat</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                            </div>
                            <select name="tingkat" id="tingkat" class="custom-select">
                                <option value="" selected disabled>Pilih Tingkat</option>
                                <option value="SD" id="SD" name="tingkat">SD</option>
                                <option value="SMP" id="SMP" name="tingkat">SMP</option>
                                <option value="SMA" id="SMA" name="tingkat">SMA</option>
                            </select>
                        </div>
                        <?= form_error('tingkat', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="provinsi">Provinsi</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                            </div>
                            <input value="<?= set_value('provinsi'); ?>" name="provinsi" id="provinsi" type="text" class="form-control" placeholder="Provinsi...">
                        </div>
                        <?= form_error('provinsi', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="kota">Kota</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                            </div>
                            <input value="<?= set_value('kota'); ?>" name="kota" id="kota" type="text" class="form-control" placeholder="Kota...">
                        </div>
                        <?= form_error('kota', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="kota">Upload Form</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                            </div>
                            <input class="form-control" type="file" name="file" id="file">
                        </div>
                        <?= form_error('kota', '<small class="text-danger">', '</small>'); ?>
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