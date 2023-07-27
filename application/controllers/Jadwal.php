<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $data['title'] = "Jadwal Pertandingan";
        $data['jadwal'] = $this->admin->getSchedule();
        $this->template->load('templates/dashboard', 'jadwal/data', $data);
    }
}
