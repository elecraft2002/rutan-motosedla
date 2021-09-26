<?php
require_once("./php/config.php");
$error = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $array = json_decode($_REQUEST["array"]);
    $photos = [];
    $imageNames = [];
    if (!empty($array)) {

        $sql = $conn->prepare("DELETE FROM `data`");
        $sql->execute();
        $sql = $conn->prepare("INSERT INTO data (id, root, name,folderName, url) VALUES (?,?,?,?,?)");
        for ($i = 0; $i < count($array); $i++) {
            $sql->bind_param("issss", $i, $root, $name, $folderName, $url);
            $root = $array[$i][0];
            $name = $array[$i][1];
            $nameWithType = $array[$i][2];
            $folderName = $array[$i][3];
            $url = $array[$i][4] . "&export=download";
            $sql->execute();
            $imageName = "$folderName-$nameWithType";
            array_push($imageNames, $imageName);
            array_push($photos, $url);
        }
    }
    for ($i = 0; $i < count($photos); $i++) {
        $imageNameSearch = $imagenames[$i];
        if (!file_exists(__DIR__ . "imgs/resized/$imageNameSearch")) {
            $resize = new ResizeImage($photos[$i]);
            $resize->resizeTo(100, 100, "maxWidth");
            $resize->saveImage(__DIR__ . "imgs/resized/$imageNameSearch");
        }
    }
}
