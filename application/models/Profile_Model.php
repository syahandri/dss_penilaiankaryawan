<?php

class Profile_Model extends CI_Model {

    public function getProfileById ($id) {
        $this->db->from('tbladmin');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }
}

?>