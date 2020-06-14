<?php

class Penilaian_Model extends CI_Model {

      //variabel untuk keperluan pagination jquery datatable
    var $column_order  = [null, 'tgl_penilaian', 'nip', 'nama_karyawan', 'nilai_alternatif_MPE', null];
    var $column_search = ['tgl_penilaian', 'nip', 'nama_karyawan', 'nilai_alternatif_MPE'];
    var $order         = ['nilai_alternatif_MPE' => 'desc'];

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
        $this->db->select("nip, concat(nip, ' - ', nama_karyawan) AS nip_nama");
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