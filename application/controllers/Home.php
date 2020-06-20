<?php

class Home extends CI_Controller
{

    public function __construct()
    {
        parent:: __construct();
        if ($this->session->userdata('masuk') != TRUE) {
            redirect(base_url('auth'));
        }

        $this->load->model('Home_Model');
    }

    public function index ()
    {
        $data['judul'] = 'Beranda';
        $this->load->view('_templates/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('_templates/footer');
    }

    public function getHasil () {
    $data = $this->Home_Model->getHasil($this->input->post('filterTgl'));

        foreach($data as $row) {
            $output[] = [
                'tgl_penilaian' => $row['tgl_penilaian'],
                'nama_karyawan' => $row['nama_karyawan'],
                'nilai_mpe' => floatval($row['nilai_alternatif_MPE'])
            ];
        }
        echo json_encode($output);
    }

    public function getTgl () {
        $data = $this->Home_Model->getTgl();
        
        $index = 0;
        $array[] = [
                "tgl_penilaian" => "--- Pilih Tanggal ---"
            ];

        array_splice($data, $index, 0 , $array);
        echo json_encode($data);
    }
}