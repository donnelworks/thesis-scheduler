<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Colleger_m extends CI_Model
{
    private $table = 'colleger';

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
            colleger.id,
            colleger.nim,
            colleger.name,
            colleger.address,
            colleger.phone,
            colleger.study_program_id,
            colleger.classroom_id,
            colleger.created_date,
            colleger.updated_date,
            study.name AS study_program_name,
            class.name AS classroom_name,
            user_create.name AS created_name,
            user_update.name AS updated_name,
        ')
            ->from("$this->table AS colleger")
            ->join('study_program AS study', 'study.id = colleger.study_program_id', 'left')
            ->join('classroom AS class', 'class.id = colleger.classroom_id', 'left')
            ->join('user AS user_create', 'user_create.id = colleger.created_by', 'left')
            ->join('user AS user_update', 'user_update.id = colleger.updated_by', 'left')
            ->where('colleger.deleted_date', null);

        if ($filter['nim_filter'] != null) {
            $this->dt->like('colleger.nim', $filter['nim_filter']);
        }
        if ($filter['name_filter'] != null) {
            $this->dt->like('colleger.name', $filter['name_filter']);
        }
        if ($filter['study_filter'] != null) {
            $this->dt->where('colleger.study_program_id', $filter['study_filter']);
        }
        if ($filter['classroom_filter'] != null) {
            $this->dt->where('colleger.classroom_id', $filter['classroom_filter']);
        }
        return $this->dt->generate();
    }

    function create_data($post)
    {
        $col = [
            'nim' => $post['nim'],
            'name' => $post['name'],
            'address' => empty($post['address']) ? NULL : $post['address'],
            'phone' => empty($post['phone']) ? NULL : $post['phone'],
            'study_program_id' => $post['study_program'],
            'classroom_id' => $post['classroom'],
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => $this->app->user()->id,
        ];

        $this->db->insert($this->table, $col);
    }

    function update_data($post)
    {
        $col = [
            'nim' => $post['nim'],
            'name' => $post['name'],
            'address' => empty($post['address']) ? NULL : $post['address'],
            'phone' => empty($post['phone']) ? NULL : $post['phone'],
            'study_program_id' => $post['study_program'],
            'classroom_id' => $post['classroom'],
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
