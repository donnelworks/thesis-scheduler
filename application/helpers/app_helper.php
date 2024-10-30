<?php

if (!function_exists('log_debug'))
{
    function log_debug($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }
}

if (!function_exists('initials'))
{
    function initials($name) 
    {
        $words = explode(' ', $name);
    
        $initials = '';
        if (count($words) > 1) {
            for ($i = 0; $i < min(2, count($words)); $i++) {
                $initials .= strtoupper($words[$i][0]);
            }
        } else {
            $initials = strtoupper($words[0][0]);
            if (strlen($words[0]) > 1) {
                $initials .= strtoupper($words[0][1]);
            }
        }
    
        return $initials;
    }
}

if (!function_exists('validate_form'))
{
    function validate_form($rules)
    {
        $CI = &get_instance();
        $CI->load->library('form_validation');
    
        foreach ($rules as $field => $rule) {
            $CI->form_validation->set_rules($field, $rule['label'], $rule['rules']);
        }
    
        $CI->form_validation->set_error_delimiters('<span class="text-danger invalid-message">', '</span>');
        $CI->form_validation->set_message('required', '{field} wajib diisi');
        $CI->form_validation->set_message('valid_email', '{field} tidak valid');
		$CI->form_validation->set_message('is_natural', '{field} wajib diisi angka');
		$CI->form_validation->set_message('greater_than_equal_to', '{field} kurang dari nilai minimal');
    
        if ($CI->form_validation->run()) {
            return ['status' => true, 'error' => []];
        } else {
            $errors = [];
            foreach ($rules as $field => $rule) {
                $errors[$field] = form_error($field);
            }
            return ['status' => false, 'error' => $errors];
        }
    }
}

if (!function_exists('generate_order')) {
    function generate_order($table, $target_column, $key = null)
    {
        $CI = &get_instance();

        $CI->db->select_max($target_column)->from($table);
        if ($key !== null) {
            $CI->db->where($key);
        }
        $query = $CI->db->order_by($target_column, 'desc')->limit(1)->get();

        $order = 0;

        if ($query->num_rows() > 0) {
            $order = (float) $query->row()->num_order + 1;
        } else {
            $order = 1;
        }
        return $order;
    }
}

if (!function_exists('date_time')) {
    function date_time($value, $type, $sep, $lang = "id")
    {
        $monthId = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
        $monthEn = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $monthIdFull = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $monthEnFull = [1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $fullDate = explode(" ", $value)[0];
        $date = explode("-", $fullDate)[2];
        $month = explode("-", $fullDate)[1];
        $year = explode("-", $fullDate)[0];

        if ($type === "datetime-string-full" || $type === "datetime-string" || $type === "datetime-number" || $type === "time") {
            $fullTime = explode(" ", $value)[1];
            $hour = explode(":", $fullTime)[0];
            $minute = explode(":", $fullTime)[1];
            $second = explode(":", $fullTime)[2];
        }

        // Date Time String Full
        if ($type === "datetime-string-full") {
            return $date . $sep . ($lang === "id" ? $monthIdFull[(int)$month] : $monthEnFull[(int)$month]) . $sep . $year . " " . $fullTime;
        }
        // Date Time String
        if ($type === "datetime-string") {
            return $date . $sep . ($lang === "id" ? $monthId[(int)$month] : $monthEn[(int)$month]) . $sep . $year . " " . $fullTime;
        }
        // Date Time Number
        if ($type === "datetime-number") {
            return $date . $sep . $month . $sep . $year . " " . $fullTime;
        }
        // Date String Only Full
        if ($type === "date-string-full") {
            return $date . $sep . ($lang === "id" ? $monthIdFull[(int)$month] : $monthEnFull[(int)$month]) . $sep . $year;
        }
        // Date String Only
        if ($type === "date-string") {
            return $date . $sep . ($lang === "id" ? $monthId[(int)$month] : $monthEn[(int)$month]) . $sep . $year;
        }
        // Date Number Only
        if ($type === "date-number") {
            return $date . $sep . $month . $sep . $year;
        }
        // Time Only
        if ($type === "time") {
            return $fullTime;
        }
    }
}
