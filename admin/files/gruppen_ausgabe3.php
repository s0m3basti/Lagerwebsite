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

    $pdf = new MYPDF("H", "mm", "A4", true, 'UTF-8', false);
    
    $pdf->SetCreator("DRK Sommercamp");
    $pdf->SetAuthor("DRK Sommercamp");
    $pdf->SetTitle('Teilnehmerordner');
    $pdf->SetSubject('Teilnehmerordner');

    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    
    $pdf->SetFont('dejavusans', '', 12);
    $pdf->SetMargins(20, 20, 15, true);

    $csv = array_map('str_getcsv', file('doc/gruppen.csv'));

    //Deckblatt des Ordner

    $deckblatt='<br><br><br><br><br><br><br><br><br><br><br><br>
        <p style="text-align: center; font-weight: bold; font-size: 30pt;">
            Teilnehmerordner 
            <br>DRK Sommercamp '.$jahr.'
            <br>
        </p>
        <p style="text-align: center; font-size: 25pt;">
            <br>Vom : '.$anfang.' 
            <br>Bis : '.$ende.'
        </p>';
            

    $pdf->AddPage();
    $pdf->Image('../img/header-admin.png', 55, 50, 100, 0, 'PNG', '', 'C', false, 150, '', false, false, 1, false, false, false);
    $pdf->writeHTML($deckblatt, true, false, true, false, '');

    function ges($name){
        if(strpos($name,"w") !== 0){
            return "maennlich";
        }
        else{
            return "weiblich";
        }
    }
    function geschlecht($var){
        if($var == "maennlich"){
            return "m";
        }    
        else{
            return "w";
        }
    }

    try{
        $db = new PDO("$host; $name" ,$user,$pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        for($i = 0; $i<count($csv); $i++){

            $sql = 'SELECT * 
                    FROM tbl_stammdaten s , tbl_anmeldedaten e
                    WHERE s.TeilnehmerID = e.TeilnehmerID
                    AND Jahr = '.$jahr.'
                    AND Geschlecht = "'.ges($csv[$i][0]).'"
                    AND LagerAlter >= '.$csv[$i][1].'
                    AND LagerAlter <= '.$csv[$i][2].'
                    ORDER BY Geschlecht, LagerAlter, Nachname, Vorname;';

            $html = '
                <h1 style="text-align: center; font-size: 25pt;"> Gruppe '.$csv[$i][3].' </h1>
            ';
            $html .= '
            <table style="width: 100%; font-size: 10pt; border: solid 1px black; padding: 2px;">
            <tr style="border: solid 1px black; text-align: center; background-color: lightgrey;">
                <td style="border: solid 1px black; width: 2%;"></td>
                <td style="border: solid 1px black;width: 12%;">Vorname</td>
                <td style="border: solid 1px black;width: 12%;">Nachname</td>
                <td style="border: solid 1px black;width: 3%;">Gs.</td>
                <td style="border: solid 1px black;width: 5%;">Alter im Lager</td>
                <td style="border: solid 1px black;width: 11%;">Schwimmer <br> (Schwimmstufe)</td>
                <td style="border: solid 1px black;width: 4%;">Badeerlaubnis</td>
                <td style="border: solid 1px black;width: 4%;">Springen</td>
                <td style="border: solid 1px black;width: 13%;">Ernährung</td>
                <td style="border: solid 1px black;width: 13%;">Krankheit</td>
                <td style="border: solid 1px black;width: 13%;">Medikamente</td>
                <td style="border: solid 1px black;width: 4%;">Taschengeld</td>
                <td style="border: solid 1px black;width: 4%;">KFZ</td>
            </tr>';
            $zähler = 0;
            foreach ($db->query($sql) as $row){
                $zähler++;
                $html.= '<tr style="border: solid 1px black;">
                            <td style="border: solid 1px black; text-align:center; ">'.$zähler.'</td>
                            <td style="border: solid 1px black; text-align:left; ">'.$row['Vorname'].'</td>
                            <td style="border: solid 1px black; text-align:left; ">'.$row['Nachname'].'</td>
                            <td style="border: solid 1px black; text-align:center; ">'.geschlecht($row['Geschlecht']).'</td>
                            <td style="border: solid 1px black; text-align:center; ">'.$row['LagerAlter'].'</td>
                            <td style="border: solid 1px black; text-align:left;  ">'.$row['Schwimmer'].' ('.$row['Schwimmstufe'].')</td>
                            <td style="border: solid 1px black; text-align:center;  ">'.$row['Badeerlaubnis'].'</td>
                            <td style="border: solid 1px black; text-align:center;  ">'.$row['Springen'].'</td>
                            <td style="border: solid 1px black; text-align:left;   font-size: 6pt;">'.$row['Ernaehrung'].'</td>
                            <td style="border: solid 1px black; text-align:left;   font-size: 6pt;">'.$row['Krankheit'].'</td>
                            <td style="border: solid 1px black; text-align:left;   font-size: 6pt;">'.$row['Medikamente'].'</td>
                            <td style="border: solid 1px black; text-align:center;  ">'.$row['Taschengeld'].'</td>
                            <td style="border: solid 1px black; text-align:center;  ">'.$row['KFZ'].'</td>
                            </tr>';
            }
            $html .= '</table>';

            $pdf->AddPage('L');
            $pdf->writeHTML($html, true, false, true, false, '');

            $sql = 'SELECT * 
                    FROM tbl_stammdaten s, tbl_srgb e, tbl_anmeldedaten a  
                    WHERE s.TeilnehmerID = e.TeilnehmerID
                    AND s.TeilnehmerID = a.TeilnehmerID
                    AND Jahr = '.$jahr.'
                    AND Geschlecht = "'.ges($csv[$i][0]).'"
                    AND LagerAlter >= '.$csv[$i][1].'
                    AND LagerAlter <= '.$csv[$i][2].'
                    ORDER BY Geschlecht, LagerAlter, Nachname, Vorname;';
            foreach ($db->query($sql) as $row){

                $html = '
                    <h1 style="font-size: 14pt; font-weight: bold; text-align: center;">
                        Anmeldung von  '.$row['Vorname'].'  '.$row['Nachname'].' ('.$row['art'].')
                    </h1>
                    <table style="width: 100%; font-size: 10pt; border: solid 1px black; padding: 2px;">
                        <tr style="border: solid 1px black; text-align: left;">
                            <td colspan="2" style="border: solid 1px black; text-align: left; font-size: 12pt; font-weight: bold;">Angaben zum Teilnehmer:</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Vorname</td>
                            <td style="border: none; width: 65%;"> '.$row['Vorname'].'</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Nachname</td>
                            <td style="border: none; width: 65%;"> '.$row['Nachname'].'</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">geschlecht</td>
                            <td style="border: none; width: 65%;"> '.$row['Geschlecht'].'</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Geburtstag</td>
                            <td style="border: none; width: 65%;">'.date("d.m.Y", strtotime($row['Geburtstag'])).' ( '.$row['LagerAlter'].')</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td colspan="2" style="border: solid 1px black; text-align: left; font-size: 12pt; font-weight: bold;">Angaben zum Sorgeberechtigten:</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Vorname</td>
                            <td style="border: none; width: 65%;"> '.$row['e_Vorname'].'</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Nachname</td>
                            <td style="border: none; width: 65%;"> '.$row['e_Nachname'].'</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Straße</td>
                            <td style="border: none; width: 65%;"> '.$row['Strasse'].'</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Postleitzahl</td>
                            <td style="border: none; width: 65%;"> '.$row['PLZ'].'</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Ort</td>
                            <td style="border: none; width: 65%;"> '.$row['Ort'].'</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Telefonnummer (Privat)</td>
                            <td style="border: none; width: 65%;"> '.$row['Tel_pri'].'</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Telefonnummer (Handy)</td>
                            <td style="border: none; width: 65%;"> '.$row['Tel_handy'].'</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Telefonnumer (Dienstlich)</td>
                            <td style="border: none; width: 65%;"> '.$row['Tel_dienstl'].'</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">E-Mail-Adresse</td>
                            <td style="border: none; width: 65%;"> '.$row['email'].'</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Mitlied / Mitarbeiter</td>
                            <td style="border: none; width: 65%;"> '.$row['mitglied'].'/ '.$row['mitarbeiter'].'</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td colspan="2" style="border: solid 1px black; text-align: left; font-size: 12pt; font-weight: bold;">Angaben für den Betreuer:</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Schwimmer (mit Stufe)</td>
                            <td style="border: none; width: 65%;"> '.$row['Schwimmer'].' ( '.$row['Schwimmstufe'].')</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Badeerlaubnis</td>
                            <td style="border: none; width: 65%;"> '.$row['Badeerlaubnis'].'</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Springen ins Wasser</td>
                            <td style="border: none; width: 65%;"> '.$row['Springen'].'</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Ernährung</td>
                            <td style="border: none; width: 65%;"> '.$row['Ernaehrung'].'</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Krankheiten</td>
                            <td style="border: none; width: 65%;"> '.$row['Krankheit'].'</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Medikamente</td>
                            <td style="border: none; width: 65%;"> '.$row['Medikamente'].'</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Taschengeldverwaltung</td>
                            <td style="border: none; width: 65%;"> '.$row['Taschengeld'].'</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Art und Name der KV</td>
                            <td style="border: none; width: 65%;"> '.$row['Versicherung_name'].' ( '.$row['Versicherung_art'].')</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Private KFZ</td>
                            <td style="border: none; width: 65%;"> '.$row['KFZ'].'</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Ratenzahlung (mit Anzahl)</td>
                            <td style="border: none; width: 65%;"> '.$row['Ratenzahlung'].' ( '.$row['Raten_anzahl'].')</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Shirts (mit Größe und Anzahl)</td>
                            <td style="border: none; width: 65%;"> '.$row['Shirts'].' ( '.$row['Shirts_groesse'].' -  '.$row['Shirts_anzahl'].')</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td colspan="2" style="border: solid 1px black; text-align: left; font-size: 12pt; font-weight: bold;">Metadaten:</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Art der Anmeldung</td>
                            <td style="border: none; width: 65%;"> '.$row['art'].'</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">Datum der Anmeldung</td>
                            <td style="border: none; width: 65%;"> '.$row['Datum'].'</td>
                        </tr>
                        <tr style="border: solid 1px black; text-align: left;">
                            <td style="border: none; width: 35%;">IP / bearbeiter der Anmeldung</td>
                            <td style="border: none; width: 65%;"> '.$row['IP_Adresse'].'</td>
                        </tr>
                    </table>
                ';

                if($row['art'] == "analog"){
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

            $pdf->AddPage('H');
            $pdf->writeHTML($html, true, false, true, false, '');

            }
        } 
    }
    catch(PDOException $e){
        $fehler = $e->getMessage();
        echo $fehler;
    }
    finally{
        $db = null;
    }

   
    
    $pdf->Output(dirname(__FILE__)."/doc/teilnehmerordner.pdf", 'F');
    $pdf->Close();

    $logtext = 'Das Dokument: Teilnehmerordner wurde am '.date("Y-m-d H:i:s").' von '.$_SESSION['userid'].' ('.$_SESSION['vorname'].' '.$_SESSION['nachname'].') erstellt und heruntergeladen.';
    $logtext = utf8_decode($logtext);
    $log = "../../changelogs/ausgabe.txt";
    $logdata = fopen("$log", "a");
    fwrite($logdata, $logtext."\n");
    fclose($logdata);

    header("Location:ausgabe_download.php?output=teilnehmerordner");
    //header("Location:../gruppen.php");