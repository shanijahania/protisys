<?php

class MY_Form_validation extends CI_Form_validation {

    public function __construct() {
        parent::__construct();
    }

    public function is_unique($str, $field) {
        // echo "heloooooooooooooooooooooooooo";
        $field_ar = explode('.', $field);
        $query = $this->CI->db->get_where($field_ar[0], array($field_ar[1] => $str), 1, 0);
        if ($query->num_rows() === 0) {
            return TRUE;
        }

        return FALSE;
    }
}