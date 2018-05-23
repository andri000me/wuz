<?php
$total = 0;
if(isset($_SESSION['rute_id'])){

		$query = $db->selectID('rute',$_SESSION['rute_id']);
		$data = $query->fetch();

		$jumlah_harga = $data['price'] * $_SESSION['jml_penumpang'];
		$_SESSION['id_transportasi'] = $data[5];
		$_SESSION['harga'] = $data['price'];
		$_SESSION['jumlah_harga'] = $jumlah_harga;
		// $net = $jumlah_harga - ($val * (($rs[5] * $rs[4])/100));
		// $total += $net;
	}
	
?>

		<!-- <tr>
			<td>  //$data[1]?> </td>
			<td>  // $data[2]?> </td>
			<td> <// number_format($_SESSION['jml_penumpang']); ?> </td>
			<td>  // $data[3]?> %</td>
			<td>  //number_format($jumlah_harga); ?> </td>
			<td> </td>
			<td><a href="cart.php?act=plus&amp;buku_id=<?php //echo $key; ?>&amp;ref=index.php"><i class="fa fa-plus"></i></a></td>
			<td><a href="cart.php?act=min&amp;buku_id=<?php //echo $key; ?>&amp;ref=index.php"><i class="fa fa-minus"></i></a> </td>
			<td><a href="cart.php?act=del&amp;buku_id=<?php //echo $key; ?>&amp;ref=index.php"><i class="fa fa-remove"></i></a> </td>
		</tr> -->

<?php
//}
    ?>