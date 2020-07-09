<?php

class Hasil_penilaian extends CI_Controller {

    public function __construct () {
        parent::__construct();
        
        // load model hasil_penilaian
        $this->load->model('Hasil_penilaian_Model');
    }

    public function index () {
        $data['judul'] = 'Hasil Penilaian Karyawan';
        $data['aktif'] = 'laporan';

        $this->load->view('_templates/header', $data);
        $this->load->view('hasil_penilaian/index', $data);
        $this->load->view('_templates/footer');
    }

    public function getDataHasil () {
        $list = $this->Hasil_penilaian_Model->getDataTables();
        $data = [];
        $no   = $this->input->post('start');

        foreach ($list as $nilai) {
                 $row = [];
            $row[]    = ++$no;
            $row[]    = $nilai->tgl_penilaian;
            $row[]    = $nilai->nip;
            $row[]    = $nilai->nama_karyawan;
            $row[]    = $nilai->nilai_alternatif_MPE;

            $data[] = $row;
        }

        $output = [
            "draw"            => $this->input->post('draw'),
            "recordsTotal"    => $this->Hasil_penilaian_Model->countAll(),
            "recordsFiltered" => $this->Hasil_penilaian_Model->countFiltered(),
            "data"            => $data,
        ];
    
        echo json_encode($output);
    }
}
