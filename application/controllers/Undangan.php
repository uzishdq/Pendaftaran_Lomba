<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Undangan extends CI_Controller
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
        $data['title'] = "Undangan";
        $data['undangan'] = $this->admin->getUndangan();
        $data['person'] = $this->admin->getEmailContactPersonAll();
        $this->template->load('templates/dashboard', 'undangan/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('NAMA_UNDANGAN', 'Nama Undangan', 'required|trim');
    }

    private function _config()
    {
        $config['upload_path']      = "./assets/file/undangan/";
        $config['allowed_types']    = 'pdf';
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
                $data['title'] = "Upload Undangan";
                $this->template->load('templates/dashboard', 'undangan/add', $data);
            }
            else
            {
                if (!$this->upload->do_upload('FILE_UNDANGAN')) //sesuai dengan name pada form 
                {
                    set_pesan('data gagal disimpan Ukuran File Terlalu Besar', false);
                    redirect('undangan/add');
                }
                else
                {
                    $file_data = $this->upload->data();
                    $file_name = $file_data['file_name'];

                    $input = array(
                        'FILE_UNDANGAN' => $file_name,
                        'TGL_UNDANGAN' => $this->input->post('TGL_UNDANGAN'),
                        'NAMA_UNDANGAN' => $this->input->post('NAMA_UNDANGAN'),
                    );
                    $save = $this->admin->insert('undangan', $input);

                    if ($save)
                    {
                        set_pesan('data berhasil disimpan.');
                        redirect('undangan');
                    }
                    else
                    {
                        set_pesan('data gagal disimpan', false);
                        redirect('undangan/add');
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

    public function delete($getId)
    {
        $id = encode_php_tags($getId);

        if ($this->admin->delete('undangan', 'ID_UNDANGAN', $id))
        {
            set_pesan('data berhasil dihapus.');
        }
        else
        {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('undangan');
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
                $data['title'] = "Edit Undangan";
                $data['undangan'] = $this->admin->get('undangan', ['ID_UNDANGAN' => $id]);
                $this->template->load('templates/dashboard', 'undangan/edit', $data);
            }
            else
            {
                if (!$this->upload->do_upload('FILE_UNDANGAN')) //sesuai dengan name pada form 
                {
                    $file_name = $this->input->post('OLD_FILE_UNDANGAN');
                }
                else
                {
                    $file_data = $this->upload->data();
                    $file_name = $file_data['file_name'];
                    $old_foto_atribut = $this->input->post('OLD_FILE_UNDANGAN');
                    if ($old_foto_atribut && file_exists('assets/file/undangan/' . $old_foto_atribut))
                    {
                        unlink('assets/file/undangan/' . $old_foto_atribut);
                    }
                }

                $input = array(
                    'FILE_UNDANGAN' => $file_name,
                    'TGL_UNDANGAN' => $this->input->post('TGL_UNDANGAN'),
                    'NAMA_UNDANGAN' => $this->input->post('NAMA_UNDANGAN'),
                );

                $update = $this->admin->update('undangan', 'ID_UNDANGAN', $id, $input);

                if ($update)
                {
                    set_pesan('data berhasil diedit.');
                    redirect('undangan');
                }
                else
                {
                    set_pesan('data gagal diedit', false);
                    redirect('undangan/edit/' . $id);
                }
            }
        }
        catch (Exception $e)
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function UndanganKirim()
    {
        $recipients = $this->input->post('recipients');
        $file = $this->input->post('FILE_UNDANGAN');

        if (!empty($recipients))
        {
            $this->_sendUndangan($recipients, $file);
        }
        else
        {
            echo 'gagal';
        }
    }

    private function _sendUndangan($recipients, $file)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.googlemail.com',
            'smtp_user' => 'rizza.10519123@mahasiswa.unikom.ac.id',
            'smtp_pass' => '77969506',
            'smtp_port' => 465,
            'smtp_crypto' => 'ssl',
            'mailtype' => 'text',
            'charset' => 'utf-8',
            'newline' => "\r\n",
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $filePath = FCPATH . 'assets/file/undangan/' . $file;

        if (!empty($recipients))
        {

            if (file_exists($filePath))
            {


                foreach ($recipients as $recipient)
                {
                    $this->email->clear();
                    $this->email->from('por.piis2005@gmail.com', 'Panitia PORPIS (Pekan Olahraga Permata Insani Islamic School)');
                    $this->email->subject('Undangan');
                    $this->email->message('Testing');
                    $this->email->to($recipient);
                    $this->email->attach($filePath);

                    if ($this->email->send())
                    {
                        set_pesan('Email with attachment sent to:' . $recipient);
                        redirect('undangan');
                    }
                    else
                    {
                        set_pesan('Failed to send email with attachment to :' . $recipient);
                        redirect('undangan');
                        echo $this->email->print_debugger();
                    }
                }
            }
            else
            {
                set_pesan('Attachment not found:' . $filePath, false);
                redirect('undangan');
            }
        }
        else
        {
            set_pesan('Tidak ada penerima yang dipilih', false);
            redirect('undangan');
        }
    }
}
