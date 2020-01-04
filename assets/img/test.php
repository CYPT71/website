<?php
function LoadGif($imgname)
{
    /* Tente d'ouvrir l'image */
    $im = @imagecreatefromgif($imgname);

    /* Traitement si l'ouverture a échoué */
    if(!$im)
    {
        /* Création d'une image vide */
        $im = imagecreatetruecolor (150, 30);
        $bgc = imagecolorallocate ($im, 255, 255, 255);
        $tc = imagecolorallocate ($im, 0, 0, 0);

        imagefilledrectangle ($im, 0, 0, 150, 30, $bgc);

        /* Affiche un message d'erreur dans l'image */
        imagestring ($im, 1, 5, 5, 'Error loading ' . $imgname, $tc);
    }

    return $im;
}

header('Content-Type: image/gif');

$img = LoadGif('background.gif');

imagegif($img);
imagedestroy($img);

?>