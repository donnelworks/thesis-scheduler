<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lecturer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();
        $this->load->model([
            'lecturer_m' => 'mod',
            'study_program_m' => 'study_mod',
        ]);
    }

    function index()
    {
        $res['title'] = "Dosen";
        $res['studies'] = $this->study_mod->get_data(['deleted_date' => NULL]);
        $this->template->load('lecturer', $res, 'lecturer_js');
    }

    function load_table()
    {
        $filter = $this->input->post();
        header('Content-Type: application/json');
        $res = $this->mod->load_table($filter);
        echo $res;
    }

    function submit_data()
    {
        $post = $this->input->post();
        $responses = ['success' => true, 'status_message' => "SUCCESS", 'data' => null];

        // Validation
        $rules = [
            'nidn' => [
                'label' => "NIDN",
                'rules' => 'trim|required|callback_nidn_check'
            ],
            'name' => [
                'label' => "Nama",
                'rules' => 'trim|required'
            ],
            'study_program' => [
                'label' => "Program Studi",
                'rules' => 'trim|required'
            ],
            'job_position' => [
                'label' => "Jabatan",
                'rules' => 'trim|required'
            ],
        ];
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

    function nidn_check($nidn)
    {
        $post = $this->input->post();
        if ($post['submit_action'] === "create") {
            $key = ['nidn' => $nidn, 'deleted_date' => NULL];
        } else if ($post['submit_action'] === "update") {
            $key = ['id !=' => $post['id'], 'nidn' => $nidn, 'deleted_date' => NULL];
        }

        $isExist = $this->mod->get_data($key)->num_rows();
        if ($isExist > 0) {
            $this->form_validation->set_message('nidn_check', '{field} sudah dipakai');
            return false;
        } else {
            return true;
        }
    }
}
