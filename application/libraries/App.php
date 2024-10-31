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
      $user_data = $this->ci->user_m->get_data(
        ['user.id' => $user_id, 'user.deleted_date' => NULL],
        ['colleger' => 'colleger.id = user.colleger_id'],
        '
          user.id,
          user.username,
          user.name,
          user.role,
          user.colleger_id,
          colleger.nim,
          colleger.address,
          colleger.phone,
          colleger.study_program_id,
          colleger.classroom_id,
        '
      )->row();
  
      return $user_data;
    }
}
