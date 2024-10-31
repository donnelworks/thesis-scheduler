<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Submission_m extends CI_Model
{
    private $table = 'submission';

    function get_data($where = [], $join = [], $select = '*')
    {
        $this->db->select($select);
        $this->db->from($this->table);

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

    function load_table($filter)
    {
        $this->dt->select('
            submission.id,
            submission.colleger_id,
            submission.title,
            submission.status,
            submission.created_date,
            submission.updated_date,
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
            ->join('user AS user_create', 'user_create.id = colleger.created_by', 'left')
            ->join('user AS user_update', 'user_update.id = colleger.updated_by', 'left')
            ->where('submission.deleted_date', NULL);

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
            'date' => $post['date'],
            'time' => $post['time'],
            'colleger_id' => $post['colleger'],
            'type' => $post['type'],
            'title' => empty($post['title']) ? NULL : $post['title'],
            'lecturer_id' => $post['lecturer'],
            'status' => $post['status'],
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => $this->app->user()->id,
        ];
        
        $this->db->insert($this->table, $col);
    }
    
    function update_data($post)
    {
        $col = [
            'date' => $post['date'],
            'time' => $post['time'],
            'colleger_id' => $post['colleger'],
            'type' => $post['type'],
            'title' => empty($post['title']) ? NULL : $post['title'],
            'lecturer_id' => $post['lecturer'],
            'status' => $post['status'],
            'updated_date' => date('Y-m-d H:i:s'),
            'updated_by' => $this->app->user()->id,
        ];

        $this->db->where('id', $post['id'])
        ->update($this->table, $col);
    }

    function delete_data($key)
    {
        $col['deleted_date'] = date('Y-m-d H:i:s');
        $this->db->where($key)->update($this->table, $col);
    }
}
