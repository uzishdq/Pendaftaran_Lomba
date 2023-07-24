<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $data['event'] = $this->admin->count('event');
        $data['registrasi'] = $this->admin->count('registrasi');
        $data['user'] = $this->admin->count('user');
        $data['transaksi'] = [
            'barang_masuk' => $this->admin->getEvent(),
            'barang_keluar' => $this->admin->getRegistrasi('Futsal')
        ];

        // Line Chart
        $bln = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        $data['cbm'] = [];
        $data['cbk'] = [];

        foreach ($bln as $b) {
            $data['cbm'][] = $this->admin->chartEventMulai($b);
            $data['cbk'][] = $this->admin->chartEventAkhir($b);
        }

        $this->template->load('templates/dashboard', 'dashboard', $data);
    }
}
