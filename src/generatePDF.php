<?php
require './fpdf186/fpdf.php';
include 'connect.php';
session_start();
// check if factuurid is in use
do{
    $factuurid = rand(1000,9999);
    $resultaat =  ->query("SELECT * from tblfacturen where factuurid = '" . $factuurid . "'");
    $row = $resultaat->num_rows;
}while ($row >= 1);
// info voor de factuur
$sql = "SELECT tblgebruikers.naam as achternaam, tblproducten.naam as naam, tblgebruikers.voornaam as voornaam, tblproducten.prijs as prijs FROM tblgebruikers,tblproducten,tblfacturen WHERE tblgebruikers.gebruikerid = '" . $_SESSION["login"] . "' AND tblgebruikers.gebruikerid = tblfacturen.koperid AND tblfacturen.productid = tblproducten.productid";
$resultaat =  ->query($sql);
while ($row = $resultaat->fetch_assoc()) {
        $naam = ''.$row["voornaam"].' '.$row["achternaam"].'';
}
// generatePDF
$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial', '', 16);
$pdf->Cell(40, 10, 'Order ID:');
$pdf->Cell(40, 10, $factuurid);

$pdf_file = 'order_' . $factuurid . '.pdf';
$pdf->Output('F', '../public/orders/' . $pdf_file);

$pdf_data = file_get_contents('./orders/order_' . $factuurid . '.pdf');
$pdf_data = mysqli_real_escape_string(  $pdf_data);

$sql = "update tblfacturen SET factuurpdf ='" . $pdf_data . "' where factuurid = '" . $factuurid . "'";
if ( ->query($sql)) {
    echo "PDF file saved to database.";
} else {
    echo "Error: " . $sql . "<br>" .  ->error;
}

define('EURO', chr(128));

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Helvetica', 'B', 16);
$pdf->Cell(190, 10, 'Factuur 2dekansveilingen', 0, 1, 'C');

$pdf->SetFont('Helvetica', '', 12);
$pdf->Cell(40, 10, 'Naam:', 0, 0);
$pdf->Cell(100, 10, $naam, 0, 1);

$pdf->Cell(40, 10, 'Factuurnummer:', 0, 0);
$pdf->Cell(100, 10, $factuurid, 0, 1);

$invoiceDate = date('d-m-Y');
$pdf->Cell(40, 10, 'Datum:', 0, 0);
$pdf->Cell(100, 10, $invoiceDate, 0, 1);

$pdf->SetFont('Helvetica', 'B', 12);
$pdf->Cell(90, 10, 'Artikel', 1, 0, 'C');
$pdf->Cell(30, 10, 'Prijs', 1, 0, 'C');

$totaal = 0;
$resultaat =  ->query("SELECT tblgebruikers.naam as achternaam, tblproducten.naam as naam, tblgebruikers.voornaam as voornaam, tblproducten.prijs as prijs FROM tblgebruikers,tblproducten,tblfacturen WHERE tblgebruikers.gebruikerid = '" . $_SESSION["login"] . "' AND tblgebruikers.gebruikerid = tblfacturen.koperid AND tblfacturen.productid = tblproducten.productid");
$pdf->SetFont('Helvetica', '', 12);
while($row = $resultaat->fetch_assoc()){
        $pdf->SetY(60);
    $pdf->Cell(90, 10, $row['naam'], 1, 0);
    $pdf->Cell(30, 10, EURO . ' ' . number_format($row['prijs'], 2), 1, 0);
}

// output PDF to browser
$pdf->Output('F', '../public/orders/' . $pdf_file);
header ("Location: ../public/orders/".$pdf_file);