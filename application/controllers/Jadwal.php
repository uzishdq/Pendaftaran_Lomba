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
        $data['atribut'] = $this->admin->getAtributAll();
        $this->template->load('templates/dashboard', 'jadwal/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('NAMA_ATRIBUT', 'Nama Atribut', 'required|trim');
    }

    private function _config()
    {
        $config['upload_path']      = "./assets/file/pertandingan/";
        $config['allowed_types']    = 'jpg|jpeg|png';
        $config['encrypt_name']     = TRUE;
        $config['max_size']         = '10048';

        $this->load->library('upload', $config);
    }

    public function add()
    {
        $this->_validasi();
        $this->_config();
        try
        {
            if ($this->form_validation->run() == false)
            {
                $data['title'] = "Upload Jadwal Pertandingan";
                $data['event'] = $this->admin->getAtributEvent();
                $this->template->load('templates/dashboard', 'jadwal/add', $data);
            }
            else
            {
                if (!$this->upload->do_upload('FOTO_ATRIBUT')) //sesuai dengan name pada form 
                {
                    set_pesan('data gagal disimpan Ukuran File Terlalu Besar', false);
                    redirect('jadwal/add');
                }
                else
                {
                    $file_data = $this->upload->data();
                    $file_name = $file_data['file_name'];

                    $input = array(
                        'FOTO_ATRIBUT' => $file_name,
                        'ID_EVENT' => $this->input->post('ID_EVENT'),
                        'NAMA_ATRIBUT' => $this->input->post('NAMA_ATRIBUT'),
                        'ID_USER' => $this->input->post('ID_USER'),
                    );
                    $save = $this->admin->insert('atribut', $input);

                    if ($save)
                    {
                        set_pesan('data berhasil disimpan.');
                        redirect('jadwal');
                    }
                    else
                    {
                        set_pesan('data gagal disimpan', false);
                        redirect('jadwal/add');
                    }
                }
            }
        }
        catch (Exception $e)
        {
            set_pesan('data gagal disimpan' . $e->getMessage(), false);
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();
        $this->_config();
        try
        {
            if ($this->form_validation->run() == false)
            {
                $data['title'] = "Edit Jadwal Pertandingan";
                $data['atribut'] = $this->admin->get('atribut', ['ID_ATRIBUT' => $id]);
                $this->template->load('templates/dashboard', 'jadwal/edit', $data);
            }
            else
            {
                if (!$this->upload->do_upload('FOTO_ATRIBUT')) //sesuai dengan name pada form 
                {
                    $file_name = $this->input->post('OLD_FOTO_ATRIBUT');
                }
                else
                {
                    $file_data = $this->upload->data();
                    $file_name = $file_data['file_name'];
                    $old_foto_atribut = $this->input->post('OLD_FOTO_ATRIBUT');
                    if ($old_foto_atribut && file_exists('assets/file/pertandingan/' . $old_foto_atribut))
                    {
                        unlink('assets/file/pertandingan/' . $old_foto_atribut);
                    }
                }

                $input = array(
                    'FOTO_ATRIBUT' => $file_name,
                    'ID_EVENT' => $this->input->post('ID_EVENT'),
                    'NAMA_ATRIBUT' => $this->input->post('NAMA_ATRIBUT'),
                    'ID_USER' => $this->input->post('ID_USER'),
                );

                $update = $this->admin->update('atribut', 'ID_ATRIBUT', $id, $input);

                if ($update)
                {
                    set_pesan('data berhasil diedit.');
                    redirect('jadwal');
                }
                else
                {
                    set_pesan('data gagal diedit', false);
                    redirect('jadwal/edit/' . $id);
                }
            }
        }
        catch (Exception $e)
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('atribut', 'ID_ATRIBUT', $id))
        {
            set_pesan('data berhasil dihapus.');
        }
        else
        {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('jadwal');
    }
}
