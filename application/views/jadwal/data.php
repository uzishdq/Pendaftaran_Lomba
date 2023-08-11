<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm mb-4 border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Upload Jadwal Pertandingan
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('jadwal/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-sitemap"></i>
                    </span>
                    <span class="text">
                        Upload
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
                    <th>Tingkat</th>
                    <th>Jenis Event</th>
                    <th>Nama Event</th>
                    <th>Jadwal Pertandingan</th>
                    <th>Ket</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $role = $this->session->userdata('login_session')['role'];
                if ($atribut) :
                    foreach ($atribut as $e) :
                        if ($e['NAMA_TINGKAT_EVENT'] == $role || $role == "ADMIN") :
                ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $e['NAMA_TINGKAT_EVENT']; ?></td>
                                <td><?= $e['NAMA_JENIS_EVENT']; ?></td>
                                <td><?= $e['NAMA_EVENT']; ?></td>
                                <td><a href="<?= base_url('/assets/file/pertandingan/') . $e['FOTO_ATRIBUT'] ?>" target="_blank">Jadwal</a></td>
                                <td><?= $e['NAMA_ATRIBUT']; ?></td>
                                <td>
                                    <a href="jadwal/edit/<?= $e['ID_ATRIBUT'] ?>" class="btn btn-circle btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i></a>
                                    <a onclick="return confirm('Yakin ingin menghapus data?')" href="<?= base_url('jadwal/delete/') . $e['ID_ATRIBUT'] ?>" class="btn btn-circle btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach;

                else : ?>
                    <tr>
                        <td colspan="8" class="text-center"> Data Kosong. Silahkan tambahkan Jadwal Pertandingan</td>
                    </tr>
                <?php endif; ?>

            </tbody>
        </table>
    </div>
</div>
<!-- <div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Pertandingan
                </h4>
            </div>
            <div class="col-auto">
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped" id="dataTable">
            <thead>
                <tr>
                    <th>Nama Event</th>
                    <th>Jenis Event</th>
                    <th>Tingkat Event</th>
                    <th>Tim 1</th>
                    <th>Tim 2</th>
                    <th>Sekolah 1</th>
                    <th>Sekolah 2</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jadwal as $j) : ?>
                    <tr>
                        <td><?= $j['Nama_Event']; ?></td>
                        <td><?= $j['Jenis_Event']; ?></td>
                        <td><?= $j['Tingkat_Event']; ?></td>
                        <td><?= $j['Tim_Peserta_1']; ?></td>
                        <td><?= $j['Tim_Peserta_2']; ?></td>
                        <td><?= $j['Sekolah_1']; ?></td>
                        <td><?= $j['Sekolah_2']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div> -->

<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Undian Team
                </h4>
            </div>
            <div class="col-auto">
                <form class="form-inline" method="post" action="<?php echo base_url('jadwal/index'); ?>">
                    <div class="form-group mx-sm-3">
                        <label for="jenis_event" class="mr-2">Jenis Event:</label>
                        <select name="jenis_event" id="jenis_event" class="form-control w-auto">
                            <!-- Loop untuk menampilkan pilihan jenis event -->
                            <?php foreach ($jenisEvent as $jenis_event) : ?>
                                <option value="<?php echo $jenis_event['ID_JENIS_EVENT']; ?>"><?php echo $jenis_event['NAMA_JENIS_EVENT']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mx-sm-3">
                        <label for="tingkat_event" class="mr-2">Tingkat Event:</label>
                        <select name="tingkat_event" id="tingkat_event" class="form-control w-auto">
                            <!-- Loop untuk menampilkan pilihan tingkat event -->
                            <?php foreach ($tingkatEvent as $tingkat_event) : ?>
                                <option value="<?php echo $tingkat_event['ID_TINGKAT_EVENT']; ?>"><?php echo $tingkat_event['NAMA_TINGKAT_EVENT']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row" id="spinnerContainer">
                    <?php
                    if (isset($spinner)) :
                        if ($spinner) :
                            foreach ($spinner as $index => $s) : ?>
                                <div class="col-md-4 m-3">
                                    <div id="item<?= $index ?>" class="card p-3">
                                        <div class="one"><?= $s['NAMA_TEAM']; ?> - <?= $s['SEKOLAH']; ?></div>
                                    </div>
                                </div>
                            <?php
                            endforeach;
                        else : ?>
                            <div class="col m-3">
                                <div id="item" class="card p-3">
                                    <div class="h5 text-center">
                                        <p class="font-weight-bold">Data Tidak ditemukan</p>
                                    </div>
                                </div>
                            </div>
                        <?php endif;
                    else : ?>
                        <div class="col m-3">
                            <div id="item" class="card p-3">
                                <div class="h5 text-center">
                                    <p class="font-weight-bold">Data Kosong</p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="button" id="spinButton" class="btn btn-sm btn-outline-dark btn-block" data-toggle="modal" data-target="#staticBackdrop">
            Undi Team
        </button>
    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Team Terpilih</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modalResult"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Terima</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('spinButton').addEventListener('click', function() {
        const container = document.getElementById('spinnerContainer');
        const randomIndex = Math.floor(Math.random() * container.children.length);
        const selectedItem = container.children[randomIndex];

        // Mendapatkan informasi tim yang terpilih
        const selectedTeamInfo = `Tim: ${selectedItem.innerText}`;

        // Menampilkan hasil di modal
        const modalResult = document.getElementById('modalResult');
        modalResult.innerHTML = selectedTeamInfo;

        // Munculkan modal
        $('#staticBackdrop').modal('show');

        // Hapus elemen yang dipilih dari daftar
        container.removeChild(selectedItem);
    });
</script>