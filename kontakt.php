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
    <script src="https://kit.fontawesome.com/7a91434f52.js" crossorigin="anonymous"></script>
    <?php
    include "./php/templates/header.php"
    ?>
</head>

<body>
    <?php include __DIR__ . "/php/templates/nav.php"
    ?>
    <main>
        <h1>Rutan Performance Konakt</h1>
        <!--         <div class="doba">
            <h2>Betriebszeiten:</h2>
            <p><span>MON-FRI: 9-15h</span> !!! IMMER NACH VORHERIGER TELEFONISCHER VEREINBARUNG</p>
        </div> -->
        <div>
            <!-- <h2>Wo Sie uns finden</h2> -->
            <div class="info">
                <!--                 <div class=" info--left">
                    <p>RUTAN ACCESSORIES s.r.o.</p>
                    <p>OPERATIONEN</p>
                    <p>Mníšecká 107</p>
                    <p>463 31 Mníšek _ Fojtka</p>
                </div> -->
                <div class=" info--left">
                    <p>Ich spreche Deutsch</p>
                    <p>Ich spreche Englisch</p>
                    <p>E-mail:</p>
                </div>
                <div class="info--right">
                    <p><span> <a href="tel:+420 735 757 027">+420 735 757 027</a></span></p>
                    <p><span><a href="tel:+420 733 612 642">+420 733 612 642</a></span>
                    </p>
                    <p><span> <a href="mailto:info@rutan-performance.com">info@rutan-performance.com</a></span></p>
                </div>
            </div>
            <h2>RUTAN ACCESSORIES s.r.o. ; Mníšecká 107/e ; 463 31 Mníšek – Fojtka ; Tschechien</h2>
            <p>Bestellvorgang - senden Sie uns eine Anfrage mit dem Motorradtyp an <span> <a href="mailto:info@rutan.cz">info@rutan.cz</a></span> oder verwenden Sie das
                untenstehende Kontaktformular. Geben Sie an, welche Änderungen Sie wünschen, und wir senden Ihnen ein
                Angebot mit Fotos und weiteren Informationen.

                <br>Dann schicken Sie uns den Sattel, wir wählen gemeinsam eine Designkonfiguration aus und haben ihn
                innerhalb von zwei Wochen zurück!
            </p>
        </div>
        <form class="form-horizontal" action='./kontaktPost.php' method="post" enctype="multipart/form-data">
            <fieldset>
                <!-- Form Name -->
                <legend>KONTAKT</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class=" control-label" for="given-name">Name</label>
                    <div class="">
                        <input id="given-name" name="given-name" type="text" placeholder="Name" class="form-control input-md" required="">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class=" control-label" for="family-name">Nachname</label>
                    <div class="">
                        <input id="family-name" name="family-name" type="text" placeholder="Nachname" class="form-control input-md" required="">
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class=" control-label" for="tel">Telefon</label>
                    <div class="">
                        <input id="tel" name="tel" type="tel" placeholder="Telefon" class="form-control input-md" required="">
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class=" control-label" for="email">Email</label>
                    <div class="">
                        <input id="email" name="email" type="email" placeholder="Email" class="form-control input-md" required="">
                    </div>
                </div>

                <!-- Textarea -->
                <div class="form-group">
                    <label class=" control-label" for="textarea">Bericht</label>
                    <div class="">
                        <textarea class="form-control" id="textarea" name="textarea"></textarea>
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class=" control-label" for="singlebutton">SENDEN</label>
                    <div class="">
                        <button type="submit" value="Upload Image" name="submit" id="buy__btn" class="item__button buy__button noUnderline">ANFRAGE</button>
                    </div>
                </div>

            </fieldset>
        </form>
    </main>
    <?php include __DIR__ . "/php/templates/footer.php" ?>
</body>

</html>