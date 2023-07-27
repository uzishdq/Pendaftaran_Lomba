<!-- Include DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">


<!--Page Title-->
<section class="page-title text-center" style="background-image:url(<?= base_url(); ?>assets/img/images/background/3.jpg);">
  <div class="container">
    <div class="title-text">
      <h1>DATA<span> TEAM</span></h1>
    </div>
  </div>
</section>
<!--End Page Title-->
<section class="cta">
  <div class="tabs">
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
            <div class="col-xl-12 working-time item">
              <h2><?= $je['NAMA_JENIS_EVENT']; ?></h2>
              <table class="table table-striped text-white">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Event</th>
                    <th scope="col">Nama Team</th>
                    <th scope="col">Jumlah Peserta</th>
                    <th scope="col">Asal Sekolah</th>
                    <th scope="col">Tingkat</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1; // Inisialisasi nomor urut di setiap jenis event
                  $foundEvent = false; // Variabel penanda jika ada event yang sesuai dengan jenis event
                  if ($team) :
                    foreach ($team as $t) :
                      if ($t['ID_JENIS_EVENT'] == $je['ID_JENIS_EVENT']) { // Memeriksa ID jenis event yang sesuai
                        $foundEvent = true; // Mengubah penanda menjadi true karena ada event yang sesuai
                  ?>
                        <tr>
                          <th scope="row"><?= $no++; ?></th>
                          <td><?= $t['NAMA_EVENT']; ?></td>
                          <td><?= $t['NAMA_TEAM']; ?></td>
                          <td><?= $t['JUMLAH_PESERTA']; ?></td>
                          <td><?= $t['SEKOLAH']; ?></td>
                          <td><?= $t['TINGKAT']; ?></td>
                        </tr>
                    <?php
                      }
                    endforeach;
                  endif;

                  if (!$foundEvent) :
                    ?>
                    <tr>
                      <td colspan="4">Tidak Ada Data</td>
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
    <h1>Tidak ada Data</h1>
  <?php endif; ?>
  </div>
</section>



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
</script>