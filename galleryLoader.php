<?php
require_once("./php/config.php");
$error = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $array = json_decode($_REQUEST["array"]);
    $array = json_decode($_REQUEST["array"]);
    $roots = json_decode($_REQUEST["roots"]);

    if (!empty($array)) {

        $sql = $conn->prepare("DELETE FROM `data`");
        $sql->execute();
        $sql = $conn->prepare("INSERT INTO data (root, name,folderName, url) VALUES (?,?,?,?)");
        for ($i = 0; $i < count($array); $i++) {
            $sql->bind_param("ssss", $root, $name, $folderName, $url);
            $root = $array[$i][0];
            $name = $array[$i][1];
            $folderName = $array[$i][2];
            $parentName = //$array[$i][3];
            $url = $array[$i][4] . "&export=download";
            $sql->execute();
        }
/*         $sql = $conn->prepare("DELETE FROM `roots`");
        $sql->execute();
        $sql = $conn->prepare("INSERT INTO roots (root, folderName, parentName) VALUES (?,?,?)");
        for ($i = 0; $i < count($roots); $i++) {
            $sql->bind_param("sss", $root, $folderName, $parentName);
            $root = $roots[$i][0];
            $folderName = $roots[$i][1];
            $parentName = $roots[$i][2];
            $sql->execute();
        } */
    }
}