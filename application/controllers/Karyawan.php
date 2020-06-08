<?php

class Karyawan extends CI_Controller {

    public function __construct () {
        parent:: __construct();
        if ($this->session->userdata('masuk') != TRUE) {
            redirect(base_url('auth'));
        }
        $this->load->model('Karyawan_Model');
    }

    public function index () {
        $data['judul'] = 'Data Karyawan';

        $this->load->view('_templates/header', $data);
        $this->load->view('karyawan/index', $data);
        $this->load->view('_templates/footer');
    }

    public function getKaryawan () {
        $list = $this->Karyawan_Model->getDataTables();
        $data = [];
        $no   = $this->input->post('start');

        foreach ($list as $karyawan) {
                 $row = [];
            $row[]    = ++$no;
            $row[]    = $karyawan->nip;
            $row[]    = $karyawan->nama_karyawan;
            $row[]    = $karyawan->jenis_kelamin;
            $row[]    = $karyawan->alamat;
            $row[]    = $karyawan->email;
            $row[]    = $karyawan->no_telp;
            
            //add action in table
            $row[] = '
            <div    class = "d-sm-flex bd-highlight align-content-center justify-content-around">
            <button type  = "button" id               = "'. $karyawan->nip . '"class = "btn btn-sm updateKaryawan">
            <i      class = "fas fa-pencil-alt" style = "color:blue"></i>
            </buton>
           
            <button type  = "button" id          = "' . $karyawan->nip . '"class = "btn btn-sm deleteKaryawan">
            <i      class = "fas fa-trash" style = "color:red"></i>
            </button>
            </div>
            ';

            $data[] = $row;
        }

        $output = [
            "draw"            => $this->input->post('draw'),
            "recordsTotal"    => $this->Karyawan_Model->countAll(),
            "recordsFiltered" => $this->Karyawan_Model->countFiltered(),
            "data"            => $data,
        ];
    
        echo json_encode($output);
    }

    public function getKaryawanById () {
        $data = $this->Karyawan_Model->getKaryawanById($this->input->post('id'));
        echo json_encode($data);
    }

    public function tambahKaryawan () {
        $rules = [
            [
                'field' => 'nip',
                'label' => 'NIP',
                'rules' => 'required|numeric|is_unique[tblkaryawan.nip]'
            ],
            [
                'field' => 'nama',
                'label' => 'Nama Karyawan',
                'rules' => 'required|regex_match[/^([a-z\. ])+$/i]'
            ],
            [
                'field' => 'gender',
                'label' => 'Jenis Kelamin',
                'rules' => 'required'
            ],
            [
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'required'
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[tblkaryawan.email]'
            ],
            [
                'field' => 'telp',
                'label' => 'Telepon',
                'rules' => 'required|numeric'
            ]
        ];

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'nip'    => form_error('nip'),
                'nama'   => form_error('nama'),
                'gender' => form_error('gender'),
                'alamat' => form_error('alamat'),
                'email'  => form_error('email'),
                'telp'   => form_error('telp')
            ];   

            echo json_encode($data);
        } else {
            $this->Karyawan_Model->tambahKaryawan();
            echo json_encode(array("status" => TRUE));
        }

    }

    // method check email untuk ubah data (karena email is_unique)
    function check_email ($email) {
        if ($this->input->post('nip')) {
            $nip = $this->input->post('nip');
         } else {
            $nip = '';
        }

        $result = $this->Karyawan_Model->check_email($nip, $email);
        if ($result == 0) {
            $response = true;
        } else {
            $this->form_validation->set_message('check_email', 'Field {field} sudah terdaftar');
            $response = false;
        }
        return $response;
    }

    public function ubahKaryawan () {
        $rules = [
            [
                'field' => 'nip',
                'label' => 'NIP',
                'rules' => 'required|numeric'
            ],
            [
                'field' => 'nama',
                'label' => 'Nama Karyawan',
                'rules' => 'required|regex_match[/^([a-z\. ])+$/i]'
            ],
            [
                'field' => 'gender',
                'label' => 'Jenis Kelamin',
                'rules' => 'required'
            ],
            [
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'required'
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email|callback_check_email'
            ],
            [
                'field' => 'telp',
                'label' => 'Telepon',
                'rules' => 'required|numeric'
            ]
        ];

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'nip'    => form_error('nip'),
                'nama'   => form_error('nama'),
                'gender' => form_error('gender'),
                'alamat' => form_error('alamat'),
                'email'  => form_error('email'),
                'telp'   => form_error('telp')
            ];   

            echo json_encode($data);
        } else {
            $this->Karyawan_Model->ubahKaryawan();
            echo json_encode(array("status" => TRUE));
        }
    }

    public function hapusKaryawan () {
        $this->Karyawan_Model->hapusKaryawan($this->input->post('id'));
        echo json_encode(["status" => TRUE]);
    }
}