<?php

class Auth_model extends CI_Model
{
    public function getUser($nip)
    {
        $this->db->where('nip', $nip);
        $result = $this->db->get('tbladmin')->row();
        return $result;
    }
}
