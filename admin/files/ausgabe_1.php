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
    
          $this->SetFont('', 'C', 50);
          $this->SetTextColor(209,183,49);
          $this->Ln(5);        
          $this->Cell(0, 0, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    
        }
        public function Footer() {
            $this->SetY(-15);
           $this->SetFont('helvetica', 'I', 10);
          $this->Cell(0, 0, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    
        }
    }

    $header = '
        <h1 style="font-size: 14pt; text-decoration: underline; text-align: center;">
            Teilnehmerübersicht - '.$jahr.'
        </h1>
    ';
    $footer = '
        <br><br>
        <hr>
        <table style="width: 100%; font-size: 8pt">
            <tr>
                <td style="text-align: left; padding-top: 4px;">DRK-Sommercamp '.$jahr.'</td>
                <td style="text-align: right; padding-top: 4px;">Erstellt am: '.date('d.m.Y').'</td>
            </tr>
        </table>
    ';
    $table_head = '
        
    ';

    $html = nl2br(trim($header)).'
            <table style="width: 100%; font-size: 10pt; border: solid 1px black; padding: 2px;">
            <tr style="border: solid 1px black; text-align: center; background-color: lightgrey;">
                <td style="border: solid 1px black;"></td>
                <td style="border: solid 1px black;">Vorname</td>
                <td style="border: solid 1px black;">Nachname</td>
                <td style="border: solid 1px black;">Geschlecht</td>
                <td style="border: solid 1px black;">Geburtstag</td>
                <td style="border: solid 1px black;">Alter im Lager</td>
            </tr>';
            try{
                $db = new PDO("$host; $name" ,$user,$pass);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                $i = 0;
                $sql = "SELECT * 
                        FROM tbl_stammdaten 
                        WHERE Jahr = $jahr 
                        ORDER BY Geschlecht, LagerAlter, Nachname, Vorname DESC;";
                foreach ($db->query($sql) as $row){
                    $i++;
                    $html.= '<tr style="border: solid 1px black;">
                        <td style="border: solid 1px black; text-align:right;">'.$i.'</td>
                        <td style="border: solid 1px black; text-align:right;">'.$row['Nachname'].'</td>
                        <td style="border: solid 1px black; text-align:right;">'.$row['Vorname'].'</td>
                        <td style="border: solid 1px black; text-align:right;">'.$row['Geschlecht'].'</td>
                        <td style="border: solid 1px black; text-align:right;">'.date('d.m.Y',strtotime($row['Geburtstag'])).'</td>
                        <td style="border: solid 1px black; text-align:right;">'.$row['LagerAlter'].'</td>
                    </tr>';
                };
                echo "</table>";
            }
            catch(PDOException $e){
                $fehler = $e->getMessage();
                echo "Es ist ein Fehler bei der Kommunikation mit der Datenbank aufgetreten. </br> $fehler";
            }
            finally{
                $db = null;
            }
        
    $html .= 
        '</table>
        '.$footer;


$pdf = new MYPDF("L", "mm", "A4", true, 'UTF-8', false);
 
$pdf->SetCreator("DRK Sommercamp");
$pdf->SetAuthor("DRK Sommercamp");
$pdf->SetTitle('Teilnehmerübersicht');
$pdf->SetSubject('Teilnehmerübersicht');
 
$pdf->SetAutoPageBreak(TRUE);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
$pdf->SetFont('dejavusans', '', 12);
$pdf->SetMargins(5, 0, 5, true);

$pdf->AddPage();
 
$pdf->writeHTML($html, true, false, true, false, '');
 
$pdf->Output(dirname(__FILE__)."/doc/übersicht.pdf", 'F');
  

    // $header = '
    //     <hr>
    //         <h1 style="font-size: 16pt; text-decoration: underline;">
    //             Teilnehmerübersicht - '.$jahr.'
    //         </h2>
    //     <hr>
    // ';

    // $footer = '
    //     <hr>
    //         <table style="width: 100%; bottom: 0">
    //             <tr>
    //                 <td style="text-align: left;">DRK-Sommercamp '.$jahr.'</td>
    //                 <td style="text-align: right">Erstellt am: '.date('d.m.Y').'</td>
    //             </tr>
    //         </table>
    // ';

    // $html= '
    //     <table>
    //         <tr>
    //             <td>'.nl2br(trim($header)).'</td>
    //         </tr>
    //         <tr>
    //             Content goes here
    //         </tr>
    //     </table>
    //     '.nl2br(trim($footer)).'
    // ';

    // $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // $pdf->setCreator("DRK Sommercamp");
    // $pdf->setTitle("Teilnehmerübersicht",true);
    // $pdf->setSubject("Teilnehmerübersicht",true);

    // $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    // $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    // $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    // $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    // $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    // $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // $pdf->SetFont('dejavusans ', '', 12);

    // $pdf->AddPage();
    // $pdf->writeHTML($html, true, false, true, false, '');
    // $pdf->Output("übersicht.pdf","I");
    // // $pdf->Output("doc/übersicht.pdf", 'F');

    header("Location:../ausgabe.php?task=1&download=1");

?>