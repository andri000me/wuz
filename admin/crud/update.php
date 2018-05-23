<?php
require('../models/general.php');
$db = new database();
$crud = new crud();


if(isset($_GET['c'])){
    $kd = htmlentities($_POST['kd']);
    $nm = htmlentities($_POST['nm']);
    $alm = htmlentities($_POST['alm']);
    $telp = htmlentities($_POST['telp']);
    $em = htmlentities($_POST['em']);
    $jk = htmlentities($_POST['jk']);

    $data =" nm_customer='$nm',alamat='$alm',telp='$telp',jk='$jk',email='$em' ";
    $crud->update('customer',$data,$kd);
}

elseif(isset($_GET['u'])){
    $kd = htmlentities($_POST['kd']);
    $nm = htmlentities($_POST['nm']);
    $lv = htmlentities($_POST['lv']);
    $un = htmlentities($_POST['un']);

    $data ="nm_user='$nm',username='$un',level='$lv'";
    $crud->update('user',$data,$kd);
}

elseif(isset($_GET['s'])){
    $id = htmlentities($_POST['id']);
    $kd = htmlentities($_POST['kd']);
    $kd_trans = htmlentities($_POST['kd_trans']);
    
    $data =" kd_seat='$kd',kd_transportation='$kd_trans' ";
    $query = $d->prepare("UPDATE seat SET $data WHERE id = '$id'");
    if($query->execute()){
       echo "<script>alert('Data berhasil diupdate'); window.history.go(-2);</script>";
    }
    else{
        echo "<script>alert('Data gagal diupdate'); window.history.go(-1);</script>";
    }
}

elseif(isset($_GET['tt'])){
    $kd = htmlentities($_POST['kd']);
    $nm = htmlentities($_POST['desk']);
    $data ="description='$nm'";
    $query = $d->prepare("UPDATE transportation_type SET $data WHERE kd_tt = '$kd'");
        if($query->execute()){
            echo "<script>alert('Data berhasil diupdate'); window.history.go(-2);</script>";
        }
        else{
            echo "<script>alert('Data gagal diupdate'); window.history.go(-1);</script>";
        }
}

elseif(isset($_GET['trans'])){
    $kd = htmlentities($_POST['kd']);
    $nm = htmlentities($_POST['nm']);
    $seat = htmlentities($_POST['seat_qty']);
    $kd_tt = htmlentities($_POST['kd_tt']);
    $desc = htmlentities($_POST['desc']);
    $data =" nm_trans='$nm',seat_qty='$seat',kd_tt='$kd_tt',description='$desc' ";
    $crud->update('transportation',$data,$kd);
}

elseif(isset($_GET['place'])){
    $kd = htmlentities($_POST['kd']);
    $nm = htmlentities($_POST['nm']);
    $jn = htmlentities($_POST['jn']);
    $kt = htmlentities($_POST['kt']);
    $alm = htmlentities($_POST['alm']);
    $data =" nm_place='$nm',jenis='$jn',kota='$kt',alamat='$alm' ";
    $crud->update('place',$data,$kd);
}

elseif(isset($_GET['rute'])){
    $kd = htmlentities($_POST['kd']);
    $nm = htmlentities($_POST['jam']);
    $jn = htmlentities($_POST['asal']);
    $kt = htmlentities($_POST['tujuan']);
    $alm = htmlentities($_POST['harga']);
    $trans = htmlentities($_POST['trans']);
    $data =" depart_at='$nm',rute_from='$jn',rute_to='$kt',price='$alm', kd_transportation='$trans'";
    $crud->update('rute',$data,$kd);
}

elseif(isset($_GET['j'])){
    $kd = htmlentities($_POST['kd']);
    $nm = htmlentities($_POST['nm']);
    $kk = htmlentities($_POST['kk']);

    $data =" nm_jenis='$nm', kd_kategori='$kk' ";
    $crud->update('jenis',$data,$kd);
}

?>