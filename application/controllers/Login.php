<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		has_login();
		$this->load->model([
            'schedule_m' => 'schedule',
        ]);
	}

	public function index()
	{
		$data['title'] = "Login";
		$this->load->view('login', $data);
	}

	function load_table()
    {
        $filter = $this->input->post();
        header('Content-Type: application/json');
        $res = $this->schedule->load_table_dashboard($filter);
        echo $res;
    }
}
