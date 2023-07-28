<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pertandingan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $data['title'] = "Pertandingan";
        $data['event'] = $this->admin->getAtributAll();
        $this->template->load('templates/landing-page', 'landing_page/theme/pertandingan', $data);
    }
}
