<?php

require_once("./php/config.php");

$search = "";
$itemnum = 15;
//$search = "FOTOGALERIE";
if (!empty($_GET["search"])) {
    $search = htmlspecialchars($_GET["search"]);
}
//searchFolders($conn, $search);
//searchItems($conn, $search);
//echo $actual_link;

function searchFolders($conn, $search)
{
    $array = [];
    //echo $folderName;
    $sql = "SELECT root FROM data WHERE root LIKE '%$search%'";
    //$sql = "SELECT * FROM data WHERE root LIKE '%$search%' AND folderName LIKE '%$folderName%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $root = $row["root"];
            $root = str_replace($search, "", $root);
            $root = explode("/", $root);

            array_push($array, $root[0]);
        }

        $array = array_unique($array);

        for ($i = 0; $i < count($array); $i++) {
            if (!isset($array[$i])) {
                $array = array_splice($array, $i);
            }
        }
        $out = "";
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i] != "") {
                $link = $search . $array[$i];
                //$out .= '<a href="gallery.php?search=' . $link . '/">';
                //$out .= "$array[$i]</a><br>";
                $out .=                     '<li class="folders__button">
            <a class="folders__text noUnderline" href="gallery.php?search=' . $link . '/">' . $array[$i] . '</a>
        </li>';
            }
        }
        return $out;
    } else {
        return "";
    }
}

function searchItems($conn, $search)
{
    //Počet produktů na stránce
    global $itemnum;
    $page = 0;
    if (!empty($_GET["page"]) && is_numeric($_GET["page"]))
        $page = $_GET["page"];
    $offset = $page * $itemnum;
    $sql = "SELECT * FROM data WHERE root LIKE'%$search%' LIMIT $itemnum OFFSET  $offset";
    $result = $conn->query($sql);
    $price = 199;

    if ($result->num_rows > 0) {
        // output data of each row
        $out = "";

        while ($row = $result->fetch_assoc()) {
            $root = $row["root"];
            $model = str_replace("FOTOGALERIE", "", $root);
            $model[strlen($model) - 1] = " ";
            $model = str_replace("/", " - ", $model);
            $name = $row["name"];
            $id = $row["id"];
            $description = "Sattel für $model ab 199 euro!";
            $link = "product.php?search=$search&page=$page&id=$id";

            $nameWithType = $row["nameWithType"];
            $folderName = $row["folderName"];
            $url = __DIR__ . "/imgs/resized/" . "$folderName-$nameWithType";

            if (!file_exists($url)) {
                $url = $row["url"];
            }

            $out .=                '<li class="item">
            <h3 class="item__name"><a href="' . $link . '">' . $name . '</a></h3>
            <figure class="img__container">
                <img class="item__img" src="' . $url . '" alt="' . $name . '">
            </figure>
            <div class="item__info">
                <div class="item--row">
                    <p class="item__price">AB ' . $price . ' EUR</p>
                    <a class="item__button noUnderline" href="' . $link . '">ANFRAGE</a>
                </div>
                <p class="item__description">' . $description . '</p>
            </div>
        </li>';
        }
        return $out;
    }
    return "";
}
function nextPage($conn, $search)
{
    //Počet produktů na stránce
    global $itemnum;
    $page = 0;
    if (!empty($_GET["page"]) && is_numeric($_GET["page"]))
        $page = $_GET["page"];
    $offset = $page * $itemnum + $itemnum;
    $sql = "SELECT root FROM data WHERE root LIKE '%$search%'";
    $result = $conn->query($sql);
    if ($result->num_rows > $offset) {
        return true;
    }
    return false;
}

function folderName($search)
{

    $folder = explode("/", $search);
    $folderName = $folder[count($folder) - 2];
    return $folderName;
}

function pages($conn, $search)
{
    $out = "";
    $page = 0;
    if (!empty($_GET["page"]) && is_numeric($_GET["page"]))
        $page = $_GET["page"];
    $next = "inactive";
    $back = "inactive";
    $pageBack = $page;
    $pageNext = $page;
    if (nextPage($conn, $search)) {
        $next = "active";
        $pageNext = $page + 1;
    }
    if ($page > 0) {
        $back = "active";
        $pageBack = $page - 1;
    }

    $out .= '<a class="pages__button noUnderline pages__button--' . $back . '" href="gallery.php?search=' . $search . "&page=" . $pageBack . '"><i class="fas fa-angle-left"></i>Vorherige Seite</a>';
    $out .= '<a class="pages__button noUnderline pages__button--' . $next . '" href="gallery.php?search=' . $search . "&page=" . $pageNext . '">Nächste Seite<i class="fas fa-angle-right"></i></a>';
    return $out;
}

function root($search)
{
    $out = "";
    $root = explode("/", $search);
    $link = "";
    for ($i = 0; $i < count($root); $i++) {
        if ($root[$i] != "") {
            $link .= $root[$i] . "/";
            //echo "folder" . $root[$i] . "<br>";
            $out .= '<li class="folder__root">         
               <a class="root__file" href="gallery.php?search=' . $link . '">' . $root[$i] . '</a><i class="fas fa-angle-right"></i>     
              </li>';
        }
    }
    return $out;
}
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="stylesheet" href="./styles/nav.css">
    <link rel="stylesheet" href="./styles/gallery.css">
    <script src="https://kit.fontawesome.com/7a91434f52.js" crossorigin="anonymous"></script>
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
                <!-- <h1>Rutan performance sedla</h1> -->
                <ul class="folder__container">
                    <?php echo root($search) ?>
                </ul>
                <h2 class="folder__dir"><?php

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
</body>

</html>