<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Submission extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();
        $this->load->model([
            'submission_m' => 'submission',
            'colleger_m' => 'colleger',
            'lecturer_m' => 'lecturer',
        ]);
    }

    function index()
    {
        $res['title'] = "Pengajuan Sidang";
        $res['collegers'] = $this->colleger->get_data(['deleted_date' => NULL]);
        $res['lectures'] = $this->lecturer->get_data(['deleted_date' => NULL]);
        $this->template->load('submission/read', $res, 'submission/read_js');
    }

    function create()
    {
        $res['title'] = "Buat Pengajuan Sidang";
        $res['collegers'] = $this->colleger->get_data(['deleted_date' => NULL]);
        $res['lectures'] = $this->lecturer->get_data(['deleted_date' => NULL]);
        $this->template->load('submission/create', $res, 'submission/create_js');
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
            'colleger' => [
                'label' => "Mahasiswa",
                'rules' => 'trim|required|callback_colleger_check'
            ],
            'lecturer' => [
                'label' => "Pembimbing",
                'rules' => 'trim|required|callback_lecturer_check'
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

    function colleger_check($colleger_id)
    {
        $post = $this->input->post();
        if ($post['submit_action'] === "create") {
            $key = ['colleger_id' => $colleger_id, 'status !=' => 2, 'delete_date' => NULL];
        } else if ($post['submit_action'] === "update") {
            $key = ['id !=' => $post['id'], 'colleger_id' => $colleger_id, 'status !=' => 2, 'delete_date' => NULL];
        }

        $isExist = $this->mod->get_data($key)->num_rows();
        if ($isExist > 0) {
            $this->form_validation->set_message('colleger_check', '{field} sudah terdaftar');
            return false;
        } else {
            return true;
        }
    }

    function lecturer_check($lecturer_id)
    {
        $post = $this->input->post();
        if ($post['submit_action'] === "create") {
            $key = ['lecturer_id' => $lecturer_id, 'colleger_id' => $post['colleger'], 'status !=' => 2, 'delete_date' => NULL];
        } else if ($post['submit_action'] === "update") {
            $key = ['id !=' => $post['id'], 'lecturer_id' => $lecturer_id, 'colleger_id' => $post['colleger'], 'status !=' => 2, 'delete_date' => NULL];
        }

        $isExist = $this->mod->get_data($key)->num_rows();
        if ($isExist > 0) {
            $this->form_validation->set_message('lecturer_check', '{field} sudah terdaftar di Mahasiswa ini');
            return false;
        } else {
            return true;
        }
    }
}
