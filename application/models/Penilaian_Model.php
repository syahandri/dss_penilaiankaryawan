<?php

class Penilaian_Model extends CI_Model {
      //variabel untuk keperluan pagination jquery datatable
    var $column_order  = [null, 'tgl_penilaian', 'nip', 'nama_karyawan', 'nilai_aternatif_MPE', null];
    var $column_search = ['nip', 'nama_karyawan', 'nilai_aternatif_MPE'];
    var $order         = ['nilai_aternatif_MPE' => 'desc'];

      // PAGINATION USING JQUERY DATA TABLES
      private function _get_datatables_query () {
        $this->db->from('nilai_alternatifMPE');
        
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->input->post('search')['value']) {
                if ($i == 0) {
                    $this->db->group_start();
                    $this->db->like($item, $this->input->post('search')['value']);
                } else {
                    $this->db->or_like($item, $this->input->post('search')['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }

            $i++;
        }

        if ($this->input->post('order')) {
            $this->db->order_by($this->column_order[$this->input->post('order')[0]['column']], $this->input->post('order')[0]['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function getDataTables () {
        $this->_get_datatables_query();
        if ($this->input->post('length') != 1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            return $this->db->get()->result();
        }
    }

    public function countFiltered () {
        $this->_get_datatables_query();
        return $this->db->get()->num_rows();
    }

    public function countAll () {
        $this->db->from('nilai_alternatifMPE');
        return $this->db->count_all_results();
    }

    public function getNip () {
        $this->db->select("nip, nama_karyawan, concat(nip, ' - ', nama_karyawan) AS nip_nama");
        return $this->db->get('tblkaryawan')->result_array();
    }

    public function getKriteria () {
        $this->db->select("kode_kriteria, concat(kode_kriteria, ' - ', kriteria) AS kriteria");
        return $this->db->get('tblkriteria')->result_array();
    }

    public function getSubKriteria () {
         $this->db->select("kode_subkriteria, concat(kode_subkriteria, ' - ', subkriteria) AS subkriteria");
        return $this->db->get('tblsubkriteria')->result_array();
    }
}

?>