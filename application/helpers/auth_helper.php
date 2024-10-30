<?php

if (!function_exists('has_login'))
{
  function has_login()
  {
    $CI = &get_instance();
    $CI->load->model('user_m');

    $user_id = $CI->session->userdata('user_id');
    $userExist = $CI->user_m->get_data(['id' => $user_id, 'deleted_date' => NULL])->row();

    if($userExist) {
      redirect('dashboard');
    }
  }
}

if (!function_exists('not_login'))
{
  function not_login()
  {
    $CI = &get_instance();
    $CI->load->model('user_m');

    $user_id = $CI->session->userdata('user_id');
    $userExist = $CI->user_m->get_data(['id' => $user_id, 'deleted_date' => NULL])->row();
    if(!$userExist) {
      redirect('login');
    }
  }
}
