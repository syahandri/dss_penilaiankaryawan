<?php

class Auth_model extends CI_Model
{

    public function getUser($nip)
    {
        $this->db->where('nip', $nip);
        $result = $this->db->get('tbladmin')->row();
        return $result;

        // $query = $this->db->query("SELECT * FROM tbladmin WHERE nip='$nip' AND pass=MD5('$password') LIMIT 1");
        // return $query;
    }
}
