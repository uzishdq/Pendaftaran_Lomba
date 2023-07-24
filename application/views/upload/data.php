<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Upload
                </h4>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Team</th>
                    <th>Nama Peserta</th>
                    <th>Event</th>
                    <th>Foto</th>
                    <th>Raport</th>
                    <th>Kartu Pelajar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($uploads) :
                    $no = 1;
                    foreach ($uploads as $u) :
                        $this->db->where('id_registrasi',$u['registrasi_id']);
                        $registrasi =  $this->db->get('registrasi')->result_array();
                        foreach($registrasi as $r):
                            $this->db->where('id_event',$r['event_id']);
                            $events =  $this->db->get('event')->result_array();
                        endforeach;
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $u['nama_team']; ?></td>
                            <td><?= $u['nama_peserta']; ?></td>
                            <td><?php 
                            foreach($events as $e):
                                echo $e['nama_event'];
                            endforeach;
                            ?></td>
                            <td>
                                <a href="<?= base_url('/'). $u['foto'] ?>">
                                    <img src="<?= base_url('/'). $u['foto'] ?>" alt="Foto" class="img-thumbnail" width="100">
                                </a>
                                </td>
                                <td>
                                <a href="<?= base_url('/'). $u['raport'] ?>">
                                    <img src="<?= base_url('/'). $u['raport'] ?>" alt="Raport" class="img-thumbnail" width="100">
                                </a>
                                </td>
                                <td>
                                <a href="<?= base_url('/'). $u['kartu_pelajar'] ?>">
                                    <img src="<?= base_url('/'). $u['kartu_pelajar'] ?>" alt="Kartu Pelajar" class="img-thumbnail" width="100">
                                </a>
                            </td>
                            <th>
                                <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('upload/delete/') . $u['id_uploads'] ?>" class="btn btn-circle btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </th>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>