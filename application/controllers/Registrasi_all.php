<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registrasi_all extends CI_Controller
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
        $data['title'] = "Data Registrasi";
        $data['event'] = $this->admin->getEvent();
        $data['registerAll'] = $this->admin->getRegistrasiAll();
        $this->template->load('templates/dashboard', 'registrasi_all/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_jenis', 'Nama Jenis', 'required|trim');
    }

    public function add()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Jenis";
            $this->template->load('templates/dashboard', 'jenis/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('jenis', $input);
            if ($insert) {
                set_pesan('data berhasil disimpan');
                redirect('jenis');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('jenis/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Jenis";
            $data['jenis'] = $this->admin->get('jenis', ['id_jenis' => $id]);
            $this->template->load('templates/dashboard', 'jenis/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('jenis', 'id_jenis', $id, $input);
            if ($update) {
                set_pesan('data berhasil disimpan');
                redirect('jenis');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('jenis/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('jenis', 'id_jenis', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('jenis');
    }

    public function toggle($getId)
    {
        $id = $getId;
        $status = $this->admin->get('registrasi', ['ID_REGISTRASI' => $id])['STATUS_REGISTRASI'];
        $toggle = $status ? 0 : 1; //Jika user aktif maka nonaktifkan, begitu pula sebaliknya
        $pesan = $toggle ? 'Terima' : 'Tolak';

        if ($this->admin->update('registrasi', 'ID_REGISTRASI', $id, ['STATUS_REGISTRASI' => $toggle])) {
            set_pesan($pesan);
        }
        redirect('registrasi_all');
    }
}
