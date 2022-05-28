<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends Auth_Controller {

    public function __construct() {
		parent::__construct();
		$this->load->model('M_laporan', 'laporan');
	}


    public function lap_pendaftaran()
    {
        $data['judul'] = 'Laporan Pendafaran';
        $data['lap_pendaftaran'] = $this->laporan->lap_pendaftaran()->result();
        $this->load->view('templates/header');
        $this->load->view('templates/navbar', $data);
        $this->load->view('laporan/pendaftaran', $data);
        $this->load->view('templates/footer');
    }

    public function lap_siswa()
    {
        $data['akhir'] = '';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tahun = $this->input->post('tahun');
            $datanya =  $this->laporan->lap_seluruh($tahun)->result();
            $jenis = []; $data = []; $d = [];
            foreach($datanya as $da) {
                $jenis[$da->kode] = $da->nama;

                $datanya2 =  $this->laporan->lap_seluruh($tahun)->result();
                foreach($datanya2 as $da2) {
                    $d[$da2->nama] = $da2->nilai;
                }
                $m = max($d);
				$k = array_search($m, $d);
				$data[$da->nis."-".$da->siswa."-".$da->nilai_max."-".$k][$da->kode] = $da->nilai;
            }
            $data['akhir'] = $data;
        }


        $data['judul'] = 'Laporan Seluruh';
        // $data['lap_siswa'] = $this->laporan->lap_siswa()->result();
        $this->load->view('templates/header');
        $this->load->view('templates/navbar', $data);
        $this->load->view('laporan/seluruh', $data);
        $this->load->view('templates/footer');
    }



}