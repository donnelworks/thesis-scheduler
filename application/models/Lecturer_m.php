<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lecturer_m extends CI_Model
{
    private $table = 'lecturer';

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
            lecturer.id,
            lecturer.nidn,
            lecturer.nip,
            lecturer.name,
            lecturer.address,
            lecturer.study_program_id,
            lecturer.job_position,
            lecturer.created_date,
            lecturer.updated_date,
            study.name AS study_program_name,
            user_create.name AS created_name,
            user_update.name AS updated_name,
        ')
            ->from("$this->table AS lecturer")
            ->join('study_program AS study', 'study.id = lecturer.study_program_id', 'left')
            ->join('user AS user_create', 'user_create.id = lecturer.created_by', 'left')
            ->join('user AS user_update', 'user_update.id = lecturer.updated_by', 'left')
            ->where('lecturer.deleted_date', null);

        if ($filter['nidn_filter'] != null) {
            $this->dt->like('lecturer.nidn', $filter['nidn_filter']);
        }
        if ($filter['name_filter'] != null) {
            $this->dt->like('lecturer.name', $filter['name_filter']);
        }
        if ($filter['study_filter'] != null) {
            $this->dt->where('lecturer.study_program_id', $filter['study_filter']);
        }
        return $this->dt->generate();
    }

    function create_data($post)
    {
        $col = [
            'nidn' => $post['nidn'],
            'nip' => empty($post['nip']) ? NULL : $post['nip'],
            'name' => $post['name'],
            'address' => empty($post['address']) ? NULL : $post['address'],
            'study_program_id' => $post['study_program'],
            'job_position' => $post['job_position'],
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => $this->app->user()->id,
        ];

        $this->db->insert($this->table, $col);
    }

    function update_data($post)
    {
        $col = [
            'nidn' => $post['nidn'],
            'nip' => empty($post['nip']) ? NULL : $post['nip'],
            'name' => $post['name'],
            'address' => empty($post['address']) ? NULL : $post['address'],
            'study_program_id' => $post['study_program'],
            'job_position' => $post['job_position'],
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
