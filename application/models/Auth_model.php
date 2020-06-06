<?php

class Auth_model extends CI_Model
{
    public function getLoginByNip($nip)
    {
        $this->db->where('nip', $nip);
        $result = $this->db->get('tbladmin');
        return $result;
    
    }

    public function getLoginByPass($password)
    {
        $this->db->where('pass', $password);
        $result = $this->db->get('tbladmin')->row_array();
        return $result;
    
    }
}
