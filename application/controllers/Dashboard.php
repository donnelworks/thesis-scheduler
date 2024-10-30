<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    not_login();
    // $this->load->model([
    //     'activity_m' => 'mod_act',
    // ]);
  }

  public function index()
  {
    $data['title'] = "Dashboard";
    $this->template->load('dashboard', $data, 'dashboard_js');
  }
}
