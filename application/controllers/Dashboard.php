<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    not_login();
    $this->load->model([
        'study_program_m' => 'study',
        'classroom_m' => 'classroom',
        'lecturer_m' => 'lecturer',
        'colleger_m' => 'colleger',
        'submission_m' => 'submission',
        'schedule_m' => 'schedule',
    ]);
  }

  public function index()
  {
    $user = $this->app->user();
    $data['title'] = "Dashboard";
    $data['study'] = $this->study->get_data(['deleted_date' => NULL]);
    $data['classroom'] = $this->classroom->get_data(['deleted_date' => NULL]);
    $data['lecturer'] = $this->lecturer->get_data(['deleted_date' => NULL]);
    $data['colleger'] = $this->colleger->get_data(['deleted_date' => NULL]);
    $data['submissions'] = $this->submission->get_data_dashboard(
      ['submission.deleted_date' => NULL],
      [
        'colleger' => 'colleger.id = submission.colleger_id',
        'study_program AS study' => 'study.id = colleger.study_program_id',
      ],
      'submission.*, 
      colleger.nim AS colleger_nim,  
      colleger.name AS colleger_name, 
      study.name AS study_program_name'
    )->result();
    $data['schedules'] = $this->schedule->get_data_dashboard(
      ['schedule.deleted_date' => NULL],
      [
          'submission' => 'submission.id = schedule.submission_id',
          'colleger' => 'colleger.id = submission.colleger_id',
          'study_program AS study' => 'study.id = colleger.study_program_id',
      ],
      'schedule.*, 
      colleger.nim AS colleger_nim,  
      colleger.name AS colleger_name, 
      study.name AS study_program_name'
    )->result();

    if ($user->role === "2") {
      $data['schedule'] = $this->schedule->get_data_dashboard(
        ['submission.colleger_id' => $user->colleger_id, 'schedule.deleted_date' => NULL],
        [
            'submission' => 'submission.id = schedule.submission_id',
            'colleger' => 'colleger.id = submission.colleger_id',
            'study_program AS study' => 'study.id = colleger.study_program_id',
            'lecturer AS main_lecturer' => 'main_lecturer.id = submission.main_lecturer',
            'lecturer AS secondary_lecturer' => 'secondary_lecturer.id = submission.secondary_lecturer',
            'lecturer AS lead_tester' => 'lead_tester.id = schedule.lead_tester',
            'lecturer AS main_tester' => 'main_tester.id = schedule.main_tester',
            'lecturer AS secondary_tester' => 'secondary_tester.id = schedule.main_tester'
        ],
        'schedule.*,
        submission.title,
        colleger.nim AS colleger_nim,  
        colleger.name AS colleger_name, 
        study.name AS study_program_name,
        main_lecturer.name AS main_lecturer_name,
        secondary_lecturer.name AS secondary_lecturer_name,
        lead_tester.name AS lead_tester_name,
        main_tester.name AS main_tester_name,
        secondary_tester.name AS secondary_tester_name,
        '
      )->row();
    }
    
    $this->template->load('dashboard', $data, 'dashboard_js');
  }
}
