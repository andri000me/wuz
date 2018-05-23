<?php

class booking extends database{

	public function __construct(){
		$this->conn = parent::connection();
	}

	// public function inputBooking($var){
	// 	$query = $this->db->prepare("INSERT INTO customer VALUES($var)");
	// 	if($query->execute()){
	// 		echo "<script>alert('Data berhasil ditambahkan'); window.location.href='index';</script>";
	// 	}
	// 	else{
	// 		echo "<script>alert('Data gagal ditambahkan'); window.location.href='index';</script>";
	// 	}
	// }

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

	public function getKd(){
		$query = $this->conn->prepare("SELECT MAX(kd_reservation) FROM reservation");
		$query->execute();
		$r = $query->fetch();
		$kd = substr($r[0],2);
	    $tambah=$kd+1; 
	        if($tambah < 10)
	            $kd_="RS000".$tambah;
	        else
	            $kd_="RS00".$tambah;
	        
        return $kd_;
	}

	public function selectCount($table){
		$query = $this->db->prepare("SELECT * FROM $table");
		$query->execute();
		$data = $query->rowCount();
		return $data;
	}

}

?>