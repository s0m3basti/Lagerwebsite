<!DOCTYPE html>
<html lang="de">
    <head>
        <?php
            include 'files/linkmaker.php';
            
        ?>
		<title> Shop | DRK Sommercamp </title>
		<meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <script type="text/javascript" src="<?php echo(linkmaker("/files/active.js"))?>"></script>
	</head>
    
    <body>
         <!-- Header einfügen-->
          <?php
                include 'files/head.php';
                require 'files/cookie.php';
            ?>
        <div class="bg">
            <div id="Inhalt">
                    <p>Shop wird geladen ...</p>
                <script>
                    var spread_shop_config = {
                        shopName: 'DRK-Sommercamp',
                        locale: 'de_DE',
                        prefix: 'https://shop.spreadshirt.de',
                        baseId: 'Inhalt'
                    };
                </script>
                <script type="text/javascript"
                    src="https://shop.spreadshirt.de/shopfiles/shopclient/shopclient.nocache.js">
                </script>
            </div>
        </div>
            <!-- Footer einfügen -->
            <?php
                include 'files/footer.php';
            ?>
    </body>
</html>