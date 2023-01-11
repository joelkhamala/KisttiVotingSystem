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
$pdf->SetTitle('Online Results List');
	$qry = mysqli_query($con, "SELECT * FROM candidates");
	$date = date('D, d, M Y');
	$br = "<br>";
	if($qry)
	{
		$y = 50;
		$x = 8;
		$i = 1;
		while($row = mysqli_fetch_array($qry))
		{
		$pdf->Cell(0,8," ",0,1);
		$pdf->Cell(0,8," ",0,1);
		$pdf->setFont("Arial","B","9");
			$pdf->SetFillColor(170, 170, 170); //gray
			$pdf->setFont("Arial","B","9");
			$pdf->setXY(8, 50); 
			$pdf->Cell(10, 8, "SNo.", 1, 0, "L", 1);
			$pdf->Cell(30, 8, "Name", 1, 0, "L", 1);   // CHANGE THESE TO REPRESENT YOUR FIELDS
			$pdf->Cell(25, 8, "Level of Study", 1, 0, "L", 1);
			$pdf->Cell(13, 8, "Course", 1, 0, "L", 1);
			$pdf->Cell(25, 8, "Department", 1, 0, "L", 1);
			$pdf->Cell(40, 8, "Candidate Category", 1, 0, "L", 1);
			$pdf->Cell(15, 8, "Hostel", 1, 0, "L", 1);
			$pdf->Cell(30, 8, "Registration Date", 1, 0, "L", 1);
            $pdf->Cell(10, 8, "Votes", 1, 0, "L", 1);
 
			$y = $y + 8;
			$x = $x + 0;  
			 
			$pdf->setXY($x, $y);
			 
		$pdf->setFont("Arial","","9");
		$pdf->Cell(10, 8, $i, 1);
		$pdf->Cell(30, 8, $row['candidate_name'], 1);   // CHANGE THESE TO REPRESENT YOUR FIELDS
        $pdf->Cell(25, 8, $row['level_of_study'], 1);
        $pdf->Cell(13, 8, strtoupper($row['course_name']), 1);
        $pdf->Cell(25, 8, $row['candidate_department'], 1);
        $pdf->Cell(40, 8, $row['candidate_category'], 1);
        $pdf->Cell(15, 8, ucwords(str_replace("_", " ",$row['residence'])), 1);
        $pdf->Cell(30, 8, $row['date_of_birth'], 1);
        $pdf->Cell(10, 8, $row['votes'], 1);
		$pdf->Cell(0,10," ",0,1);
		$i++;
	}
	    $pdf->setFont("Helvetica","","9");
		$pdf->Cell(20,10,"CANDIDATES USE:",0,1);
		$pdf->Cell(20,10,"CANDIDATE SIGN HERE: ___________________",0,1);
		$pdf->Cell(0,10,"FOR OFFICIAL USE ONLY:",0,1,'B');
		$pdf->Cell(20,10,"OFFICIAL SIGN HERE: ___________________",0,1);
		$pdf->Cell(0,10,"DATE OF DOWNLOAD: ".$date.".",0,1);
		$pdf->Output('Kisiwa e-voting '.date('F Y').' poll results.pdf','I');
    
	}
	
?>