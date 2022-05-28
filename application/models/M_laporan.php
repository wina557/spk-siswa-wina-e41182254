<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan extends CI_Model {

    public function lap_pendaftaran()
    {
        $query=$this->db->query('SELECT * FROM siswa WHERE nis IN(SELECT nis FROM nilai)');
      return $query;
    }

    public function lap_seluruh($tahun)
    {
        $query=$this->db->query("SELECT b.kode, b.nama, h.nilai, m.nama AS siswa, m.nis, (SELECT MAX(nilai) FROM hasil WHERE nis=h.nis) AS nilai_max FROM siswa m JOIN hasil h ON m.nis=h.nis JOIN jenis b ON b.kode=h.kode WHERE m.tahun_daftar='".$tahun."'");
      return $query;
    }

    public function lap_seluruh2($tahun)
    {
        $query=$this->db->query(" SELECT b.nama, a.nilai FROM hasil a JOIN jenis b USING(kode) WHERE a.nis=$r[nis] AND a.tahun='".$tahun."'");
      return $query;
     
    }

}