<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_bagian extends CI_Model {
    // function tampil_suratmasuk() {

    //     $this->db->from('tb_suratmasuk');
    //     $this->db->where('disposisi1', $this->userdata['nama']);
    //     $this->db->or_where('disposisi2', $this->userdata['nama']);
    //     $this->db->or_where('disposisi3', $this->userdata['nama']);
        
	// 	$query = $this->db->get();

	// 	return $query;
    // }
    
    function tampil_suratmasuk() {
        $tanggal = date('Y-m-d h:i:s');
        $user = $this->userdata['nama'];
        $query = $this->db->query("SELECT * FROM tb_suratmasuk WHERE (disposisi1 = '".$user."' AND tanggal_disposisi1 <= '".$tanggal."') OR (disposisi2 = '".$user."' AND tanggal_disposisi2 <= '".$tanggal."') or (disposisi3 = '".$user."' AND tanggal_disposisi3 <= '".$tanggal."') ");
        return $query;
    }
}