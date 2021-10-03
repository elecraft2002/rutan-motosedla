<?php

require_once __DIR__ . "/php/config.php";
require_once "./php/templates/functions.php";

$search = "";
$name = "";
$root = "";
$urlSmallSize = "";
$urlFullsize = "";
if (!empty($_GET["search"])) {
    $search = test_input($_GET["search"]);
}
$id = "";
if (!empty($_GET["id"])) {
    $id = test_input($_GET["id"]);
}
if (empty($_GET["id"]) && empty($_GET["search"])) {
    echo "redirect";
    header("Location: ./gallery.php");
    exit();
}
function product($conn, $id)
{
    $sql = "SELECT * FROM data WHERE id LIKE'%$id%'";
    $result = $conn->query($sql);
    global $name;
    global $root;
    global $urlSmallSize;
    global $urlFullsize;
    global $price;
    global $idProduct;

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $name = $row["name"];
            $root = $row["root"];
            $folderName = $row["folderName"];
            $nameWithType = $row["nameWithType"];
            $idProduct = $row["id"];

            $urlSmallSize = "./imgs/resized/" . "$folderName-$nameWithType";
            $urlFullsize = "./imgs/original/" . "$folderName-$nameWithType";

            if (!file_exists($urlSmallSize)) {
                $urlSmallSize = $row["url"];
                $urlFullsize = $row["url"];
            }
            $sql = "SELECT * FROM prices WHERE id LIKE'%$id%'";
            $ids = $conn->query($sql);
            while ($id = $ids->fetch_assoc()) {
                $price = $id["price"];
                $visible = $id["visible"];
            }
            if ($visible == 0) {
                header("Location: ./gallery.php");
                exit();
            }
        }
    } else {
        echo "redirect";
        header("Location: ./gallery.php");
        exit();
    }
}
product($conn, $id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/nav.css">
    <link rel="stylesheet" href="./styles/gallery.css">
    <script src="https://kit.fontawesome.com/7a91434f52.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./styles/product.css">
    <link rel="stylesheet" href="./styles/footer.css">
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.2.1/lightgallery.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.2.1/plugins/zoom/lg-zoom.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.2.1/plugins/thumbnail/lg-thumbnail.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.2.1/css/lg-fullscreen.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.2.1/css/lg-zoom.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.2.1/css/lightgallery.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.2.1/css/lightgallery-core.min.css">
    <title>Rutan Performance Product</title>
</head>

<body>
    <?php
    include "./php/templates/nav.php"
    ?>
    <main>
        <ul class="folder__container">
            <?php echo root("$search"); ?>
        </ul>
        <div class="content">
            <div id="gallery" class="content__img">
                <a class="noUnderline" href="<?php echo $urlFullsize; ?>">
                    <figure>
                        <img src="<?php echo $urlSmallSize ?>" alt="<?php echo $name ?>">
                    </figure>
                </a>
            </div>
            <div class="content__info">
                <h1>SEO Název</h1>
                <h2> <?php echo $name ?></h2>
                <p class="buy__price" id="price0">Preis : <span><?php echo $price ?></span> EUR
                </p>
                <div class="rendered-form">
                    <a id="ANPASSEN" class="item__button buy__button noUnderline">ANPASSEN</a>
                    <form class="form-horizontal form--hidden">
                        <fieldset>

                            <!-- Form Name -->
                            <legend>ANPASSEN</legend>

                            <!-- Multiple Checkboxes -->
                            <div class="form-group">
                                <label class=" control-label" for="0">Gelkissen 15mm STANDART
                                    integration <br>
                                    <span>60 Euro / pro platz</span></label>
                                <div class="">
                                    <div class="checkbox">
                                        <label for="0-0">
                                            <input type="checkbox" name="0" id="0-0" data-price="60" value="1">
                                            Fahrer
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label for="0-1">
                                            <input type="checkbox" name="0" id="0-1" data-price="60" value="2">
                                            Beifahrer
                                        </label>
                                    </div>
                                </div>
                                <figure class="form-group__container">
                                    <img class="form-group__img" loading="lazy" src="./imgs/sedlo.jpg" alt="">
                                </figure>
                            </div>

                            <!-- Multiple Checkboxes -->
                            <div class="form-group">
                                <label class=" control-label" for="1">Gelkissen 20mm PREMIUM
                                    integration <br> <span>90 Euro / pro platz</span></label>
                                <div class="">
                                    <div class="checkbox">
                                        <label for="1-0">
                                            <input type="checkbox" name="1" id="1-0" data-price="90" value="1">
                                            Fahrer
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label for="1-1">
                                            <input type="checkbox" name="1" id="1-1" data-price="90" value="2">
                                            Beifahrer
                                        </label>
                                    </div>
                                </div>
                                <figure class="form-group__container">
                                    <img class="form-group__img" loading="lazy" src="./imgs/sedlo.jpg" alt="">
                                </figure>
                            </div>

                            <!-- Multiple Checkboxes -->
                            <div class="form-group">
                                <label class=" control-label" for="2">Sitzheizung integration <br> <span>90 Euro / pro platz</span></label>
                                <div class="">
                                    <div class="checkbox">
                                        <label for="2-0">
                                            <input type="checkbox" name="2" id="2-0" data-price="90" value="1">
                                            Fahrer
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label for="2-1">
                                            <input type="checkbox" name="2" id="2-1" data-price="90" value="2">
                                            Beifahrer
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Multiple Checkboxes -->
                            <div class="form-group">
                                <label class=" control-label" for="3">Änderungen in der Höhe und der
                                    Breite <br> <span>20 Euro / pro platz</span></label>
                                <div class="">
                                    <div class="checkbox">
                                        <label for="3-0">
                                            <input type="checkbox" name="3" id="3-0" data-price="20" value="1">
                                            Fahrer
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label for="3-1">
                                            <input type="checkbox" name="3" id="3-1" data-price="20" value="2">
                                            Beifahrer
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Multiple Checkboxes -->
                            <div class="form-group">
                                <label class=" control-label" for="4">Ziernähte - quernähten und
                                    Rautensteppung <br> <span>20 Euro / pro platz</span></label>
                                <div class="">
                                    <div class="checkbox">
                                        <label for="4-0">
                                            <input type="checkbox" name="4" id="4-0" data-price="20" value="1">
                                            Fahrer
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label for="4-1">
                                            <input type="checkbox" name="4" id="4-1" data-price="20" value="2">
                                            Beifahrer
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Textarea -->
                            <div class="form-group">
                                <label class=" control-label" for="textarea">Ich möchte andere Designänderungen
                                    an diesem Sattel vornehmen</label>
                                <div class="">
                                    <textarea class="form-control" id="textarea" name="textarea"></textarea>
                                </div>
                            </div>

                        </fieldset>
                        <div class="buy">
                            <p class="buy__price" id="price">Preis : <span><?php echo $price ?></span> EUR
                            </p>
                            <a id="ANFRAGE" class="item__button buy__button noUnderline">ANFRAGE</a>
                        </div>
                    </form>

                </div>
            </div>
    </main>
    <?php include __DIR__ . "/php/templates/footer.php" ?>
</body>
<script>
    let id = "<?php echo $idProduct ?>"
</script>
<script defer src="./scripts/product.js"></script>
<script type="text/javascript">
    lightGallery(document.getElementById('gallery'));
</script>

</html>