<?php

/**
 * Created by PhpStorm.
 * User: sankester
 * Date: 11/05/2017
 * Time: 15:54
 */
class MSubKriteria extends CI_Model{

    public $kd_penilaian;
    public $kd_kriteria;
    public $keterangan;
    public $bobot;


    public function __construct(){
        parent::__construct();
    }

    private function getTable()
    {
        return 'penilaian';
    }

    private function getData(){
        $data = array(
            'kd_kriteria' => $this->kd_kriteria,
            'keterangan' => $this->keterangan,
            'bobot' => $this->bobot
        );
        return $data;
    }

    public function getAll()
    {
        $query = $this->db->get($this->getTable());
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $subkriterias[] = $row;
            }

            return$subkriterias;
        }
    }

    public function getById()
    {
        $this->db->where('kd_kriteria', $this->kd_kriteria);
        $query = $this->db->get($this->getTable());

        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $subkriteria[] = $row;
            }

            return $subkriteria;
        }
    }

    public function insert()
    {
        $data = $this->getData();
        $this->db->insert($this->getTable(), $data);
        return $this->db->insert_id();
    }

    public function update()
    {
        $data = $this->getData();
        $this->db->where('kd_penilaian', $this->kd_penilaian);
        $this->db->where('kd_kriteria', $this->kd_kriteria);
        $this->db->update($this->getTable(), $data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('kd_kriteria', $id);
        return $this->db->delete($this->getTable());
    }
}