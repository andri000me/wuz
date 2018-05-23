<?php

class customer extends database{

	public function __construct(){
		parent::__construct();
	}

	public function getKd(){
		$query = $this->db->prepare("SELECT MAX(kd_customer) FROM customer");
		$query->execute();
		$data = $query->fetch();
		$kode=substr($data[0],1); 
        $tambah=$kode+1; 
            if($tambah < 10){
                	$kd_="C0000".$tambah;
            }else{
                	$kd_="C000".$tambah;
            }
        echo $kd_;
	}

}

?>