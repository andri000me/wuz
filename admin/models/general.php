<?php

$host = "localhost";
		$dbname="db_ticketing";
		$un = "root";
		$pw="";
		$d = new PDO("mysql:host={$host};dbname={$dbname}", $un,$pw);

class database{

	public function __construct(){
		$host = "localhost";
		$dbname="db_ticketing";
		$un = "root";
		$pw="";
		$this->db = new PDO("mysql:host={$host};dbname={$dbname}", $un,$pw);
	}

	public function login($un,$pw,$lv){
		try{
			$query = $this->db->prepare("SELECT * FROM user where username = ? && level = ?");
			$query->bindParam(1,$un);
			$query->bindParam(2,$lv);
			$query->execute();
			$data = $query->fetch();

			if($query->rowCount() > 0){
				if(password_verify($pw, $data['password'])){
					$_SESSION['kd_user'] = $data[0];
					$_SESSION['username_user'] = $un;
					$_SESSION['nama_user'] = $data[1];
					$_SESSION['level_user'] = $lv;
					if($lv == 'SA' || $lv == 'AV'){
						header('location:admin');
					}
				}
				else{
					echo "<script>alert('Password Salah'); window.location.href='index'; </script>";
				}
			}
			elseif($lv != $data[3]){
					echo "<script>alert('Anda salah memasukkan level'); window.location.href='index'; </script>";
			}
			else{
				echo "<script>alert('Sorry, Username Tidak Terdaftar'); window.location.href='index'; </script>";
			}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function logged(){
		if(isset($_SESSION['username_user'])){
			return true;
		}
	}

	public function logout(){
		unset($_SESSION['username_user']);
		unset($_SESSION['nama_user']);
		unset($_SESSION['kd_user']);
		unset($_SESSION['level_user']);
		session_destroy();
		echo "<script>alert('Anda Telah Keluar dari Akun'); window.location.href='../index';</script>";
	}

	// public function checkFoto(){
	// 	$query= $this->d->prepare("select foto from pegawai where username = '$_SESSION[username]'");
	// 	$query->execute();
	// 	$data = $query->fetch();
	// 	if($data[0]==null){
	// 		return true;
	// 	}
	// }

	public function selectCount($table){
		$query = $this->db->prepare("SELECT * FROM $table");
		$query->execute();
		$data = $query->rowCount();
		return $data;
	}

	public function selectAllLimit($table,$start,$sum){
		$query = $this->db->prepare("SELECT * FROM $table limit $start,$sum");
		$query->execute();
		$data = $query->fetchAll();
		return $data;
	}

	public function selectAllLimitt($table,$start,$sum){
		$query = $this->db->prepare("SELECT * FROM $table ORDER BY status_pembayaran DESC limit $start,$sum");
		$query->execute();
		$data = $query->fetchAll();
		return $data;
	}

	public function selectID($table,$id){
		$kd = 'kd_'.$table;
		$sql="SELECT * FROM $table where $kd = '$id'";
		$query= $this->db->query($sql);
		return $query;
	}

	public function select($table,$data){
		$sql="SELECT * FROM $table where $data";
		$query= $this->db->query($sql);
		return $query;
	}

}


class crud extends database{

	public function __construct(){
		parent::__construct();
	}

	public function selectAll($table){
		$query = $this->db->prepare("SELECT * FROM $table");
		$query->execute();
		$data = $query->fetchAll();
		return $data;
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

	public function insertt($table,$var){
		$query = $this->db->prepare("INSERT INTO $table VALUES ($var)");
		if($query->execute()){
			echo "<script>alert('Data berhasil ditambahkan'); window.location.href='seat';</script>";
		}
		else{
			echo "<script>alert('Data gagal ditambahkan'); window.location.href='seat';</script>";
		}
	}

	public function update($table,$var,$id){
		$kd = "kd_".$table;
		$query = $this->db->prepare("UPDATE $table SET $var WHERE $kd = '$id'");
		if($query->execute()){
			echo "<script>alert('Data berhasil diupdate'); window.history.go(-2);</script>";
		}
		else{
			echo "<script>alert('Data gagal diupdate'); window.history.go(-1);</script>";
		}
	}

	public function delete($table,$id){
		$kd = "kd_".$table;
		$query = $this->db->prepare("DELETE FROM $table where $kd ='$id'");
		if($query->execute()){
			echo "<script>alert('Data berhasil dihapus'); window.history.go(-1);</script>";
		}
		else {
			echo "<script>alert('Aduh Gagal'); window.href.location='../index';</script>";
		}
	}


}

?>