<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');

        $upcoming_events = $this->admin->get_upcoming_events();
        foreach ($upcoming_events as $event)
        {
            $this->admin->update_status_selesai($event->ID_EVENT);
        }
    }

    public function index()
    {
        $data['title'] = "registrasi";
        $data['event'] = $this->admin->getEvent();

        $this->template->load('templates/landing-page', 'landing_page/theme/service', $data);
    }
}
