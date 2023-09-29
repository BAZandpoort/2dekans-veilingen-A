<?php 
        /*if (!(isset($_POST["afrekenen"]))) {
                header("Location: index.php");
            }*/

        require('./fpdf186/fpdf.php');
        include "connect.php";
        session_start();
        
        $factuurId = rand(1000, 9999);
        
        $products2 = 16; 
        $products = explode(",", $_POST["products"]); 
        $products_count = array_count_values($products2);
        $products_info = array();
        
        foreach ($products_count as $product => $quantity) {
                $sql = "SELECT * FROM tblproducten WHERE productid = " . $product; 
                $resultaat = $mysqli->query($sql); 
                $row = $resultaat->fetch_assoc();
                $product_info = array(
                        "productid" => $product,
                        "naam" =>$row["naam"],
                        "prijs" => $row["prijs"],
                        "quantity" => $quantity
                );

                array_push($products_info, $product_info);
        };

        $sql = "SELECT * FROM tblgebruikers WHERE gebruikersnaam = '" . $_SESSION["1"] . "'";
        $resultaat = $mysqli->querry($sql); 
        $row = $resultaat->fetch_assoc(); 
        $email = $row["email"]; 
        $koperId = $row["koperid"];
        
        $pdf=new FPDF(); 
        $pdf->AddPage(); 
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(190,10, 'BETALING' ,'B' ,1, 'C');
        $pdf->ln();
        
        $pdf->SetFont('Arial', '', 12); 
        $pdf->Cell(40,10, 'Email', 0, 0); 
        $pdf->Cell(100, 10, $email, 0, 1); 

        $pdf->Cell(40, 10, 'Invoice Number:', 0, 0); 
        $pdf->Cell(100, 10, $factuurId, 0, 1); 

        $invoiceDate = data('d-m-Y'); 
        $pdf->Cell(40,  10, 'Invoice Date:', 0, 0);
        $pdf->Cell(100, 10, $invoiceDate, 0, 1); 

        $pdf->SetFont('Helvetica', 'B', 12); 
        $pdf->Cell(90, 10, 'Item', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Price', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Quantity', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Total', 1, 1, 'C');

        $total = 0; 
        $pdf->SetFont('Helvetica', '', 12); 
        foreach ($products_info as $item) {
                for ($teller = 0; $teller < $item['quantity']; $teller++) {
                        $productIds[] = $item['id']; 
                }
                $pdf->Cell(90, 10, $item['naam'],1 , 0);
                $pdf->Cell(30,10, EURO . ' '. $item['prijs'], 1, 0);
                $pdf->Cell(30,10, $item['quantity'], 1,0);
                $pdf->Cell(40, 10, EURO. ' '. $item['prijs']*$item['quantity'], 1,1);
                $total += $item['prijs']*$item['quantity'];  
        }

        $pdf->SetFont('Helvetica', 'B', 12); 
        $pdf ->Cell(120, 10, '', 0,0); 
        $pdf ->Cell(30, 10, 'Total', 0,0);
        $pdf -> Cell(40, 10, EURO. '' . number_format($total, 2, ',', '.'), 0, 1, 'R');

        $pdf_file = 'order_'. $factuurId . '.pdf'; 
        $pdf ->Output('F', './orders/' . $pdf_file); 

        $pdf_data = file_get_contents('./orders/order_' . $factuurId  . '.pdf');
        $pdf_data = mysqli_real_escape_string($mysqli, $pdf_data);

        $datum = date("l, j F Y");

        $sql = "INSERT INTO tblfacturen (factuurid, koperid, productid, datum, factuurpdf) VALUES (".$factuurId.",".$koperId."," .$product."," .$datum. "," .$pdf_data.")";
        if ($mysqli->query($sql)) {
         echo "PDF file saved to database.";
        } else {
         echo "Error: " . $sql . "<br>" . $mysqli->error;
        }

        echo ' <a href="./orders/' . $pdf_file . '" target="_blank">Download PDF</a>';
?>
