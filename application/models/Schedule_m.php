<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule_m extends CI_Model
{
    private $table = 'schedule';

    function get_data($where = [], $join = [], $select = '*')
    {
        $this->db->select($select);
        $this->db->from("$this->table AS schedule");

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
        $this->db->from("$this->table AS schedule");

        if (!empty($join)) {
            foreach ($join as $table => $condition) {
                $this->db->join($table, $condition, 'left');
            }
        }

        if (!empty($where)) {
            $this->db->where($where);
        }
        
        $this->db->limit(5);
        $this->db->order_by('schedule.created_date', 'asc');
        $query = $this->db->get();
        return $query;
    }

    function load_table($filter)
    {
        $this->dt->select('
            schedule.*,
            colleger.nim AS colleger_nim,
            colleger.name AS colleger_name,
            study.name AS study_program_name,
            lead_tester.name AS lead_tester_name,
            main_tester.name AS main_tester_name,
            secondary_tester.name AS secondary_tester_name,
            user_create.name AS created_name,
            user_update.name AS updated_name,
        ')
            ->from("$this->table AS schedule")
            ->join('submission', 'submission.id = schedule.submission_id', 'left')
            ->join('colleger', 'colleger.id = submission.colleger_id', 'left')
            ->join('study_program AS study', 'study.id = colleger.study_program_id', 'left')
            ->join('lecturer AS lead_tester', 'lead_tester.id = schedule.lead_tester', 'left')
            ->join('lecturer AS main_tester', 'main_tester.id = schedule.main_tester', 'left')
            ->join('lecturer AS secondary_tester', 'secondary_tester.id = schedule.main_tester', 'left')
            ->join('user AS user_create', 'user_create.id = submission.created_by', 'left')
            ->join('user AS user_update', 'user_update.id = submission.updated_by', 'left')
            ->where('schedule.deleted_date', NULL);

        if ($filter['number_filter'] != NULL) {
            $this->dt->like('schedule.number', $filter['number_filter']);
        }
        if ($filter['submission_filter'] != NULL) {
            $this->dt->where('schedule.submission_id', $filter['submission_filter']);
        }
        if ($filter['periode_filter'] != NULL) {
            $periode = explode(" s/d ", $filter['periode_filter']);
            $this->dt->where('schedule.date >=', date('Y-m-d', strtotime($periode[0])))->where('schedule.date <=', date('Y-m-d', strtotime($periode[1])));
        }
        return $this->dt->generate();
    }

    function load_table_dashboard($filter)
    {
        $this->dt->select('
            schedule.*,
            colleger.nim AS colleger_nim,
            colleger.name AS colleger_name,
            study.name AS study_program_name,
            lead_tester.name AS lead_tester_name,
            main_tester.name AS main_tester_name,
            secondary_tester.name AS secondary_tester_name,
            user_create.name AS created_name,
            user_update.name AS updated_name,
        ')
            ->from("$this->table AS schedule")
            ->join('submission', 'submission.id = schedule.submission_id', 'left')
            ->join('colleger', 'colleger.id = submission.colleger_id', 'left')
            ->join('study_program AS study', 'study.id = colleger.study_program_id', 'left')
            ->join('lecturer AS lead_tester', 'lead_tester.id = schedule.lead_tester', 'left')
            ->join('lecturer AS main_tester', 'main_tester.id = schedule.main_tester', 'left')
            ->join('lecturer AS secondary_tester', 'secondary_tester.id = schedule.main_tester', 'left')
            ->join('user AS user_create', 'user_create.id = submission.created_by', 'left')
            ->join('user AS user_update', 'user_update.id = submission.updated_by', 'left')
            ->where('schedule.deleted_date', NULL);

        if ($filter['nim_filter'] != NULL) {
            $this->dt->like('colleger.nim', $filter['nim_filter']);
        }
        if ($filter['name_filter'] != NULL) {
            $this->dt->like('colleger.name', $filter['name_filter']);
        }
        if ($filter['periode_filter'] != NULL) {
            $periode = explode(" s/d ", $filter['periode_filter']);
            $this->dt->where('schedule.date >=', date('Y-m-d', strtotime($periode[0])))->where('schedule.date <=', date('Y-m-d', strtotime($periode[1])));
        }
        return $this->dt->generate();
    }

    function create_data($post)
    {
        $col = [
            'date' => date('Y-m-d', strtotime($post['date'])),
            'start_time' => $post['start_time'],
            'end_time' => $post['end_time'],
            'number' => $post['number'],
            'submission_id' => $post['submission'],
            'lead_tester' => $post['lead_tester'],
            'main_tester' => $post['main_tester'],
            'secondary_tester' => $post['secondary_tester'],
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => $this->app->user()->id,
        ];
        
        $this->db->insert($this->table, $col);
    }

    function update_data($post)
    {
        $col = [
            'date' => date('Y-m-d', strtotime($post['date'])),
            'start_time' => $post['start_time'],
            'end_time' => $post['end_time'],
            'number' => $post['number'],
            'submission_id' => $post['submission'],
            'lead_tester' => $post['lead_tester'],
            'main_tester' => $post['main_tester'],
            'secondary_tester' => $post['secondary_tester'],
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
