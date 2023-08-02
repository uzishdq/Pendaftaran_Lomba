<!--Page Title-->
<section class="page-title text-center" style="background-image:url(<?= base_url(); ?>assets/img/images/background/3.jpg);">
  <div class="container">
    <div class="title-text">
      <h1>PORPIIS CUP</h1>
    </div>
  </div>
</section>
<!--End Page Title-->
<?php
if ($event) :
  foreach ($event as $e) :
?>
    <section class="service-overview section">
      <div class="container service-box">
        <div class="row">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="content-block">
              <h2><?= $e['NAMA_EVENT']; ?><br>Competition</h2>
              <ul>
                <h5><span>Persyaratan :</span></h5>
                <li><i class="fas fa-caret-right"></i>Sehat jasmani dan rohani</li>
                <li><i class="fas fa-caret-right"></i>Masih berstatus siswa sekolah aktif</li>
                <li><i class="fas fa-caret-right"></i>Mematuhi syarat & ketentuan yang berlaku</li>
                <li><i class="fas fa-caret-right"></i>Melakukan pembayaran biaya pendaftaran</li>
                <h6><br>Biaya Pendaftaran: Rp.<?= number_format($e['BIAYA_EVENT'], 0, ',', '.'); ?></h6>
                <h6 class="font-weight-bold"><br>Transfer: <?= $e['BANK_EVENT']; ?></h6>
              </ul>
              <?php if ($e['STATUS_EVENT'] == "ditutup")
              { ?>
                <a href="#" class="btn-style-one" style="border-radius:10px;">Pendaftaran Ditutup</a>
              <?php }
              else
              { ?>
                <a href="<?= base_url('registrasi/daftar/') . $e['ID_EVENT'] ?>" class="btn-style-one" style="border-radius:10px;">Daftar Sekarang</a>
              <?php } ?>

            </div>
          </div>
          <div class="col-lg-6">
            <img loading="lazy" class="img-fluid" style="border-radius=10px;" src="<?= base_url('assets/file/logo_event/' . $e['FOTO_EVENT']); ?>" alt="service-image">
          </div>
        </div>
    </section>

  <?php endforeach; ?>
<?php else : ?>
  <section class="service-overview section">
    <div class="container service-box">
      <div class=" mb-5 mb-lg-0">
        <div class="content-block d-flex align-items-center justify-content-center">
          <h2>Tidak Ada <br>Competition</h2>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>