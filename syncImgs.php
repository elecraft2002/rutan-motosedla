<?php
require_once __DIR__ . "/php/config.php";
require __DIR__ . "/php/resizeImg.php";
$sql = "SELECT * FROM data LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $num = 0;
    while ($row = $result->fetch_assoc()) {
        $nameWithType = $row["nameWithType"];
        $folderName = $row["folderName"];
        $imageName = "$folderName - $nameWithType";
        $url = __DIR__ . "/imgs/original/" . $imageName;
        $photoUrl = $row["url"];
        if (!file_exists($url)) {
            /*             save_image($photoUrl, $url);
            $resize = new ResizeImage($url);
            $resize->resizeTo(360, 360, "maxWidth");
            $resize->saveImage(__DIR__ . "/imgs/resized/" . $imageNames, 75);
            echo $imageName . " $num <br>";
            $num++; */
            save_image($photoUrl, $url);
            $resize = new ResizeImage($url);
            $resize->resizeTo(360, 360, "maxWidth");
            $resize->saveImage(__DIR__ . "/imgs/resized/" . $imageName, 75);
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
