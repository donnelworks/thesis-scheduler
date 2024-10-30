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
            submission.date,
            submission.time,
            submission.type,
            submission.title,
            submission.status,
            submission.created_date,
            submission.updated_date,
            colleger.nim AS colleger_nim,
            colleger.name AS colleger_name,
            study.name AS study_program_name,
            lecturer.name AS lecturer_name,
            user_create.name AS created_name,
            user_update.name AS updated_name,
        ')
            ->from("$this->table AS submission")
            ->join('colleger', 'colleger.id = submission.colleger_id', 'left')
            ->join('study_program AS study', 'study.id = colleger.study_program_id', 'left')
            ->join('lecturer', 'lecturer.id = submission.lecturer_id', 'left')
            ->join('user AS user_create', 'user_create.id = colleger.created_by', 'left')
            ->join('user AS user_update', 'user_update.id = colleger.updated_by', 'left')
            ->where('submission.deleted_date', null);

        if ($filter['periode_filter'] != null) {
            $this->dt->where('submission.date >=', date('Y-m-d', strtotime($filter['periode_filter'])))
            ->where('submission.date <=', date('Y-m-d', strtotime($filter['periode_filter'])));
        }
        if ($filter['type_filter'] != null) {
            $this->dt->where('submission.type', $filter['type_filter']);
        }
        if ($filter['nim_filter'] != null) {
            $this->dt->like('colleger.nim', $filter['nim_filter']);
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
