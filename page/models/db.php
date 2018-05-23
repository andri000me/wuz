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

	public function connection(){
		$host = "localhost";
		$dbname="db_ticketing";
		$un = "root";
		$pw="";

		$this->con = new PDO("mysql:host={$host};dbname={$dbname}", $un,$pw);
		return $this->con;
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
        return $kd_;
	}

	public function login($un,$pw){
		try{
			$query = $this->db->prepare("SELECT * FROM customer where username = ?");
			$query->bindParam(1,$un);
			$query->execute();
			$data = $query->fetch();

			if($query->rowCount() > 0){
				if(password_verify($pw, $data['password'])){
					$_SESSION['kd_cust'] = $data[0];
					$_SESSION['username_cust'] = $un;
					$_SESSION['nama_cust'] = $data['nm_customer'];
					$_SESSION['email'] = $data['email'];

					if(isset($_SESSION['idseat'])){ 
						echo "<script>window.location.href='booking_payment';</script>";
					}
					else{
						echo "<script>window.location.href='index';</script>";}
				}
				else{
					echo "<script>alert('Gagal'); window.location.href='login?log'; </script>";
				}
			}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function isLogged(){
		if(isset($_SESSION['username_cust']) && isset($_SESSION['nama_cust'])){
			return true;
		}
	}

	public function logout(){
		unset($_SESSION['username_cust']);
		unset($_SESSION['nama_cust']);
		unset($_SESSION['kd_cust']);
		unset($_SESSION['email']);
		unset($_SESSION['pembayaran']);
		unset($_SESSION['idseat']);
		unset($_SESSION['total_harga']);
		unset($_SESSION['potong']);
		echo "<script>alert('Anda Telah Keluar dari Akun'); window.location.href='index';</script>";
	}

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

	public function selectAll($table){
		$query = $this->db->prepare("SELECT * FROM $table");
		$query->execute();
		$data = $query->fetchAll();
		return $data;
	}

	public function register($kd,$nm,$un,$pw,$em,$nul,$nulll,$nullll,$nol){
		$query = $this->db->prepare("INSERT INTO customer VALUES ('$kd','$nm','$un','$pw','$em','$nul','$nulll','$nullll','$nol')");
		if($query->execute()){
			if(isset($_SESSION['idseat']) AND isset($_SESSION['jml_penumpang'])){
				$_SESSION['kd_cust'] = $kd;
				$_SESSION['username_cust'] = $un;
				$_SESSION['nama_cust'] = $nm;
				$_SESSION['email'] = $em;

				echo "<script>alert('Selamat! Anda sekarang menjadi Sahabat Wuz. Silakan lanjutkan transaksi Anda'); window.location.href='booking_payment';</script>";
			} else{
				$_SESSION['username_cust'] = $un;
				echo "<script>alert('Selamat! Anda sekarang menjadi Sahabat Wuz. Semoga nyaman dengan pelayanan kami'); window.location.href='login?log';</script>";
			}
		}
		else{
			echo "<script>alert('Maaf, terjadi kesalahan'); window.location.href='login?reg';</script>";
		}
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