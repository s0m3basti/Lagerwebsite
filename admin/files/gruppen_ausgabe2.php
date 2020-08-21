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
    require "tcpdf/tcpdf.php";

    class MYPDF extends TCPDF {

        public function Header() {
            require '../../files/datenzugriff.php';

            $this->SetFont('helvetica', 'BU', 20);  
            $this->Ln(5);     
            $this->Cell(0, 15, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Ln(20);
    
        }
        public function Footer() {
            $uvorname = $_SESSION['vorname'];
            $unachname = $_SESSION['nachname'];
            require '../../files/datenzugriff.php';

            $this->SetY(-15);
            $this->SetFont('helvetica', 'I', 10);
            $html = '
                <hr> <br>
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 33%; text-align: left;">DRK Sommercamp '.$jahr.'</td>
                        <td style="width: 33%; text-align: center;">'.$this->getAliasNumPage().'/'.$this->getAliasNbPages().'</td>
                        <td style="width: 33%; text-align: righ;">Erstellt am '.date('d.m.Y H:i').', von '.$uvorname.' '.$unachname.'.</td>
                    </tr>
                </table>
            ';
            //$this->writeHTML($html, true, false, true, false, ''); 
        }
    }

    $pdf = new MYPDF("H", "mm", "A4", true, 'UTF-8', false);
    
    $pdf->SetCreator("DRK Sommercamp");
    $pdf->SetAuthor("DRK Sommercamp");
    $pdf->SetTitle('Teilnehmerübersicht');
    $pdf->SetSubject('Teilnehmerübersicht');

    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    
    $pdf->SetFont('dejavusans', '', 12);
    $pdf->SetMargins(5, 20, 5, true);

    $csv = array_map('str_getcsv', file('doc/gruppen.csv'));


    function ges($name){
        if(strpos($name,"w") !== 0){
            return "maennlich";
        }
        else{
            return "weiblich";
        }
    }

    
        try{
            $db = new PDO("$host; $name" ,$user,$pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            for($i = 0; $i<count($csv); $i++){
                ${"html$i"} = ' ';
                ${"html$i"} .= '
                    <h1 style="text-align: center; font-size: 60pt;"> Gruppe '.$csv[$i][3].' </h1>
                ';
                $sql = 'SELECT *
                        FROM tbl_stammdaten 
                        WHERE Jahr = '.$jahr.' 
                        AND Geschlecht = "'.ges($csv[$i][0]).'"
                        AND LagerAlter >= '.$csv[$i][1].'
                        AND LagerAlter <= '.$csv[$i][2].'
                        ORDER BY Vorname, Nachname;';
                foreach ($db->query($sql) as $row){
                    ${"html$i"}.= '<p style="text-align: center; font-size: 25pt;">'.$row['Vorname'].' '.$row['Nachname'].'</p><br>';
                }
            $pdf->AddPage();
            $pdf->writeHTML(${"html$i"}, true, false, true, false, '');
            } 
        }
        catch(PDOException $e){
            $fehler = $e->getMessage();
            echo $fehler;
        }
        finally{
            $db = null;
        }

   
    
    $pdf->Output(dirname(__FILE__)."/doc/zeltliste.pdf", 'F');
    $pdf->Close();

    $logtext = 'Das Dokument: Zeltliste wurde am '.date("Y-m-d H:i:s").' von '.$_SESSION['userid'].' ('.$_SESSION['vorname'].' '.$_SESSION['nachname'].') erstellt und heruntergeladen.';
    $logtext = utf8_decode($logtext);
    $log = "../../changelogs/ausgabe.txt";
    $logdata = fopen("$log", "a");
    fwrite($logdata, $logtext."\n");
    fclose($logdata);

    header("Location:ausgabe_download.php?output=zeltliste");
    //header("Location:../gruppen.php");