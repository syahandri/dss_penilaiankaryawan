<?php

class Kriteria extends CI_Controller {

    public function __construct () {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            redirect(base_url('auth'));
        }
        // load model kriteris
        $this->load->model('Kriteria_Model');
    }

    public function index () {
        $data['judul'] = 'Daftar Kriteria';

        $this->load->view('_templates/header', $data);
        $this->load->view('kriteria/index', $data);
        $this->load->view('_templates/footer');
    }

    public function getKriteria () {
        $list = $this->Kriteria_Model->getDataTables();
        $data = [];
        $no = $this->input->post('start');

        foreach ($list as $kriteria) {
            $row = [];
            $row[] = ++$no;
            $row[] = $kriteria->kode_kriteria;
            $row[] = $kriteria->kriteria;
            $row[] = $kriteria->bobot;
            
            //add action in table
            $row[] = '
            <div class="d-sm-flex bd-highlight align-content-center justify-content-around">
            <button type="button" id="'. $kriteria->kode_kriteria . '"class="btn btn-sm updateKriteria">
            <i class="fas fa-pencil-alt" style="color:blue"></i>
            </buton>
           
            <button type="button" id="' . $kriteria->kode_kriteria . '"class="btn btn-sm deleteKriteria">
            <i class="fas fa-trash" style="color:red"></i>
            </button>
            </div>
            ';

            $data[] = $row;
        }

        $output = [
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Kriteria_Model->countAll(),
            "recordsFiltered" => $this->Kriteria_Model->countFiltered(),
            "data" => $data,
        ];
    
        echo json_encode($output);
    }

    public function getKriteriaById () {
        $data = $this->Kriteria_Model->getKriteriaById($this->input->post('id'));
        echo json_encode($data);
    }

    public function kodeOtomatis () {
        $data = $this->Kriteria_Model->kodeOtomatis();

        $data['kodeUrut'] = $data['kode_kriteria'];

        $urutan = (int) substr($data['kodeUrut'], 3, 3);
        $urutan++;

        $huruf = 'KTR';

        $data['kodeUrut'] = $huruf . sprintf("%03s", $urutan);
        echo json_encode($data);
    }

    public function tambahKriteria () {
        $rules = [
            [
                'field' => 'kodeKriteria',
                'label' => 'Kode Kriteria',
                'rules' => 'required'
            ],
            [
                'field' => 'kriteria',
                'label' => 'Kriteria',
                'rules' => 'required'
            ],
            [
                'field' => 'bobot',
                'label' => 'Bobot Kriteria',
                'rules' => 'required|numeric'
            ]
        ];

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'kodeKriteria' => form_error('kodeKriteria'),
                'kriteria' => form_error('kriteria'),
                'bobot' => form_error('bobot')
            ];   

            echo json_encode($data);
        } else {
            $this->Kriteria_Model->tambahKriteria();
            echo json_encode(array("status" => TRUE));
        }

    }

    public function ubahKriteria () {
        $rules = [
            [
                'field' => 'kodeKriteria',
                'label' => 'Kode Kriteria',
                'rules' => 'required'
            ],
            [
                'field' => 'kriteria',
                'label' => 'Kriteria',
                'rules' => 'required'
            ],
            [
                'field' => 'bobot',
                'label' => 'Bobot Kriteria',
                'rules' => 'required|numeric'
            ]
        ];

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'kodeKriteria' => form_error('kodeKriteria'),
                'kriteria' => form_error('kriteria'),
                'bobot' => form_error('bobot')
            ];   

            echo json_encode($data);
        } else {
            $this->Kriteria_Model->ubahKriteria();
            echo json_encode(array("status" => TRUE));
        }
    }

    public function hapusKriteria () {
        $this->Kriteria_Model->hapusKriteria($this->input->post('id'));
        echo json_encode(["status" => TRUE]);
    }
}
