<?php

class Profile_Model extends CI_Model {

    public function getProfileByNip ($nip) {
        $this->db->from('tbladmin');
        $this->db->where('nip', $nip);
        return $this->db->get()->row();
    }

    // private function _uploadImage()
    // {
    //     $config['upload_path']          = './assets/img/upload/';
    //     $config['allowed_types']        = 'jpeg|jpg|png|gif'; 
    //     $config['overwrite']			= true;
      
    //     $this->load->library('upload', $config);
    
    //     if ($this->upload->do_upload('image')) {
    //         return $this->upload->data("file_name");
    //     } else {

    //         $data =  $this->upload->display_errors(); 
    //         echo json_encode($data);

    //         return "profile.png";
    //     }
        
    // }

    public function ubahProfile ($image) {
        $data = [
            "foto" => $image
        ];

        $this->db->where('nip', $this->input->post('nipProfile', true));
        $this->db->update('tbladmin', $data);
    }

    // method check email akan dipanggil saat ubah data
    // function check_nip ($id = '', $nip) {
    //     $this->db->where('nip', $nip);
    //     if ($id) {
    //         $this->db->where_not_in('id', $id);
    //     }
    //     return $this->db->get('tbladmin')->num_rows();
    // }
}

?>