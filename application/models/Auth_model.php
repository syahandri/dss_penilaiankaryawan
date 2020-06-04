<?php

class Auth_model extends CI_Model
{

    public function auth_pegawai($nip, $password)
    {
        $query = $this->db->query("SELECT * FROM tbladmin WHERE nip='$nip' AND pass=MD5('$password') LIMIT 1");
        return $query;
    }
}
