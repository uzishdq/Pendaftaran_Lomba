      <!--Page Title-->
      <section class="page-title text-center" style="background-image:url(<?= base_url(); ?>assets/img/images/background/3.jpg);">
          <div class="container">
              <div class="title-text">
                  <h1><?= $title; ?></h1>
              </div>
          </div>
      </section>
      <!--End Page Title-->

      <section class="section style-three pb-0">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12 order-1 order-lg-0">
                      <div class="contact-area style-two pl-0 pr-0 pr-lg-4">
                          <div class="section-title">
                              <h3></h3>
                          </div>
                          <?= $this->session->flashdata('pesan'); ?>
                          <form name="register_futsal" action="<?= base_url('pendaftaran/add') ?>" method="post" enctype="multipart/form-data">
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <select name="event_id" id="event_id" class="custom-select" required>
                                              <option value="" selected disabled>Pilih Event</option>
                                              <?php foreach ($event as $e) : ?>
                                                  <option <?= set_select('event_id', $e['id_event']) ?> value="<?= $e['id_event'] ?>"><?= $e['nama_event'] ?></option>
                                              <?php endforeach; ?>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <input class="form-control" type="text" name="nama_team" id="nama_team" placeholder="Nama Team" required="">
                                      </div>
                                      <?= form_error('nama_team', '<small class="text-danger">', '</small>'); ?>
                                      <div class="form-group">
                                          <input class="form-control" type="text" name="sekolah" id="sekolah" placeholder="Asal Sekolah" required="">
                                      </div>
                                      <?= form_error('sekolah', '<small class="text-danger">', '</small>'); ?>
                                      <div class="form-group">
                                          <!-- <select class="form-control" name="provinsi" id="provinsi" required>
                          <option value="">Provinsi</option>
                        </select> -->
                                          <input class="form-control" type="text" name="provinsi" id="provinsi" placeholder="Provinsi" required="">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <input class="form-control" type="text" name="peserta" id="peserta" placeholder="Jumlah Anggota" required="numeric" oninput="addFormSections()">
                                      </div>
                                      <div class="form-group">
                                          <select name="tingkat" id="tingkat" class="custom-select">
                                              <option value="" selected disabled>Pilih Tingkat</option>
                                              <option value="SD" id="SD" name="tingkat">SD</option>
                                              <option value="SMP" id="SMP" name="tingkat">SMP</option>
                                              <option value="SMA" id="SMA" name="tingkat">SMA</option>
                                          </select>
                                      </div>
                                      <div class="form-group">
                                          <!-- <select class="form-control" name="kota" id="kota" required>
                          <option value="">Kota</option>
                        </select> -->
                                          <input class="form-control" type="text" name="kota" id="kota" placeholder="Kota" required="">
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="mb-3">
                                          <label for="file" class="drop-container">
                                              <img id='folder-upload' src="<?= base_url() ?>assets/img/images/icons/upload-folder.png">
                                              <span class="drop-title">Upload Bukti Pembayaran</span>
                                              or
                                              <input type="file" id="file" name="file" accept="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, image/gif, image/jpeg, image/png" required style="width: 350px;
                                max-width: 100%;
                                color: #444;
                                padding: 5px;
                                background: #fff;
                                border-radius: 10px;">
                                          </label>
                                      </div>
                                      <div class="section-title">
                                          <h3>Upload <span>Persyaratan</span></h3><br>
                                      </div>
                                      <form name="register_futsal" action="<?= base_url('pendaftaran/add') ?>" method="post" enctype="multipart/form-data">
                                          <div class="form-container">
                                              <div class="row" id="form-sections-container">
                                                  <!-- Peserta 1 -->
                                                  <div class="col-sm">
                                                      <div class="form-group">
                                                          <label for="upload1">
                                                              <img id=preview-image1 src="<?= base_url() ?>assets/img/avatar/user.png" alt="peserta1" class="rounded-circle shadow-sm img-thumbnail">
                                                              <input type="file" id="upload1" name="upload1" style="display:none" onchange="previewFile(event, 'preview-image1')">
                                                          </label>
                                                      </div>
                                                      <?= form_error('foto', '<small class="text-danger">', '</small>'); ?>
                                                      <div class="form-group">
                                                          <input class="form-control" type="text" id="nama_peserta1" name="nama_peserta1" placeholder="Nama Peserta 1" required="">
                                                      </div>
                                                      <?= form_error('nama_peserta', '<small class="text-danger">', '</small>'); ?>
                                                      <div class="form-group">
                                                          <label for="raport" class="form-label text-center">Upload Scan Raport
                                                              <input class="form-control" id="raport1" name="raport1" type="file" required="">
                                                          </label>
                                                      </div>
                                                      <div class="form-group">
                                                          <label for="kartu_pelajar" class="form-label text-center">Upload Scan Kartu Pelajar
                                                              <input class="form-control" id="kartu_pelajar1" name="kartu_pelajar1" type="file" required="">
                                                          </label>
                                                      </div>
                                                  </div>
                                                  <!-- Peserta 2 -->
                                                  <div class="col-sm">
                                                      <div class="form-group">
                                                          <label for="upload2">
                                                              <img id=preview-image2 src="<?= base_url() ?>assets/img/avatar/user.png" alt="peserta2" class="rounded-circle shadow-sm img-thumbnail">
                                                              <input type="file" id="upload2" name="upload2" style="display:none" onchange="previewFile(event, 'preview-image2')">
                                                          </label>
                                                      </div>
                                                      <?= form_error('foto', '<small class="text-danger">', '</small>'); ?>
                                                      <div class="form-group">
                                                          <input class="form-control" type="text" id="nama_peserta2" name="nama_peserta2" placeholder="Nama Peserta 2" required="">
                                                      </div>
                                                      <?= form_error('nama_peserta2', '<small class="text-danger">', '</small>'); ?>
                                                      <div class="form-group">
                                                          <label for="raport2" class="form-label text-center">Upload Scan Raport
                                                              <input class="form-control" id="raport2" name="raport2" type="file" required="">
                                                          </label>
                                                      </div>
                                                      <div class="form-group">
                                                          <label for="kartu_pelajar2" class="form-label text-center">Upload Scan Kartu Pelajar
                                                              <input class="form-control" id="kartu_pelajar2" name="kartu_pelajar2" type="file" required="">
                                                          </label>
                                                      </div>
                                                  </div>
                                                  <!-- Peserta 3 -->
                                                  <div class="col-sm">
                                                      <div class="form-group">
                                                          <label for="upload3">
                                                              <img id=preview-image3 src="<?= base_url() ?>assets/img/avatar/user.png" alt="peserta3" class="rounded-circle shadow-sm img-thumbnail">
                                                              <input type="file" id="upload3" name="upload3" style="display:none" onchange="previewFile(event, 'preview-image3')">
                                                          </label>
                                                      </div>
                                                      <?= form_error('foto', '<small class="text-danger">', '</small>'); ?>
                                                      <div class="form-group">
                                                          <input class="form-control" type="text" id="nama_peserta3" name="nama_peserta3" placeholder="Nama Peserta 3" required="">
                                                      </div>
                                                      <?= form_error('nama_peserta3', '<small class="text-danger">', '</small>'); ?>
                                                      <div class="form-group">
                                                          <label for="raport3" class="form-label text-center">Upload Scan Raport
                                                              <input class="form-control" id="raport3" name="raport3" type="file" required="">
                                                          </label>
                                                      </div>
                                                      <div class="form-group">
                                                          <label for="kartu_pelajar3" class="form-label text-center">Upload Scan Kartu Pelajar
                                                              <input class="form-control" id="kartu_pelajar3" name="kartu_pelajar3" type="file" required="">
                                                          </label>
                                                      </div>
                                                  </div>
                                                  <!-- Peserta 4 -->
                                                  <div class="col-sm">
                                                      <div class="form-group">
                                                          <label for="upload4">
                                                              <img id=preview-image4 src="<?= base_url() ?>assets/img/avatar/user.png" alt="peserta4" class="rounded-circle shadow-sm img-thumbnail">
                                                              <input type="file" id="upload4" name="upload4" style="display:none" onchange="previewFile(event, 'preview-image4')">
                                                          </label>
                                                      </div>
                                                      <?= form_error('foto', '<small class="text-danger">', '</small>'); ?>
                                                      <div class="form-group">
                                                          <input class="form-control" type="text" id="nama_peserta4" name="nama_peserta4" placeholder="Nama Peserta 4" required="">
                                                      </div>
                                                      <?= form_error('nama_peserta4', '<small class="text-danger">', '</small>'); ?>
                                                      <div class="form-group">
                                                          <label for="raport4" class="form-label text-center">Upload Scan Raport
                                                              <input class="form-control" id="raport4" name="raport4" type="file" required="">
                                                          </label>
                                                      </div>
                                                      <div class="form-group">
                                                          <label for="kartu_pelajar4" class="form-label text-center">Upload Scan Kartu Pelajar
                                                              <input class="form-control" id="kartu_pelajar4" name="kartu_pelajar4" type="file" required="">
                                                          </label>
                                                      </div>
                                                  </div>
                                                  <!-- Peserta 5 -->
                                                  <div class="col-sm">
                                                      <div class="form-group">
                                                          <label for="upload5">
                                                              <img id=preview-image5 src="<?= base_url() ?>assets/img/avatar/user.png" alt="peserta5" class="rounded-circle shadow-sm img-thumbnail">
                                                              <input type="file" id="upload5" name="upload5" style="display:none" onchange="previewFile(event, 'preview-image5')">
                                                          </label>
                                                      </div>
                                                      <?= form_error('foto', '<small class="text-danger">', '</small>'); ?>
                                                      <div class="form-group">
                                                          <input class="form-control" type="text" id="nama_peserta5" name="nama_peserta5" placeholder="Nama Peserta 5" required="">
                                                      </div>
                                                      <?= form_error('nama_peserta5', '<small class="text-danger">', '</small>'); ?>
                                                      <div class="form-group">
                                                          <label for="raport5" class="form-label text-center">Upload Scan Raport
                                                              <input class="form-control" id="raport5" name="raport5" type="file" required="">
                                                          </label>
                                                      </div>
                                                      <div class="form-group">
                                                          <label for="kartu_pelajar5" class="form-label text-center">Upload Scan Kartu Pelajar
                                                              <input class="form-control" id="kartu_pelajar5" name="kartu_pelajar5" type="file" required="">
                                                          </label>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </form>
                                      <div class="col-lg d-flex justify-content-center">
                                          <div class="form-group text-center">
                                              <button type="submit" class="btn-style-one" style="border-radius:12px;width: 250px;">submit now</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                      </div>
                      </form>
                  </div>
              </div>
          </div>
          </div>
      </section>

      <script>
          function validateForm() {
              // Get the file input element
              var fileInput = document.getElementById('fileInput');

              // Check if the file input value is empty
              if (fileInput.value === '') {
                  alert('Please select a file to upload.');
                  return false; // Prevent form submission
              }

              // Other validation checks can be added here if needed

              // If all validations pass, allow form submission
              return true;
          }

          function previewFile(event, previewId) {
              const input = event.target;
              if (input.files && input.files[0]) {
                  const reader = new FileReader();

                  reader.onload = function(e) {
                      const previewImage = document.getElementById(previewId);
                      previewImage.src = e.target.result;
                  }

                  reader.readAsDataURL(input.files[0]);
              }
          }

          function addFormSections() {
              var pesertaInput = document.getElementById('peserta');
              var pesertaValue = parseInt(pesertaInput.value);
              var formSectionsContainer = document.getElementById('form-sections-container');

              // Clear existing form sections
              formSectionsContainer.innerHTML = '';

              // Generate new form sections based on the input value
              for (var i = 1; i <= pesertaValue; i++) {
                  var formSectionHtml = `
            <div class="col-sm">
                <div class="form-group">
                    <label for="upload${i}">
                        <img id="preview-image${i}" src="<?= base_url() ?>assets/img/avatar/user.png" alt="peserta${i}" class="rounded-circle shadow-sm img-thumbnail">
                        <input type="file" id="upload${i}" name="upload${i}" style="display:none" onchange="previewFile(event, 'preview-image${i}')">
                    </label>
                </div>
                <?= form_error('foto', '<small class="text-danger">', '</small>'); ?>
                <div class="form-group">
                    <input class="form-control" type="text" id="nama_peserta${i}" name="nama_peserta${i}" placeholder="Nama Peserta ${i}" required="">
                </div>
                <?= form_error('nama_peserta', '<small class="text-danger">', '</small>'); ?>
                <div class="form-group">
                    <label for="raport" class="form-label text-center">Upload Scan Raport
                        <input class="form-control" id="raport${i}" name="raport${i}" type="file" required="">
                    </label>
                </div>
                <?= form_error('raport', '<small class="text-danger">', '</small>'); ?>
                <div class="form-group">
                    <label for="kartu_pelajar" class="form-label text-center">Upload Scan Kartu Pelajar
                        <input class="form-control" id="kartu_pelajar${i}" name="kartu_pelajar${i}" type="file" required="">
                    </label>
                </div>
                <?= form_error('kartu_pelajar', '<small class="text-danger">', '</small>'); ?>
            </div>
        `;
                  formSectionsContainer.innerHTML += formSectionHtml;
              }
          }
      </script>

      <style>
          input[type=file] {}

          .drop-container {
              position: relative;
              display: flex;
              gap: 10px;
              flex-direction: column;
              justify-content: center;
              align-items: center;
              height: 220px;
              padding: 20px;
              border-radius: 10px;
              border: 2px dashed #555;
              color: #444;
              cursor: pointer;
              transition: background .2s ease-in-out, border .2s ease-in-out;
          }

          .drop-container:hover {
              background: #eee;
              border-color: #111;
          }

          .drop-container:hover .drop-title {
              color: #222;
          }

          .drop-title {
              color: #444;
              font-size: 20px;
              font-weight: bold;
              text-align: center;
              transition: color .2s ease-in-out;
          }

          .form-container {
              display: flex;
              flex-wrap: wrap;
              justify-content: center;
          }

          .col-sm {
              flex: 0 0 20%;
              /* Adjust this value as needed */
              max-width: 20%;
              /* Adjust this value as needed */
              padding: 10px;
              box-sizing: border-box;
          }
      </style>
      <!-- End Section -->