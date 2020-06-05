<?php

class Sub_kriteria extends CI_Controller {

    public function __construct () {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            redirect(base_url('auth'));
        }
        // load model sub_kriteria
        $this->load->model('Sub_kriteria_Model');
    }

    public function index () {
        $data['judul'] = 'Daftar Sub Kriteria';

        $this->load->view('_templates/header', $data);
        $this->load->view('sub_kriteria/index', $data);
        $this->load->view('_templates/footer');
    }

    public function getSubKriteria () {
        $list = $this->Sub_kriteria_Model->getDataTables();
        $data = [];
        $no = $this->input->post('start');

        foreach ($list as $subkriteria) {
            $row = [];
            $row[] = ++$no;
            $row[] = $subkriteria->kode_subkriteria;
            $row[] = $subkriteria->kode_kriteria;
            $row[] = $subkriteria->subkriteria;
            $row[] = $subkriteria->nilai;
            
            //add action in table
            $row[] = '
            <div class="d-sm-flex bd-highlight align-content-center justify-content-around">
            <button type="button" id="'. $subkriteria->kode_subkriteria . '"class="btn btn-sm updateSubKriteria">
            <i class="fas fa-pencil-alt" style="color:blue"></i>
            </buton>
           
            <button type="button" id="' . $subkriteria->kode_subkriteria . '"class="btn btn-sm deleteSubKriteria">
            <i class="fas fa-trash" style="color:red"></i>
            </button>
            </div>
            ';

            $data[] = $row;
        }

        $output = [
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Sub_kriteria_Model->countAll(),
            "recordsFiltered" => $this->Sub_kriteria_Model->countFiltered(),
            "data" => $data,
        ];
    
        echo json_encode($output);
    }

    public function getSubKriteriaById () {
        $data = $this->Sub_kriteria_Model->getSubKriteriaById($this->input->post('id'));
        echo json_encode($data);
    }

    public function kodeOtomatis () {
        $data = $this->Sub_kriteria_Model->kodeOtomatis();

        $data['kodeUrut'] = $data['kode_subkriteria'];

        $urutan = (int) substr($data['kodeUrut'], 3, 3);
        $urutan++;

        $huruf = 'SUB';

        $data['kodeUrut'] = $huruf . sprintf("%03s", $urutan);
        echo json_encode($data);
    }

    public function getKodeKriteria () {
        $data = $this->Sub_kriteria_Model->getKodeKriteria();
        echo json_encode($data);
    }

    public function tambahSubKriteria () {
        $rules = [
            [
                'field' => 'kodeKriteria',
                'label' => 'Kode Kriteria',
                'rules' => 'required'
            ],
            [
                'field' => 'kodesubKriteria',
                'label' => 'Kode Sub Kriteria',
                'rules' => 'required'
            ],
            [
                'field' => 'subKriteria',
                'label' => 'Sub Kriteria',
                'rules' => 'required'
            ],
            [
                'field' => 'nilai',
                'label' => 'Nilai',
                'rules' => 'required|numeric'
            ]
        ];

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'kodeKriteria' => form_error('kodeKriteria'),
                'kodesubKriteria' => form_error('kodesubKriteria'),
                'subKriteria' => form_error('subKriteria'),
                'nilai' => form_error('nilai')
            ];   

            echo json_encode($data);
        } else {
            $this->Sub_kriteria_Model->tambahsubKriteria();
            echo json_encode(array("status" => TRUE));
        }

    }

    public function ubahSubKriteria () {
        $rules = [
            [
                'field' => 'kodeKriteria',
                'label' => 'Kode Kriteria',
                'rules' => 'required'
            ],
            [
                'field' => 'kodesubKriteria',
                'label' => 'Kode Sub Kriteria',
                'rules' => 'required'
            ],
            [
                'field' => 'subKriteria',
                'label' => 'Sub Kriteria',
                'rules' => 'required'
            ],
            [
                'field' => 'nilai',
                'label' => 'Nilai',
                'rules' => 'required|numeric'
            ]
        ];
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'kodeKriteria' => form_error('kodeKriteria'),
                'kodesubKriteria' => form_error('kodesubKriteria'),
                'subKriteria' => form_error('subKriteria'),
                'nilai' => form_error('nilai')
            ];   

            echo json_encode($data);
        } else {
            $this->Sub_kriteria_Model->ubahSubKriteria();
            echo json_encode(array("status" => TRUE));
        }
    }

    public function hapusSubKriteria () {
        $this->Sub_kriteria_Model->hapusSubKriteria($this->input->post('id'));
        echo json_encode(["status" => TRUE]);
    }
}
