<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rutan Performance Kontakt</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="./styles/normalize.css">
    <link rel="stylesheet" href="./styles/nav.css">
    <link rel="stylesheet" href="./styles/gallery.css">
    <link rel="stylesheet" href="./styles/kontakt.css">
    <link rel="stylesheet" href="./styles/footer.css">
    <link rel="stylesheet" href="./styles/product.css">
    <link rel="stylesheet" href="./styles/preisliste.css">
    <script src="https://kit.fontawesome.com/7a91434f52.js" crossorigin="anonymous"></script>
    <?php
    include "./php/templates/header.php"
    ?>
</head>

<body>
    <?php include __DIR__ . "/php/templates/nav.php"
    ?>
    <main>
        <h1>Rutan Performance Preisliste</h1>
        <fieldset>

            <!-- Form Name -->
            <legend>ANPASSEN</legend>

            <!-- Multiple Checkboxes -->
            <div class="form-group">
                <label class=" control-label" for="0">Gelkissen 15mm STANDART
                    integration <br>
                    <span>60 Euro / pro platz</span></label>

                <figure class="form-group__container">
                    <img class="form-group__img" loading="lazy" src="./imgs/sedlo.jpg" alt="">
                </figure>
            </div>

            <!-- Multiple Checkboxes -->
            <div class="form-group">
                <label class=" control-label" for="1">Gelkissen 20mm PREMIUM
                    integration <br> <span>90 Euro / pro platz</span></label>

                <figure class="form-group__container">
                    <img class="form-group__img" loading="lazy" src="./imgs/sedlo.jpg" alt="">
                </figure>
            </div>

            <!-- Multiple Checkboxes -->
            <div class="form-group">
                <label class=" control-label" for="2">Sitzheizung integration <br> <span>90 Euro / pro platz</span></label>
            </div>

            <!-- Multiple Checkboxes -->
            <div class="form-group">
                <label class=" control-label" for="3">Änderungen in der Höhe und der
                    Breite <br> <span>20 Euro / pro platz</span></label>

            </div>

            <!-- Multiple Checkboxes -->
            <div class="form-group">
                <label class=" control-label" for="4">Ziernähte - quernähten und
                    Rautensteppung <br> <span>20 Euro / pro platz</span></label>
            </div>
            </div>
        </fieldset>
    </main>
    <?php include __DIR__ . "/php/templates/footer.php" ?>
</body>

</html>