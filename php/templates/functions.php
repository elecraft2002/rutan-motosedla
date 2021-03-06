<?php
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
        sort($array);

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

    if ($result->num_rows > 0) {
        // output data of each row
        $out = "";

        while ($row = $result->fetch_assoc()) {
            $root = $row["root"];
            $model = str_replace("FOTOGALERIE", "", $root);
            $model[strlen($model) - 1] = " ";
            $model = str_replace("/", " - ", $model);
            $name = $row["name"];
            $productId = $row["id"];

            $sql = "SELECT * FROM prices WHERE id LIKE'%$productId%'";
            $ids = $conn->query($sql);
            while ($id = $ids->fetch_assoc()) {
                $price = $id["price"];
                $visible = $id["visible"];
            }

            $description = "Sattel für $model ab $price euro!";
            $link = "product.php?search=$search&page=$page&id=$productId";

            $nameWithType = $row["nameWithType"];
            $folderName = $row["folderName"];
            $url = "./imgs/resized/" . "$folderName-$nameWithType";

            if (!file_exists($url)) {
                $url = $row["url"];
            }
            if ($visible == 1) {
                $out .=                '<li class="item"><a class="noUnderline" href="' . $link . '">
<h3 class="item__name"></h3>
<figure class="img__container">
<img class="item__img" src="' . $url . '" alt="' . $name . '">
</figure>
<div class="item__info">
<div class="item--row">
<p class="item__price">AB ' . $price . ' EUR</p>
<a class="item__button noUnderline" href="' . $link . '">ANFRAGE</a>
</div>
</div></a>
</li>';
            }
/*             if ($visible == 1) {
                $out .=                '<li class="item"><a class="noUnderline" href="' . $link . '">
<h3 class="item__name"></h3>
<figure class="img__container">
<img class="item__img" src="' . $url . '" alt="' . $name . '">
</figure>
<div class="item__info">
<div class="item--row">
<p class="item__price">AB ' . $price . ' EUR</p>
<a class="item__button noUnderline" href="' . $link . '">ANFRAGE</a>
</div>
<p class="item__description">' . $description . '</p>
</div></a>
</li>';
            } */
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
    $rootArray = explode("/", $search);
    $link = "";
    for ($i = 0; $i < count($rootArray); $i++) {
        if ($rootArray[$i] != "") {
            $link .= $rootArray[$i] . "/";
            //echo "folder" . $root[$i] . "<br>";
            $out .= '<li class="folder__root">
<a class="root__file" href="gallery.php?search=' . $link . '">' . $rootArray[$i] . '</a><i class="fas fa-angle-right"></i>
</li>';
        }
    }
    return $out;
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
