<?php
require_once("./php/config.php");
require "./php/templates/functions.php";
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require './vendor/autoload.php';

$error = false;
$price = 0;
$info = "";
$text = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //print_r($_REQUEST);
    $textarea = $_REQUEST["textarea"];
    $id = $_REQUEST["id"];
    $name = $_REQUEST["given-name"];
    $surname = $_REQUEST["family-name"];
    $tel = $_REQUEST["tel"];
    $email = $_REQUEST["email"];
    $motorrad = $_REQUEST["motorrad"];
    $customization = $_REQUEST["customization"];

    $customization = json_decode($customization);
    $textarea = test_input($textarea);
    $id = test_input($id);
    $name = test_input($name);
    $surname = test_input($surname);
    $tel = test_input($tel);
    $email = test_input($email);
    $motorrad = test_input($motorrad);


    for ($i = 0; $i < count($customization); $i++) {
        $price += priceValidation($customization[$i]);
        $info .= infoText($customization[$i]);
    }
    $sql = "SELECT * FROM data WHERE id LIKE'%$id%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {

            $sattleName = $row["name"];
            $root = $row["root"];
            $url = $row["url"];


            $sql = "SELECT * FROM prices WHERE id LIKE'%$id%'";
            $ids = $conn->query($sql);
            while ($id = $ids->fetch_assoc()) {
                $price += intval($id["price"]);
                $visible = $id["visible"];
            }
        }
    } else {
        $error = true;
    }
    //echo $info;
    //echo $price;

    $text = '<body>
    <div class="container">

        <div class="container__info">
            <img src="http://rutan-performance.com/imgs/logo.png" width="100" alt="Rutan logo">
            <h1>Nová obědnávka z Motosedla DE</h1>
            <h2>Sedlo</h2>
            <div>
                <p>Jméno sedla :<b> ' . $sattleName . '</b></p>
                <p>Cesta k sedlu : ' . $root . '</p>
            </div>
            <h2>Konfigurace</h2>
            <div>' . $info . '</div>
            <h2>Cena</h2>
            <div><b>' . $price . ' EUR<b></div>
            <h2>Info</h2>
            <div>
                <p>Jméno : ' . $name . '</p>
                <p>Příjmení : ' . $surname . '</p>
                <p>Telefon : ' . $tel . '</p>
                <p>Email : ' . $email . '</p>
                <p>Typ motorky : ' . $motorrad . '</p>
            </div>
        </div>
        <figure>
            <img src="' . $url . '" width="400" alt="Sedlo">
        </figure>
    </div>

    <style>
        .container__info div {
            font-size: 1.2em;
            padding-left: 1rem;
            border-left: 5px #ffc107 solid;
        }

        .container__info h2 {
            font-size: 1.1em;
            color:black;
        }
        .container__info p {
            font-size: 1.5em;
        }

        .container {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;

        }
    </style>
</body>';

    if (true) {
        //echo $text;
        //Create an instance; passing 'true' enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.volny.cz';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

            $mail->Username   = 'rutanmotosedla@volny.cz';                     //SMTP username
            $mail->Password   = 'Rutanmotosedla2021';                               //SMTP password
            //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set 'SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS'

            //Recipients
            $mail->setFrom('rutanmotosedla@volny.cz', 'Mailer');
            $mail->addAddress('manickaczru@gmail.com', 'Joe User');     //Add a recipient

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Motosedla DE';
            $mail->Body    = $text;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            //echo 'Message has been sent';
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

function priceValidation($id)
{
    $id = explode("-", $id);
    $id = $id[0];
    if ($id == 0)
        return 60;
    if ($id == 1)
        return 90;
    if ($id == 2)
        return 90;
    if ($id == 3)
        return 20;
    if ($id == 4)
        return 20;
}
function infoText($ids)
{
    $ids = explode("-", $ids);
    $id = $ids[0];
    $type = $ids[1];

    if ($type == 0)
        $settle = "u <b>ŘIDIČE</b>";
    if ($type == 1)
        $settle = "u <b>SPOLUJEZDECE</b>";

    if ($id == 0) {
        $out = "Gelový polštářek 15 mm STANDART $settle za <b>60 EUR</b>
<br>";
        return $out;
    }
    if ($id == 1) {
        $out = "Gelový polštářek 20 mm PREMIUM $settle za <b>90 EUR</b>
    <br>";
        return $out;
    }
    if ($id == 2) {
        $out = "Vyhřívání sedadla $settle za <b>90 EUR</b>
        <br>";
        return $out;
    }
    if ($id == 3) {
        $out = "Změny výšky a šířky $settle za <b>20 EUR</b>
            <br>";
        return $out;
    }
    if ($id == 4) {
        $out = "Dekorativní vyšívání - křížkové vyšívání a vyšívání kosočtverců $settle za <b>20 EUR</b>
                <br>";
        return $out;
    }
}
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
    <title>Rutan Performance Kauf</title>
</head>

<body>
    <?php
    include "./php/templates/nav.php"
    ?>
    <main>
        <div>
            <h2>Wir danken Ihnen für Ihren Kauf.</h2>
            <a href="./index.php">
                <figure><img src="./imgs/logo.png" width="200" alt="Rutan logo"></figure>
            </a>
        </div>
    </main>
    <?php include __DIR__ . "/php/templates/footer.php" ?>
    <style>
        main {
            flex-direction: column;
            width: 100vw;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-items: center;
            align-items: center;
            text-align: center;
            max-width: 100vw;
        }

        main div {
            margin-top: 30vh;
        }
        img {
            max-width: 200px;
        }

        .navigation {
            width: 100vw;
        }
    </style>
</body>

</html>