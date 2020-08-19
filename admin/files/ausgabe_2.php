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

    $id = $_GET['id'];

    try{
        $db = new PDO("$host; $name" ,$user,$pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * 
                FROM tbl_stammdaten s, tbl_srgb e, tbl_anmeldedaten a  
                WHERE s.TeilnehmerID = e.TeilnehmerID
                AND s.TeilnehmerID = a.TeilnehmerID
                AND Jahr = $jahr
                AND s.TeilnehmerID = '".$id."';";
        foreach ($db->query($sql) as $row);

        $vorname = $row['Vorname'];
        $nachname = $row['Nachname'];
        $geschlecht = $row['Geschlecht'];
        $gebdatum = $row['Geburtstag'];
        $e_nachname = $row['e_Nachname'];
        $e_vorname = $row['e_Vorname'];
        $strasse = $row['Strasse'];
        $plz = $row['PLZ'];
        $ort = $row['Ort'];
        $tel_pri = $row['Tel_pri'];
        $tel_handy = $row['Tel_handy'];
        $tel_dienstl = $row['Tel_dienstl'];
        $email = $row['email'];
        $mitglied = $row['mitglied'];
        $mitarbeiter = $row['mitarbeiter'];
        $schwimmer = $row['Schwimmer'];
        $schwimmstufe = $row['Schwimmstufe'];
        $badeerlaubnis = $row['Badeerlaubnis'];
        $springen = $row['Springen'];
        $ernaehrung = $row['Ernaehrung'];
        $krankheit = $row['Krankheit'];
        $medikamente = $row['Medikamente'];
        $taschengeld = $row['Taschengeld'];
        $versicherung_art = $row['Versicherung_art'];
        $versicherung_name = $row['Versicherung_name'];
        $kfz = $row['KFZ'];
        $ratenzahlung = $row['Ratenzahlung'];
        $raten_anzahl = $row['Raten_anzahl'];
        $shirts = $row['Shirts'];
        $shirts_anzahl = $row['Shirts_anzahl'];
        $shirts_groesse = $row['Shirts_groesse'];
        $art = $row['art'];
    }
    catch(PDOException $e){
        $fehler = $e->getMessage();
        $html.= "Es ist ein Fehler bei der Kommunikation mit der Datenbank aufgetreten. </br> $fehler";
    }
    finally{
        $db = null;
    }

    class MYPDF extends TCPDF {

        public function Header() {
            require '../../files/datenzugriff.php';

            $this->Image('../img/header-admin.png', 80, 2, 45, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
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
            $this->writeHTML($html, true, false, true, false, ''); 
        }
    }

    $html = "Test";

    $pdf = new MYPDF("H", "mm", "A4", true, 'UTF-8', false);
    
    $pdf->SetCreator("DRK Sommercamp");
    $pdf->SetAuthor("DRK Sommercamp");
    $pdf->SetTitle('Anmeldung von '.$vorname.' '.$nachname);
    $pdf->SetSubject('Anmeldung von '.$vorname.' '.$nachname);

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
    $pdf->SetMargins(5, 0, 5, true);

    $pdf->AddPage();
    $pdf->writeHTML($html, true, false, true, false, '');
    
    $pdf->Output(dirname(__FILE__)."/doc/anmeldung#".$id.".pdf", 'F');
    $pdf->Close();

    $logtext = 'Das Dokument: Anmeldung (von '.$id.': '.$vorname.' '.$nachname.') wurde am '.date("Y-m-d H:i:s").' von '.$_SESSION['userid'].' ('.$_SESSION['vorname'].' '.$_SESSION['nachname'].') erstellt und heruntergeladen.';
    $logtext = utf8_decode($logtext);
    $log = "../../changelogs/ausgabe.txt";
    $logdata = fopen("$log", "a");
    fwrite($logdata, $logtext."\n");
    fclose($logdata);

    //header("Location:../ausgabe.php?task=2&download=1");
    header("Location:../ausgabe.php?task=2");

?>