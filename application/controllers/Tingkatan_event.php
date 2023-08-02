<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tingkatan_event extends CI_Controller
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
        $data['title'] = "Tingkatan Event";
        $data['tingkat'] = $this->admin->get('tingkat_event');

        $this->template->load('templates/dashboard', 'tingkatan_event/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('NAMA_TINGKAT_EVENT', 'Nama Jenis', 'required|trim');
    }

    public function add()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false)
        {
            $data['title'] = "Tingkatan Event";
            $this->template->load('templates/dashboard', 'tingkatan_event/add', $data);
        }
        else
        {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('tingkat_event', $input);
            if ($insert)
            {
                set_pesan('data berhasil disimpan');
                redirect('tingkatan_event');
            }
            else
            {
                set_pesan('data gagal disimpan', false);
                redirect('tingkatan_event/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false)
        {
            $data['title'] = "Tingkatan Event";
            $data['tingkat'] = $this->admin->get('tingkat_event', ['ID_TINGKAT_EVENT' => $id]);
            $this->template->load('templates/dashboard', 'tingkatan_event/edit', $data);
        }
        else
        {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('tingkat_event', 'ID_TINGKAT_EVENT', $id, $input);
            if ($update)
            {
                set_pesan('data berhasil disimpan');
                redirect('tingkatan_event');
            }
            else
            {
                set_pesan('data gagal disimpan', false);
                redirect('tingkatan_event/edit');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('tingkat_event', 'ID_TINGKAT_EVENT', $id))
        {
            set_pesan('data berhasil dihapus.');
        }
        else
        {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('tingkatan_event');
    }
}
