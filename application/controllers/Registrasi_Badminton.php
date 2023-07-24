<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registrasi_Badminton extends CI_Controller
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
        $data['title'] = "Registrasi";
        $data['registrasi'] = $this->admin->getRegistrasi('Badminton');
        $data['event'] = $this->admin->get('event');
        $this->template->load('templates/dashboard', 'registrasi/badminton/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_team', 'Nama Team', 'required|trim');
        $this->form_validation->set_rules('peserta', 'Jumlah Peserta', 'required|trim');
        $this->form_validation->set_rules('sekolah', 'Asal Sekolah', 'required|trim');
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required|trim');
        $this->form_validation->set_rules('kota', 'Kota', 'required|trim');
    }

    private function _config()
    {
        $config['upload_path']      = './uploads/';
        $config['allowed_types']    = 'pdf|doc|docx|gif|jpg|jpeg|png';
        $config['encrypt_name']     = TRUE;
        $config['max_size']         = '2048';

        $this->load->library('upload', $config);
    }

    public function add()
    {
        $this->_validasi();
        $this->_config();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Registrasi";
            $data['registrasi'] = $this->admin->getRegistrasi('Badminton');
            $data['event'] = $this->admin->get('event');
            $this->template->load('templates/dashboard', 'registrasi/badminton/add', $data);
        } else {
            $input = $this->input->post(null, true);
            if (empty($_FILES['file'])) {
                $insert = $this->admin->insert('registrasi', $input);
                if ($insert) {
                    set_pesan('data berhasil disimpan.');
                } else {
                    set_pesan('data gagal disimpan.');
                }
                redirect('registrasi');
            } else {
                if ($this->upload->do_upload('file') == false) {
                    echo $this->upload->display_errors();
                    die;
                } else {
                    if (userdata('file') != null) {
                        $old_image = FCPATH . 'uploads/' . userdata('file');
                        if (!unlink($old_image)) {
                            set_pesan('gagal hapus file.');
                            redirect('registrasi_badminton/add');
                        }
                    }

                    $input['file'] = $this->upload->data('file_name');
                    $update = $this->admin->insert('registrasi', $input);
                    if ($update) {
                        set_pesan('data berhasil disimpan.');
                    } else {
                        set_pesan('data gagal disimpan');
                    }
                    redirect('registrasi_badminton');
                }
            }
        }
    }


    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Registrasi";
            $data['registrasi'] = $this->admin->get('registrasi', ['id_registrasi' => $id]);
            $data['event'] = $this->admin->get('event');
            $this->template->load('templates/dashboard', 'registrasi/badminton/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('registrasi', 'id_registrasi', $id, $input);

            if ($update) {
                set_pesan('data berhasil diedit.');
                redirect('registrasi_badminton');
            } else {
                set_pesan('data gagal diedit.');
                redirect('registrasi_badminton/edit/' . $id);
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
        redirect('registrasi_badminton');
    }
}
