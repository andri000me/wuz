<?php

class transportation extends database{

	public function __construct(){
		parent::__construct();
	}

	public function getKd($var){
		$query = $this->db->prepare("SELECT MAX(kd_transportation) FROM transportation where kd_transportation LIKE '$var%'");
		$query->execute();
		$r = $query->fetch();
		$kd = substr($r[0],4);
	    $tambah=$kd+1; 
	        if($tambah < 10)
	            $kd_="0".$tambah;
	        else
	            $kd_="".$tambah;
	        
        return $kd_;
	}

	public function selectAllLimit($var,$start,$sum){
		$query = $this->db->prepare("SELECT * FROM transportation where kd_tt LIKE '%$var' limit $start,$sum");
		$query->execute();
		$data = $query->fetchAll();
		return $data;
	}

	public function selectAirplane(){
		$sql="SELECT * FROM transportation where kd_tt LIKE '%P' ";
		$query= $this->db->query($sql);
		return $query;
	}

	public function selectTrain(){
		$sql="SELECT * FROM transportation where kd_tt LIKE '%T' ";
		$query= $this->db->query($sql);
		return $query;
	}

	public function selectCount($var){
		$query = $this->db->prepare("SELECT * FROM transportation where kd_tt LIKE '%$var'");
		$query->execute();
		$data = $query->rowCount();
		return $data;
	}

}

?>