<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_m extends CI_Model
{
    private $table = 'user';

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
        $user_id = $this->app->user()->id;
        $this->dt->select('
            user.id,
            user.username,
            user.name AS user_name,
            user.role,
            user.colleger_id,
            user.created_date,
            user.updated_date,
            user_create.name AS created_name,
            user_update.name AS updated_name,
        ')
            ->from("$this->table AS user")
            ->join('user AS user_create', 'user_create.id = user.created_by', 'left')
            ->join('user AS user_update', 'user_update.id = user.updated_by', 'left')
            ->where('user.id !=', $user_id)
            ->where('user.deleted_date', NULL);

        if ($filter['role_filter'] != NULL) {
            $this->dt->where('user.role', $filter['role_filter']);
        }
        if ($filter['name_filter'] != NULL) {
            $this->dt->like('user.username', $filter['name_filter'])
                ->or_like('user.name', $filter['name_filter']);
        }
        return $this->dt->generate();
    }

    function create_data($post)
    {
        $col = [
            'username' => $post['username'],
            'pass' => password_hash($post['pass'], PASSWORD_DEFAULT),
            'name' => $post['name'],
            'role' => $post['role'],
            'colleger_id' => empty($post['colleger']) ? NULL : $post['colleger'],
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => $this->app->user()->id,
        ];
        $this->db->insert($this->table, $col);
    }
    
    function update_data($post)
    {
        $col = [
            'username' => $post['username'],
            'name' => $post['name'],
            'role' => $post['role'],
            'colleger_id' => empty($post['colleger']) ? NULL : $post['colleger'],
            'updated_date' => date('Y-m-d H:i:s'),
            'updated_by' => $this->app->user()->id,
        ];
        if (!empty($post['pass'])) {
            $col['pass'] = password_hash($post['pass'], PASSWORD_DEFAULT);
        }
        $this->db->where('id', $post['id'])->update($this->table, $col);
    }

    function delete_data($key)
    {
        $col['deleted_date'] = date('Y-m-d H:i:s');
        $this->db->where($key)->update($this->table, $col);
    }
}
