<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Error404 extends CI_Controller
{
    public function index()
    {
        $this->output->set_status_header('404');
        // $this->template->load('templates/landing-page', 'landing_page/theme/errors/error_404');
        $data['heading'] = "404";
        $data['message'] = "404";
        $this->load->view('errors/html/error_404',$data);
    }
}
