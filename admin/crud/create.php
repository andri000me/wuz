<?php
session_start();
require('../models/general.php');
require('../models/mtransportation.php');
$db = new database();
$crud = new crud();
$trans = new transportation();

   function clear(){
        if (isset($_SESSION['barang'])) {
            foreach ($_SESSION['barang'] as $key => $val) {
                unset($_SESSION['barang'][$key]);
            }
            unset($_SESSION['barang']);
        }
    }

    function clearz(){
    if (isset($_SESSION['jual'])) {
        foreach ($_SESSION['jual'] as $key => $val) {
            unset($_SESSION['jual'][$key]);
        }
            unset($_SESSION['jual']);
            unset($_SESSION['final']);
            unset($_SESSION['total']);
            unset($_SESSION['harga']);
            }
    }

if(isset($_GET['b'])){
    $br = htmlentities($_POST['br']);
    $nm = htmlentities($_POST['nm']);
    $hb = htmlentities($_POST['hb']);
    $hj = htmlentities($_POST['hj']);
    $st = htmlentities($_POST['st']);
    $kk = htmlentities($_POST['kk']);
    $ks = htmlentities($_POST['ks']);

    $qry = $d->prepare("select max(kd_barang) from barang where kd_barang LIKE '$kk%'");
    $qry->execute();
    $r = $qry->fetch();
    $kd = substr($r[0],2);
    $tambah=$kd+1; 
        if($tambah < 10)
            $kd_=$kk."00".$tambah;
        else
            $kd_=$kk."0".$tambah;

    $data ="'$kd_','$br','$nm','$hb','$hj','$st','$kk','$ks'";
    $crud->insert('barang',$data);
}

if(isset($_GET['u'])){
    $kd = htmlentities($_POST['kd']);
    $nm = htmlentities($_POST['nm']);
    $lv = htmlentities($_POST['lv']);
    $un = htmlentities($_POST['un']);
    $pw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
    
    $data ="'$kd','$nm','$un','$pw','$lv' ";
    $crud->insert('user',$data);
}

if(isset($_GET['c'])){
    $kd = htmlentities($_POST['kd']);
    $nm = htmlentities($_POST['nm']);
    $alm = htmlentities($_POST['alm']);
    $telp = htmlentities($_POST['telp']);
    $jk = htmlentities($_POST['jk']);
    $em = htmlentities($_POST['em']);
    $un = htmlentities($_POST['un']);
   $pw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
        
    $data =" '$kd','$nm','$un','$pw','$em','$alm','$telp','$jk','0'";
    $query = $d->prepare("INSERT INTO customer VALUES ($data)");
        if($query->execute()){
            echo "<script>alert('Data berhasil ditambahkan'); window.history.go(-1);</script>";
        }
        else{
            echo "<script>alert('Data gagal ditambahkan'); window.history.go(-1);</script>";
        }
}

if(isset($_GET['s'])){
    $kd = htmlentities($_POST['kd']);
    $kd_trans = htmlentities($_POST['kd_trans']);
    
    $data ="'null','$kd','$kd_trans' ";
    $crud->insert('seat',$data);
}

elseif(isset($_GET['trans'])){
    $kd = htmlentities($_POST['kd']);
    $nm = htmlentities($_POST['nm']);
    $seat = htmlentities($_POST['seat_qty']);
    $kd_tt = htmlentities($_POST['kd_tt']);
    $desc = htmlentities($_POST['desc']);
    $kdd = $kd_tt.$kd;
    $kddd = $trans->getKd($kdd);
    $kd_ = $kdd.$kddd;
    
    $data ="'$kd_','$nm','$seat','$kd_tt','$desc' ";
    $crud->insert('transportation',$data);
}

elseif(isset($_GET['place'])){
    $kd = htmlentities($_POST['kd']);
    $nm = htmlentities($_POST['nm']);
    $jn = htmlentities($_POST['jn']);
    $kt = htmlentities($_POST['kt']);
    $alm = htmlentities($_POST['alm']);
    
    $data ="'$kd','$nm','$jn','$kt','$alm' ";
    $crud->insert('place',$data);
}

elseif(isset($_GET['rute'])){
    $kd = htmlentities($_POST['kd']);
    $jam = htmlentities($_POST['jam']);
    $asal = htmlentities($_POST['asal']);
    $tujuan = htmlentities($_POST['tujuan']);
    $harga = htmlentities($_POST['harga']);
    $trans = htmlentities($_POST['trans']);
    
    $data ="'$kd','$jam','$asal','$tujuan','$harga','$trans' ";
    $crud->insert('rute',$data);
}

