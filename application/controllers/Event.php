<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
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
        $data['title'] = "Event";
        $data['event'] = $this->admin->getEvent();
        $this->template->load('templates/dashboard', 'event/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_event', 'Nama Event', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'required|trim');
        $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required|trim');
        $this->form_validation->set_rules('tanggal_akhir', 'Tanggal Akhir', 'required|trim');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Event";
            $data['jenis'] = $this->admin->get('jenis');
            $this->template->load('templates/dashboard', 'event/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $save = $this->admin->insert('event', $input);
            if ($save) {
                set_pesan('data berhasil disimpan.');
                redirect('event');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('event/add');
            }
        }
    }


    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Event";
            $data['jenis'] = $this->admin->get('jenis');
            $data['event'] = $this->admin->get('event', ['id_event' => $id]);
            $this->template->load('templates/dashboard', 'event/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('event', 'id_event', $id, $input);

            if ($update) {
                set_pesan('data berhasil diedit.');
                redirect('event');
            } else {
                set_pesan('data gagal diedit.');
                redirect('event/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('event', 'id_event', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('event');
    }
}
