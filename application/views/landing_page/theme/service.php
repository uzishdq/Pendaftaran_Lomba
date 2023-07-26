<!--Page Title-->
<section class="page-title text-center" style="background-image:url(<?= base_url(); ?>assets/img/images/background/3.jpg);">
    <div class="container">
        <div class="title-text">
            <h1>PORPIIS CUP</h1>
            <ul class="title-menu clearfix">
                <!-- <li>
                    <a href="welcome">home &nbsp;/</a>
                </li>
                <li>Event</li> -->
            </ul>
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
                    <!-- <p>Futsal ialah sebuah permainan bola yang dimainkan oleh dua tim, yang masing-masing timnya memiliki jumlah anggota yakni lima orang. 
                      Tujuan dari permainan adalah untuk memasukkan bola ke gawang lawan sebanyak, dengan memanipulasi bola dengan kaki. -->
                    </p>
                    <ul>
                      <h5><span>Persyaratan :</span></h5>
                      <li><i class="fas fa-caret-right"></i>Sehat jasmani dan rohani</li>
                      <li><i class="fas fa-caret-right"></i>Masih berstatus siswa sekolah aktif</li>
                      <li><i class="fas fa-caret-right"></i>Mematuhi syarat & ketentuan yang berlaku</li>
                      <li><i class="fas fa-caret-right"></i>Melakukan pembayaran biaya pendaftaran</li>
                      <h6><br>Biaya Pendaftaran: <?= $e['BIAYA_EVENT']; ?></h6>
                      <h6 class="font-weight-bold" ><br>Transfer: <?= $e['BANK_EVENT']; ?></h6>
                    </ul>
                    <a href="pendaftaran" class="btn-style-one" style="border-radius:10px;">Register Now</a>
                  </div>
                </div>
                <div class="col-lg-6">
                  <img loading="lazy" class="img-fluid" style="border-radius=10px;" src="<?= base_url('/'). $e['FOTO_EVENT'] ?>" alt="service-image">
                </div>
              </div>
          </section>

            <?php endforeach; ?>
          <?php else : ?>
                    <tr>
                        <td colspan="3" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
          <?php endif; ?>

<section class="service-overview section">
  <div class="container service-box">
    <div class="row">
      <div class="col-lg-6 mb-5 mb-lg-0">
        <div class="content-block">
          <h2>Futsal<br>Competition</h2>
          <!-- <p>Futsal ialah sebuah permainan bola yang dimainkan oleh dua tim, yang masing-masing timnya memiliki jumlah anggota yakni lima orang. 
            Tujuan dari permainan adalah untuk memasukkan bola ke gawang lawan sebanyak, dengan memanipulasi bola dengan kaki. -->
          </p>
          <ul>
            <h5><span>Persyaratan :</span></h5>
            <li><i class="fas fa-caret-right"></i>Sehat jasmani dan rohani</li>
            <li><i class="fas fa-caret-right"></i>Masih berstatus siswa sekolah aktif</li>
            <li><i class="fas fa-caret-right"></i>Mematuhi syarat & ketentuan yang berlaku</li>
            <li><i class="fas fa-caret-right"></i>Melakukan pembayaran biaya pendaftaran</li>
            <h6><br>Biaya Pendaftaran: Rp. 300.000</h6>
            <h6 class="font-weight-bold" ><br>Transfer: BCA 897654312 a/n Permata Insani</h6>
          </ul>
          <a href="pendaftaran" class="btn-style-one" style="border-radius:10px;">Register Now</a>
        </div>
      </div>
      <div class="col-lg-6">
        <img loading="lazy" class="img-fluid" style="border-radius=10px;" src="<?= base_url(); ?>assets/img/images/services/futsal.jpg" alt="service-image">
      </div>
    </div>
</section>

<section class="section pt-0">
  <div class="container service-box">
    <div class="row">
      <div class="col-lg-6">
        <img loading="lazy" class="img-fluid" src="<?= base_url(); ?>assets/img/images/services/service-2.jpg" alt="service-image">
      </div>
      <div class="col-lg-6">
        <div class="contents">
          <div class="section-title">
            <h3>Badminton<br>Competition</br></h3>
          </div>
          <div class="text">
            <!-- <p>Bulu tangkis atau yang dikenal juga dengan istilah badminton merupakan salah satu cabang olahraga yang sangat terkenal di Indonesia dan dunia. 
              Dimana bulu tangkis ini merupakan cabang olahraga yang masuk ke dalam kategori permainan dan dapat dilakukan di dalam ataupun di luar ruangan dalam lapangan khusus. 
              Lapangan bulu tangkis sendiri dibagi menjadi dua sama besar dan dipisahkan oleh net yang tergantung di tiang net yang diletakkan di pinggir lapangan tengah.</p> -->
          </div>
          <ul class="content-list">
            <h5><span>Persyaratan :</span></h5>
            <li>
              <i class="far fa-check-circle"></i>Sehat jasmani dan rohani</li>
            <li>
              <i class="far fa-check-circle"></i>Masih berstatus siswa sekolah aktif</li>
            <li>
              <i class="far fa-check-circle"></i>Mematuhi syarat & ketentuan yang berlaku</li>
              <h6><br>Biaya Pendaftaran: Rp. 300.000</h6>
              <h6 class="font-weight-bold"><br>Transfer: BCA 897654312 a/n Permata Insani</h6>
          </ul>
          <a href="pendaftaran" class="btn-style-one" style="border-radius:10px;">Register Now</a>
        </div>
      </div>
    </div>
  </div>
</section>



<!-- <section class="cta">
  <div class="container-fluid">
    <div class="cta-block row no-gutters">
      <div class="col-lg-4 col-md-6 emmergency item">
        <i class="fa fa-phone"></i>
        <h2>Contact Person</h2>
        <a href="tel:1-800-700-6200">+62 821 345 789</a>
        <p>Informasi selengkapnya silahkan hubungi nomor berikut</p>
      </div>
      <div class="col-lg-4 col-md-12 top-doctor item">
        <i class="fa fa-money"></i>
        <h2>Pembayaran</h2>
          <p>BCA - <span>0812xxx - a.n admin</span></p>
          <p>DANA - <span>0812xxx - a.n admin</span></p>
          <p>OVO - <span>0812xxx - a.n admin</span></p>
      </div>
      <div class="col-lg-4 col-md-12 working-time item">
        <i class="fa fa-hourglass-o"></i>
        <h2>Jadwal Perlombaan</h2>
        <ul class="w-hours">
          <li>Futsal <span>08-February-2023</span></li>
          <li>Badminton<span>09-February-2023</span></li>
          <li>E - Sport<span>10-February-2023</span></li>
        </ul>
      </div>
    </div>
  </div>
</section> -->