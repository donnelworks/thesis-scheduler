<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		has_login();
	}

	public function index()
	{
		$data['title'] = "Login";
		$this->load->view('login', $data);
	}
}
