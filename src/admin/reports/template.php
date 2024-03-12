<?php

    require_once('../../TCPDF-main/tcpdf.php');

    include ("../../connection.php");

        class PDF extends TCPDF  {


            public function Header() {
                $imageFile = K_PATH_IMAGES.'header.jpg';
                $this->Image($imageFile, 30, 10, 150, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

            }
            public function Footer() {


                
                $this->SetFont('helvetica', 'I',8);
                date_default_timezone_set("Asia/Hong_Kong");
                $today = date("F j, Y / g:i A", time());

                $this->Cell(25,5,''.$today,0,0,'L');
                $this->Cell(164, 5,'Page ' .$this->getAliasNumPage().' of ' .$this->getAliasNbPages(),
                0, false, 'R', 0, '', 0, false, 'T', 'M');
                
            }
        }

        // create new PDF document
        $pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Project: Learn');
        $pdf->SetTitle('Printable Reports');
        $pdf->SetSubject('');
        $pdf->SetKeywords('');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }


        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 14, '', true);
        

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        $pdf->Ln(30);

        $pdf->SetFont('helvetica', 'B',10);
        $pdf->Cell(175,5, 'Report',0,1,'C');
        $pdf->Ln(3);

        $pdf->SetFillColor(224, 235, 255);
        $pdf->Cell(10,5,'ID', 1,0,'C',0);
        $pdf->Cell(35,5, 'Name', 1,0,'C',1);
        $pdf->Cell(30,5, 'Email', 1,0,'C',1);
        $pdf->Cell(25,5, 'Contact', 1,0,'C',1);
        $pdf->Cell(20,5, 'Gender', 1,0,'C',1);
        $pdf->Cell(20,5, 'Status', 1,0,'C',1);
        $pdf->Cell(35,5, 'Registration Date', 1,0,'C',1);
    
    
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Reports.pdf', 'I');

    
?>