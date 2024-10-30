<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();
        $this->load->model([
            'user_m' => 'mod',
            'colleger_m' => 'colleger',
        ]);
    }

    function index()
    {
        $res['title'] = "Pengguna";
        $res['collegers'] = $this->colleger->get_data(['deleted_date' => NULL]);
        $this->template->load('user', $res, 'user_js');
    }

    function load_table()
    {
        $filter = $this->input->post();
        header('Content-Type: application/json');
        $res = $this->mod->load_table($filter);
        echo $res;
    }

    function get_colleger()
    {
        $post = $this->input->post();
        $res = ['success' => true, 'status_message' => "SUCCESS", 'data' => null];

        $res['data'] = $this->colleger->get_data(['id' => $post['colleger'], 'deleted_date' => NULL])->row()->name;
        echo json_encode($res);
    }

    function submit_data()
    {
        $post = $this->input->post();
        $responses = ['success' => true, 'status_message' => "SUCCESS", 'data' => null];

        // Validation
        $rules = [
            'username' => [
                'label' => "Username",
                'rules' => 'trim|required|callback_username_check'
            ],
            'name' => [
                'label' => "Nama",
                'rules' => 'trim|required'
            ],
        ];
        if ($post['role'] === "2") {
            $rules['colleger'] = [
                'label' => "Mahasiswa",
                'rules' => 'trim|required|callback_colleger_check'
            ];
        }
        if ($post['submit_action'] === "create") {
            $rules['pass'] = [
                'label' => "Password",
                'rules' => 'trim|required'
            ];
        }
        $validate_result = validate_form($rules);

        if ($validate_result['status']) {
            if ($post['submit_action'] === "create") {
                $this->mod->create_data($post);
                $responses['data'] = ['message' => "Data berhasil ditambah"];
            } else if ($post['submit_action'] === "update") {
                $this->mod->update_data($post);
                $responses['data'] = ['message' => "Data berhasil diubah"];
            }
        } else {
            $responses['success'] = false;
            $responses['status_message'] = "FORM_VALIDATION_ERROR";
            $responses['data'] = ['error' => $validate_result['error']];
        }

        echo json_encode($responses);
    }

    function delete_data()
    {
        $post = $this->input->post();
        $res = ['success' => true, 'status_message' => "SUCCESS", 'data' => null];

        $this->mod->delete_data(['id' => $post['delete_key']]);
        $res['data'] = ['message' => "Data berhasil dihapus"];
        echo json_encode($res);
    }

    function username_check($username)
    {
        $post = $this->input->post();
        if ($post['submit_action'] === "create") {
            $key = ['username' => $username, 'deleted_date' => NULL];
        } else if ($post['submit_action'] === "update") {
            $key = ['id !=' => $post['id'], 'username' => $username, 'deleted_date' => NULL];
        }

        $isExist = $this->mod->get_data($key)->num_rows();
        if ($isExist > 0) {
            $this->form_validation->set_message('username_check', '{field} sudah dipakai');
            return false;
        } else {
            return true;
        }
    }

    function colleger_check($colleger_id)
    {
        $post = $this->input->post();
        if ($post['submit_action'] === "create") {
            $key = ['colleger_id' => $colleger_id, 'deleted_date' => NULL];
        } else if ($post['submit_action'] === "update") {
            $key = ['id !=' => $post['id'], 'colleger_id' => $colleger_id, 'deleted_date' => NULL];
        }

        $isExist = $this->mod->get_data($key)->num_rows();
        if ($isExist > 0) {
            $this->form_validation->set_message('colleger_check', '{field} sudah terdaftar');
            return false;
        } else {
            return true;
        }
    }
}
