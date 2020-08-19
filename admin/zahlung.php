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
?>

<!DOCTYPE HTML>
<head>
    <title> Zahlungsportal | Admin | DRK Sommercamp </title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" id="favicon">
    <link rel="stylesheet" href="CSS/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
        const status = <?php echo $status ?>
    </script>
    <script src="files/indexstatus.js" defer></script>
</head>
<body>
    <?php
        require("files/nav.html");
    ?>
    <div class="content">
        <h1>Zahlungsportal</h1>
        <h2>Hier siehst du alle noch offenen Zahlungen.</h2>
        
    </div>
</body>
</html>