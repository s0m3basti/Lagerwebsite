<?php
    session_start();
    if(!isset($_SESSION['userid'])) {
        header("Location: ../login.php?er=1");
    }
     
    //Abfrage der Nutzer ID vom Login
    $userid = $_SESSION['userid'];
    $uvorname = $_SESSION['vorname'];
    $unachname = $_SESSION['nachname'];
    $umail = $_SESSION['mail'];
    $urechte = $_SESSION['rechte'];
    
    require '../../files/linkmaker.php';
    require '../../files/datenzugriff.php';
    require '../../Datenbank/writer.php';
    require "fpdf/fpdf.php";

    class PDF extends FPDF{
        function header(){
            $this->SetFont('Arial','BU',16);
            $this->Cell(0,0,utf8_decode("Teilnehmerübersicht "),0,0,'C');
            $this->Ln(20);
        }
        function footer(){
            $this->SetY(-15);
            $this->SetFont('Arial','I',8);
            $this->Cell(0,10,'DRK Sommercamp - Erstellt am: '.date("d.m.Y"),0,0,'L');
            $this->Cell(0,10,$this->PageNo().'/{nb}',0,0,'R');
        }
        function tableHead(){
            $this->SetFont('Arial', 'B',12);
            $this->Cell(20,10,'Vorname',1,0,'C');
            $this->Cell(20,10,'Nachname',1,0,'C');
            $this->Cell(20,10,'Geschlecht',1,0,'C');
            $this->Cell(20,10,'Geburtstag',1,0,'C');
            $this->Cell(20,10,'Alter im Lager',1,0,'C');
            $this->Cell(20,10,'Schwimmer',1,0,'C');
            $this->Cell(20,10,'Badeerlaubnis',1,0,'C');
            $this->Cell(20,10,'Taschengeld',1,0,'C');
            $this->Cell(20,10,'Art der Versicherung',1,0,'C');
            $this->Cell(20,10,'Name der Versicherung',1,0,'C');
            $this->Cell(20,10,'Ratenzahlung',1,0,'C');
            $this->Cell(20,10,'Shirts',1,0,'C');
        }
    }

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->SetCreator("DRK-Sommercamp");
    $pdf->SetTitle("Teilnehmerübersicht",true);
    $pdf->AddPage('L','A4',0,);
    $pdf->SetFont('Arial','',12);
    $pdf->tableHead();
    $pdf->Output('F','doc/übersicht.pdf');

    header("Location:../ausgabe.php?task=1");

?>