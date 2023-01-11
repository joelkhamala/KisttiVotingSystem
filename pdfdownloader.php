
<?php
session_start();
include "config.php";
require('fpdf/fpdf.php');
if (isset($_GET['id'])) 
{

class PDF extends FPDF
{
// Page header
function Header()
{
	$this->Image('images/logo.png',80,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(60);
    // Title
    $this->Cell(70,60,'KISIWA TTI ONLINE VOTING SYSTEM',5,0,'C');
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
    $this->Cell(0,-20,"KISIWA TTI VOTING SYSTEM",0,0);
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
	$id = $_GET['id'];
	$qry = mysqli_query($con, "SELECT * FROM candidates WHERE candidate_id = '$id'");
	$row = mysqli_fetch_array($qry);
	if($qry)
	{
		$pdf->Cell(0,10," ",0,1);
		$pdf->Cell(0,10," ",0,1);
		$pdf->Cell(0,-10,"CANDIDATE PERSONAL DETAILS:",0,1);
			$pdf->SetFillColor(170, 170, 170); //gray
			$pdf->setFont("Arial","B","9");
			$pdf->setXY(10, 50); 
			$pdf->Cell(35, 10, "Names", 1, 0, "L", 1);   // CHANGE THESE TO REPRESENT YOUR FIELDS
			$pdf->Cell(33, 10, "Date of Birth", 1, 0, "L", 1);
			$pdf->Cell(20, 10, "Residence", 1, 0, "L", 1);
			$pdf->Cell(10, 10, "Course", 1, 0, "L", 1);
			$pdf->Cell(16, 10, "Department", 1, 0, "L", 1);
			$pdf->Cell(30, 10, "Category", 1, 0, "L", 1);
 
			$y = 60;
			$x = 10;  
			 
			$pdf->setXY($x, $y);
			 
			$pdf->setFont("Arial","","9");
		$pdf->Cell(35, 8, $row['candidate_name'], 1);   // CHANGE THESE TO REPRESENT YOUR FIELDS
        $pdf->Cell(33, 8, $row['date_of_birth'], 1);
        $pdf->Cell(20, 8, $row['residence'], 1);
        $pdf->Cell(10, 8, $row['course'], 1);
        $pdf->Cell(16, 8, $row['candidate_department'], 1);
		$pdf->Cell(30, 8, $row['candidate_category'],1);
		$pdf->Cell(0,10," ",0,1);

	}

		$pdf->Cell(0,10,"STUDENT USE:",0,1);
		$pdf->Cell(20,10,"CANDIDATE SIGN HERE: ___________________",0,1);
		$pdf->Cell(0,10,"FOR OFFICIAL USE ONLY:",0,1,'B');
		$pdf->Cell(20,10,"OFFICIAL SIGN HERE: ___________________",0,1);
		$pdf->Cell(0,10,"DATE OF DOWNLOAD: ".$date.".",0,1);
		$pdf->Output();
    
	}
?>