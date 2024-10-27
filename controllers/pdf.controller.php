<?php
// include class
require_once('../class/app.php');
$model = new app;
session_start();
$qr = (isset($_GET['qrd']) ? $_GET['qrd'] : null);
$idname = $_SESSION['nombre'];
$img = $model->getInfoCatPDF($idname)['logojpg'];
$adress = $model->getInfoCatPDF($idname)['locales'];
$telefono = $model->getInfoCatPDF($idname)['phone'];

$newCon = $model->extra();;
$sql = "SELECT * FROM `data` WHERE session ='$idname'";
$query = mysqli_query($newCon, $sql);
$jsonArray = array();


require('fpdf/fpdf.php');

// create document
$pdf = new FPDF();
$pdf->AddPage();

// config document
$pdf->SetTitle('Catalogo general');
$pdf->SetAuthor('WebFlayer');
$pdf->SetCreator('FPDF Maker');

// add title

$pdf->Image($img, null, null, 50);

$pdf->Ln(2);

// add text
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 7, utf8_decode($adress), 0, 1);
$pdf->Ln();
$pdf->MultiCell(0, 7, utf8_decode('Contacto: ') . $telefono, 0, 1);
$pdf->Ln(2);
$pdf->MultiCell(120, 7, utf8_decode('¡Tienda digital!'), 0, 'L');
$pdf->Ln(2);
$pdf->Image($qr, 12, null, null, 24);
$pdf->Ln(1);

while ($array = mysqli_fetch_array($query)) {
    /* $pdf->Cell(100, 40, $array['id'].". ".utf8_decode($array['keyy']) . " " . utf8_decode($array['var']), 1, 0, 'L'); */
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->SetTextColor(255, 104, 107);
    $pdf->Ln(4);
    $pdf->MultiCell(120, 10,  utf8_decode($array['keyy']) . " " . utf8_decode($array['var']), '0', 'L');
    $pdf->Ln(4);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(20, 40, "$" . utf8_decode($array['number']), 0, 0, 'C');
    $pdf->Cell(50, 55, "", 0, 0, 'C');
    if ($array['link'] == null or empty($array['link'])) {
        $pdf->Image("../dashboard/views/img/box.png", null, null, 55);
    } else {
        $pdf->Image($array['link'], null, null, 40);
    }

    $pdf->Ln(4);
   
        $pdf->MultiCell(188, 10, utf8_decode($array['dscr']), 'B', 'L');
    

    $pdf->Ln(3);
}


// add image


// output file
$pdf->Output('', 'fpdf-complete.pdf');
