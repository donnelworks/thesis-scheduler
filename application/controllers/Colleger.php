<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Colleger extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();
        $this->load->model([
            'colleger_m' => 'mod',
            'study_program_m' => 'study_mod',
            'classroom_m' => 'classroom_mod',
        ]);
    }

    function index()
    {
        $res['title'] = "Mahasiswa";
        $res['studies'] = $this->study_mod->get_data(['deleted_date' => NULL]);
        $res['classes'] = $this->classroom_mod->get_data(['deleted_date' => NULL]);
        $this->template->load('colleger', $res, 'colleger_js');
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
            'nim' => [
                'label' => "NIM",
                'rules' => 'trim|required|callback_nim_check'
            ],
            'name' => [
                'label' => "Nama",
                'rules' => 'trim|required'
            ],
            'study_program' => [
                'label' => "Program Studi",
                'rules' => 'trim|required'
            ],
            'classroom' => [
                'label' => "Kelas",
                'rules' => 'trim|required'
            ],
            'phone' => [
                'label' => "No. Tlp",
                'rules' => 'trim|is_natural'
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

    function nim_check($nim)
    {
        $post = $this->input->post();
        if ($post['submit_action'] === "create") {
            $key = ['nim' => $nim, 'delete_date' => NULL];
        } else if ($post['submit_action'] === "update") {
            $key = ['id !=' => $post['id'], 'nim' => $nim, 'delete_date' => NULL];
        }

        $isExist = $this->mod->get_data($key)->num_rows();
        if ($isExist > 0) {
            $this->form_validation->set_message('nim_check', '{field} sudah dipakai');
            return false;
        } else {
            return true;
        }
    }
}
