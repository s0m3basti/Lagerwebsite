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
            $this->Cell(0, 15, 'Teilnehmerliste (Angaben für den Betreuer) - '.$jahr, 0, false, 'C', 0, '', 0, false, 'M', 'M');
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
            try{
                $db = new PDO("$host; $name" ,$user,$pass);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                function geschlecht($var){
                    if($var == "maennlich"){
                        return "m";
                    }    
                    else{
                        return "w";
                    }
                }

                $i = 0;
                $sql = "SELECT * 
                        FROM tbl_stammdaten s , tbl_anmeldedaten e
                        WHERE s.TeilnehmerID = e.TeilnehmerID
                        AND Jahr = $jahr 
                        ORDER BY Geschlecht, LagerAlter, Nachname, Vorname;";
                foreach ($db->query($sql) as $row){
                    $i++;

                    if($row['Geschlecht'] == "maennlich"){
                        $html.= '<tr style="border: solid 1px black;">
                            <td style="border: solid 1px black; text-align:center; background-color: #80c1ff;">'.$i.'</td>
                            <td style="border: solid 1px black; text-align:left; background-color: #80c1ff;">'.$row['Vorname'].'</td>
                            <td style="border: solid 1px black; text-align:left; background-color: #80c1ff;">'.$row['Nachname'].'</td>
                            <td style="border: solid 1px black; text-align:center; background-color: #80c1ff;">'.geschlecht($row['Geschlecht']).'</td>
                            <td style="border: solid 1px black; text-align:center; background-color: #80c1ff;">'.$row['LagerAlter'].'</td>
                            <td style="border: solid 1px black; text-align:left;  background-color: #80c1ff;">'.$row['Schwimmer'].' ('.$row['Schwimmstufe'].')</td>
                            <td style="border: solid 1px black; text-align:center;  background-color: #80c1ff;">'.$row['Badeerlaubnis'].'</td>
                            <td style="border: solid 1px black; text-align:center;  background-color: #80c1ff;">'.$row['Springen'].'</td>
                            <td style="border: solid 1px black; text-align:left;  background-color: #80c1ff; font-size: 6pt;">'.$row['Ernaehrung'].'</td>
                            <td style="border: solid 1px black; text-align:left;  background-color: #80c1ff; font-size: 6pt;">'.$row['Krankheit'].'</td>
                            <td style="border: solid 1px black; text-align:left;  background-color: #80c1ff; font-size: 6pt;">'.$row['Medikamente'].'</td>
                            <td style="border: solid 1px black; text-align:center;  background-color: #80c1ff;">'.$row['Taschengeld'].'</td>
                            <td style="border: solid 1px black; text-align:center;  background-color: #80c1ff;">'.$row['KFZ'].'</td>
                            </tr>';
                    }
                    else{
                        $html.= '<tr style="border: solid 1px black;">
                        <td style="border: solid 1px black; text-align:center; background-color: #ffc266;">'.$i.'</td>
                        <td style="border: solid 1px black; text-align:left; background-color: #ffc266 ;">'.$row['Vorname'].'</td>
                        <td style="border: solid 1px black; text-align:left; background-color: #ffc266 ;">'.$row['Nachname'].'</td>
                        <td style="border: solid 1px black; text-align:center; background-color: #ffc266 ;">'.geschlecht($row['Geschlecht']).'</td>
                        <td style="border: solid 1px black; text-align:center; background-color: #ffc266 ;">'.$row['LagerAlter'].'</td>
                        <td style="border: solid 1px black; text-align:left;  background-color: #ffc266 ;">'.$row['Schwimmer'].' ('.$row['Schwimmstufe'].')</td>
                        <td style="border: solid 1px black; text-align:center;  background-color: #ffc266 ;">'.$row['Badeerlaubnis'].'</td>
                        <td style="border: solid 1px black; text-align:center;  background-color: #ffc266 ;">'.$row['Springen'].'</td>
                        <td style="border: solid 1px black; text-align:left;  background-color: #ffc266 ; font-size: 6pt;">'.$row['Ernaehrung'].'</td>
                        <td style="border: solid 1px black; text-align:left;  background-color: #ffc266 ; font-size: 6pt;">'.$row['Krankheit'].'</td>
                        <td style="border: solid 1px black; text-align:left;  background-color: #ffc266 ; font-size: 6pt;">'.$row['Medikamente'].'</td>
                        <td style="border: solid 1px black; text-align:center;  background-color: #ffc266 ;">'.$row['Taschengeld'].'</td>
                        <td style="border: solid 1px black; text-align:center;  background-color: #ffc266 ;">'.$row['KFZ'].'</td>
                        </tr>';
                    }                    
                };
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
    $pdf->SetTitle('Angaben für den Betreuer');
    $pdf->SetSubject('Angaben für den Betreuer');

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

    $pdf->AddPage();
    $pdf->writeHTML($html, true, false, true, false, '');
    
    $pdf->Output(dirname(__FILE__)."/doc/angaben_fuer_Betreuer.pdf", 'F');
    $pdf->Close();

    $logtext = 'Das Dokument: Angaben für den Betreuer wurde am '.date("Y-m-d H:i:s").' von '.$_SESSION['userid'].' ('.$_SESSION['vorname'].' '.$_SESSION['nachname'].') erstellt und heruntergeladen.';
    $logtext = utf8_decode($logtext);
    $log = "../../changelogs/ausgabe.txt";
    $logdata = fopen("$log", "a");
    fwrite($logdata, $logtext."\n");
    fclose($logdata);

    header("Location:ausgabe_download.php?output=angaben_fuer_Betreuer");
    //header("Location:../ausgabe.php?task=3");
?>