<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Undangan
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('undangan/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Upload Undangan
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped" id="dataTable">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>Tanggal pembuatan file</th>
                    <th>Nama Jenis Event</th>
                    <th>File</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($undangan) :
                    foreach ($undangan as $u) :
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $u['TGL_UNDANGAN']; ?></td>
                            <td><?= $u['NAMA_UNDANGAN']; ?></td>
                            <td><a href="<?= base_url('/assets/file/undangan/') . $u['FILE_UNDANGAN'] ?>" target="_blank">file</a></td>
                            <td>
                                <a href="<?= base_url('undangan/edit/') . $u['ID_UNDANGAN'] ?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('Yakin ingin hapus? <?= $u['NAMA_UNDANGAN']; ?>')" href="<?= base_url('undangan/delete/') . $u['ID_UNDANGAN'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="card mt-4 shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Contact Person Sekolah
                </h4>
            </div>

        </div>
    </div>
    <div class="card-body">
        <?= form_open('undangan/UndanganKirim'); ?>
        <div class="row form-group">
            <label class="col-md-1" for="FILE_UNDANGAN">Undangan</label>
            <div class="col-md-9 mx-auto text-center">
                <div class="input-group">
                    <select name="FILE_UNDANGAN" class="custom-select">
                        <option value="" selected disabled>Pilih Undangan</option>
                        <?php foreach ($undangan as $eu) : ?>
                            <option value="<?= $eu['FILE_UNDANGAN'] ?>"><?= $eu['NAMA_UNDANGAN'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="input-group-append">
                        <a class="btn btn-primary" href="<?= base_url('tingkatan_event/add'); ?>"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <?= form_error('FILE_UNDANGAN', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped" id="dataTable">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Sekolah - Kota</th>
                    <th><label><input type="checkbox" id="selectAll"> Pilih Semua</label><br></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($person) :
                    foreach ($person as $p) :
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $p['NAMA_CONTACT_PERSON']; ?></td>
                            <td><?= $p['EMAIL_CONTACT_PERSON']; ?></td>
                            <td><?= $p['SEKOLAH'] ?> - <?= $p['KOTA'] ?></td>
                            <td>
                                <input type="checkbox" name="recipients[]" value="<?= $p['EMAIL_CONTACT_PERSON']; ?>">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer d-flex justify-content-end">
        <div class="col-auto">
            <button type="submit" class="btn btn-sm btn-outline-success btn-icon-split">
                <span class="icon">
                    <i class="fa fa-paper-plane"></i>
                </span>
                <span class="text">
                    Kirim Undangan
                </span>
            </button>
        </div>
    </div>
    <?= form_close(); ?>
</div>

<script>
    document.getElementById("selectAll").addEventListener("click", function() {
        var checkboxes = document.getElementsByName("recipients[]");
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = this.checked;
        }
    });
</script>