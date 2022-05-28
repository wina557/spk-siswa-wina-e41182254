<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_input extends CI_Model
{

  // rangking
  public function tampil_rangking()
  {
    return $this->db->get('jenis');
  }

  function rangking_by_kode($kode)
  {
    $this->db->from('jenis');
    $this->db->where('kode', $kode);
    $query = $this->db->get();

    return $query->row();
  }

  public function rangking_tambah($data)
  {
    $this->db->insert('jenis', $data);
    return $this->db->affected_rows();
  }

  function rangking_edit($rangking, $kode)
  {
    return $this->db->update('jenis', $rangking, array('kode' => $kode));
  }

  function rangking_hapus($kode)
  {
    $this->db->delete('jenis', array('kode' => $kode));
    return $this->db->affected_rows();
  }

  // tutup rangking

  //siswa
  public function tampil_siswa()
  {
    return $this->db->get('siswa');
  }

  function siswa_by_nis($nis)
  {
    $this->db->from('siswa');
    $this->db->where('nis', $nis);
    $query = $this->db->get();

    return $query->row();
  }

  public function siswa_tambah($data)
  {
    $this->db->insert('siswa', $data);
    return $this->db->affected_rows();
  }

  function siswa_edit($siswa, $nis)
  {
    return $this->db->update('siswa', $siswa, array('nis' => $nis));
  }

  function siswa_hapus($nis)
  {
    $this->db->delete('siswa', array('nis' => $nis));
    return $this->db->affected_rows();
  }
  //tutup siswa

  //kriteria
  public function tampil_kriteria()
  {
    return $this->db->get('kriteria');
  }

  function kriteria_by_kode($kd_kriteria)
  {
    $this->db->from('kriteria');
    $this->db->where('kd_kriteria', $kd_kriteria);
    $query = $this->db->get();

    return $query->row();
  }

  function kriteriaAll_by_kode($kode)
  {
    $query = $this->db->query('SELECT nama, kd_kriteria from kriteria where kode = ' . $kode . '');
    return $query;
  }

  public function kriteria_tambah($data)
  {
    $this->db->insert('kriteria', $data);
    return $this->db->affected_rows();
  }

  function kriteria_edit($kriteria, $kd_kriteria)
  {
    return $this->db->update('kriteria', $kriteria, array('kd_kriteria' => $kd_kriteria));
  }

  function kriteria_hapus($kd_kriteria)
  {
    $this->db->delete('kriteria', array('kd_kriteria' => $kd_kriteria));
    return $this->db->affected_rows();
  }
  //tutup kriteria


  //penilaian
  public function tampil_penilaian()
  {
    $query = $this->db->query('SELECT a.kd_penilaian, c.nama AS nama_jenis, b.nama AS nama_kriteria, a.keterangan, a.bobot FROM penilaian a JOIN kriteria b ON a.kd_kriteria=b.kd_kriteria JOIN jenis c ON a.kode=c.kode');
    return $query;
  }

  function penilaian_by_kode($kd_penilaian)
  {
    $this->db->from('penilaian');
    $this->db->where('kd_penilaian', $kd_penilaian);
    $query = $this->db->get();

    return $query->row();
  }

  public function penilaian_tambah($data)
  {
    $this->db->insert('penilaian', $data);
    return $this->db->affected_rows();
  }

  function penilaian_edit($penilaian, $kd_penilaian)
  {
    return $this->db->update('penilaian', $penilaian, array('kd_penilaian' => $kd_penilaian));
  }

  function penilaian_hapus($kd_penilaian)
  {
    $this->db->delete('penilaian', array('kd_penilaian' => $kd_penilaian));
    return $this->db->affected_rows();
  }
  //tutup penilaian

  //persyaratan
  public function tampil_persyaratan()
  {
    $query = $this->db->query('SELECT a.kd_nilai, c.nama AS nama_jenis, b.nama AS nama_kriteria, d.nis, d.nama AS nama_siswa, a.nilai FROM nilai a JOIN kriteria b ON a.kd_kriteria=b.kd_kriteria JOIN jenis c ON a.kode=c.kode JOIN siswa d ON d.nis=a.nis');
    return $query;
  }

  function persyaratan_by_kode($kd_nilai)
  {
    $this->db->from('nilai');
    $this->db->where('kd_nilai', $kd_nilai);
    $query = $this->db->get();

    return $query->row();
  }

  public function persyaratan_tambah($data)
  {
    $this->db->insert('nilai', $data);
  }

  function persyaratan_edit($persyaratan, $kd_nilai)
  {
    return $this->db->update('nilai', $persyaratan, array('kd_nilai' => $kd_nilai));
  }

  function persyaratan_hapus($kd_nilai)
  {
    $this->db->delete('nilai', array('kd_nilai' => $kd_nilai));
    return $this->db->affected_rows();
  }

  public function persyaratan_cek($data)
  {
    $sql = "SELECT kd_nilai FROM nilai WHERE kode = '" . $data['kode'] . "' AND kd_kriteria = '" . $data['kd_kriteria'] . "' AND nis = '" . $data['nis'] . "'";
    return $this->db->query($sql)->num_rows();
  }

  //tutup perysaratan


  function ambilKriteria()
  {
    return $this->db->get('penilaian');
  }
  public function edit_persyaratan($id)
  {
    $get = $this->db->query("SELECT nilai.*,siswa.nama AS nama_siswa, kriteria.nama , jenis.nama AS nama_jenis FROM nilai
          LEFT JOIN siswa ON siswa.nis=nilai.nis
          LEFT JOIN kriteria ON kriteria.kd_kriteria=nilai.kd_kriteria
          LEFT JOIN jenis ON jenis.kode=nilai.kode
          WHERE nilai.kd_nilai=?", [$id]);
    if ($get->num_rows() != 0) {
      $row = $get->row_array();
      $row['nilai_kriteria'] = $this->getNilai($row['kd_kriteria']);
      return $row;
    }
    return [];
  }

  public function getNilai($kd_kriteria)
  {
    $get = $this->db->query("SELECT bobot,keterangan FROM penilaian where kd_kriteria=?", [$kd_kriteria]);
    if ($get->num_rows() != 0) {
      $result = $get->result_array();
      return $result;
    } else {
      return [];
    }
  }

  public function update_persyaratan($params)
  {
    $data['nilai'] = $params['kd_kriteria'];
    $this->db->where("kd_nilai", $params['kd_nilai']);
    $this->db->update('nilai', $data);
    if ($this->db->affected_rows()) {
      return true;
    } else {
      return false;
    }
  }
}
