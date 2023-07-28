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
        $data['jenisEvent'] = $this->admin->getJenisEvent();
        $data['registerAll'] = $this->admin->getRegistrasiAll();
        $this->template->load('templates/dashboard', 'registrasi_all/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_jenis', 'Nama Jenis', 'required|trim');
    }

    public function team($idRegistrasi)
    {
        $id = encode_php_tags($idRegistrasi);
        $data['title'] = "Data Team";
        $data['team'] = $this->admin->getTeamPeserta($id);
        $this->template->load('templates/dashboard', 'registrasi_all/team', $data);
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('registrasi', 'ID_REGISTRASI', $id)) {
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
