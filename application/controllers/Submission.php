<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Submission extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();
        $this->load->library('upload');
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
        $this->template->load('submission/read', $res, 'submission/read_js');
    }

    function create()
    {
        $res['title'] = "Buat Pengajuan Sidang";
        $res['lectures'] = $this->lecturer->get_data(['deleted_date' => NULL]);
        $this->template->load('submission/create', $res, 'submission/create_js');
    }

    function load_table()
    {
        $filter = $this->input->post();
        header('Content-Type: application/json');
        $res = $this->submission->load_table($filter);
        echo $res;
    }

    function submit_data()
    {
        $post = $this->input->post();
        $responses = ['success' => true, 'status_message' => "SUCCESS", 'data' => null];

        $submission_form = $this->upload('submission_form', 'pdf');
        $ktm = $this->upload('ktm', 'pdf|jpg|jpeg|png');

        log_debug($submission_form['data']);
        log_debug($ktm['data']);
        die;

        // Validation
        $rules = [
            'title' => [
                'label' => "Judul",
                'rules' => 'trim|required'
            ],
            'main_lecturer' => [
                'label' => "Pembimbing Utama",
                'rules' => 'trim|required'
            ],
            'secondary_lecturer' => [
                'label' => "Pembimbing Pendamping",
                'rules' => 'trim|required'
            ],
            'phone' => [
                'label' => "No. Tlp.",
                'rules' => 'trim|required|is_natural'
            ],
        ];
        $validate_result = validate_form($rules);

        if ($validate_result['status']) {
            if ($post['submit_action'] === "create") {
                $this->submission->create_data($post);
                $responses['data'] = ['message' => "Data berhasil ditambah"];
            } else if ($post['submit_action'] === "update") {
                $this->submission->update_data($post);
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

        $this->submission->delete_data(['id' => $post['delete_key']]);
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

        $isExist = $this->submission->get_data($key)->num_rows();
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

        $isExist = $this->submission->get_data($key)->num_rows();
        if ($isExist > 0) {
            $this->form_validation->set_message('lecturer_check', '{field} sudah terdaftar di Mahasiswa ini');
            return false;
        } else {
            return true;
        }
    }

    function upload($file, $allowed_types)
    {
        $result = NULL;

        $config['upload_path'] = './assets/files/submissions/';
        $config['file_name'] = $this->app->user()->nim . "-" . $file;
        $config['allowed_types'] = $allowed_types;
        $config['max_size'] = 5000;
        $config['overwrite'] = TRUE;

        $this->upload->initialize($config);
        $this->upload->set_message('upload_invalid_filetype', 'Tipe file tidak diizinkan, silakan unggah file PDF');
        $this->upload->set_message('upload_file_exceeds_limit', "Ukuran file melebihi batas maksimal 5MB");

        if (!$this->upload->do_upload($file)) {
            $result = ['status' => FALSE, 'data' => $this->upload->display_errors()];
        } else {
            $result = ['status' => TRUE, 'data' => $this->upload->data()];
        }

        return $result;
    }
}
