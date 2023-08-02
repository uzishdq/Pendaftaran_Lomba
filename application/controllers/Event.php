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
        $this->form_validation->set_rules('NAMA_EVENT', 'Nama Event', 'required|trim');
        $this->form_validation->set_rules('TGL_MULAI_EVENT', 'Tanggal Mulai', 'required|trim');
        $this->form_validation->set_rules('TGL_AKHIR_EVENT', 'Tanggal Akhir', 'required|trim');
        $this->form_validation->set_rules('BIAYA_EVENT', 'Biaya Event', 'required|trim');
        $this->form_validation->set_rules('BANK_EVENT', 'Bank Event', 'required|trim');
        $this->form_validation->set_rules('STATUS_EVENT', 'STATUS EVENT', 'required|trim');

    }

    private function _config()
    {
        $config['upload_path']      = "./assets/file/logo_event/";
        $config['allowed_types']    = 'pdf|doc|docx|gif|jpg|jpeg|png';
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
                $data['title'] = "Event";
                $data['jenis'] = $this->admin->get('jenis_event');
                $data['tingkat'] = $this->admin->get('tingkat_event');
                $this->template->load('templates/dashboard', 'event/add', $data);
            }
            else
            {
                if (!$this->upload->do_upload('FOTO_EVENT')) //sesuai dengan name pada form 
                {
                    set_pesan('data gagal disimpan', false);
                    redirect('event/add');
                }
                else
                {
                    $file_data = $this->upload->data();
                    $file_name = $file_data['file_name'];

                    $IdTingkatEvent = $this->input->post('ID_TINGKAT_EVENT');
                    $IdJenisEvent = $this->input->post('ID_JENIS_EVENT');
                    $namaEvent = $this->input->post('NAMA_EVENT');
                    $tglMulai = $this->input->post('TGL_MULAI_EVENT');
                    $tglAkhir = $this->input->post('TGL_AKHIR_EVENT');
                    $bank = $this->input->post('BANK_EVENT');
                    $status = $this->input->post('STATUS_EVENT');

                    $biaya = $this->input->post('BIAYA_EVENT');
                    $nominal = preg_replace('/[^\d]/', '', $biaya);
                    $nominal_int = intval($nominal);

                    // $foto = $_FILES['FOTO_EVENT']["tmp_name"];
                    // $foto_path = 'assets/file/logo_event/' . $file_name;
                    // move_uploaded_file($foto, $foto_path);

                    $input = array(
                        'ID_TINGKAT_EVENT' => $IdTingkatEvent,
                        'ID_JENIS_EVENT' => $IdJenisEvent,
                        'NAMA_EVENT' => $namaEvent,
                        'TGL_MULAI_EVENT' => $tglMulai,
                        'TGL_AKHIR_EVENT' => $tglAkhir,
                        'FOTO_EVENT' => $file_name,
                        'BIAYA_EVENT' => $nominal_int,
                        'BANK_EVENT' => $bank,
                        'STATUS_EVENT' => $status,
                    );
                    $save = $this->admin->insert('event', $input);
                    if ($save)
                    {
                        set_pesan('data berhasil disimpan.');
                        redirect('event');
                    }
                    else
                    {
                        set_pesan('data gagal disimpan', false);
                        redirect('event/add');
                    }
                }
            }
        }
        catch (Exception $e)
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }



    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();
        $this->_config();
        if ($this->form_validation->run() == false)
        {
            $data['title'] = "Event";
            $data['jenis'] = $this->admin->get('jenis_event');
            $data['tingkat'] = $this->admin->get('tingkat_event');
            $data['event'] = $this->admin->get('event', ['ID_EVENT' => $id]);
            $this->template->load('templates/dashboard', 'event/edit', $data);
        }
        else
        {
            if (!$this->upload->do_upload('FOTO_EVENT'))
            {
                $file_name = $this->input->post('OLD_FOTO_EVENT');
                set_pesan('Foto Menggunakan yang sebelumnya diedit.', false);
            }
            else
            {

                $file_data = $this->upload->data();
                $file_name = $file_data['file_name'];
                $old_foto_event = $this->input->post('OLD_FOTO_EVENT');
                if ($old_foto_event && file_exists('assets/file/logo_event/' . $old_foto_event))
                {
                    unlink('assets/file/logo_event/' . $old_foto_event);
                }
            }

            // Convert biaya to integer
            $biaya = $this->input->post('BIAYA_EVENT');
            $nominal = preg_replace('/[^\d]/', '', $biaya);
            $nominal_int = intval($nominal);

            // Prepare data for database update
            $input = array(
                'FOTO_EVENT' => $file_name,
                'ID_JENIS_EVENT' => $this->input->post('ID_JENIS_EVENT'),
                'NAMA_EVENT' => $this->input->post('NAMA_EVENT'),
                'TGL_MULAI_EVENT' => $this->input->post('TGL_MULAI_EVENT'),
                'TGL_AKHIR_EVENT' => $this->input->post('TGL_AKHIR_EVENT'),
                'BIAYA_EVENT' => $nominal_int,
                'BANK_EVENT' => $this->input->post('BANK_EVENT'),
                'STATUS_EVENT' => $this->input->post('STATUS_EVENT')
            );
            $update = $this->admin->update('event', 'ID_EVENT', $id, $input);

            if ($update)
            {
                set_pesan('data berhasil diedit.');
                redirect('event');
            }
            else
            {
                set_pesan('data gagal diedit.');
                redirect('event/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);

        if ($this->admin->delete('event', 'ID_EVENT', $id))
        {

            set_pesan('data berhasil dihapus.');
        }
        else
        {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('event');
    }
}
