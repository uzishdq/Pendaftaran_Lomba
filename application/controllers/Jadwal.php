<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Jadwal Pertandingan";
        $data['jadwal'] = $this->admin->getSchedule();
        $this->template->load('templates/dashboard', 'jadwal/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('NAMA_ATRIBUT', 'Nama Atribut', 'required|trim');
        $this->form_validation->set_rules('TINGKAT_ATRIBUT', 'Tingkat', 'required');
    }

    private function _config()
    {
        $config['upload_path']      = "./assets/file/";
        $config['allowed_types']    = 'pdf|doc|docx|gif|jpg|jpeg|png';
        $config['encrypt_name']     = TRUE;

        $this->load->library('upload', $config);
    }



    public function add()
    {
        $this->_validasi();
        $this->_config();
        try {
            if ($this->form_validation->run() == false) {
                $data['title'] = "Upload Jadwal Pertandingan";
                $data['event'] = $this->admin->getAtributEvent();
                $this->template->load('templates/dashboard', 'jadwal/add', $data);
            } else {
                if (!$this->upload->do_upload('FOTO_ATRIBUT')) //sesuai dengan name pada form 
                {
                    echo 'anda gagal upload';
                } else {
                    $file_data = $this->upload->data();
                    $file_name = $file_data['file_name'];
                    $foto = $_FILES['FOTO_ATRIBUT']["tmp_name"];
                    $foto_path = 'assets/file/pertandingan/' . $file_name;
                    move_uploaded_file($foto, $foto_path);

                    $input = array(
                        'FOTO_ATRIBUT' => $foto_path,
                        'ID_EVENT' => $this->input->post('ID_EVENT'),
                        'NAMA_ATRIBUT' => $this->input->post('NAMA_ATRIBUT'),
                        'TINGKAT_ATRIBUT' => $this->input->post('TINGKAT_ATRIBUT'),
                        'ID_USER' => $this->input->post('ID_USER'),
                    );
                    $save = $this->admin->insert('atribut', $input);

                    if ($save) {
                        set_pesan('data berhasil disimpan.');
                        redirect('jadwal');
                    } else {
                        set_pesan('data gagal disimpan', false);
                        redirect('jadwal/add');
                    }
                }
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
}
