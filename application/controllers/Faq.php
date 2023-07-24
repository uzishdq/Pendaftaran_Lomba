<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Faq extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "FAQ";
        $this->template->load('templates/landing-page', 'landing_page/theme/faq', $data);
    }
}