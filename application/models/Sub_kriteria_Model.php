<?php

class Sub_kriteria_Model extends CI_Model {

    //variabel untuk keperluan pagination jquery datatable
    var $column_order  = [null, 'kode_subkriteria', 'kode_kriteria', 'subkriteria', 'nilai', null];
    var $column_search = ['kode_subkriteria', 'kode_kriteria', 'subkriteria', 'nilai'];
    var $order         = ['kode_subkriteria' => 'asc'];

      // PAGINATION USING JQUERY DATA TABLES
      private function _get_datatables_query () {
        $this->db->from('tblsubkriteria');
        
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
        $this->db->from('tblsubkriteria');
        return $this->db->count_all_results();
    }

    public function getSubKriteriaById ($kode_subkriteria) {
        $this->db->from('tblsubkriteria');
        $this->db->where('kode_subkriteria', $kode_subkriteria);
        return $this->db->get()->row();
    }

    public function kodeOtomatis () {
        $this->db->select_max('kode_subkriteria');
        return $this->db->get('tblsubkriteria')->row_array();
    }

    public function getKodeKriteria () {
        $this->db->select('kode_kriteria, kriteria');
        return $this->db->get('tblkriteria')->result_array();
    }

    public function tambahSubKriteria () {
        $data = [
            "kode_kriteria"    => $this->input->post('kodeKriteria', true),
            "kode_subkriteria" => $this->input->post('kodesubKriteria', true),
            "subkriteria"      => $this->input->post('subKriteria', true),
            "nilai"            => $this->input->post('nilai', true)
        ];

        return $this->db->insert('tblsubkriteria', $data);
    }

    public function ubahSubKriteria () {
        $data = [
            "kode_kriteria"    => $this->input->post('kodeKriteria', true),
            "kode_subkriteria" => $this->input->post('kodesubKriteria', true),
            "subkriteria"      => $this->input->post('subKriteria', true),
            "nilai"            => $this->input->post('nilai', true)
        ];

        $this->db->where('kode_subkriteria', $this->input->post('kodesubKriteria', true));
        $this->db->update('tblsubkriteria', $data);
    }

    public function hapusSubKriteria ($kode_subkriteria) {
        $this->db->delete('tblsubkriteria', ['kode_subkriteria' => $kode_subkriteria]);
    }

}

?>