<?php
require __DIR__ . "/php/resizeImg.php";
echo "ahoj<br>";
$imageNames = "LEV1-BR-3.jpg";
$photos = "https://drive.google.com/uc?id=1vKHJh2ryT6AUoqQ9UnItb86FAol-n0VV";
$fileRoot = __DIR__ . "/imgs/original/" . $imageNames;
if (!file_exists($fileRoot)) {
    echo "neexistuje";
    save_image($photos, $fileRoot);
    $resize = new ResizeImage($fileRoot);
    $resize->resizeTo(360, 360, "maxWidth");
    $resize->saveImage(__DIR__ . "/imgs/resized/$imageNames", 50);
} else {
    echo "Existuje";
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
