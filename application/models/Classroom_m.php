<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Classroom_m extends CI_Model
{
    private $table = 'classroom';

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
            class.id,
            class.name,
            class.notes,
            class.created_date,
            class.updated_date,
            user_create.name AS created_name,
            user_update.name AS updated_name,
        ')
            ->from("$this->table AS class")
            ->join('user AS user_create', 'user_create.id = class.created_by', 'left')
            ->join('user AS user_update', 'user_update.id = class.updated_by', 'left')
            ->where('class.deleted_date', null);

        if ($filter['name_filter'] != null) {
            $this->dt->like('class.name', $filter['name_filter']);
        }
        return $this->dt->generate();
    }

    function create_data($post)
    {
        $col = [
            'name' => $post['name'],
            'notes' => empty($post['notes']) ? NULL : $post['notes'],
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => $this->app->user()->id,
        ];

        $this->db->insert($this->table, $col);
    }

    function update_data($post)
    {
        $col = [
            'name' => $post['name'],
            'notes' => empty($post['notes']) ? NULL : $post['notes'],
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
