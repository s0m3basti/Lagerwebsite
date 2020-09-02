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
        $lageralter = $row['LagerAlter'];
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
        $datum = $row['Datum'];
        $ip = $row['IP_Adresse'];
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

            $this->SetFont('helvetica', 'BU', 20);  
            $this->Ln(5);     
            $this->Cell(0, 15, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Ln(20);
    
        }
        public function Footer() {
            $uvorname = $_SESSION['vorname'];
            $unachname = $_SESSION['nachname'];
            require '../../files/datenzugriff.php';

            $this->SetY(-20);
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
        <h1 style="font-size: 14pt; font-weight: bold; text-align: center;">
            Anmeldung von '.$vorname.' '.$nachname.' ('.$art.')
        </h1>
    <table style="width: 100%; font-size: 10pt; border: solid 1px black; padding: 2px;">
        <tr style="border: solid 1px black; text-align: left;">
            <td colspan="2" style="border: solid 1px black; text-align: left; font-size: 12pt; font-weight: bold;">Angaben zum Teilnehmer:</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Vorname</td>
            <td style="border: none; width: 65%;">'.$vorname.'</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Nachname</td>
            <td style="border: none; width: 65%;">'.$nachname.'</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">geschlecht</td>
            <td style="border: none; width: 65%;">'.$geschlecht.'</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Geburtstag</td>
            <td style="border: none; width: 65%;">'.date("d.m.Y", strtotime($gebdatum)).' ('.$lageralter.')</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td colspan="2" style="border: solid 1px black; text-align: left; font-size: 12pt; font-weight: bold;">Angaben zum Sorgeberechtigten:</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Vorname</td>
            <td style="border: none; width: 65%;">'.$e_vorname.'</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Nachname</td>
            <td style="border: none; width: 65%;">'.$e_nachname.'</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Straße</td>
            <td style="border: none; width: 65%;">'.$strasse.'</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Postleitzahl</td>
            <td style="border: none; width: 65%;">'.$plz.'</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Ort</td>
            <td style="border: none; width: 65%;">'.$ort.'</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Telefonnummer (Privat)</td>
            <td style="border: none; width: 65%;">'.$tel_pri.'</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Telefonnummer (Handy)</td>
            <td style="border: none; width: 65%;">'.$tel_handy.'</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Telefonnumer (Dienstlich)</td>
            <td style="border: none; width: 65%;">'.$tel_dienstl.'</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">E-Mail-Adresse</td>
            <td style="border: none; width: 65%;">'.$email.'</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Mitlied / Mitarbeiter</td>
            <td style="border: none; width: 65%;">'.$mitglied.'/'.$mitarbeiter.'</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td colspan="2" style="border: solid 1px black; text-align: left; font-size: 12pt; font-weight: bold;">Angaben für den Betreuer:</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Schwimmer (mit Stufe)</td>
            <td style="border: none; width: 65%;">'.$schwimmer.' ('.$schwimmstufe.')</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Badeerlaubnis</td>
            <td style="border: none; width: 65%;">'.$badeerlaubnis.'</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Springen ins Wasser</td>
            <td style="border: none; width: 65%;">'.$springen.'</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Ernährung</td>
            <td style="border: none; width: 65%;">'.$ernaehrung.'</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Krankheiten</td>
            <td style="border: none; width: 65%;">'.$krankheit.'</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Medikamente</td>
            <td style="border: none; width: 65%;">'.$medikamente.'</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Taschengeldverwaltung</td>
            <td style="border: none; width: 65%;">'.$taschengeld.'</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Art und Name der KV</td>
            <td style="border: none; width: 65%;">'.$versicherung_name.' ('.$versicherung_art.')</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Private KFZ</td>
            <td style="border: none; width: 65%;">'.$kfz.'</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Ratenzahlung (mit Anzahl)</td>
            <td style="border: none; width: 65%;">'.$ratenzahlung.' ('.$raten_anzahl.')</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Shirts (mit Größe und Anzahl)</td>
            <td style="border: none; width: 65%;">'.$shirts.' ('.$shirts_groesse.' - '.$shirts_anzahl.')</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td colspan="2" style="border: solid 1px black; text-align: left; font-size: 12pt; font-weight: bold;">Metadaten:</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Art der Anmeldung</td>
            <td style="border: none; width: 65%;">'.$art.'</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">Datum der Anmeldung</td>
            <td style="border: none; width: 65%;">'.$datum.'</td>
        </tr>
        <tr style="border: solid 1px black; text-align: left;">
            <td style="border: none; width: 35%;">IP / bearbeiter der Anmeldung</td>
            <td style="border: none; width: 65%;">'.$ip.'</td>
        </tr>
    </table>';

    if($art == "analog"){
        $html .= '
        <br>
        <h2 style="font-size: 10pt; font-weight: normal; text-align: center;">
            Die Unterschrift zu dieser Anmeldung befindet sich auf dem erhaltenen Anmeldedokument. 
        </h2>';
    }
    else{
        $html .= '
        <br>
        <h2 style="font-size: 10pt; font-weight: normal; text-align: center;">
            Unterschrift des Sorgeberechtigten: ____________________________________ 
        </h2>';
    }

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
    $pdf->SetMargins(10, 20, 10, true);

    $pdf->AddPage();
    $pdf->writeHTML($html, true, false, true, false, '');
    
    $pdf->Output(dirname(__FILE__)."/doc/".$id.".pdf", 'F');
    $pdf->Close();

    $logtext = 'Das Dokument: Anmeldung (von '.$id.': '.$vorname.' '.$nachname.') wurde am '.date("Y-m-d H:i:s").' von '.$_SESSION['userid'].' ('.$_SESSION['vorname'].' '.$_SESSION['nachname'].') erstellt und heruntergeladen.';
    $logtext = utf8_decode($logtext);
    $log = "../../changelogs/ausgabe.txt";
    $logdata = fopen("$log", "a");
    fwrite($logdata, $logtext."\n");
    fclose($logdata);

    //header("Location:../ausgabe.php?task=2&download=1");
    header("Location:ausgabe_download.php?output=".$id);

?>