<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_m extends CI_Model
{
    private $table = 'user';

    function get_data($conditions = [], $join = [])
    {
        $this->db->from($this->table);
        if (!empty($join)) {
            foreach ($join as $table => $condition) {
                $this->db->join($table, $condition, 'left');
            }
        }
        if (!empty($conditions)) {
            $this->db->where($conditions);
        }
        $query = $this->db->get();
        return $query;
    }

    function check_user_auth($req)
    {
        $sql = "SELECT id, pass FROM $this->table WHERE BINARY username = ? AND deleted_date IS NULL";
        $query = $this->db->query($sql, [
            htmlspecialchars($req['username'], ENT_QUOTES, 'UTF-8'),
        ]);
        return $query;
    }
}
