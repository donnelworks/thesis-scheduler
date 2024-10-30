<?php

class App
{
    protected $ci;

    function __construct()
    {
      $this->ci = &get_instance();
    }
  
    function user()
    {
      $this->ci->load->model('user_m');
      $user_id = $this->ci->session->userdata('user_id');
      $user_data = $this->ci->user_m->get_data(['id' => $user_id, 'deleted_date' => NULL])->row();
  
      return $user_data;
    }
}
