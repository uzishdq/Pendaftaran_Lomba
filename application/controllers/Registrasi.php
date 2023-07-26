<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registrasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['event'] = $this->admin->getEvent();
        $data['registerAll'] = $this->admin->getRegistrasiAll();
        $this->template->load('templates/landing-page', 'landing_page/theme/registrasi', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('NAMA_TEAM', 'Nama Team', 'required|trim');
        $this->form_validation->set_rules('JUMLAH_PESERTA', 'Jumlah Peserta', 'required|trim');
        $this->form_validation->set_rules('SEKOLAH', 'Asal Sekolah', 'required|trim');
        $this->form_validation->set_rules('PROVINSI', 'Provinsi', 'required|trim');
        $this->form_validation->set_rules('KOTA', 'Kota', 'required|trim');
        $this->form_validation->set_rules('file', 'File', 'callback_validate_file');
    }

    private function _config()
    {
        $config['upload_path']      = "./assets/file/";
        $config['allowed_types']    = 'pdf|doc|docx|gif|jpg|jpeg|png';
        $config['encrypt_name']     = TRUE;
        $config['max_size']         = '2048';

        $this->load->library('upload', $config);
    }

    public function tambah($getId)
    {
        $id = encode_php_tags($getId);
        $this->_config();
        try {
            $namaPengurus = $this->input->post('NAMA_CONTACT_PERSON');
            $tlpPengurus = $this->input->post('NO_TELP_CONTACT_PERSON');
            $emailPengurus = $this->input->post('EMAIL_CONTACT_PERSON');

            $dataCp = array(
                'NAMA_CONTACT_PERSON' => $namaPengurus,
                'NO_TELP_CONTACT_PERSON' => $tlpPengurus,
                'EMAIL_CONTACT_PERSON' => $emailPengurus,
            );

            $insertCp = $this->admin->insert('contact_person', $dataCp);
            $contact_id = $this->db->insert_id();
            if (!$insertCp) {
                echo "Gagal contact person";
            }

            if (!$this->upload->do_upload('BUKTI_BAYAR')) //sesuai dengan name pada form 
            {
                echo 'anda gagal upload';
            } else {
                $file_data = $this->upload->data();
                $file_name = $file_data['file_name'];
                $idEvent = $id;
                $buktiBayar = $_FILES['BUKTI_BAYAR']["tmp_name"];
                $jumlahPeserta = $this->input->post('JUMLAH_PESERTA');
                $statusRegistrasi = '0';

                $buktiBayar_path = 'assets/file/bukti_bayar/' . $file_name;
                move_uploaded_file($buktiBayar, $buktiBayar_path);

                $dataRg = array(
                    'ID_EVENT' => $idEvent,
                    'JUMLAH_PESERTA' => $jumlahPeserta,
                    'BUKTI_BAYAR' => $buktiBayar_path,
                    'STATUS_REGISTRASI' => $statusRegistrasi,
                );

                $insertRg = $this->admin->insert('registrasi', $dataRg);
                $register_id = $this->db->insert_id();

                if (!$insertRg) {
                    echo "Gagal registrasi";
                }

                $namaTeam = $this->input->post('NAMA_TEAM');
                $sekolah = $this->input->post('SEKOLAH');
                $tingkat = $this->input->post('TINGKAT');
                $provinsi = $this->input->post('PROVINSI');
                $kota = $this->input->post('KOTA');

                $dataTm = array(
                    'ID_CONTACT_PERSON' => $contact_id,
                    'ID_REGISTRASI' => $register_id,
                    'NAMA_TEAM' => $namaTeam,
                    'SEKOLAH' => $sekolah,
                    'TINGKAT' => $tingkat,
                    'PROVINSI' => $provinsi,
                    'KOTA' => $kota,
                );

                $insertTm = $this->admin->insert('team', $dataTm);
                $team_id = $this->db->insert_id();

                if (!$insertTm) {
                    echo "Gagal registrasi";
                }


                $dataupload = array();

                for ($i = 1; $i < $jumlahPeserta; $i++) {
                    $nama_peserta = $this->input->post('nama_peserta' . $i);
                }

                for ($i = 1; $i <= $jumlahPeserta; $i++) {
                    $foto = $_FILES['upload' . $i];
                    $nama_peserta = $this->input->post('nama_peserta' . $i);
                    // if($nama_peserta == ''){
                    //     set_pesan('Foto tidak boleh kosong !!!.');
                    //     redirect('pendaftaran');
                    // }
                    $raport = $_FILES['RAPORT_PELAJAR' . $i];
                    $kartu_pelajar = $_FILES['KARTU_PELAJAR' . $i];

                    // Handle file uploads and store the file paths
                    $foto_path = 'assets/file/foto/' . $foto['name'];
                    move_uploaded_file($foto['tmp_name'], $foto_path);

                    $raport_path = 'assets/file/raport/' . $raport['name'];
                    move_uploaded_file($raport['tmp_name'], $raport_path);

                    $kartu_pelajar_path = 'assets/file/kartu_pelajar/' . $kartu_pelajar['name'];
                    move_uploaded_file($kartu_pelajar['tmp_name'], $kartu_pelajar_path);

                    // Create an array with the input values
                    $insertTm = array(
                        'ID_TEAM' => $team_id,
                        'FOTO_PESERTA' => $foto_path,
                        'NAMA_PESERTA' => $nama_peserta,
                        'KARTU_PELAJAR' => $kartu_pelajar_path,
                        'RAPORT_PELAJAR'  => $raport_path,
                    );

                    // Add the input data to the main data array
                    $dataupload[] = $insertTm;
                }

                foreach ($dataupload as $input_data) {
                    $uploads = $this->admin->insert('peserta', $input_data);
                }

                if ($uploads) {
                    set_pesan('Data Registrasi Berhasil Disimpan.');
                } else {
                    set_pesan('Data Registrasi Gagal Disimpan.');
                }
                redirect('service');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function daftar($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();
        $this->_config();
        try {
            if ($this->form_validation->run() == false) {
                $data['title'] = $this->admin->getEventId($id);
                $data['id'] = $id;
                $this->template->load('templates/landing-page', 'landing_page/theme/registrasi/daftar', $data);
            } else {
                $namaPengurus = $this->input->post('NAMA_CONTACT_PERSON');
                $tlpPengurus = $this->input->post('NO_TELP_CONTACT_PERSON');
                $emailPengurus = $this->input->post('EMAIL_CONTACT_PERSON');

                $dataCp = array(
                    'NAMA_CONTACT_PERSON' => $namaPengurus,
                    'NO_TELP_CONTACT_PERSON' => $tlpPengurus,
                    'EMAIL_CONTACT_PERSON' => $emailPengurus,
                );

                $insertCp = $this->admin->insert('contact_person', $dataCp);
                $contact_id = $this->db->insert_id();
                if (!$insertCp) {
                    echo "Gagal contact person";
                }

                if (!$this->upload->do_upload('BUKTI_BAYAR')) //sesuai dengan name pada form 
                {
                    echo 'anda gagal upload';
                } else {
                    $file_data = $this->upload->data();
                    $file_name = $file_data['file_name'];
                    $idEvent = $id;
                    $buktiBayar = $_FILES['BUKTI_BAYAR']["tmp_name"];
                    $jumlahPeserta = $this->input->post('JUMLAH_PESERTA');
                    $statusRegistrasi = '0';

                    $buktiBayar_path = 'assets/file/bukti_bayar/' . $file_name;
                    move_uploaded_file($buktiBayar, $buktiBayar_path);

                    $dataRg = array(
                        'ID_EVENT' => $idEvent,
                        'JUMLAH_PESERTA' => $jumlahPeserta,
                        'BUKTI_BAYAR' => $buktiBayar_path,
                        'STATUS_REGISTRASI' => $statusRegistrasi,
                    );

                    $insertRg = $this->admin->insert('register', $dataRg);
                    $register_id = $this->db->insert_id();

                    if (!$insertRg) {
                        echo "Gagal registrasi";
                    }

                    $namaTeam = $this->input->post('NAMA_TEAM');
                    $sekolah = $this->input->post('SEKOLAH');
                    $tingkat = $this->input->post('TINGKAT');
                    $provinsi = $this->input->post('PROVINSI');
                    $kota = $this->input->post('KOTA');

                    $dataTm = array(
                        'ID_CONTACT_PERSON' => $contact_id,
                        'ID_REGISTRASI' => $register_id,
                        'NAMA_TEAM' => $namaTeam,
                        'SEKOLAH' => $sekolah,
                        'TINGKAT' => $tingkat,
                        'PROVINSI' => $provinsi,
                        'KOTA' => $kota,
                    );

                    $insertTm = $this->admin->insert('register', $dataTm);
                    $team_id = $this->db->insert_id();

                    if (!$insertTm) {
                        echo "Gagal registrasi";
                    }


                    $dataupload = array();

                    for ($i = 1; $i < $jumlahPeserta; $i++) {
                        $nama_peserta = $this->input->post('nama_peserta' . $i);
                    }

                    for ($i = 1; $i <= $jumlahPeserta; $i++) {
                        $foto = $_FILES['upload' . $i];
                        $nama_peserta = $this->input->post('nama_peserta' . $i);
                        // if($nama_peserta == ''){
                        //     set_pesan('Foto tidak boleh kosong !!!.');
                        //     redirect('pendaftaran');
                        // }
                        $raport = $_FILES['RAPORT_PELAJAR' . $i];
                        $kartu_pelajar = $_FILES['KARTU_PELAJAR' . $i];

                        // Handle file uploads and store the file paths
                        $foto_path = 'assets/file/foto/' . $foto['name'];
                        move_uploaded_file($foto['tmp_name'], $foto_path);

                        $raport_path = 'assets/file/raport/' . $raport['name'];
                        move_uploaded_file($raport['tmp_name'], $raport_path);

                        $kartu_pelajar_path = 'assets/file/kartu_pelajar/' . $kartu_pelajar['name'];
                        move_uploaded_file($kartu_pelajar['tmp_name'], $kartu_pelajar_path);

                        // Create an array with the input values
                        $insertTm = array(
                            'ID_TEAM' => $team_id,
                            'FOTO_PESERTA' => $foto_path,
                            'NAMA_PESERTA' => $nama_peserta,
                            'KARTU_PELAJAR'  => $raport_path,
                            'KARTU_PELAJAR' => $kartu_pelajar_path,
                        );

                        // Add the input data to the main data array
                        $dataupload[] = $insertTm;
                    }

                    foreach ($dataupload as $input_data) {
                        $uploads = $this->admin->insert('peserta', $input_data);
                    }

                    if ($uploads) {
                        set_pesan('Data Registrasi Berhasil Disimpan.');
                    } else {
                        set_pesan('Data Registrasi Gagal Disimpan.');
                    }
                    redirect('service');
                }
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
}
