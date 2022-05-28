<?php

/**
 * Created by PhpStorm.
 * User: sankester
 * Date: 11/05/2017
 * Time: 15:53
 */
class MNilai extends CI_Model{

    public $nis;
    public $kd_kriteria;
    public $nilai;

    public function __construct(){
        parent::__construct();
    }

    private function getTable()
    {
        return 'nilai';
    }

    private function getData()
    {
        $data = array(
            'nis' => $this->nis,
            'kd_kriteria' => $this->kd_kriteria,
            'nilai' => $this->nilai
        );

        return $data;
    }

    public function insert()
    {
        $status = $this->db->insert($this->getTable(), $this->getData());
        return $status;
    }

    public function getNilaiBySiswa($id)
    {
        $query = $this->db->query(
            'select
            max(u.nis) as nis,
            max(u.nama) as nama,
            max(k.kd_kriteria) as kd_kriteria,
            max(n.nilai) as nilai
             from siswa u, nilai n, kriteria k, subkriteria sk where u.nis = n.nis AND k.kd_kriteria = n.kd_kriteria and k.kd_kriteria = sk.kd_kriteria and u.nis = '.$id.' GROUP by n.nilai '
        );
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $nilai[] = $row;
            }

            return $nilai;
        }
    }

    public function getNilaiSiswa()
    {
        $query = $this->db->query(
            'select u.nis, u.nama, k.kd_kriteria, k.nama as kriteria ,n.nilai from siswa u, nilai n, kriteria k where u.nis = n.nis AND k.kd_kriteria = n.kd_kriteria '
        );
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $nilai[] = $row;
            }

            return $nilai;
        }
    }

    public function update()
    {
        $data = array('nilai' => $this->nilai);
        $this->db->where('nis', $this->nis);
        $this->db->where('kd_kriteria', $this->kd_kriteria);
        $this->db->update($this->getTable(), $data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('nis', $id);
        return $this->db->delete($this->getTable());
    }
}