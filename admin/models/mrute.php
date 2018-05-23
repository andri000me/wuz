<?php
class rute extends database{
	public function __construct(){
		parent::__construct();
	}
	public function getKd(){
		$query = $this->db->prepare("SELECT MAX(kd_rute) FROM rute");
		$query->execute();
		$data = $query->fetch();
		$kode=substr($data[0],2); 
        $tambah=$kode+1; 
            if($tambah < 10){
                	$kd_="RT000".$tambah;
            }else{
                	$kd_="RT00".$tambah;
            }
        echo $kd_;
	}
}

?>