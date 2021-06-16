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
            $this->Cell(0, 15, 'Offene Zahlungen - '.$jahr, 0, false, 'C', 0, '', 0, false, 'M', 'M');
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
            $this->writeHTML($html, true, false, true, false, ''); 
        }
    }


    $html = '
            <table style="width: 100%; font-size: 10pt; border: solid 1px black; padding: 2px;">
            <tr style="border: solid 1px black; text-align: center; background-color: lightgrey;">
                <td style="border: solid 1px black; width: 2%;"></td>
                <td style="border: solid 1px black;width: 11%;">Vorname des Kindes</td>
                <td style="border: solid 1px black;width: 11%;">Nachname des Kindes</td>
                <td style="border: solid 1px black;width: 10%;">Geschlecht des Kindes</td>
                <td style="border: solid 1px black;width: 10%;">Geburtstag</td>
                <td style="border: solid 1px black;width: 10%;">Vorname der Eltern</td>
                <td style="border: solid 1px black;width: 10%;">Nachname der Eltern</td>
                <td style="border: solid 1px black;width: 10%;">Kontaktdaten</td>
                <td style="border: solid 1px black;width: 5%;">Ratenzahlung</td>
                <td style="border: solid 1px black;width: 5%;">Ratenanzahl</td>
                <td style="border: solid 1px black;width: 6%;">Betrag</td>
                <td style="border: solid 1px black;width: 10%;">Bezahlt?</td>
            </tr>';

            $null = 0;

            try{
                $db = new PDO("$host; $name" ,$user,$pass);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $zähler = 0;
                    $sql = "SELECT * 
                                FROM tbl_stammdaten s, tbl_anmeldedaten a, tbl_srgb e
                                WHERE s.TeilnehmerID = a.TeilnehmerID
                                AND s.TeilnehmerID = e.TeilnehmerID
                                AND Jahr = $jahr
                                AND zahlungsdaten != ".$null."
                                ORDER BY Nachname, Vorname;";
                    foreach ($db->query($sql) as $row){
                        $zähler++;
                        $html.= '<tr style="border: solid 1px black;">
                            <td style="border: solid 1px black; border-top: solid 2px black; text-align:left; ">'.$zähler.'</td>
                            <td style="border: solid 1px black; border-top: solid 2px black; text-align:right; ">'.$row['Vorname'].'</td>
                            <td style="border: solid 1px black; border-top: solid 2px black; text-align:right; ">'.$row['Nachname'].'</td>
                            <td style="border: solid 1px black; border-top: solid 2px black; text-align:right; ">'.$row['Geschlecht'].'</td>
                            <td style="border: solid 1px black; border-top: solid 2px black; text-align:right; ">'.date('d.m.Y',strtotime($row['Geburtstag'])).'</td>
                            <td style="border: solid 1px black; border-top: solid 2px black; text-align:right; ">'.$row['e_Vorname'].'</td>
                            <td style="border: solid 1px black; border-top: solid 2px black; text-align:right;">'.$row['e_Nachname'].'</td>
                            <td style="border: solid 1px black; border-top: solid 2px black; text-align:right;">'.$row['Tel_pri'].'<br>'.$row['Tel_handy'].'<br>'.$row['Tel_dienstl'].'</td>
                            <td style="border: solid 1px black; border-top: solid 2px black; text-align:right;">'.$row['Ratenzahlung'].'</td>
                            <td style="border: solid 1px black; border-top: solid 2px black; text-align:right;">'.$row['Raten_anzahl'].'</td>
                            <td style="border: solid 1px black; border-top: solid 2px black; text-align:right;">'.$row['zahlungsdaten'].' €</td>
                            <td style="border: solid 1px black; border-top: solid 2px black; text-align:right;"> </td>
                        </tr>';
                    } 
            }
            catch(PDOException $e){
                $fehler = $e->getMessage();
                $html.= "Es ist ein Fehler bei der Kommunikation mit der Datenbank aufgetreten. </br> $fehler";
            }
            finally{
                $db = null;
            }
    $html .= 
        '</table>';


    $pdf = new MYPDF("L", "mm", "A4", true, 'UTF-8', false);
    
    $pdf->SetCreator("DRK Sommercamp");
    $pdf->SetAuthor("DRK Sommercamp");
    $pdf->SetTitle('Zahlungsübersicht');
    $pdf->SetSubject('zahlungsübersicht');

    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    
    $pdf->SetFont('dejavusans', '', 12);
    $pdf->SetMargins(5, 20, 5, true);

    $pdf->AddPage();
    $pdf->writeHTML($html, true, false, true, false, '');
    
    $pdf->Output(dirname(__FILE__)."/doc/zahlungsuebersicht.pdf", 'F');
    $pdf->Close();

    $logtext = 'Das Dokument: Zahlungsübersicht wurde am '.date("Y-m-d H:i:s").' von '.$_SESSION['userid'].' ('.$_SESSION['vorname'].' '.$_SESSION['nachname'].') erstellt und heruntergeladen.';
    $logtext = utf8_decode($logtext);
    $log = "../../changelogs/ausgabe.txt";
    $logdata = fopen("$log", "a");
    fwrite($logdata, $logtext."\n");
    fclose($logdata);

    header("Location:ausgabe_download.php?output=zahlungsuebersicht");
    //header("Location:../zahlung.php");
?>