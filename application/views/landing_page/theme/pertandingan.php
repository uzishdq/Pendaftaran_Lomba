<section class="m-5 d-flex justify-content-center align-items-center">
    <?php
    $no = 1;
    if ($event) :
        foreach ($event as $e) :
            $tanggalMulai = $e['TGL_MULAI_EVENT'];
            $datetime1 = date_create($tanggalMulai);
            $tglAwal = date_format($datetime1, 'd');

            $tanggalAkhir = $e['TGL_AKHIR_EVENT'];
            $datetime2 = date_create($tanggalAkhir);
            $tglAkhir = date_format($datetime2, 'd F Y');
    ?>
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
                    <h5 class="card-title"><?= strtoupper($e['NAMA_EVENT']); ?></h5>
                    <p class="card-text"> <?= $tglAwal; ?> - <?= $tglAkhir; ?></p>
                </div>
                <img loading="lazy" class="img-fluid" style="border-radius=10px;" src="<?= $e['FOTO_ATRIBUT'] ?>" alt="service-image">
            </div>

        <?php endforeach;
    else : ?>
        <div class="shadow card w-75 ">
            <div class="card-body text-center">
                <h5 class="card-title">Tidak Ada Pertandingan</h5>
                <p class="card-text">Pekan Olahraga Permata Insani Islamic School</p>
            </div>
        </div>
    <?php endif; ?>
</section>