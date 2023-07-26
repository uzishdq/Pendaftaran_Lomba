<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Registrasi PORPIIS";
        $data['registrasi'] = $this->admin->getRegistrasi('futsal');
        $data['event'] = $this->admin->get('event');
        $this->template->load('templates/landing-page', 'landing_page/theme/pendaftaran', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_team', 'Nama Team', 'required|trim');
        $this->form_validation->set_rules('peserta', 'Jumlah Peserta', 'required|trim');
        $this->form_validation->set_rules('sekolah', 'Asal Sekolah', 'required|trim');
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required|trim');
        $this->form_validation->set_rules('kota', 'Kota', 'required|trim');
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

    public function add()
    {

        $this->_validasi();
        $this->_config();

        try {
            if ($this->form_validation->run() == false) {
                $data['title'] = "Registrasi";
                $data['registrasi'] = $this->admin->getRegistrasi('futsal');
                $data['event'] = $this->admin->get('event');
                $data['uploads'] = $this->admin->getUploads();
                $this->template->load('templates/landing-page', 'landing_page/theme/pendaftaran', $data);
            } else {
                $name = $this->input->post('nama_team');
                $participant = $this->input->post('peserta');
                $school = $this->input->post('sekolah');
                $provinsi = $this->input->post('provinsi');
                $kota = $this->input->post('kota');
                $tingkat = $this->input->post('tingkat');
                $event = $this->input->post('event_id');

                if ($this->upload->do_upload('file')) {
                    $file_data = $this->upload->data();
                    $file_name = $file_data['file_name'];

                    $data = array(
                        'nama_team' => $name,
                        'peserta' => $participant,
                        'sekolah' => $school,
                        'provinsi' => $provinsi,
                        'kota' => $kota,
                        'tingkat' => $tingkat,
                        'file' => $file_name,
                        'event_id' => $event
                    );

                    $insert = $this->admin->insert('registrasi', $data);

                    $dataupload = array();
                    $registrasi_id = $this->db->insert_id();

                    for ($i = 1; $i < $participant; $i++) {
                        $nama_peserta = $this->input->post('nama_peserta' . $i);
                    }

                    // Loop through the inputs
                    for ($i = 1; $i <= $participant; $i++) {
                        $foto = $_FILES['upload' . $i];
                        $nama_peserta = $this->input->post('nama_peserta' . $i);
                        // if($nama_peserta == ''){
                        //     set_pesan('Foto tidak boleh kosong !!!.');
                        //     redirect('pendaftaran');
                        // }
                        $raport = $_FILES['raport' . $i];
                        $kartu_pelajar = $_FILES['KARTU_PELAJAR' . $i];

                        // Handle file uploads and store the file paths
                        $foto_path = 'assets/file/foto/' . $foto['name'];
                        move_uploaded_file($foto['tmp_name'], $foto_path);

                        $raport_path = 'assets/file/raport/' . $raport['name'];
                        move_uploaded_file($raport['tmp_name'], $raport_path);

                        $kartu_pelajar_path = 'assets/file/kartu_pelajar/' . $kartu_pelajar['name'];
                        move_uploaded_file($kartu_pelajar['tmp_name'], $kartu_pelajar_path);

                        // Create an array with the input values
                        $input_data = array(
                            'foto' => $foto_path,
                            'nama_peserta' => $nama_peserta,
                            'raport' => $raport_path,
                            'kartu_pelajar' => $kartu_pelajar_path,
                            'registrasi_id' => $registrasi_id
                        );

                        // Add the input data to the main data array
                        $dataupload[] = $input_data;
                    }

                    // Store the values in the database

                    foreach ($dataupload as $input_data) {
                        $uploads = $this->admin->insert('uploads', $input_data);
                    }

                    if ($insert) {
                        set_pesan('Data Registrasi Berhasil Disimpan.');
                    } else {
                        set_pesan('Data Registrasi Gagal Disimpan.');
                    }
                    redirect('pendaftaran');
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('pendaftaran', $error);
                }
            }
        } catch (Exception $e) {
            // Handle the exception here
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    // Validation callback function for the file upload
    public function validate_file()
    {
        $this->_validasi();
        $config = $this->_config();
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('file')) {
            $this->form_validation->set_message('validate_file', $this->upload->display_errors());
            return false;
        }
        return true;
    }


    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Registrasi";
            $data['registrasi'] = $this->admin->get('registrasi', ['id_registrasi' => $id]);
            $data['event'] = $this->admin->get('event');
            $this->template->load('templates/landing-page', 'landing_page/theme/appointment', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('registrasi', 'id_registrasi', $id, $input);

            if ($update) {
                set_pesan('data berhasil diedit.');
                redirect('registrasi');
            } else {
                set_pesan('data gagal diedit.');
                redirect('registrasi/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('registrasi', 'id_registrasi', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('registrasi');
    }

    public function futsal()
    {
        $data['title'] = "Registrasi Futsal";
        $data['registrasi'] = $this->admin->getRegistrasi('futsal');
        $data['event'] = $this->admin->get('event');
        $this->template->load('templates/landing-page', 'landing_page/theme/pendaftaran', $data);
    }
}
