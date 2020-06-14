<?php

class Karyawan_Model extends CI_Model {
    
    //variabel untuk keperluan pagination jquery datatable
    var $column_order  = [null, 'nip', 'nama_karyawan', 'jenis_kelamin', 'email', 'no_telp', 'alamat', null];
    var $column_search = ['nip', 'nama_karyawan', 'jenis_kelamin', 'alamat', 'email', 'no_telp'];
    var $order         = ['nama_karyawan' => 'asc'];

    // PAGINATION USING JQUERY DATA TABLES
    private function _get_datatables_query () {
        $this->db->from('tblkaryawan');
        
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
        $this->db->from('tblkaryawan');
        return $this->db->count_all_results();
    }

    public function getKaryawanById ($nip) {
        $this->db->from('tblkaryawan');
        $this->db->where('nip', $nip);
        return $this->db->get()->row();
    }

    public function tambahKaryawan () {
        $data = [
            "nip"           => $this->input->post('nip', true),
            "nama_karyawan" => $this->input->post('nama', true),
            "jenis_kelamin" => $this->input->post('gender', true),
            "alamat"        => $this->input->post('alamat', true),
            "email"         => $this->input->post('email', true),
            "no_telp"       => $this->input->post('telp', true)
        ];

        return $this->db->insert('tblkaryawan', $data);
    }

    public function ubahKaryawan () {
        $data = [
            "nip"           => $this->input->post('nip', true),
            "nama_karyawan" => $this->input->post('nama', true),
            "jenis_kelamin" => $this->input->post('gender', true),
            "alamat"        => $this->input->post('alamat', true),
            "email"         => $this->input->post('email', true),
            "no_telp"       => $this->input->post('telp', true)
        ];

        $this->db->where('nip', $this->input->post('nip', true));
        $this->db->update('tblkaryawan', $data);
    }

    // method check email akan dipanggil saat ubah data
    function check_email ($nip = '', $email) {
        $this->db->where('email', $email);
        if ($nip) {
            $this->db->where_not_in('nip', $nip);
        }
        return $this->db->get('tblkaryawan')->num_rows();
    }

    public function hapusKaryawan ($nip) {
        $this->db->delete('tblkaryawan', ['nip' => $nip]);
    }
}

?>