<?php

class Home_Model extends CI_Model {

    public function getHasil ($tgl_penilaian) {
        $this->db->where('tgl_penilaian', $tgl_penilaian);
        return $this->db->get('nilai_alternatifMPE')->result_array();
    }

    public function getTgl () {
        $this->db->select('tgl_penilaian');
        $this->db->group_by('tgl_penilaian');
        $this->db->order_by('tgl_penilaian', 'DESC');
        return $this->db->get('nilai_alternatifMPE')->result_array();
    }

}

?>