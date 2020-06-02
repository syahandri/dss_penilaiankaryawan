<?php

class Kriteria_Model extends CI_Model {

    //variabel untuk keperluan pagination jquery datatable
    var $column_order = [null, 'kode_kriteria', 'kriteria', 'bobot', null];
    var $column_search = ['kode_kriteria', 'kriteria', 'bobot'];
    var $order = ['kode_kriteria' => 'asc'];

    
    // PAGINATION USING JQUERY DATA TABLES
    private function _get_datatables_query () {
        $this->db->from('tblkriteria');
        
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
        $this->db->from('tblkriteria');
        return $this->db->count_all_results();
    }

    public function getKriteriaById ($kode_kriteria) {
        $this->db->from('tblkriteria');
        $this->db->where('kode_kriteria', $kode_kriteria);
        return $this->db->get()->row();
    }

    public function kodeOtomatis () {
        $this->db->select_max('kode_kriteria');
        return $this->db->get('tblkriteria')->row_array();
    }

    public function tambahKriteria () {
        $data = [
            "kode_kriteria" => $this->input->post('kodeKriteria', true),
            "kriteria" => $this->input->post('kriteria', true),
            "bobot" => $this->input->post('bobot', true)
        ];

        return $this->db->insert('tblkriteria', $data);
    }

    public function ubahKriteria () {
        $data = [
            "kode_kriteria" => $this->input->post('kodeKriteria', true),
            "kriteria" => $this->input->post('kriteria', true),
            "bobot" => $this->input->post('bobot', true)
        ];

        $this->db->where('kode_kriteria', $this->input->post('kodeKriteria', true));
        $this->db->update('tblkriteria', $data);
    }

    public function hapusKriteria ($kode_kriteria) {
        $this->db->delete('tblkriteria', ['kode_kriteria' => $kode_kriteria]);
    }

}

?>