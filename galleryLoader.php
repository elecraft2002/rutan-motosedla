<?php
require_once("./php/config.php");
require __DIR__ . "/php/resizeImg.php";
$error = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //max_execution_time = 3600;
    set_time_limit(3600);
    // collect value of input field
    $array = json_decode($_REQUEST["array"]);
    $photos = [];
    $imageNames = [];
    if (!empty($array)) {

        $sql = $conn->prepare("DELETE FROM `data`");
        $sql->execute();
        $sql = $conn->prepare("INSERT INTO data (id, root, name,folderName, url,nameWithType) VALUES (?,?,?,?,?,?)");
        for ($i = 0; $i < count($array); $i++) {
            $sql->bind_param("isssss", $i, $root, $name, $folderName, $url, $nameWithType);
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
        $fileRoot = __DIR__ . "/imgs/original/" . $imageNames[$i];
        if (!file_exists($fileRoot)) {
            save_image($photos[$i], $fileRoot);
            $resize = new ResizeImage($fileRoot);
            $resize->resizeTo(360, 360, "maxWidth");
            $resize->saveImage(__DIR__ . "/imgs/resized/" . $imageNames[$i], 75);
        }
    }
}
function save_image($inPath, $outPath)
{ //Download images from remote server
    $in =    fopen($inPath, "rb");
    $out =   fopen($outPath, "wb");
    while ($chunk = fread($in, 8192)) {
        fwrite($out, $chunk, 8192);
    }
    fclose($in);
    fclose($out);
}
