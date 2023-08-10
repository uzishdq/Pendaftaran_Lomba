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
        if ($this->admin->delete('registrasi', 'ID_REGISTRASI', $id))
        {
            set_pesan('data berhasil dihapus.');
        }
        else
        {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('jenis');
    }

    public function toggle($getId)
    {
        $id = $getId;
        $status = $this->admin->get('registrasi', ['ID_REGISTRASI' => $id])['STATUS_REGISTRASI'];
        $email = $this->admin->getEmailMessage($id);
        $toggle = $status ? 0 : 1; //Jika user aktif maka nonaktifkan, begitu pula sebaliknya
        $pesan = $toggle ? 'Terima' : 'Tolak';
        if ($this->admin->update('registrasi', 'ID_REGISTRASI', $id, ['STATUS_REGISTRASI' => $toggle]))
        {
            $this->_sendMail($email);
            set_pesan($pesan);
        }
        redirect('registrasi_all');
    }

    public function tolak($getId)
    {
        $id = $getId;
        $status = $this->admin->get('registrasi', ['ID_REGISTRASI' => $id])['STATUS_REGISTRASI'];
        $email = $this->admin->getEmailMessage($id);

        if ($status == 1)
        {
            $status = 0;
            $template = "Assalamualaikum,\r\n\r\nKepada : {nama}, {sekolah}, \r\n\r\nMohon Maaf Registrasi Anda Ditolak. \r\n\r\nDalam Event {event} Tingkat {tingkat} - Nama Event {namaEvent} \r\nNama Team : {namaTeam} - Sekolah : {sekolah} - Provinsi : {provinsi} - Kota : {kota} \r\n\r\n\r\nTerima kasih.";
            if ($this->admin->update('registrasi', 'ID_REGISTRASI', $id, ['STATUS_REGISTRASI' => $status]))
            {
                $this->_sendMail($email, $template);
                set_pesan("Status Berhasil Diubah, Email Segera Dikirimkan ");
            }
            else
            {
                set_pesan("Status Gagal Diubah, Email Tidak Dikirimkan ", false);
            }
        }
        redirect('registrasi_all');
    }

    public function terima($getId)
    {
        $id = $getId;
        $status = $this->admin->get('registrasi', ['ID_REGISTRASI' => $id])['STATUS_REGISTRASI'];
        $email = $this->admin->getEmailMessage($id);

        if ($status == 0)
        {
            $status = 1;
            $template = "Assalamualaikum,\r\n\r\nKepada : {nama}, {sekolah}, \r\n\r\nSelamat Registrasi Anda Diterima. \r\n\r\nDalam Event {event} Tingkat {tingkat} - Nama Event {namaEvent} \r\nNama Team : {namaTeam} - Sekolah : {sekolah} - Provinsi : {provinsi} - Kota : {kota} \r\n\r\n\r\nTerima kasih.";
            if ($this->admin->update('registrasi', 'ID_REGISTRASI', $id, ['STATUS_REGISTRASI' => $status]))
            {
                $this->_sendMail($email, $template);
                set_pesan("Status Berhasil Diubah, Email Segera Dikirimkan ");
            }
            else
            {
                set_pesan("Status Gagal Diubah, Email Tidak Dikirimkan ", false);
            }
        }
        redirect('registrasi_all');
    }

    private function _sendMail($email, $template)
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

        foreach ($email as $ue)
        {
            $message = str_replace('{nama}', $ue['NAMA_CONTACT_PERSON'], $template);
            $message = str_replace('{sekolah}', $ue['SEKOLAH'], $message);
            $message = str_replace('{event}', $ue['NAMA_JENIS_EVENT'], $message);
            $message = str_replace('{tingkat}', $ue['NAMA_TINGKAT_EVENT'], $message);
            $message = str_replace('{namaEvent}', $ue['NAMA_EVENT'], $message);
            $message = str_replace('{namaTeam}', $ue['NAMA_TEAM'], $message);
            $message = str_replace('{provinsi}', $ue['PROVINSI'], $message);
            $message = str_replace('{kota}', $ue['KOTA'], $message);

            $this->email->from('por.piis2005@gmail.com', 'Panitia PORPIS (Pekan Olahraga Permata Insani Islamic School');
            $this->email->to($ue['EMAIL_CONTACT_PERSON']);
            $this->email->subject('Info Registrasi Pekan Olahraga Permata Insani Islamic School');
            $this->email->message($message);
        }

        if ($this->email->send())
        {
            return true;
        }
        else
        {
            echo $this->email->print_debugger();
            die;
        }
    }
}
