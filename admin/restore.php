<form enctype="multipart/form-data" method="post" class="form-horizontal">
    <div class="form-group">
        <label class="col-sm-3 control-label">File Database (*.sql)</label>
        <div class="col-sm-7">
            <input type="text" name="nip" class="form-control" maxlength="12">
            <input type="file" name="datafile" size="30" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-7">
            <button type="submit" name="restore" class="btn btn-danger">Restore Database</button>
        </div>
    </div>
</form>
<?php
    if(isset($_POST['restore'])){
        $koneksi=mysql_connect("localhost","root","");
        mysql_select_db("db_ksp",$koneksi);
        $nama_file=$_FILES['datafile']['name'];
        $ukuran=$_FILES['datafile']['size'];
        if ($nama_file==""){
            echo "Fatal Error";
        }
        else{
        //definisikan variabel file dan alamat file
            $uploaddir='./restore/';
            $alamatfile=$uploaddir.$nama_file;
            if (move_uploaded_file($_FILES['datafile']['tmp_name'],$alamatfile)){
                $filename = './restore/'.$nama_file.'';                                    
                $templine = '';
                $lines = file($filename);
                    foreach ($lines as $line){
                        if (substr($line, 0, 2) == '--' || $line == '')
                        continue;
                        $templine .= $line;
                        if (substr(trim($line), -1, 1) == ';'){
                            mysql_query($templine) or print('Error performing query ' .$templine .'\: '.mysql_error().'');
                            $templine = '';
                        }
                    }
                echo "Restore Database Telah Berhasil, Silahkan dicek !";
            }
            else{
                echo "Restore Database Gagal, kode error = ".$_FILES['location']['error'];
            }    
        }
    }
    else{
        unset($_POST['restore']);
    }
?>
<?php

// $dbHost = "localhost";
// $dbUser = "root";
// $dbPass = "";
// $dbName = "db_ksp";

// mysql_connect($dbHost, $dbUser, $dbPass);
// mysql_select_db($dbName);
 
// echo "<h1>Restore Data MySQL</h1>";
 
// echo "DB Name: ".$dbName;

// // form upload file dumo
// echo "<form enctype='multipart/form-data' method='post' action='".$_SERVER['PHP_SELF']."?op=restore'>";

// echo "<input type='hidden' name='MAX_FILE_SIZE' value='20000000'>
// <input name='datafile' type='file'>
// <input name='submit' type='submit' value='Restore'>";
// echo "</form>";

// // proses restore data
// if(isset($_GET['op'])){
// // baca nama file
// $fileName = $_FILES['datafile']['name'];
// // proses upload file

// move_uploaded_file($_FILES['datafile']['tmp_name'], $fileName);

// // membentuk string command untuk restore

// // di sini diasumsikan letak file mysql.exe terletak di direktori C:\AppServ\MySQL\bin

// $string = "C:\AppServ\MySQL\bin\mysql -u".$dbUser." -p".$dbPass." ".$dbName." < ".$fileName;

// // menjalankan command restore di shell via PHP

// exec($string);

// // hapus file dump yang diupload

// unlink($fileName);
// echo "huhuhu";

// }
// else{
//     echo "huah";
// }
?>