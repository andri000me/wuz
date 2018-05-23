<?php

$host = "localhost";
$dbname="db_ksp";
$un = "root";
$pw="";
$d = new PDO("mysql:host={$host};dbname={$dbname}", $un,$pw);

class database{

	public function __construct(){
		$host = "localhost";
		$dbname="db_ksp";
		$un = "root";
		$pw="";

		$this->db = new PDO("mysql:host={$host};dbname={$dbname}", $un,$pw);
	}

	public function selectAll($table){
		$query = $this->db->prepare("SELECT * FROM $table");
		$query->execute();
		$data = $query->fetchAll();
		return $data;
	}

	public function selectAllLimit($table,$start,$sum){
		$query = $this->db->prepare("SELECT * FROM $table limit $start,$sum");
		$query->execute();
		$data = $query->fetchAll();
		return $data;
	}

	public function selectAllLim($table,$start,$sum,$kat){
		$query = $this->db->prepare("SELECT * FROM $table where kd_kategori_simpanan='$kat' limit $start,$sum");
		$query->execute();
		$data = $query->fetchAll();
		return $data;
	}

	public function selectCount($table){
		$query = $this->db->prepare("SELECT * FROM $table");
		$query->execute();
		$data = $query->rowCount();
		return $data;
	}

	public function selectCS($kat){
		$query = $this->db->prepare("SELECT * FROM simpanan where kd_kategori_simpanan='$kat'");
        $query->execute();
        $data = $query->rowCount();
		return $data;
	}

	public function selectID($table,$id){
		$kd = 'kd_'.$table;
		$sql="SELECT * FROM $table where $kd = '$id'";
		$query= $this->db->query($sql);
		return $query;
	}

	public function selectKr($table,$data){
		$query = $this->db->prepare("SELECT * FROM $table where $data");
        $query->execute();
        $data = $query->rowCount();
		return $data;
	}

	public function select($table,$data){
		$query = $this->db->prepare("SELECT * FROM $table where $data");
		$query->execute();
		$data = $query->fetchAll();
		return $data;
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

	public function returnKd($table){
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
                elseif($table=='simpananp')
                	$kd_="K000".$tambah;
                elseif($table=='simpananw')
                	$kd_="W000".$tambah;
                elseif($table=='simpanans')
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
                elseif($table=='simpananp')
                	$kd_="K00".$tambah;
                elseif($table=='simpananw')
                	$kd_="W00".$tambah;
                elseif($table=='simpanans')
                	$kd_="S00".$tambah;
                elseif($table=='pinjaman')
                	$kd_="PJ00".$tambah;
                elseif($table=='angsuran')
                	$kd_="AN00".$tambah;
            }
        return $kd_;
	}

	public function insert($table,$var){
		$query = $this->db->prepare("INSERT INTO $table VALUES ($var)");
		if($query->execute()){
			echo "<script>alert('Data berhasil ditambahkan'); window.history.go(-1);</script>";
		}
		else{
			echo "<script>alert('Data gagal ditambahkan'); window.history.go(-1);</script>";
		}
	}

	public function update($table,$var,$id){
		$kd = "kd_".$table;
		$query = $this->db->prepare("UPDATE $table SET $var WHERE $kd = '$id'");
		if($query->execute()){
			echo "<script>alert('Data berhasil diupdate'); window.location.href='../".$table."';</script>";
		}
		else{
			echo "<script>alert('Data gagal diupdate'); window.history.go(-1);</script>";
		}
	}

	public function delete($table,$id){
		$kd = "kd_".$table;
		$query = $this->db->prepare("DELETE FROM $table where $kd ='$id'");
		if($query->execute()){
			header("location:../".$table);
		}
		else {
			echo "<script>alert('Aduh Gagal'); window.href.location='index';</script>";
		}
	}

	public function login($un,$pw,$lv){
		try{
			$query = $this->db->prepare("SELECT * FROM pegawai where username = ? && jabatan = ?");
			$query->bindParam(1,$un);
			$query->bindParam(2,$lv);
			$query->execute();
			$data = $query->fetch();

			if($query->rowCount() > 0){
				if(password_verify($pw, $data['password'])){
					$_SESSION['kd_user'] = $data[0];
					$_SESSION['username'] = $un;
					$_SESSION['nama'] = $data[1];
					$_SESSION['level'] = $lv;
					if($lv == 'admin' || $lv == 'teller'){
						header('location:admin');
					}
				}
				else{
					echo "<script>alert('Password Salah'); window.location.href=window.history.go(-1); </script>";
				}
			}
			else{
				echo "<script>alert('Username Tidak Terdaftar'); window.location.href=window.history.go(-1); </script>";
			}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function logged(){
		if(isset($_SESSION['nama'])){
			return true;
		}
	}

	public function logout(){
		if($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'teller'){
			echo "<script>alert('Anda Telah Keluar dari Akun'); window.location.href='../index';</script>";
		} 
		unset($_SESSION['username']);
		unset($_SESSION['nama']);
		unset($_SESSION['level']);
		session_destroy();
		
	}

	public function fetchFoto(){
		$query= $this->db->prepare("select foto from pegawai where username = '$_SESSION[username]'");
		$query->execute();
		$data = $query->fetch();
		echo $data[0];
	}

	public function sum(){
		$query= $this->db->prepare("select sum(nominal) from simpanan");
		$query->execute();
		$data = $query->fetch();
		echo $data[0];
	}

	public function summ(){
		$query= $this->db->prepare("select sum(nominal) from bunga_pinjam");
		$query->execute();
		$data = $query->fetch();
		echo $data[0];
	}

	public function checkFoto(){
		$query= $this->db->prepare("select foto from pegawai where username = '$_SESSION[username]'");
		$query->execute();
		$data = $query->fetch();
		if($data[0]==null){
			return true;
		}
	}

	public function searchJadwal($key){
		$query = $this->db->prepare("SELECT * FROM jadwal 
				JOIN kota AS a ON jadwal.`asal` = a.`id_kota`
				JOIN kota AS b ON jadwal.`tujuan` = b.`id_kota`
				WHERE a.`nm_kota` LIKE '%".$key."%' 
				OR b.`nm_kota` LIKE '%".$key."%'");
		$query->execute();
		$data = $query->fetchAll();
		return $data;
	}
}

?>