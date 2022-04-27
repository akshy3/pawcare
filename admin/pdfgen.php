<?php
session_start();
include('../includes/dbconn.php');
include('fpdf/fpdf.php');

$sql="SELECT * FROM register WHERE id>5";
$data=mysqli_query($con,$sql);


if(isset($_POST['btn_pdf']))
{
    $pdf=new FPDF('p','mm','a4');
    $pdf->SetFont('arial','b','14');
    $pdf->AddPage();
    $pdf->cell('25','10','Name','1','0','C');
    $pdf->cell('40','10','Email','1','0','C');
    $pdf->cell('35','10','Contact','1','1','C');

while($row=mysqli_fetch_assoc($data))
{
    $pdf->cell('25','10', $row['r_name'],'1','0','C');
    $pdf->cell('40','10', $row['email'],'1','0','C');
    $pdf->cell('35','10', $row['phone'],'1','1','C'); 
}


    $pdf->Output();
}
?>