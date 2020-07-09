<?php

class Home_Model extends CI_Model {

    public function getHasil ($tgl_penilaian) {
        $this->db->where('tgl_penilaian', $tgl_penilaian);
        $this->db->order_by('nilai_alternatif_MPE', 'DESC');
        return $this->db->get('nilai_alternatifmpe')->result_array();
    }

    public function getTgl () {
        $this->db->select('tgl_penilaian');
        $this->db->group_by('tgl_penilaian');
        $this->db->order_by('tgl_penilaian', 'DESC');
        return $this->db->get('nilai_alternatifmpe')->result_array();
    }

    public function countKaryawan () {
        return $this->db->count_all_results('tblkaryawan');
    }

    public function countKriteria () {
        return $this->db->count_all_results('tblkriteria');
    }

    public function countSub () {
        return $this->db->count_all_results('tblsubkriteria');
    }

}

?>