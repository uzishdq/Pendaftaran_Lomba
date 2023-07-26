<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_event extends CI_Controller
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
        $data['title'] = "Jenis Event";
        $data['jenis'] = $this->admin->get('jenis_event');
        
        $this->template->load('templates/dashboard', 'jenis_event/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('NAMA_JENIS_EVENT', 'Nama Jenis', 'required|trim');
    }

    public function add()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Jenis Event";
            $this->template->load('templates/dashboard', 'jenis_event/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('jenis_event', $input);
            if ($insert) {
                set_pesan('data berhasil disimpan');
                redirect('jenis_event');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('jenis_event/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Jenis";
            $data['jenis'] = $this->admin->get('jenis_event', ['ID_JENIS_EVENT' => $id]);
            $this->template->load('templates/dashboard', 'jenis_event/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('jenis_event', 'ID_JENIS_EVENT', $id, $input);
            if ($update) {
                set_pesan('data berhasil disimpan');
                redirect('jenis_event');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('jenis_event/edit');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('jenis_event', 'ID_JENIS_EVENT', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('jenis_event');
    }
}
