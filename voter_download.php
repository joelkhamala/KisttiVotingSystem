<?php
session_start();
include 'config.php';
require('fpdf184/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
	$this->Image('images/logo.png',100,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(70);
    // Title
    $this->Cell(65,65,'KISIWA ONLINE VOTING SYSTEM',5,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    $this->SetX(5);
    $this->Cell(0,20,"Page".$this->PageNo().'/{nb}',0,1);
    $this->SetX(90);
    $this->Cell(0,-20,"KISIWA TTI ONLINE VOTING SYSTEM",0,0);
    
    // Page number\
}
}
// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->SetAuthor('By: Admin');
$pdf->SetTitle('Online Voters List');
	$qry = mysqli_query($con, "SELECT * FROM tbl_users");
	$date = date('D, d, M Y');
	$br = "<br>";
	if($qry)
	{
		$y = 50;
		$x = 15;
		$i = 1;
		while($row = mysqli_fetch_array($qry))
		{
		$pdf->Cell(0,8," ",0,1);
		$pdf->Cell(0,8," ",0,1);
		$pdf->setFont("Arial","B","9");
			$pdf->SetFillColor(170, 170, 170); //gray
			$pdf->setFont("Arial","B","9");
			$pdf->setXY(15, 50); 
			$pdf->Cell(10, 8, "SNo.", 1, 0, "L", 1);
			$pdf->Cell(30, 8, "Voter's Name", 1, 0, "L", 1);   // CHANGE THESE TO REPRESENT YOUR FIELDS
			$pdf->Cell(25, 8, "User Name", 1, 0, "L", 1);
			$pdf->Cell(30, 8, "Admission Number", 1, 0, "L", 1);
			$pdf->Cell(40, 8, "Voter's Email", 1, 0, "L", 1);
			$pdf->Cell(30, 8, "Voter ID", 1, 0, "L", 1);
 
			$y = $y + 8;
			$x = $x + 0;  
			 
			$pdf->setXY($x, $y);
			 
		$pdf->setFont("Arial","","9");
		$pdf->Cell(10, 8, $i, 1);
		$pdf->Cell(30, 8, $row['full_name'], 1);   // CHANGE THESE TO REPRESENT YOUR FIELDS
        $pdf->Cell(25, 8, $row['username'], 1);
        $pdf->Cell(30, 8, $row['admission'], 1);
        $pdf->Cell(40, 8, $row['email'], 1);
        $pdf->Cell(30, 8, $row['voter_id'], 1);
		$pdf->Cell(0,10," ",0,1);
		$i++;
		if($pdf->PageNo()>1)
    {
        $pdf->SetY(-10);
    }
	}
	    $pdf->setFont("Helvetica","","9");
		$pdf->Cell(0,10,"FOR OFFICIAL USE ONLY:",0,1,'B');
		$pdf->Cell(20,10,"OFFICIAL SIGN HERE: ___________________",0,1);
		$pdf->Cell(0,10,"DATE OF DOWNLOAD: ".$date.".",0,1);
		$pdf->Output('Kisiwa e-voting '.date('F Y').' Poll Voter List.pdf','I');
    
	}
	
?>