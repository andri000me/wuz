<?php
mysql_connect('localhost','root',''); mysql_select_db('db_ticketing');
require('../../assets/fpdf/fpdf.php');

$pdf = new FPDF("P","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->Image('../../assets/images/logo-def.png',2,0.8,1.6,1.6);
$pdf->SetX(5);            
$pdf->MultiCell(19.5,0.3,'REKAP DATA WUZ TICKET',0,'L');   
$pdf->SetFont('Arial','B',10);
$pdf->SetX(5);
$pdf->MultiCell(19.5,0.5,'JL. Entah Dimana',0,'L');
$pdf->SetX(5);
$pdf->MultiCell(19.5,0.5,'email : cswuz@gmail.com',0,'L');
$pdf->Line(1,2.6,28.5,2.6);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,2.7,28.5,2.7);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(17.5,0.7,"Laporan Data Customer",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);

$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);

$pdf->Cell(1.5, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Kode Customer', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Nama Customer', 1, 0, 'C');
$pdf->Cell(5.5, 0.8, 'Email', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Username', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
$query=mysql_query("select * from customer");
while($r=mysql_fetch_array($query)){
	$pdf->Cell(1.5, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(3, 0.8, $r[0],1, 0, 'C');
	$pdf->Cell(4, 0.8, $r[1], 1, 0,'C');
	$pdf->Cell(5.5, 0.8, $r[4], 1, 0,'C');
	$pdf->Cell(4, 0.8, $r[2], 1, 1,'C');

	$no++;
}

$pdf->Output("lap_customer.pdf","I");

?>

