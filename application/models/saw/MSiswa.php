<?php
/**
 * Created by PhpStorm.
 * User: sankester
 * Date: 11/05/2017
 * Time: 15:51
 */

class MSiswa extends CI_Model{

    public $nis;
    public $nama;

    public function __construct(){
        parent::__construct();
    }

    private function getTable(){
        return 'siswa';
    }

    private function getData(){
        $data = array(
            'nama' => $this->nama
        );

        return $data;
    }

    public function getAll()
    {
        $nama = array();
        $query = $this->db->get($this->getTable());
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $nama[] = $row;
            }
        }
        return $nama;
    }


    public function insert()
    {
        $this->db->insert($this->getTable(), $this->getData());
        return $this->db->insert_id();
    }

    public function update($where)
    {
        $status = $this->db->update($this->getTable(), $this->getData(), $where);
        return $status;

    }

    public function delete($id)
    {
        $this->db->where('nis', $id);
        return $this->db->delete($this->getTable());
    }

    public function getLastID(){
        $this->db->select('nis');
        $this->db->order_by('nis', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->getTable());
        return $query->row();
    }

    public function castingNIM($nama)
    {
        $get = $this->db->query("SELECT * FROM siswa where nama=?",[$nama]);
        $retVal = ($get->num_rows()!=0) ? $get->row_array() : 0 ;
        return $retVal;
    }

    public function simpanHasil($data)
    {
        $this->db->trans_begin();
        $this->db->insert('hasil', $data);
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
            # code...
        }
        $this->db->trans_complete();
    }

    public function resetHasil()
    {
        $this->db->truncate("hasil");
    }


}