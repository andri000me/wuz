<?php

class user extends database{

	public function __construct(){
		parent::__construct();
	}

	public function getKd(){
		$query = $this->db->prepare("SELECT MAX(kd_user) FROM user");
		$query->execute();
		$data = $query->fetch();
		$kode=substr($data[0],1); 
        $tambah=$kode+1; 
            if($tambah < 10){
                	$kd_="U0000".$tambah;
            }else{
                	$kd_="U000".$tambah;
            }
        echo $kd_;
	}

}

?>