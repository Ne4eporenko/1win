<?php
set_time_limit(0);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

function webp($src, $q) {
    $dir = pathinfo($src, PATHINFO_DIRNAME);
    $name = pathinfo($src, PATHINFO_FILENAME);
    $ext = pathinfo($src, PATHINFO_EXTENSION);
    $dest = "{$dir}/{$name}.webp";
    $is_alpha = false;
    if (mime_content_type($src) == 'image/png') {
        $is_alpha = true;
        $img = imagecreatefrompng($src);
    } elseif (mime_content_type($src) == 'image/jpeg') {
        $img = imagecreatefromjpeg($src);
    }
    else {
        return $src;
    }
    if ($is_alpha) {
        imagepalettetotruecolor($img);
        imagealphablending($img, true);
        imagesavealpha($img, true);
    }
    imagewebp($img, $dest, $q);
    return $dest;
}
function readDirectory()
{
    $iterator = new GlobIterator(__DIR__."/*.png");
    $filelist = array();
    foreach($iterator as $entry) {
        $filelist[] = $entry->getFilename();
    }
    return $filelist;

}
$files = readDirectory();
//echo '<pre>';
//print_r ($files);
//echo '</pre>';
foreach ($files as $el) {
    var_dump(webp(__DIR__.'/'.$el, 70));
}

//var_dump(webp(__DIR__.'/f0523e9ecde5ad8b11164fad48d4fe158acdee47.jpg', 60));
