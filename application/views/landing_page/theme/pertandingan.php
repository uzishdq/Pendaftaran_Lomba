<section class="page-title text-center" style="background-image:url(<?= base_url(); ?>assets/img/images/background/3.jpg);">
    <div class="container">
        <div class="title-text">
            <h1>JADWAL<span> PERTANDINGAN</span></h1>
        </div>
    </div>
</section>

<div class="tabs mt-5">
    <ul class="nav nav-tabs justify-content-center" id="teamTab" role="tablist">
        <li class="nav-item" role="presentation">
            <?php if ($jenisEvent) : ?>
                <?php foreach ($jenisEvent as $je) : ?>
                    <a onclick="showTable('<?= $je['ID_EVENT']; ?>')"><?= $je['NAMA_EVENT']; ?></a>
                <?php endforeach; ?>
            <?php else : ?>
                <a>Tidak Ada Event</a>
            <?php endif; ?>
        </li>
    </ul>
</div>

<?php if ($jenisEvent) : ?>
    <?php foreach ($jenisEvent as $je) : ?>
        <div class="table-container" id="<?= $je['ID_EVENT']; ?>">
            <?php
            $no = 1; // Inisialisasi nomor urut di setiap jenis event
            $foundEvent = false; // Variabel penanda jika ada event yang sesuai dengan jenis event
            if ($event) :
                foreach ($event as $e) :
                    if ($e['ID_EVENT'] == $je['ID_EVENT']) { // Memeriksa ID jenis event yang sesuai
                        $foundEvent = true;
                        $tanggalMulai = $e['TGL_MULAI_EVENT'];
                        $datetime1 = date_create($tanggalMulai);
                        $tglAwal = date_format($datetime1, 'd');

                        $tanggalAkhir = $e['TGL_AKHIR_EVENT'];
                        $datetime2 = date_create($tanggalAkhir);
                        $tglAkhir = date_format($datetime2, 'd F Y'); // Mengubah penanda menjadi true karena ada event yang sesuai
            ?>
                        <section class="m-5 d-flex justify-content-center align-items-center">
                            <div class="shadow card w-75 ">
                                <div class="card-header">
                                    <div class="row">
                                        <h6 class="col">
                                            <?= strtoupper($e['NAMA_JENIS_EVENT']); ?>
                                        </h6>
                                        <h6 class="col-auto">
                                            Tingkat: <?= strtoupper($e['TINGKAT_ATRIBUT']); ?>
                                        </h6>
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?= strtoupper($e['NAMA_EVENT']); ?> - <?= strtoupper($e['NAMA_ATRIBUT']); ?></h5>
                                    <p class="card-text"> <?= $tglAwal; ?> - <?= $tglAkhir; ?></p>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <img loading="lazy" style="border-radius: 10px; width: 100%;" src="<?= $e['FOTO_ATRIBUT'] ?>" alt="service-image">
                                </div>
                            </div>
                        </section>
                <?php
                    }
                endforeach;
            endif;
            if (!$foundEvent) :
                ?>
                <section class="m-5 d-flex justify-content-center align-items-center">
                    <div class="shadow card w-75 ">
                        <div class="card-body text-center">
                            <h5 class="card-title">Tidak Ada Pertandingan</h5>
                            <p class="card-text">Pekan Olahraga Permata Insani Islamic School</p>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <section class="m-5 d-flex justify-content-center align-items-center">
        <div class="shadow card w-75 ">
            <div class="card-body text-center">
                <h5 class="card-title">Tidak Ada Pertandingan</h5>
                <p class="card-text">Pekan Olahraga Permata Insani Islamic School</p>
            </div>
        </div>
    </section>
<?php endif; ?>


<style>
    .table-container {
        display: block;
    }
</style>

<script>
    // Fungsi untuk menampilkan tabel sesuai dengan ID jenis event yang dipilih
    function showTable(idJenisEvent) {
        var tableContainers = document.getElementsByClassName('table-container');
        for (var i = 0; i < tableContainers.length; i++) {
            if (tableContainers[i].id === idJenisEvent) {
                tableContainers[i].style.display = 'block';
            } else {
                tableContainers[i].style.display = 'none';
            }
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Cari semua elemen dengan kelas "table-container"
        var tableContainers = document.getElementsByClassName('table-container');
        // Semua table-container diubah menjadi display: none (sembunyikan tabel)
        for (var i = 0; i < tableContainers.length; i++) {
            tableContainers[i].style.display = 'none';
        }
        // Tampilkan tabel pertama secara otomatis
        if (tableContainers.length > 0) {
            tableContainers[0].style.display = 'block';
        }
    });
</script>