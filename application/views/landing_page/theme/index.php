<!--=================================
=            Page Slider            =
==================================-->
<!-- <div class="hero-slider">
  <!-- Slider Item -->
<div class="hero-slider">
  <!-- Slider Item -->
  <div class="slider-item slide1" style="background-image:url(<?= base_url(); ?>assets/img/images/slider/banner-1.jpeg)">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- Slide Content Start -->
          <div class="content style text-center">
            <h2 class="text-white text-bold mb-2" data-animation-in="slideInLeft">PORPIIS</h2>
            <p class="tag-text mb-4" data-animation-in="slideInRight">Pekan Olahraga Permata Insani Islamic School</p>
            <!-- <a href="pendaftaran" class="btn btn-main btn-white" data-animation-in="slideInLeft" data-duration-in="1.2">Register Now</a> -->
          </div>
          <!-- Slide Content End -->
        </div>
      </div>
    </div>
  </div>
  <!-- Slider Item -->
  <div class="slider-item" style="background-image:url(<?= base_url(); ?>assets/img/images/slider/banner-2.jpeg);">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- Slide Content Start-->
          <div class="content style text-center">
            <h2 class="text-white" data-animation-in="slideInRight">We Challenging in Sport and E-Sport Competition</h2>
            <p class="tag-text mb-4" data-animation-in="slideInRight" data-duration-in="0.6"></p>
            <!-- <a href="pendaftaran" class="btn btn-main btn-white" data-animation-in="slideInRight" data-duration-in="1.2">register now</a> -->
          </div>
          <!-- Slide Content End-->
        </div>
      </div>
    </div>
  </div>
  <!-- Slider Item -->
  <div class="slider-item" style="background-image:url(<?= base_url(); ?>assets/img/images/slider/banner-3.jpeg)">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- Slide Content Start -->
          <div class="content text-center style">
            <h2 class="text-white text-bold mb-2" data-animation-in="slideInRight">Best Competition In Tangerang</h2>
            <!-- <p class="tag-text mb-4" data-animation-in="slideInLeft">Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae deserunt, <br>eius pariatur minus itaque nostrum.</p> -->
            <!-- <a href="pendaftaran" class="btn btn-main btn-white" data-animation-in="slideInRight"  data-duration-in="1.2">register now</a> -->
          </div>
          <!-- Slide Content End -->
        </div>
      </div>
    </div>
  </div>
</div>

<!--====  End of Page Slider  ====-->
<section class="cta"">
  <div class=" tabs">
  <h1 class="flex justify-content-center text-center mb-5">List Event</h1>
  <ul class="nav nav-tabs justify-content-center" id="teamTab" role="tablist">
    <li class="nav-item" role="presentation">
      <?php if ($jenisEvent) : ?>

        <?php foreach ($jenisEvent as $je) : ?>
          <a onclick="showTable('<?= $je['ID_JENIS_EVENT']; ?>')"><?= $je['NAMA_JENIS_EVENT']; ?></a>
        <?php endforeach; ?>
      <?php else : ?>
        <a>Tidak Ada Event</a>
      <?php endif; ?>
    </li>
  </ul>
  </div>
  <?php if ($jenisEvent) : ?>
    <?php foreach ($jenisEvent as $je) : ?>
      <div class="table-container" id="<?= $je['ID_JENIS_EVENT']; ?>">
        <div class="container-fluid">
          <div class="cta-block row no-gutters">
            <div class="section-title-inner">
              <div class="section-title"></div>
            </div>
            <div class="col-xl-12 working-time item shadow rounded">
              <h2><?= $je['NAMA_JENIS_EVENT']; ?></h2>
              <table class="table table-hover table-dark table w-100">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Event</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Status Event</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1; // Inisialisasi nomor urut di setiap jenis event
                  $foundEvent = false; // Variabel penanda jika ada event yang sesuai dengan jenis event
                  if ($event) :
                    foreach ($event as $e) :
                      if ($e['ID_JENIS_EVENT'] == $je['ID_JENIS_EVENT']) { // Memeriksa ID jenis event yang sesuai
                        $foundEvent = true; // Mengubah penanda menjadi true karena ada event yang sesuai
                        $tanggalMulai = $e['TGL_MULAI_EVENT'];
                        $datetime1 = date_create($tanggalMulai);
                        $tglAwal = date_format($datetime1, 'd');

                        $tanggalAkhir = $e['TGL_AKHIR_EVENT'];
                        $datetime2 = date_create($tanggalAkhir);
                        $tglAkhir = date_format($datetime2, 'd F Y');

                        $status = strtoupper($e['STATUS_EVENT']);
                  ?>
                        <tr>
                          <th scope="row"><?= $no++; ?></th>
                          <td><?= $e['NAMA_EVENT']; ?></td>
                          <td><?= $tglAwal; ?> - <?= $tglAkhir; ?></td>
                          <td><?= $status ?></td>
                        </tr>
                    <?php
                      }
                    endforeach;
                  endif;

                  if (!$foundEvent) :
                    ?>
                    <tr>
                      <td colspan="4" class="text-center">Tidak Ada Data</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else : ?>
  <?php endif; ?>
  </div>
