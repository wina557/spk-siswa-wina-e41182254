<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

	public function jumlah($table) {
		$sql="select * from ".$table."";
		return $this->db->query($sql)->num_rows();
	}

	//suratmasuk

	public function rulesSM()
	{
		return [
			[
				'field' => 'tanggalmasuk_suratmasuk', 'label' => 'Tanggal Surat Masuk', 'rules' => 'required'
			],
			[
				'field' => 'kode_suratmasuk', 'label' => 'Kode surat masuk', 'rules' => 'required'
			],
			[
				'field' => 'nomorurut_suratmasuk', 'label' => 'Nomor urut surat Masuk', 'rules' => 'required'
			],
			[
				'field' => 'nomor_suratmasuk', 'label' => 'Nomor Surat Masuk', 'rules' => 'required'
			],
			[
				'field' => 'tanggalsurat_suratmasuk', 'label' => 'Tanggal Surat Masuk', 'rules' => 'required'
			],
			[
				'field' => 'pengirim', 'label' => 'Pengirim', 'rules' => 'required'
			],
			[
				'field' => 'kepada_suratmasuk', 'label' => 'Kepada ', 'rules' => 'required'
			],
			[
				'field' => 'perihal_suratmasuk', 'label' => 'Perihal', 'rules' => 'required'
			],
			[
				'field' => 'operator', 'label' => 'Operator', 'rules' => 'required'
			],
			[
				'field' => 'disposisi1', 'label' => 'Disposisi 1', 'rules' => 'required'
			],
			[
				'field' => 'tanggal_disposisi1', 'label' => 'Tanggal Disposisi 1', 'rules' => 'required'
			],
			[
				'field' => 'disposisi2', 'label' => 'Disposisi 2', 'rules' => 'required'
			],
			[
				'field' => 'tanggal_disposisi2', 'label' => 'Tanggal DIsposisi 2', 'rules' => 'required'
			],
			[
				'field' => 'disposisi3', 'label' => 'Disposisi 3', 'rules' => 'required'
			],
			[
				'field' => 'tanggal_disposisi3', 'label' => 'Tanggal Disposisi', 'rules' => 'required'
			]
		];
	}


	function tampil_suratmasuk(){
		return $this->db->get('tb_suratmasuk');
	}

	function nomorSM() {
	
		$query=$this->db->query('SELECT * FROM tb_suratmasuk ORDER BY nomorurut_suratmasuk DESC LIMIT 1');
		return $query;
	}

	function disposisi() {
		return $this->db->get('tb_bagian');
	}

	function SM_tambah($data) {
		$this->db->insert('tb_suratmasuk', $data);
		return $this->db->affected_rows();
	}
	
	function SM_edit($data, $id_suratmasuk) {
		return $this->db->update('tb_suratmasuk', $data, array('id_suratmasuk' => $id_suratmasuk));
	}

	function SM_hapus($id_suratmasuk)
	{
		$this->db->delete('tb_suratmasuk', array('id_suratmasuk' => $id_suratmasuk));
		return $this->db->affected_rows();
	}

	function SM_by_id($id) {
		$this->db->from('tb_suratmasuk');
		$this->db->where('id_suratmasuk',$id);
		$query = $this->db->get();

		return $query->row();
	}

	function download_lapSM($bulan, $tahun){
		$this->db->from('tb_suratmasuk');
		$this->db->where('MONTH(tanggalsurat_suratmasuk)',$bulan);
		$this->db->where('YEAR(tanggalsurat_suratmasuk)',$tahun);
		$query = $this->db->get();
		return $query;
	}
	//tutup suratmasuk
	// surat keluar

	public function rulesSK()
	{
		return [
			[
				'field' => 'tanggalkeluar_suratkeluar', 'label' => 'Tanggal Keluar Surat keluar', 'rules' => 'required'
			],
			[
				'field' => 'kode_suratkeluar', 'label' => 'Kode surat Keluar', 'rules' => 'required'
			],
			[
				'field' => 'nomor_suratkeluar', 'label' => 'Nomor surat Keluar', 'rules' => 'required'
			],
			[
				'field' => 'nama_bagian', 'label' => 'Bagian', 'rules' => 'required'
			],
			[
				'field' => 'tanggalsurat_suratkeluar', 'label' => 'Tanggal Surat Keluar', 'rules' => 'required'
			],
			[
				'field' => 'kepada_suratkeluar', 'label' => 'Kepada', 'rules' => 'required'
			],
			[
				'field' => 'perihal_suratkeluar', 'label' => 'Perihal ', 'rules' => 'required'
			],
			[
				'field' => 'operator', 'label' => 'operator', 'rules' => 'required'
			]
		];
	}

	function tampil_suratkeluar(){
		return $this->db->get('tb_suratkeluar');
	}

	function nomorSK() {
	
		$query=$this->db->query('SELECT * FROM tb_suratkeluar ORDER BY nomor_suratkeluar DESC LIMIT 1');
		return $query;
	}

	function SK_tambah($data) {
		$this->db->insert('tb_suratkeluar', $data);
		return $this->db->affected_rows();
	}

	function SK_by_id($id) {
		$this->db->from('tb_suratkeluar');
		$this->db->where('id_suratkeluar',$id);
		$query = $this->db->get();

		return $query->row();
	}

	function SK_edit($data, $id_suratkeluar) {
		return $this->db->update('tb_suratkeluar', $data, array('id_suratkeluar' => $id_suratkeluar));
	}

	function SK_hapus($id_suratkeluar)
	{
		$this->db->delete('tb_suratkeluar', array('id_suratkeluar' => $id_suratkeluar));
		return $this->db->affected_rows();
	}

	function download_lapSK($bulan, $tahun){
		$this->db->from('tb_suratkeluar');
		$this->db->where('MONTH(tanggalsurat_suratkeluar)',$bulan);
		$this->db->where('YEAR(tanggalsurat_suratkeluar)',$tahun);
		$query = $this->db->get();
		return $query;
	}
	// tutup surata keluar

	// bagian
	function tampil_bagian(){
		return $this->db->get('tb_bagian');
	}

	public function rulesBagian()
	{
		return [
			[
				'field' => 'nama_bagian', 'label' => 'Nama bagian', 'rules' => 'required'
			],
			[
				'field' => 'username_admin_bagian', 'label' => 'Username Admin Bagian', 'rules' => 'required'
			],
			[
				'field' => 'password_bagian', 'label' => 'Password Bagian', 'rules' => 'required'
			],
			[
				'field' => 'nama_lengkap', 'label' => 'Nama Lengkap', 'rules' => 'required'
			],
			[
				'field' => 'tanggal_lahir_bagian', 'label' => 'Tanggal Lahir', 'rules' => 'required'
			],
			[
				'field' => 'alamat', 'label' => 'Alamat', 'rules' => 'required'
			],
			[
				'field' => 'no_hp_bagian', 'label' => 'Nomer Handphone ', 'rules' => 'trim|required|min_length[10]|max_length[15]'
			]
		];
	}

	function bagian_tambah($data) {
		$this->db->insert('tb_bagian', $data);
		return $this->db->affected_rows();
	}

	function bagian_by_id($id) {
		$this->db->from('tb_bagian');
		$this->db->where('id_bagian',$id);
		$query = $this->db->get();

		return $query->row();
	}

	function bagian_edit($data, $id_bagian) {
		return $this->db->update('tb_bagian', $data, array('id_bagian' => $id_bagian));
	}

	function bagian_hapus($id_bagian) {
		$this->db->delete('tb_bagian', array('id_bagian' => $id_bagian));
		return $this->db->affected_rows();
	}
	// tutup bagian

	function tampil_profil() {
		$this->db->from('tb_admin');
		$this->db->where('nama_admin',$this->userdata['nama']);
		$query = $this->db->get();

		return $query->row();
	}

	function admin_by_id($id) {
		$this->db->from('tb_admin');
		$this->db->where('id_admin',$id);
		$query = $this->db->get();

		return $query->row();
	}

	function profile_edit($data, $id_admin) {
		return $this->db->update('tb_admin', $data, array('id_admin' => $id_admin));
	}


}