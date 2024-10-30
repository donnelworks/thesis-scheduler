<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Activity extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model([
            'schedule_m' => 'mod_schedule',
            'activity_m' => 'mod_act',
            'team/member_m' => 'mod_member',
            'auth_m' => 'mod_auth',
        ]);
    }

    public function get_activity_post()
    {
        $post = $this->post();
        $token = $this->input->get_request_header('Authorization');
        $response = ['success' => TRUE, 'status_message' => 'SUCCESS', 'data' => null];

        $sessionCheck = $this->session_check($post['id'], $token);
        if (!$sessionCheck) {
            $response['success'] = false;
            $response['status_message'] = "SESSION_ERROR";
            $response['data'] = "Sesi telah berakhir";
            return $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
        }

        $member = $this->mod_member->get_data(['user_id' => $post['id']])->row();
        $activities = $this->mod_schedule->get_full_data_detail(['schdetail.team_id' => $member->team_id, 'schdetail.date' => date('Y-m-d'), 'schdetail.number !=' => null])->result();
        $response['data'] = $activities;
        return $this->set_response($response, REST_Controller::HTTP_OK);
    }

    public function get_finish_activity_post()
    {
        $post = $this->post();
        $token = $this->input->get_request_header('Authorization');
        $response = ['success' => TRUE, 'status_message' => 'SUCCESS', 'data' => null];

        $sessionCheck = $this->session_check($post['user_id'], $token);
        if (!$sessionCheck) {
            $response['success'] = false;
            $response['status_message'] = "SESSION_ERROR";
            $response['data'] = "Sesi telah berakhir";
            return $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
        }

        $act_check_in = $this->mod_act->get_data(['number_activity' => $post['number'], 'activity_id' => $post['activity_id'], 'status' => "CHECK IN"])->row();
        $act_check_out = $this->mod_act->get_data(['number_activity' => $post['number'], 'activity_id' => $post['activity_id'], 'status' => "CHECK OUT"])->row();
        $response['data'] = [
            'check_in' => $act_check_in,
            'check_out' => $act_check_out,
        ];
        return $this->set_response($response, REST_Controller::HTTP_OK);
    }

    public function activity_status_check_post()
    {
        $post = $this->post();
        $token = $this->input->get_request_header('Authorization');
        $response = ['success' => TRUE, 'status_message' => 'SUCCESS', 'data' => null];

        $sessionCheck = $this->session_check($post['user_id'], $token);
        if (!$sessionCheck) {
            $response['success'] = false;
            $response['status_message'] = "SESSION_ERROR";
            $response['data'] = "Sesi telah berakhir";
            return $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
        }

        if ($post['status_checkin'] === "0") {
            // $is_canceled = $this->mod_schedule->get_data_detail(['id' => $post['activity_id']])->row()->canceled;
            // if ($is_canceled) {
            //     $response['success'] = false;
            //     $response['status_message'] = "ACTIVITY_IS_CANCELED";
            //     $response['data'] = "Kegiatan dibatalkan";
            //     return $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
            // }

            $activity = $this->mod_schedule->get_data_detail(['team_id' => $post['team_id'], 'date' => date('Y-m-d'), 'status_checkin' => 1]);
            if ($activity->num_rows() > 0) {
                $response['success'] = false;
                $response['status_message'] = "ACTIVITY_STILL_ACTIVE";
                $response['data'] = "Tidak dapat cek kegiatan, masih ada kegiatan aktif";
                return $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        return $this->set_response($response, REST_Controller::HTTP_OK);
    }

    public function position_check_post()
    {
        $post = $this->post();
        $token = $this->input->get_request_header('Authorization');
        $response = ['success' => TRUE, 'status_message' => 'SUCCESS', 'data' => null];

        $sessionCheck = $this->session_check($post['user_id'], $token);
        if (!$sessionCheck) {
            $response['success'] = false;
            $response['status_message'] = "SESSION_ERROR";
            $response['data'] = "Sesi telah berakhir";
            return $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
        }

        $member = $this->mod_member->get_data(['user_id' => $post['user_id']])->row();
        if ($member->report_access === "0") {
            $response['success'] = false;
            $response['status_message'] = "NOT_ACCESS_MEMBER";
            $response['data'] = "Maaf Anda tidak memiliki akses";
            return $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
        }

        $finished = $this->mod_schedule->get_data_detail(['id' => $post['activity_id']])->row()->status_checkin;
        if ($finished === "2") {
            $response['success'] = false;
            $response['status_message'] = "ACTIVITY_IS_FINISHED";
            $response['data'] = "Kegiatan sudah diselesaikan";
            return $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
        }

        if ($post['status_checkin'] === "0") {
            $is_canceled = $this->mod_schedule->get_data_detail(['id' => $post['activity_id']])->row()->canceled;
            if ($is_canceled) {
                $response['success'] = false;
                $response['status_message'] = "ACTIVITY_IS_CANCELED";
                $response['data'] = "Kegiatan dibatalkan";
                return $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
            }
            
            $radius = $this->mod_schedule->get_data_detail(['id' => $post['activity_id']])->row()->radius;
            $distance = $this->mod_act->distance($post);
            if ((float) round($distance) > (float) ($radius)) {
                $response['success'] = false;
                $response['status_message'] = "POSITION_NOT_VALID";
                $response['data'] = "Tidak dapat check in, posisi belum di lokasi kegiatan";
                return $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        return $this->set_response($response, REST_Controller::HTTP_OK);
    }

    public function save_activity_post()
    {   
        $post = $this->post();
        $token = $this->input->get_request_header('Authorization');
        $response = ['success' => TRUE, 'status_message' => 'SUCCESS', 'data' => null];
        
        // $pusher = new Pusher\Pusher(
        //     '35b474ece0d9963ea9fa',
        //     '7df408fcfe4b8b2671f2',
        //     '1862548',
        //     [
        //         'cluster' => 'ap1',
        //         'useTLS' => true
        //     ]
        // );

        // $beamsClient = new \Pusher\PushNotifications\PushNotifications(array(
        //     "instanceId" => "29a1c07c-00b4-4ab7-8f8d-a8f66a994883",
        //     "secretKey" => "0789BF4965B119367E8D2AF356C09702BE0C6B15D8BB8017D4C7EE99002FF209",
        // ));

        $sessionCheck = $this->session_check($post['user_id'], $token);
        if (!$sessionCheck) {
            $response['success'] = false;
            $response['status_message'] = "SESSION_ERROR";
            $response['data'] = "Sesi telah berakhir";
            return $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
        }

        $media_name = [];
        $member = $this->mod_member->get_data(['user_id' => $post['user_id']])->row();
        foreach ($post['media'] as $media) {
            $media_name[] = $this->mod_act->upload_media($media);
        }

        $post['member_id'] = $member->id;
        $post['media'] = implode("; ", $media_name);
        $this->mod_act->save_activity($post);
        $this->mod_schedule->update_status_checkin($post);

        $response['data'] = $post['status_checkin'] === "0" ? 1 : 2;

        // $pusher->trigger('sijaga', 'update-dashboard', $response);
        // $publishResponse = $beamsClient->publishToInterests(
        //     array("sijaga-notif"),
        //     array("web" => array("notification" => array(
        //         "title" => "Kegiatan Check In",
        //         "body" => "Hello, World!",
        //         "deep_link" => "https://www.sijaga.logistikresjakbar.com",
        //     )),
        // ));
        return $this->set_response($response, REST_Controller::HTTP_CREATED);
    }

    public function map_get()
    {
        $get = $this->get();

        $res['latitude'] = $get['lat'];
        $res['longitude'] = $get['lng'];
        $this->load->view('map', $res);
    }

    private function session_check($user_id, $token)
    {
        $session_check = $this->mod_auth->get_data(['id' => $user_id, 'token' => $token, 'role_id' => 2, 'deleted' => null])->row();
        if ($session_check) {
            return true;
        } else {
            $this->mod_auth->update_token(['id' => $user_id], null);
            return false;
        }
    }
}
