<?php

class Hasil_penilaian_Model extends CI_Model {


    // variabel untuk keperluan pagination jquery datatable
    var $column_order  = [null, 'tgl_penilaian', 'nip', 'nama_karyawan', 'nilai_alternatif_MPE'];
    var $column_search = ['tgl_penilaian', 'nip', 'nama_karyawan', 'nilai_alternatif_MPE'];
    var $order = ['tgl_penilaian' => 'desc']; // order 1st
    var $order_second = ['nilai_alternatif_MPE' => 'desc']; // order 2nd

      // PAGINATION USING JQUERY DATA TABLES
      private function _get_datatables_query () {
        $this->db->from('nilai_alternatifmpe');
        
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
        } else if (isset($this->order) && isset($this->order_second)) {
            $order = $this->order;
            $order_second = $this->order_second;
            $this->db->order_by(key($order), $order[key($order)]);
            $this->db->order_by(key($order_second), $order_second[key($order_second)]);
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
        $this->db->from('nilai_alternatifmpe');
        return $this->db->count_all_results();
    }
}

?>