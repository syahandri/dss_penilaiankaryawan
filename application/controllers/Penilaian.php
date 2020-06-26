<?php

class Penilaian extends CI_Controller {

    public function __construct () {
        parent:: __construct();
        if ($this->session->userdata('masuk') != TRUE) {
            redirect(base_url('auth'));
        }
        // load model penilaian
        $this->load->model('Penilaian_Model');
    }

     public function index () {
        $data['judul'] = 'Form Penilaian Karyawan';
        $data['aktif'] = 'penilaian';

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
            $row[]    = $nilai->kriteria;
            $row[]    = $nilai->subkriteria;
            
            //add action in table
            $row[] = '           
            <button type  = "button" id="' . $nilai->nip . '" name="' . $nilai->tgl_penilaian . '"class="btn btn-sm deletePenilaian">
            <i class="fas fa-trash" style="color:red"></i>
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

        $index = 0;
        $array[] = [
            "nip" => "",
            "nip_nama" => "--- Pilih Salah Satu ---"
        ];

        array_splice($data, $index, 0 , $array);

        echo json_encode($data);

    }

    public function getKriteria () {
        $data = $this->Penilaian_Model->getKriteria();

        $index = 0;
        $array[] = [
            "kode_kriteria" => "",
            "kriteria" => "--- Pilih Salah Satu ---"
        ];

        array_splice($data, $index, 0 , $array);

        echo json_encode($data);
    }

    public function getSubKriteria () {
        $data = $this->Penilaian_Model->getSubKriteria($this->input->post('kriteria_nilai'));

        $index = 0;
        $array[] = [
            "kode_subkriteria" => "",
            "subkriteria" => "--- Pilih Salah Satu ---"
        ];

        array_splice($data, $index, 0 , $array);
        echo json_encode($data);
    }

    function cek_kriteria () {
        $result = $this->Penilaian_Model->cek_kriteria($this->input->post('tgl_penilaian'), $this->input->post('nip_nilai'),  $this->input->post('kriteria_nilai'));
        if ($result == 0) {
            $response = true;
        } else {
            $this->form_validation->set_message('cek_kriteria', '{field} (' . $this->input->post("kriteria_nilai") . ') sudah digunakan untuk menilai karyawan (' . $this->input->post('nip_nilai') . ') pada tanggal ' . $this->input->post('tgl_penilaian'));
            $response = false;
        }
        return $response;
    }

    public function tambahPenilaian () {
        $rules = [
            [
                'field' => 'tgl_penilaian',
                'label' => 'Tanggal Penilaian',
                'rules' => 'required'
            ],
            [
                'field' => 'nip_nilai',
                'label' => 'Nip',
                'rules' => 'required'
            ],
            [
                'field' => 'kriteria_nilai',
                'label' => 'Kriteria',
                'rules' => 'required|callback_cek_kriteria'
            ],
            [
                'field' => 'sub_nilai',
                'label' => 'Sub Kriteria',
                'rules' => 'required'
            ]
        ];

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'tgl_penilaian' => form_error('tgl_penilaian'),
                'nip_nilai' => form_error('nip_nilai'),
                'kriteria_nilai' => form_error('kriteria_nilai'),
                'sub_nilai' => form_error('sub_nilai')
            ];   

            echo json_encode($data);
        } else {
            $this->Penilaian_Model->tambahPenilaian();
            echo json_encode(array("status" => TRUE));
        }

    }

    public function hapusPenilaian () {
        $this->Penilaian_Model->hapusPenilaian($this->input->post('nip_nilai'), $this->input->post('tgl_penilaian'));
        echo json_encode(["status" => TRUE]);
    }
}
