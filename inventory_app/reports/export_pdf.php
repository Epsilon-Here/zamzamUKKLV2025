<?php
require "../config.php";
require __DIR__ . "/vendor/fpdf/fpdf.php";

// === SETTINGS ===
$title = "📦 Inventory Report";
$dateGenerated = date("d M Y - H:i");

// ==== FOOTER ====
class PDF extends FPDF {
    function Footer(){
        $this->SetY(-12);
        $this->SetFont('Times','I',8);
        $this->Cell(0,10,"Page ".$this->PageNo()."/{nb}",0,0,'C');
    }
}

// ==== START PDF ====
$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',11);

// ==== HEADER ====
$pdf->SetFont('Times','B',18);
$pdf->Cell(0,10,$title,0,1,'C');

$pdf->SetFont('Times','',11);
$pdf->Cell(0,6,"Generated: $dateGenerated",0,1,'C');
$pdf->Ln(5);

// ==== GET DATA ====
$stmt = $pdo->prepare("SELECT id, code, name, stock, created_at FROM items ORDER BY id ASC");
$stmt->execute();
$data = $stmt->fetchAll();

// === NO DATA ===
if (!$data){
    $pdf->Ln(10);
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(0,10,"⚠ No data found!",0,1,'C');
    $pdf->Output();
    exit;
}

// ===== TABLE HEADER =====
$pdf->SetFont('Times','B',11);
$pdf->SetFillColor(220,220,220);

$columns = [
    ["No",10],
    ["Item Code",40],
    ["Item Name",60],
    ["Stock",25],
    ["Created At",50]
];

foreach ($columns as $col){
    $pdf->Cell($col[1],10,$col[0],1,0,'C',true);
}
$pdf->Ln();

// ===== TABLE CONTENT =====
$pdf->SetFont('Times','',10);

$no = 1;
foreach($data as $row){
    $pdf->Cell(10,8,$no++,1,0,'C');
    $pdf->Cell(40,8,$row['code'],1,0,'L');
    $pdf->Cell(60,8,$row['name'],1,0,'L');
    $pdf->Cell(25,8,$row['stock'],1,0,'C');
    $pdf->Cell(50,8,$row['created_at'],1,1,'C');
}

$pdf->Ln(5);
$pdf->SetFont('Times','I',9);
$pdf->Cell(0,10,"Generated automatically — © ".date("Y"),0,1,'C');

$pdf->Output();
