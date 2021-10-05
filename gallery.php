<?php

require_once("./php/config.php");
require "./php/templates/functions.php";

$search = "";
$itemnum = 15;
//$search = "FOTOGALERIE";
if (!empty($_GET["search"])) {
    $search = test_input($_GET["search"]);
}
//searchFolders($conn, $search);
//searchItems($conn, $search);
//echo $actual_link;
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rutan Performance Galerie</title>
    <link rel="stylesheet" href="./styles/normalize.css">
    <link rel="stylesheet" href="./styles/nav.css">
    <link rel="stylesheet" href="./styles/gallery.css">
    <link rel="stylesheet" href="./styles/footer.css">
    <script src="https://kit.fontawesome.com/7a91434f52.js" crossorigin="anonymous"></script>
    <?php
    include "./php/templates/header.php"
    ?>
</head>

<body>
    <?php include __DIR__ . "/php/templates/nav.php"
    ?>
    <div class="folders">
        <div class="folders__sub">
            <p class="folders__name"></p>
        </div>
    </div>
    <?php //echo searchFolders($conn, $search) 
    ?>
    <?php //echo searchItems($conn, $search) 
    ?>
    <main>
        <div class="controlls">
            <div class="folder__container">
                <h1>Professionelle Anpassung der Motorradsitzbänke Rutan Performance Gallery</h1>
                <ul class="folder__container">
                    <?php echo root($search) ?>
                </ul>
                <h2 class="folder__dir">
                    <?php

                    $folderName = explode("/", $search);
                    if (isset($folderName[count($folderName) - 2])) {
                        $folderName = $folderName[count($folderName) - 2];
                    } else {
                        $folderName = "";
                    }
                    echo $folderName;
                    ?></h2>
                <ul class="folders">
                    <?php
                    echo searchFolders($conn, $search)
                    ?>
                </ul>
            </div>
        </div>
        <div class="items__container">
            <ul class="items">
                <?php
                echo searchItems($conn, $search)
                ?>
            </ul>
        </div>
        <div class="pages">
            <?php
            echo pages($conn, $search)
            ?>
        </div>
    </main>
    <?php include __DIR__ . "/php/templates/footer.php" ?>
</body>

</html>