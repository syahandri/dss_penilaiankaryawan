<?php

class Penilaian extends CI_Controller {

    public function __construct () {
        parent:: __construct();
        if ($this->session->userdata('masuk') != TRUE) {
            redirect(base_url('auth'));
        }
        // load model kriteris
        $this->load->model('Penilaian_Model');
    }

     public function index () {
        $data['judul'] = 'Form Penilaian';

        $this->load->view('_templates/header', $data);
        $this->load->view('penilaian/index', $data);
        $this->load->view('_templates/footer');
    }

    public function getDataPenilaian () {
        $list = $this->Penilaian_Model->getDataTables();
        $data = [];
        $no   = $this->input->post('start');

        foreach ($list as $nilai) {
                 $row = [];
            $row[]    = ++$no;
            $row[]    = $nilai->tgl_penilaian;
            $row[]    = $nilai->nip;
            $row[]    = $nilai->nama_karyawan;
            $row[]    = $nilai->nilai_aternatif_MPE;
            
            //add action in table
            $row[] = '           
            <button type  = "button" id          = "' . $nilai->nip . '"class = "btn btn-sm deletePenilaian">
            <i      class = "fas fa-trash" style = "color:red"></i>
            </button>
            </div>
            ';

            $data[] = $row;
        }

        $output = [
            "draw"            => $this->input->post('draw'),
            "recordsTotal"    => $this->Penilaian_Model->countAll(),
            "recordsFiltered" => $this->Penilaian_Model->countFiltered(),
            "data"            => $data,
        ];
    
        echo json_encode($output);
    }

    public function getNip () {
        $data = $this->Penilaian_Model->getNip();
        echo json_encode($data);
    }

    public function getKriteria () {
        $data = $this->Penilaian_Model->getKriteria();
        echo json_encode($data);
    }

    public function getSubKriteria () {
        $data = $this->Penilaian_Model->getSubKriteria();
        echo json_encode($data);
    }
}

?>