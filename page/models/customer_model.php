<?php

class customer extends database{

	public function __construct(){
		parent::__construct();
		// $this->conn = parent::connection();
	}

	public function getAllCustomer(){
		
	}

	public function insertCustomer($var){
		$query = $this->db->prepare("INSERT INTO customer VALUES($var)");
		if($query->execute()){
			echo "<script>alert('Data berhasil ditambahkan'); window.location.href='index';</script>";
		}
		else{
			echo "<script>alert('Data gagal ditambahkan'); window.location.href='index';</script>";
		}
	}

	// public function checkFoto(){
	// 	$query= $this->d->prepare("select foto from pegawai where username = '$_SESSION[username]'");
	// 	$query->execute();
	// 	$data = $query->fetch();
	// 	if($data[0]==null){
	// 		return true;
	// 	}
	// }

	public function selectAllLimit($table,$start,$sum){
		$query = $this->db->prepare("SELECT * FROM $table limit $start,$sum");
		$query->execute();
		$data = $query->fetchAll();
		return $data;
	}

	public function yol($ru){
		$r=$ru*3;
		return $r;
	}

	public function getKd($table){
		$kd = 'kd_'.$table;
		$query = $this->db->prepare("SELECT MAX($kd) FROM $table");
		$query->execute();
		$data = $query->fetch();
		$kode=substr($data[0],2); 
        $tambah=$kode+1; 
            if($tambah < 10){ 
            	if($table=='pegawai')
                	$kd_="P000".$tambah;
                elseif($table=='anggota')
                	$kd_="A000".$tambah;
                elseif($table=='simpanan')
                	$kd_="S000".$tambah;
                elseif($table=='pinjaman')
                	$kd_="PJ000".$tambah;
                elseif($table=='angsuran')
                	$kd_="AN000".$tambah;
            }else{
            	if($table=='pegawai')
                	$kd_="P00".$tambah;
                elseif($table=='anggota')
                	$kd_="A00".$tambah;
                elseif($table=='simpanan')
                	$kd_="S00".$tambah;
                elseif($table=='pinjaman')
                	$kd_="PJ00".$tambah;
                elseif($table=='angsuran')
                	$kd_="AN00".$tambah;
            }
        echo $kd_;
	}

	public function selectCount($table){
		$query = $this->db->prepare("SELECT * FROM $table");
		$query->execute();
		$data = $query->rowCount();
		return $data;
	}

}

?>