</section>



<!--about section-->
<section class="feature-section section " id="about">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="image-content">
          <div class="section-title text-center">
            <h3>Best Event <span>of Our Competition</span></h3>
            <!-- <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam magni in at debitis <br> nam error officia vero tempora alias? Sunt?</p> -->
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="item">
                <div class="icon-box">
                  <figure>
                    <a href="services.html"><img loading="lazy" src="<?= base_url(); ?>assets/img/images/resource/icon-1.png" alt="features image"></a>
                  </figure>
                </div>
                <h3 class="mb-2">Sportivitas</h3>
                <p class="text-justify">Dalam olahraga, sportivitas menekankan pentingnya fair play dan perilaku yang jujur ​​serta mengikuti aturan dengan tepat.
                  Para atlet yang memiliki sportivitas adalah mereka yang berkompetisi dengan sportif, tidak mencari cara curang untuk mencapai kemenangan,
                  dan menghormati lawan mereka. Mereka menunjukkan etika bermain yang baik, menerima keputusan wasit atau juri dengan lapang dada,
                  dan tidak menunjukkan perilaku agresif atau merendahkan lawan mereka.</p>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="item">
                <div class="icon-box">
                  <figure>
                    <a href="services.html">
                      <img loading="lazy" src="<?= base_url(); ?>assets/img/images/resource/icon-3.jpg" alt="features image">
                    </a>
                  </figure>
                </div>
                <h3 class="mb-2">Loyalitas</h3>
                <p class="text-justify">Loyalitas merupakan Seorang atlet yang loyal akan tetap berada di sisi timnya, berusaha keras,
                  dan mendukung rekan setimnya, meskipun hasilnya tidak selalu menguntungkan. Loyalitas membentuk ikatan yang kuat di antara anggota tim,
                  membangun kepercayaan, dan menciptakan semangat juang bersama untuk meraih kemenangan. Selain itu,
                  loyalitas juga mencakup menghormati aturan permainan, bersikap sportif, dan tidak terlibat dalam perilaku curang atau tidak etis yang dapat merugikan timnya.</p>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="item">
                <div class="icon-box">
                  <figure>
                    <a href="services.html">
                      <img loading="lazy" src="<?= base_url(); ?>assets/img/images/resource/icon-2.jpg" alt="features image">
                    </a>
                  </figure>
                </div>
                <h3 class="mb-2">Competitive</h3>
                <p class="text-justify">Competitive adalah istilah yang digunakan untuk menggambarkan situasi di mana individu, perusahaan, atau entitas lain bersaing untuk mencapai tujuan tertentu atau untuk menjadi yang terbaik dalam suatu bidang. Dalam konteks persaingan, pesaing berusaha untuk mencapai keunggulan atas orang atau entitas lainnya dengan cara mengatasi atau mengungguli mereka dalam berbagai aspek.</p>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="item">
                <div class="icon-box">
                  <figure>
                    <a href="services.html">
                      <img loading="lazy" src="<?= base_url(); ?>assets/img/images/resource/icon-4.jpg" alt="features image">
                    </a>
                  </figure>
                </div>
                <h3 class="mb-2">Teamwork</h3>
                <p class="text-justify">Teamwork adalah kerjasama atau kolaborasi antara anggota tim dalam mencapai tujuan bersama. Dalam konteks kerja atau proyek, teamwork adalah kemampuan anggota tim untuk bekerja bersama, saling mendukung, dan berkontribusi secara efektif guna mencapai sasaran yang telah ditetapkan.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!--End about section-->

<style>
  /* CSS untuk menyembunyikan semua tabel dengan class "table-container" */
  .table-container {
    display: none;
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