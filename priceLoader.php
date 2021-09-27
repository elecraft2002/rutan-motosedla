<?php
require_once("./php/config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //max_execution_time = 3600;
    set_time_limit(3600);
    // collect value of input field
    $prices = json_decode($_REQUEST["prices"]);
    echo "čau";
    if (!empty($prices)) {
        $sql = $conn->prepare("DELETE FROM prices");
        $sql->execute();
        $sql = $conn->prepare("INSERT INTO prices (id, price,visible) VALUES (?,?,?)");
        for ($i = 0; $i < count($prices); $i++) {
            // if (is_numeric($array[$i][0])) {
            $sql->bind_param("sii", $id, $price, $visible);
            //$price = $prices[$i][3];
            $price = $prices[$i][1];
            $id = $prices[$i][0];
            $visible = $prices[$i][2];
            $visible = intval($visible);
            $sql->execute();
            //}
        }
    }
} ?>
<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <script>
        var xhr = new XMLHttpRequest();
        xhr.open("POST", 'http://localhost:3000/rutan-motosedla/priceLoader.php', true);

        //Send the proper header information along with the request
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() { // Call a function when the state changes.
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                // Request finished. Do processing here.
                console.log(this)
                document.getElementsByTagName("body")[0].innerHTML += this.responseText;
            }
        }
        xhr.send(`prices=[["id","cena EUR"],["1DdCiEczBVT9JHqe45HxBOipMAmEudCzg",199],["1JcFifijmV_nBBAUzRvcCqume2G2EWvwo",199],["1OeOkvSs_7pJPhguV-k5YqonP6tv5X5sh",199],["1WIXhSZmPTudG7JjSCtqH3VEiFtAbV5Nr",199],["1d7AtphTgZTnQ_sL4eZEBr3P1nuPeh3AL",199],["1gKZGezs4YhGu7Xxc673PPet1MFDPb7Ok",199],["1ghTAqtFMdjbMgzJs4rlu0F6bfY9z77q8",199],["1k0SZlnBen6SrNR5JZgQFDLob9i6mBlYv",199],["1rX_gcU00XbugzHCtENp4Cb2qwyhpWPy9",199]]`);
        // xhr.send(new Int8Array());
        // xhr.send(document);
    </script>

</body>

</html> -->