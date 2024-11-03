<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Submission_m extends CI_Model
{
    private $table = 'submission';

    function get_data($where = [], $join = [], $select = '*')
    {
        $this->db->select($select);
        $this->db->from("$this->table AS submission");

        if (!empty($join)) {
            foreach ($join as $table => $condition) {
                $this->db->join($table, $condition, 'left');
            }
        }

        if (!empty($where)) {
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        return $query;
    }

    function get_data_dashboard($where = [], $join = [], $select = '*')
    {
        $this->db->select($select);
        $this->db->from("$this->table AS submission");

        if (!empty($join)) {
            foreach ($join as $table => $condition) {
                $this->db->join($table, $condition, 'left');
            }
        }

        if (!empty($where)) {
            $this->db->where($where);
        }
        
        $this->db->limit(5);
        $this->db->order_by('submission.created_date', 'asc');
        $query = $this->db->get();
        return $query;
    }

    function load_table($filter)
    {
        $user = $this->app->user();
        $this->dt->select('
            submission.id,
            submission.colleger_id,
            submission.title,
            submission.status,
            submission.created_date,
            submission.updated_date,
            submission.created_by,
            colleger.nim AS colleger_nim,
            colleger.name AS colleger_name,
            study.name AS study_program_name,
            main_lecturer.name AS main_lecturer_name,
            secondary_lecturer.name AS secondary_lecturer_name,
            user_create.name AS created_name,
            user_update.name AS updated_name,
        ')
            ->from("$this->table AS submission")
            ->join('colleger', 'colleger.id = submission.colleger_id', 'left')
            ->join('study_program AS study', 'study.id = colleger.study_program_id', 'left')
            ->join('lecturer AS main_lecturer', 'main_lecturer.id = submission.main_lecturer', 'left')
            ->join('lecturer AS secondary_lecturer', 'secondary_lecturer.id = submission.secondary_lecturer', 'left')
            ->join('user AS user_create', 'user_create.id = submission.created_by', 'left')
            ->join('user AS user_update', 'user_update.id = submission.updated_by', 'left')
            ->where('submission.deleted_date', NULL);

        if ($user->role === "2") {
            $this->dt->where('submission.created_by', $user->id);
        }
        if (isset($filter['colleger_filter'])) {
            if ($filter['colleger_filter'] != NULL) {
                $this->dt->where('submission.colleger_id', $filter['colleger_filter']);
            }
        }
        if ($filter['status_filter'] != NULL) {
            $this->dt->where('submission.status', $filter['status_filter']);
        }
        return $this->dt->generate();
    }

    function create_data($post)
    {
        $col = [
            'colleger_id' => $this->app->user()->colleger_id,
            'title' => $post['title'],
            'main_lecturer' => $post['main_lecturer'],
            'secondary_lecturer' => $post['secondary_lecturer'],
            'phone' => $post['phone'],
            'publication_journal' => empty($post['publication_journal']) ? NULL : $post['publication_journal'],
            'status' => 0,
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => $this->app->user()->id,
            'submission_form' => $post['submission_form'],
            'ktm' => $post['ktm'],
            'ktp' => $post['ktp'],
            'krs' => $post['krs'],
            'ta_guide_book' => $post['ta_guide_book'],
            'temp_transcripts' => $post['temp_transcripts'],
            'comprehensive_exam_ba' => $post['comprehensive_exam_ba'],
            'seminar_result_ba' => $post['seminar_result_ba'],
            'pbak_certificate' => $post['pbak_certificate'],
            'toefl_certificate' => $post['toefl_certificate'],
            'toafl_certificate' => $post['toafl_certificate'],
            'proof_of_memorization' => $post['proof_of_memorization'],
            'it_certificate' => $post['it_certificate'],
            'kukerta_certificate' => $post['kukerta_certificate'],
            'free_lab' => $post['free_lab'],
            'turnitin' => $post['turnitin'],
            'draft_ta' => $post['draft_ta'],
            'loa_thesis' => $post['loa_thesis'],
            'loa_non_thesis' => $post['loa_non_thesis'],
        ];
        
        $this->db->insert($this->table, $col);
    }
    
    function admin_update_data($post)
    {
        $col = [
            'status' => $post['status'],
        ];
        if (isset($post['status_notes'])) {
            $col['status_notes'] = empty($post['status_notes']) ? NULL : $post['status_notes'];
        }

        $this->db->where('id', $post['id'])
        ->update($this->table, $col);
    }
    
    function colleger_update_data($post)
    {
        $col = [
            'colleger_id' => $this->app->user()->colleger_id,
            'title' => $post['title'],
            'main_lecturer' => $post['main_lecturer'],
            'secondary_lecturer' => $post['secondary_lecturer'],
            'phone' => $post['phone'],
            'publication_journal' => empty($post['publication_journal']) ? NULL : $post['publication_journal'],
            'status' => 0,
            'updated_date' => date('Y-m-d H:i:s'),
            'updated_by' => $this->app->user()->id,
        ];
        if (isset($post['submission_form'])) {
            $col['submission_form'] = $post['submission_form'];
        }
        if (isset($post['ktm'])) {
            $col['ktm'] = $post['ktm'];
        }
        if (isset($post['ktp'])) {
            $col['ktp'] = $post['ktp'];
        }
        if (isset($post['krs'])) {
            $col['krs'] = $post['krs'];
        }
        if (isset($post['ta_guide_book'])) {
            $col['ta_guide_book'] = $post['ta_guide_book'];
        }
        if (isset($post['temp_transcripts'])) {
            $col['temp_transcripts'] = $post['temp_transcripts'];
        }
        if (isset($post['comprehensive_exam_ba'])) {
            $col['comprehensive_exam_ba'] = $post['comprehensive_exam_ba'];
        }
        if (isset($post['seminar_result_ba'])) {
            $col['seminar_result_ba'] = $post['seminar_result_ba'];
        }
        if (isset($post['pbak_certificate'])) {
            $col['pbak_certificate'] = $post['pbak_certificate'];
        }
        if (isset($post['toefl_certificate'])) {
            $col['toefl_certificate'] = $post['toefl_certificate'];
        }
        if (isset($post['toafl_certificate'])) {
            $col['toafl_certificate'] = $post['toafl_certificate'];
        }
        if (isset($post['proof_of_memorization'])) {
            $col['proof_of_memorization'] = $post['proof_of_memorization'];
        }
        if (isset($post['it_certificate'])) {
            $col['it_certificate'] = $post['it_certificate'];
        }
        if (isset($post['kukerta_certificate'])) {
            $col['kukerta_certificate'] = $post['kukerta_certificate'];
        }
        if (isset($post['free_lab'])) {
            $col['free_lab'] = $post['free_lab'];
        }
        if (isset($post['turnitin'])) {
            $col['turnitin'] = $post['turnitin'];
        }
        if (isset($post['draft_ta'])) {
            $col['draft_ta'] = $post['draft_ta'];
        }
        if (isset($post['loa_thesis'])) {
            $col['loa_thesis'] = $post['loa_thesis'];
        }
        if (isset($post['loa_non_thesis'])) {
            $col['loa_non_thesis'] = $post['loa_non_thesis'];
        }

        $this->db->where('id', $post['id'])
        ->update($this->table, $col);
    }

    function delete_data($key)
    {
        $col['deleted_date'] = date('Y-m-d H:i:s');
        $this->db->where($key)->update($this->table, $col);
    }
}
