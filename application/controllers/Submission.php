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
        $res['submission_exist'] = $this->submission->get_data(['colleger_id' => $this->app->user()->colleger_id, 'status !=' => 3, 'deleted_date' => NULL]);
        $this->template->load('submission/read', $res, 'submission/read_js');
    }

    function create()
    {
        $submission_exist = $this->submission->get_data(['colleger_id' => $this->app->user()->colleger_id, 'status !=' => 3, 'deleted_date' => NULL]);

        if ($submission_exist->num_rows() === 0) {
            $res['title'] = "Buat Pengajuan Sidang";
            $res['lectures'] = $this->lecturer->get_data(['deleted_date' => NULL]);
            $this->template->load('submission/create', $res, 'submission/create_js');
        } else {
            redirect('submission');
        }
    }

    function detail($id)
    {
        
        $res['title'] = "Detail Pengajuan Sidang";
        $res['data'] = $this->submission->get_data(
            ['submission.id' => $id, 'submission.colleger_id' => $this->app->user()->colleger_id, 'submission.deleted_date' => NULL],
            ['lecturer AS main_lecturer' => 'main_lecturer.id = submission.main_lecturer', 'lecturer AS secondary_lecturer' => 'secondary_lecturer.id = submission.secondary_lecturer'],
            'submission.*, main_lecturer.name AS main_lecturer_name, secondary_lecturer.name AS secondary_lecturer_name'
        )->row();
        $this->template->load('submission/detail', $res, 'submission/detail_js');
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
        $res = ['success' => true, 'status_message' => "SUCCESS", 'data' => null];

        $submission_exist = $this->submission->get_data(['colleger_id' => $this->app->user()->colleger_id, 'status !=' => 3, 'deleted_date' => NULL]);
        if ($submission_exist->num_rows() > 0) {
            $res = [
                'success' => false, 
                'status_message' => "ERROR_SUBMISSION_IS_EXIST", 
                'data' => "Tidak dapat buat pengajuan, masih terdapat pengajuan aktif"
            ];
            echo json_encode($res);
            return;
        }

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
            $uploads = [
                'submission_form' => 'pdf',
                'ktm' => 'pdf|jpg|jpeg|png',
                'ktp' => 'pdf|jpg|jpeg|png',
                'krs' => 'pdf|jpg|jpeg|png',
                'ta_guide_book' => 'pdf',
                'temp_transcripts' => 'pdf',
                'comprehensive_exam_ba' => 'pdf',
                'seminar_result_ba' => 'pdf|jpg|jpeg|png',
                'pbak_certificate' => 'pdf|jpg|jpeg|png',
                'toefl_certificate' => 'pdf',
                'toafl_certificate' => 'pdf',
                'proof_of_memorization' => 'pdf',
                'it_certificate' => 'pdf',
                'kukerta_certificate' => 'pdf',
                'free_lab' => 'pdf',
                'turnitin' => 'pdf',
                'draft_ta' => 'pdf',
                'loa_thesis' => 'pdf',
                'loa_non_thesis' => 'pdf',
            ];

            foreach ($uploads as $field => $allowed_types) {
                if (($field === 'loa_thesis' || $field === 'loa_non_thesis') && empty($_FILES[$field]['name'])) {
                    $post[$field] = NULL;
                    continue;
                }

                if (!$this->upload($field, $allowed_types)['status']) {
                    $res = ['success' => false, 'status_message' => "ERROR_UPLOAD", 'data' => ['field' => $field, 'message' => $this->upload($field, $allowed_types)['data']]];
                    echo json_encode($res);
                    return;
                }
                
                $post[$field] = $this->upload($field, $allowed_types)['data']['file_name'];
            }

            $this->submission->create_data($post);
            $res['data'] = ['message' => "Data berhasil ditambah"];
        } else {
            $res['success'] = false;
            $res['status_message'] = "FORM_VALIDATION_ERROR";
            $res['data'] = ['error' => $validate_result['error']];
        }

        echo json_encode($res);
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
        $config['max_size'] = 10000;
        $config['overwrite'] = TRUE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload($file)) {
            $result = ['status' => FALSE, 'data' => $this->upload->display_errors('<p class="invalid-upload text-danger m-0">', '</p>')];
        } else {
            $result = ['status' => TRUE, 'data' => $this->upload->data()];
        }

        return $result;
    }
}
