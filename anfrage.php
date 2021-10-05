<?php
require_once("./php/config.php");
$error = false;
$price = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customization = json_decode($_REQUEST["customization"]);
    //print_r($_REQUEST);
    $textarea = $_REQUEST["textarea"];
    $id = $_REQUEST["id"];
    for ($i = 0; $i < count($customization); $i++) {
        $price += priceValidation($customization[$i]);
    }
    $sql = "SELECT * FROM data WHERE id LIKE'%$id%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $sql = "SELECT * FROM prices WHERE id LIKE'%$id%'";
            $ids = $conn->query($sql);
            while ($id = $ids->fetch_assoc()) {
                $price += intval($id["price"]);
                $visible = $id["visible"];
            }
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
?>
<div class="buy__container" id="buy">
    <form class="form-horizontal" action='./buy.php?customization=<?php echo $_REQUEST["customization"] ?>&id=<?php echo $_REQUEST["id"] ?>' method="post" enctype="multipart/form-data">
        <fieldset>
            <!-- Form Name -->
            <legend>Einkaufspreis <?php echo $price ?> EUR</legend>

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
            <!-- Text input-->
            <div class="form-group">
                <label class=" control-label" for="motorrad">MOTORRAD & BAUJAHR</label>
                <div class="">
                    <input id="motorrad" name="motorrad" type="motorrad" class="form-control input-md" required="">
                </div>
            </div>

            <!-- Textarea -->
            <div class="form-group">
                <label class=" control-label" for="textarea">Ich möchte andere Designänderungen
                    an diesem Sattel vornehmen</label>
                <div class="">
                    <textarea class="form-control" id="textarea" name="textarea"><?php echo $textarea ?></textarea>
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class=" control-label" for="singlebutton">ANFRAGE</label>
                <div class="">
                    <button type="submit" value="Upload Image" name="submit" id="buy__btn" class="item__button buy__button noUnderline">ANFRAGE</button>
                </div>
            </div>

        </fieldset>
    </form>
    <div id="log"></div>

</div>