elseif(isset($_GET['sp'])){
    $qry = $d->prepare("select max(kd_simpanan) from simpanan where kd_kategori_simpanan='K1'");
    $qry->execute();
    $rr = $qry->fetch();
    $kd = substr($rr[0],2,4);
    $tambah=$kd+1; 
        if($tambah < 10)
            $kd_="SP000".$tambah;
        else
            $kd_="SP00".$tambah;
    $tgl = date('Y-m-d h:i:s');
    if (isset($_SESSION['bayar'])) {
        foreach ($_SESSION['bayar'] as $key => $val) {

        $data ="'$kd_','K1','$key','$tgl','50000','$_SESSION[kd_user]','null'";
        $query = $d->prepare("INSERT INTO simpanan VALUES ($data)");
            if($query->execute()){
                header('location:../reports/bukti?id='.$kd_.'');
                unset($_SESSION['bayar']);
            }
            else{
                header('location:../index');
            }
        }
        }
}

elseif(isset($_GET['sw'])){
    $qry = $d->prepare("select max(kd_simpanan) from simpanan where kd_kategori_simpanan='K2'");
    $qry->execute();
    $rr = $qry->fetch();
    $kd = substr($rr[0],2,4);
    $tambah=$kd+1; 
        if($tambah < 10)
            $kd_="SW000".$tambah;
        else
            $kd_="SW00".$tambah;
    $tgl = date('Y-m-d h:i:s');
    $bln = date('F Y');
    if (isset($_SESSION['bayar'])) {
        foreach ($_SESSION['bayar'] as $key => $val) {

        $data ="'$kd_','K2','$key','$tgl','20000','$_SESSION[kd_user]','$bln'";
        $query = $d->prepare("INSERT INTO simpanan VALUES ($data)");
            if($query->execute()){
                header('location:../reports/bukti?id='.$kd_.'');
                unset($_SESSION['bayar']);
            }
            else{
                header('location:../index');
            }
        }
        }
}

elseif(isset($_GET['ss'])){
    $qry = $d->prepare("select max(kd_simpanan) from simpanan where kd_kategori_simpanan='K3'");
    $qry->execute();
    $rr = $qry->fetch();
    $kd = substr($rr[0],2,4);
    $tambah=$kd+1; 
        if($tambah < 10)
            $kd_="SS000".$tambah;
        else
            $kd_="SS00".$tambah;
    $nom = $_POST['nominal'];
    $kd = $db->returnKd('simpanans');
    $tgl = date('Y-m-d h:i:s');
    if (isset($_SESSION['bayar'])) {
        foreach ($_SESSION['bayar'] as $key => $val) {

        $data ="'$kd_','K3','$key','$tgl','$nom','$_SESSION[kd_user]',''";
        $query = $d->prepare("INSERT INTO simpanan VALUES ($data)");
            if($query->execute()){
                header('location:../reports/bukti?id='.$kd_.'');
                unset($_SESSION['bayar']);
            }
            else{
                header('location:../index');
            }
        }
        }
}

elseif(isset($_GET['pj'])){
    $kd_ = $db->returnKd('pinjaman');
    $kd = htmlentities($_POST['kd']);
    $nom = htmlentities($_POST['nom']);
    $lm = htmlentities($_POST['lm']);
    $bn = 125/100;
    $wkt = date('Y-m-d h:i:s');
    $tgl = date('Y-m-d');
    $lama = "+".$lm." month";
    $tgl2 = date('Y-m-d', strtotime($lama, strtotime($tgl)));

    $bersih = $nom/$lm;
    $kotor = ($bersih*$bn)/100;
    $kotorr = $kotor*$lm+$nom;

    if (isset($_SESSION['bayar'])) {
        foreach ($_SESSION['bayar'] as $key => $val) {

        $data ="'$kd_','$wkt','$key','$_SESSION[kd_user]','$nom','$tgl','$tgl2','$lm','$bn','$kotorr','null','BL'";
        $query = $d->prepare("INSERT INTO pinjaman VALUES ($data)");
            if($query->execute()){
                header('location:../reports/bukti_pj?id='.$kd_.'');
                unset($_SESSION['bayar']);
            }
            else{
                header('location:../index');
            }
        }
        }
}

