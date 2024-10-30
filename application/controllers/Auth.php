<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['auth_m' => 'mod']);
    }

    function login()
    {
        $post = $this->input->post();
        $responses = ['success' => true, 'status_message' => "SUCCESS", 'data' => null];

        // Validation
        $rules = [
            'username' => [
                'label' => "Username",
                'rules' => 'trim|required'
            ],
            'pass' => [
                'label' => "Password",
                'rules' => 'trim|required'
            ],
        ];
        $validate_result = validate_form($rules);

        if ($validate_result['status']) {
            $user_auth = $this->mod->check_user_auth(['username' => $post['username']])->row();
            
            if ($user_auth && password_verify($post['pass'], $user_auth->pass)) {
                $this->update_session($user_auth->id);
            } else {
                $responses['success'] = false;
                $responses['status_message'] = "AUTH_ERROR";
                $responses['data'] = $this->load->view('_part/alert/error_alert', [
                    'message' => "Username / Password tidak sesuai, silakan cek kembali"
                ], TRUE);
            }
        } else {
            $responses['success'] = false;
            $responses['status_message'] = "FORM_VALIDATION_ERROR";
            $responses['data'] = $validate_result['error'];
        }

        echo json_encode($responses);
    }

    function logout()
    {
        $sessions = ['user_id'];
        $this->session->unset_userdata($sessions);
        $this->session->sess_destroy();
        redirect('login');
    }

    private function update_session($user_id)
    {
        $session_data = [
            'user_id' => $user_id,
        ];
        $this->session->set_userdata($session_data);
    }
}
