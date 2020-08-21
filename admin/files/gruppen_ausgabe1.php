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
            $this->Cell(0, 15, 'Teilnehmerliste - '.$jahr, 0, false, 'C', 0, '', 0, false, 'M', 'M');
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

    $csv = array_map('str_getcsv', file('doc/gruppen.csv'));
    function hintergrund($gruppe){
        switch($gruppe){
            case "m1":
                return "background-color: #cce6ff;";
                break;
            case "m2":
                return "background-color: #80c1ff;";
                break;
            case "m3":
                return "background-color: #339cff;";
                break;
            case "m4":
                return "background-color: #1a90ff;";
                break;
            case "m5":
                return "background-color: #0073e6;";
                break;
            case "w1":
                return "background-color: #ffebcc;";
                break;
            case "w2":
                return "background-color: #ffc266;";
                break;
            case "w3":
                return "background-color: #ff9900;";
                break;
            case "w4":
                return "background-color: #e68a00;";
                break;
            case "w5":
                return "background-color: #cc7a00;";
                break;
        }
    }

    $html = '<br><br><br><br><br>
            <table style="width: 100%; font-size: 10pt; border: solid 1px black; padding: 2px;">
            <tr style="border: solid 1px black; text-align: center; background-color: lightgrey;">
                <td style="border: solid 1px black; width: 3%;"></td>
                <td style="border: solid 1px black;width: 21%;">Vorname</td>
                <td style="border: solid 1px black;width: 21%;">Nachname</td>
                <td style="border: solid 1px black;width: 10%;">Geschlecht</td>
                <td style="border: solid 1px black;width: 10%;">Geburtstag</td>
                <td style="border: solid 1px black;width: 5%;">Alter im Lager</td>
                <td style="border: solid 1px black;width: 6%;">Gruppe</td>
                <td style="border: solid 1px black;width: 10%;">Betreuer</td>
                <td style="border: solid 1px black;width: 14%;">Zelt</td>
            </tr>';
            try{
                $db = new PDO("$host; $name" ,$user,$pass);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                for($i = 0; $i<count($csv); $i++){
                    $zähler = 0;
                    if(strpos($csv[$i][0],"w") !== 0){
                        $sql = "SELECT * 
                                FROM tbl_stammdaten 
                                WHERE Jahr = $jahr 
                                AND Geschlecht = 'maennlich'
                                AND LagerAlter >= ".$csv[$i][1]."
                                AND LagerAlter <= ".$csv[$i][2]."
                                ORDER BY Geschlecht, LagerAlter, Nachname, Vorname;";
                        foreach ($db->query($sql) as $row){
                            $zähler++;
                            $html.= '
                                <tr style="border: solid 1px black;">
                                    <td style="border: solid 1px black; text-align:left; '.hintergrund($csv[$i][0]).'">'.$zähler.'</td>
                                    <td style="border: solid 1px black; text-align:right; '.hintergrund($csv[$i][0]).'">'.$row['Vorname'].'</td>
                                    <td style="border: solid 1px black; text-align:right; '.hintergrund($csv[$i][0]).'">'.$row['Nachname'].'</td>
                                    <td style="border: solid 1px black; text-align:right; '.hintergrund($csv[$i][0]).'">'.$row['Geschlecht'].'</td>
                                    <td style="border: solid 1px black; text-align:right; '.hintergrund($csv[$i][0]).'">'.date('d.m.Y',strtotime($row['Geburtstag'])).'</td>
                                    <td style="border: solid 1px black; text-align:right; '.hintergrund($csv[$i][0]).'">'.$row['LagerAlter'].'</td>
                                    <td style="border-right: solid 1px black; text-align:center;'.hintergrund($csv[$i][0]).'">'.$csv[$i][3].'</td>
                                    <td style="border-right: solid 1px black; text-align:center;'.hintergrund($csv[$i][0]).'">'.$csv[$i][4].'</td>
                                    <td style="border-right: solid 1px black; text-align:center;'.hintergrund($csv[$i][0]).'">'.$csv[$i][5].'</td>
                                </tr>';
                        }
                    }
                    else{
                        $sql = "SELECT * 
                                FROM tbl_stammdaten 
                                WHERE Jahr = $jahr 
                                AND Geschlecht = 'weiblich'
                                AND LagerAlter >= ".$csv[$i][1]."
                                AND LagerAlter <= ".$csv[$i][2]."
                                ORDER BY Geschlecht, LagerAlter, Nachname, Vorname;";
                        foreach ($db->query($sql) as $row){
                            $zähler++;
                            $html.= '<tr style="border: solid 1px black;">
                                <td style="border: solid 1px black; border-top: solid 2px black; text-align:left; '.hintergrund($csv[$i][0]).'">'.$zähler.'</td>
                                <td style="border: solid 1px black; border-top: solid 2px black; text-align:right; '.hintergrund($csv[$i][0]).'">'.$row['Vorname'].'</td>
                                <td style="border: solid 1px black; border-top: solid 2px black; text-align:right; '.hintergrund($csv[$i][0]).'">'.$row['Nachname'].'</td>
                                <td style="border: solid 1px black; border-top: solid 2px black; text-align:right; '.hintergrund($csv[$i][0]).'">'.$row['Geschlecht'].'</td>
                                <td style="border: solid 1px black; border-top: solid 2px black; text-align:right; '.hintergrund($csv[$i][0]).'">'.date('d.m.Y',strtotime($row['Geburtstag'])).'</td>
                                <td style="border: solid 1px black; border-top: solid 2px black; text-align:right; '.hintergrund($csv[$i][0]).'">'.$row['LagerAlter'].'</td>
                                <td style="border-right: solid 1px black; border-top: solid 2px black; text-align:center;'.hintergrund($csv[$i][0]).'">'.$csv[$i][3].'</td>
                                <td style="border-right: solid 1px black; border-top: solid 2px black; text-align:center;'.hintergrund($csv[$i][0]).'">'.$csv[$i][4].'</td>
                                <td style="border-right: solid 1px black; border-top: solid 2px black; text-align:center;'.hintergrund($csv[$i][0]).'">'.$csv[$i][5].'</td>
                            </tr>';
                        }
                    }
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
    $pdf->SetMargins(5, 0, 5, true);

    $pdf->AddPage();
    $pdf->writeHTML($html, true, false, true, false, '');
    
    $pdf->Output(dirname(__FILE__)."/doc/uebersicht_filled.pdf", 'F');
    $pdf->Close();

    $logtext = 'Das Dokument: Anmeldungsübersicht wurde am '.date("Y-m-d H:i:s").' von '.$_SESSION['userid'].' ('.$_SESSION['vorname'].' '.$_SESSION['nachname'].') erstellt und heruntergeladen.';
    $logtext = utf8_decode($logtext);
    $log = "../../changelogs/ausgabe.txt";
    $logdata = fopen("$log", "a");
    fwrite($logdata, $logtext."\n");
    fclose($logdata);

    header("Location:ausgabe_download.php?output=uebersicht_filled");
    //header("Location:../gruppen.php");