elseif(isset($_GET['ang'])){
    $kd_ = $db->returnKd('angsuran');
    $kd = htmlentities($_POST['kd']);
    $nom = htmlentities($_POST['nom']);
    $urut = htmlentities($_POST['urut']);
    $lm = htmlentities($_POST['lm']);
    $ba = htmlentities($_POST['ba']);
    $angs = htmlentities($_POST['angs']);
    $tgl = date('Y-m-d');
    $tgll = date('Y-m-d h:i:s');

    if (isset($_SESSION['bayar'])) {
        foreach ($_SESSION['bayar'] as $key => $val) {

        if($urut==1){
        $data ="'$kd_','$key','$lm','$ba','BL'";
        $query = $d->prepare("INSERT INTO angsuran VALUES ($data)");
            if($query->execute()){
                $data_ = "'null','$kd_','$tgll','$urut','$ba'";
                $query_ = $d->prepare("INSERT INTO angsuran_det VALUES ($data_)");

                if($query_->execute()){
                header('location:../reports/bukti_pj?id='.$kd_.'');
                unset($_SESSION['bayar']);
                }
                else{
                    echo "gaggal";
                }
            }
            else{
                header('location:../index');
            }
        }
        else{
            $query = $d->prepare("SELECT kd_angsuran FROM angsuran where kd_peminjaman='$kd'");
            $query->execute();
            $dta = $query->fetch();

            $qr = $d->prepare("SELECT max(angsuran_ke) FROM angsuran_det where kd_angsuran='$angs'");
            $qr->execute();
            $dtz = $qr->fetch();

            if($dtz[0]<=$dta[2]){
                echo "<script>alert('Sudah lunas');</script>";
            }
            else{
            $urutan = $dtz[0]+1;

            $dataa ="'null','$angs','$tgll','$urutan','$ba'";
            $ins = $d->prepare("INSERT INTO angsuran_det VALUES ($dataa)");
            if($ins->execute()){
                header('location:../reports/bukti_pj?id='.$kd_.'');
                unset($_SESSION['bayar']);
            }
            else{
                echo "gagal";
                echo $dta[0];
            }
        }

        }


        }
}
}

elseif(isset($_GET['tt'])){
	$kd = htmlentities($_POST['kd']);
    $nm = htmlentities($_POST['desk']);

    $data ="'$kd','$nm'";
    $crud->insert('transportation_type',$data);
}

elseif(isset($_GET['bm'])){

    $time = " ".date('h:i:s');
    $kd = htmlentities($_POST['kd']);
    $tgl = htmlentities($_POST['tgl']).$time;  
    $ks = htmlentities($_POST['ks']);
    $ket = htmlentities($_POST['ket']);
    $data = "'$kd','$tgl','$ks','$ket','$_SESSION[total]'";
        $db->insert('penerimaan',$data);
            foreach ($_SESSION['barang'] as $key => $value) {
                $data_="'null', '$kd', '$key', '$value', '$_SESSION[harga]'";
                $crud->insert('penerimaan_item',$data_);
            }       
    clear();

}
elseif(isset($_GET['br'])){
    $time = " ".date('h:i:s');
    $kd = htmlentities($_POST['kd']);
    $tgl = htmlentities($_POST['tgl']).$time;  
    $ks = htmlentities($_POST['ks']);
    $ket = htmlentities($_POST['ket']);
    $data = "'$kd','$tgl','$ks','$ket'";
        $crud->insert('retur',$data);
            foreach ($_SESSION['barang'] as $key => $value) {
                $data_="'null', '$kd', '$key', '$value'";
                $db->insert('retur_item',$data_);
            }               
    clear();
}

elseif(isset($_GET['pjl'])){
    $time = " ".date('h:i:s');
    $kd_trans = htmlentities($_POST['kd_trans']);
    $pelanggan = htmlentities($_POST['pelanggan']);
    $tgl = htmlentities($_POST['tgl']).$time;  
    $final = htmlentities($_POST['final']);
    $kembali = htmlentities($_POST['kembali']);
    $user = $_SESSION['kd_user'];

        if(empty($tgl)){
            echo "<script> alert('Form masih ada yang kosong!');</script>";
        } else{

            if($kembali < 0){
                $data = "'$kd_trans','$tgl','$final','$user','$pelanggan','Hutang','$kembali'";
                $crud->insert('penjualan',$data);

                    foreach ($_SESSION['jual'] as $key => $value) {
                        $qry = $db->selectID('barang',$key);
                        $r = $qry->fetch();

                        $data_ = "'null','$kd_trans','$key','$value','$_SESSION[harga]'";
                        $crud->insert('penjualan_item',$data_);
                        echo "<script> alert('Data telah tersimpan');";
                        echo "</script>";
                        header('location:../reports/nota?id='.$kd_trans.'');
                    } 
            clearz();             
            }

            elseif($kembali >= 0){
                $data = "'$kd_trans','$tgl','$final','$user','$pelanggan','Lunas','0'";
                $crud->insert('penjualan',$data);

                    foreach ($_SESSION['jual'] as $key => $value) {
                        $data_ = "'null','$kd_trans','$key','$value','$_SESSION[harga]'";
                        $crud->insert('penjualan_item',$data_);
                        echo "<script> alert('Data telah tersimpan');";
                        echo "</script>";
                        header('location:../reports/nota?id='.$kd_trans.'');
                    } 
            clearz();             
            }
        }
}

?>