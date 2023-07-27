<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }
	
	public function index()
	{
		$data['event'] = $this->admin->getEvent();
		$data['jenisEvent'] = $this->admin->getJenisEvent();
        $data['team'] = $this->admin->getTeam();
		$this->template->load('templates/landing-page', 'landing_page/theme/team',$data);
		// $this->template->load('templates/landing-page');
	}
}
