<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();
        $this->load->library('upload');
        $this->load->model([
            'schedule_m' => 'schedule',
            'lecturer_m' => 'lecturer',
            'submission_m' => 'submission',
        ]);
    }

    function index()
    {
        $res['title'] = "Jadwal Sidang";
        $res['lectures'] = $this->lecturer->get_data(['deleted_date' => NULL]);
        $res['submissions'] = $this->submission->get_data(
            ['submission.status' => 1, 'submission.deleted_date' => NULL],
            ['colleger' => 'colleger.id = submission.colleger_id'],
            'submission.id, colleger.nim, colleger.name'
        );
        $this->template->load('schedule', $res, 'schedule_js');
    }

    function load_table()
    {
        $filter = $this->input->post();
        header('Content-Type: application/json');
        $res = $this->schedule->load_table($filter);
        echo $res;
    }

    function submit_data()
    {
        $post = $this->input->post();
        $res = ['success' => true, 'status_message' => "SUCCESS", 'data' => null];

        // Validation
        $rules = [
            'number' => [
                'label' => "Nomor Surat",
                'rules' => 'trim|required'
            ],
            'date' => [
                'label' => "Tanggal",
                'rules' => 'trim|required'
            ],
            'start_time' => [
                'label' => "Jam Mulai",
                'rules' => 'trim|required'
            ],
            'end_time' => [
                'label' => "Jam Selesai",
                'rules' => 'trim|required'
            ],
            'submission' => [
                'label' => "Pengajuan Sidang",
                'rules' => 'trim|required|callback_submission_check'
            ],
            'lead_tester' => [
                'label' => "Ketua Penguji",
                'rules' => 'trim|required'
            ],
            'main_tester' => [
                'label' => "Penguji Utama",
                'rules' => 'trim|required'
            ],
            'secondary_tester' => [
                'label' => "Penguji Pendamping",
                'rules' => 'trim|required|callback_submission_check'
            ],
        ];
        $validate_result = validate_form($rules);

        if ($validate_result['status']) {
            if ($post['submit_action'] === "create") {
                $this->schedule->create_data($post);
                $res['data'] = ['message' => "Data berhasil ditambah"];
            } else if ($post['submit_action'] === "update") {
                $this->schedule->update_data($post);
                $res['data'] = ['message' => "Data berhasil diubah"];
            }
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

        $this->schedule->delete_data(['id' => $post['delete_key']]);
        $res['data'] = ['message' => "Data berhasil dihapus"];
        echo json_encode($res);
    }

    function print()
    {
        $get = $this->input->get();
        $res['data'] = $this->schedule->get_data(
            ['schedule.id' => $get['id'], 'schedule.deleted_date' => NULL],
            [
                'submission' => 'submission.id = schedule.submission_id',
                'lecturer AS lead_tester' => 'lead_tester.id = schedule.lead_tester',
                'lecturer AS main_tester' => 'main_tester.id = schedule.main_tester',
                'lecturer AS secondary_tester' => 'secondary_tester.id = schedule.main_tester',
                'lecturer AS main_lecturer' => 'main_lecturer.id = submission.main_lecturer',
                'lecturer AS secondary_lecturer' => 'secondary_lecturer.id = submission.secondary_lecturer',
                'colleger' => 'colleger.id = submission.colleger_id',
                'study_program AS study' => 'study.id = colleger.study_program_id',
            ],
            'schedule.*, 
            main_lecturer.name AS main_lecturer_name, 
            secondary_lecturer.name AS secondary_lecturer_name, 
            lead_tester.name AS lead_tester_name, 
            main_tester.name AS main_tester_name, 
            secondary_tester.name AS secondary_tester_name, 
            submission.title,
            colleger.nim, 
            colleger.name AS colleger_name, 
            study.name AS study_program_name'
        )->row();

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);

        if ($get['type'] === "ta") {
            $title = "SURAT TUGAS SIDANG ".strtoupper($res['data']->colleger_name);
            $html_pdf = $this->load->view('pdf/ta_pdf', $res, TRUE);
        }
        
        if ($get['type'] === "ba") {
            $title = "BERITA ACARA SIDANG ".strtoupper($res['data']->colleger_name);
            $html_pdf = $this->load->view('pdf/ba_pdf', $res, TRUE);
        }

        $mpdf->SetTitle($title);
        $mpdf->SetHTMLHeader('
            <table style="width: 100%; text-align: center;">
                <tr>
                    <td valign="top" style="width: 10%;">
                        <img src="./assets/img/logo-fsains.png" style="width: 100px;" />
                    </td>
                    <th style="width: 80%">
                        KEMENTRIAN AGAMA <br>
                        UNIVERSITAS ISLAM NEGERI <br>
                        SULTAN MAULANA HASANUDDIN BANTEN <br>
                        FAKULTAS SAINS <br>
                        <span style="font-size: 7pt;">
                            JI Syech Nawawi Al Bantani Kp. Andamui Kel. Sukawana .Kce Curug Kota Serang 42171 <br>
                            Email: fsains@unibanten.ac.id
                        </span>
                    </th>
                    <td style="width: 10%"></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <hr style="margin-top: 0; height: 3px; color: #000;">
                    </td>
                </tr>
            </table>
        ');
        $mpdf->AddPage('P',
        '', '', '', '',
            15, // margin_left
            15, // margin right
            45, // margin top
            20, // margin bottom
            10, // margin header
            10); // margin footer
		$mpdf->WriteHTML($html_pdf);
		$mpdf->Output($title.'.pdf', 'I');
    }

    function submission_check($submission_id)
    {
        $post = $this->input->post();
        if ($post['submit_action'] === "create") {
            $key = ['submission_id' => $submission_id, 'deleted_date' => NULL];
        } else if ($post['submit_action'] === "update") {
            $key = ['id !=' => $post['id'], 'submission_id' => $submission_id, 'deleted_date' => NULL];
        }

        $isExist = $this->schedule->get_data($key)->num_rows();
        if ($isExist > 0) {
            $this->form_validation->set_message('submission_check', '{field} sudah terdaftar');
            return false;
        } else {
            return true;
        }
    }
}
