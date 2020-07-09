<?php

class Penilaian_Model extends CI_Model {

    // variabel untuk keperluan pagination jquery datatable
    var $column_order  = [null, 'tgl_penilaian', 'nip', 'nama_karyawan', 'kriteria', 'subkriteria', null];
    var $column_search = ['tgl_penilaian', 'nip', 'nama_karyawan', 'kriteria', 'subkriteria'];
    var $order = ['tgl_penilaian' => 'desc']; // order 1st
    var $order_second = ['nip' => 'asc']; // order 2nd
    var $order_third = ['kriteria' => 'asc']; // order 3rd

      // PAGINATION USING JQUERY DATA TABLES
      private function _get_datatables_query () {
        $this->db->select('tgl_penilaian, nip, nama_karyawan, kriteria, subkriteria');
        // $this->db->order_by('tgl_penilaian DESC, nip ASC, kriteria ASC');
        $this->db->from('detail_penilaian');
        
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
        } else if (isset($this->order) && isset($this->order_second) && isset($this->order_third)) {
            $order = $this->order;
            $order_second = $this->order_second;
            $order_third = $this->order_third;
            $this->db->order_by(key($order), $order[key($order)]);
            $this->db->order_by(key($order_second), $order_second[key($order_second)]);
            $this->db->order_by(key($order_third), $order_third[key($order_third)]);
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
        $this->db->from('detail_penilaian');
        return $this->db->count_all_results();
    }

    public function getNip () {
        $this->db->select("nip, concat(nip, ' - ', nama_karyawan) AS nip_nama");
        return $this->db->get('tblkaryawan')->result_array();
    }

    public function getKriteria () {
        $this->db->select("kode_kriteria, kriteria");
        return $this->db->get('tblkriteria')->result_array();
    }

    public function getSubKriteria ($kode_kriteria) {
        $this->db->select("kode_subkriteria, subkriteria");
        $this->db->where('kode_kriteria', $kode_kriteria);
        return $this->db->get('tblsubkriteria')->result_array();
    }

    function cek_kriteria ($tgl_penilaian, $nip, $kode_kriteria) {
        $this->db->where('kode_kriteria', $kode_kriteria);
        $this->db->where('tgl_penilaian', $tgl_penilaian);
        $this->db->where('nip', $nip);
        return $this->db->get('tblpenilaian')->num_rows();
    }

    public function tambahPenilaian () {

        $data = [
            "tgl_penilaian" => $this->input->post('tgl_penilaian', true),
            "nip" => $this->input->post('nip_nilai', true),
            "kode_kriteria" => $this->input->post('kriteria_nilai', true),
            "kode_subkriteria" => $this->input->post('sub_nilai', true)
        ];

        return $this->db->insert('tblpenilaian', $data);
    }

    public function hapusPenilaian ($nip, $tgl_penilaian) {
        $this->db->delete('tblpenilaian', ['nip' => $nip, 'tgl_penilaian' => $tgl_penilaian]);
    }
}

?>