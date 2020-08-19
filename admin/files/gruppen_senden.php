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

$count_mgr = $_POST['mgr'];
$count_wgr = $_POST['wgr'];

$gruppen = array();

for($i = 1 ; $i <= $count_mgr; $i++){
    array_push($gruppen, array('m'.$i , $_POST['m_min_'.$i] , $_POST['m_max_'.$i] , $_POST['m_name_'.$i] , $_POST['m_betreuer_'.$i] , $_POST['m_zelt_'.$i])
    );
}
for($i = 1 ; $i <= $count_wgr; $i++){
    array_push($gruppen, array('w'.$i , $_POST['w_min_'.$i] , $_POST['w_max_'.$i] , $_POST['w_name_'.$i] , $_POST['w_betreuer_'.$i] , $_POST['w_zelt_'.$i])
    );
}

$file = fopen("doc/gruppen.csv", "w");
foreach($gruppen as $zeile){
    fputcsv($file, $zeile);
}
fclose($file);

header("Location:../gruppen.php?message=1")
?>