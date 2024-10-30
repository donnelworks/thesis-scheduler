<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Auth extends REST_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model([
            'auth_m' => 'mod',
            'team/member_m' => 'mod_member',
            'team/team_m' => 'mod_team',
            'other/config_m' => 'mod_config',
        ]);
    }

    public function login_post()
    {
        $post = $this->post();
        $response = ['success' => TRUE, 'status_message' => 'SUCCESS', 'data' => null];

        // Validation
        $rules = [
            'username' => [
                'label' => "Username",
                'rules' => 'required'
            ],
            'password' => [
                'label' => "Password",
                'rules' => 'required'
            ],
        ];
        $validate_result = $this->validate_form($rules, $post);

        $app_version = $this->mod_config->get_app_version(['selected' => 1])->row();
        if ($app_version->string_version !== $post['app_version']) {
            $response['success'] = false;
            $response['status_message'] = "UPDATE_APP_VERSION";
            return $this->response($response, REST_Controller::HTTP_BAD_REQUEST); 
        }

        if ($validate_result) {
            $response['success'] = false;
            $response['status_message'] = "FORM_VALIDATION_ERROR";
            $response['data'] = $validate_result;
            return $this->response($response, REST_Controller::HTTP_BAD_REQUEST); 
        }

        $user = $this->mod->check_user(['username' => $post['username'], 'role_id' => 2])->row();
        
        if ($user && password_verify($post['password'], $user->pass)) {
            $member = $this->mod_member->get_data(['user_id' => $user->id])->row();

            if (!$member) {
                $response['success'] = false;
                $response['status_message'] = "USER_IS_NOT_MEMBER";
                $response['data'] = "Pengguna belum terdaftar sebagai anggota";
                return $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
            }

            $token = $this->update_token($user->id);
            $this->mod->update_last_login($user->id);

            $team = $this->mod_team->get_full_data(['team.id' => $member->team_id])->row();
            $response['data'] = [
                'id' => $user->id,
                'name' => $user->name,
                'team_name' => $team->team_name, 
                'unit_name' => $team->unit_name, 
                'unit_short_name' => $team->short_name, 
                'token' => $token,
            ];
            return $this->set_response($response, REST_Controller::HTTP_OK); 
        } else {
            $response['success'] = false;
            $response['status_message'] = "AUTH_ERROR";
            $response['data'] = "Username / Password tidak sesuai, silakan cek kembali";
            return $this->response($response, REST_Controller::HTTP_BAD_REQUEST); 
        }
    }

    function session_check_post()
    {
        $post = $this->post();
        $token = $this->input->get_request_header('Authorization');
        $response = ['success' => TRUE, 'status_message' => 'SUCCESS', 'data' => null];

        $app_version = $this->mod_config->get_app_version(['selected' => 1])->row();
        if ($app_version->string_version !== $post['app_version']) {
            $response['success'] = false;
            $response['status_message'] = "UPDATE_APP_VERSION";
            return $this->response($response, REST_Controller::HTTP_BAD_REQUEST); 
        }

        if (!$post['id'] || !$token) {
            $response['success'] = false;
            $response['status_message'] = "SESSION_ERROR";
            $response['data'] = "Sesi telah berakhir";
            return $this->response($response, REST_Controller::HTTP_BAD_REQUEST); 
        }

        return $this->set_response($response, REST_Controller::HTTP_OK);
    }

    function logout_post()
    {
        $post = $this->post();
        $response = ['success' => TRUE, 'status_message' => 'SUCCESS', 'data' => null];
        
        $this->mod->update_token(['id' => $post['id']], null);
        return $this->set_response($response, REST_Controller::HTTP_OK); 
    }

    private function validate_form($rules, $post)
    {
        $errors = [];
        foreach ($rules as $field => $rule) {
            $label = $rule['label'];
            $rules_array = explode("|", $rule['rules']);

            // Required
            if (in_array('required', $rules_array)) {
                if (empty($post[$field])) {
                    $errors[$field] = $label." wajib diisi";
                }
            }
        }

        return $errors;
    }

    private function update_token($user_id)
    {
        $token = generate_token(16);
        $this->mod->update_token(['id' => $user_id, 'role_id' => 2, 'deleted' => null], $token);

        $session_data = [
            'token' => $token,
        ];
        $this->session->set_userdata($session_data);
        return $token;
    }
}
