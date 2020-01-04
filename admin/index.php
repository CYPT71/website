<?php

require 'vendor/controler.php';

// on défini le répertoire où sont stockées les images de grande taille
$dir = '../pics';
// on défini le répertoire où seront stockées les miniatures
$dir_mini = '../mini';
// on défini une variable $ratio qui vaudra 150 dans notre cas (150 pixels). En fait, pour nos miniatures, nous allons respecter le ratio de l'image originale, mais nous allons forcer sa taille à 150 pixels, soit en hauteur soit en largeur (tout dépend de l'orientation de notre image : paysage ou portrait).
$ratio = 150;

// on teste si le formulaire permettant d'uploader un fichier a été soumis
if (isset($_POST['go'])) {
	// on teste si le champ permettant de soumettre un fichier est vide ou non
	if (empty($_FILES['mon_image']['tmp_name'])) {
	// si oui, on affiche un petit message d'erreur
	$erreur = 'Aucun fichier envoyé.';
	}
	else {
	// on examine le fichier uploadé en récupérant de nombreuses informations sur ce fichier (je vous suggère de regarder la documentation de la fonction getimagesize pour de plus amples informations)
	$tableau = @getimagesize($_FILES['mon_image']['tmp_name']);
	if ($tableau == FALSE) {
		// si le fichier uploadé n'est pas une image, on efface le fichier uploadé et on affiche un petit message d'erreur
		unlink($_FILES['mon_image']['tmp_name']);
		$erreur = 'Votre fichier n\'est pas une image.';
	}
	else {
		// on teste le type de notre image : jpeg ou png
		if ($tableau[2] == 2 || $tableau[2] == 3) {
		// si on a déjà un fichier qui porte le même nom que le fichier que l'on tente d'uploader, on modifie le nom du fichier que l'on upload
		if (is_file('../pics/'.$_FILES['mon_image']['name'])) $file_upload = '_'.$_FILES['mon_image']['name'];
		else $file_upload = $_FILES['mon_image']['name'];

		// on copie le fichier que l'on vient d'uploader dans le répertoire des images de grande taille
		copy ($_FILES['mon_image']['tmp_name'], $dir.'/'.$file_upload);

		// il nous reste maintenant à générer la miniature

		// si notre image est de type jpeg
		if ($tableau[2] == 2) {
			// on crée une image à partir de notre grande image à l'aide de la librairie GD
			$src = imagecreatefromjpeg($dir.'/'.$file_upload);
			// on teste si notre image est de type paysage ou portrait
			if ($tableau[0] > $tableau[1]) {
			$im = imagecreatetruecolor(round(($ratio/$tableau[1])*$tableau[0]), $ratio);
			imagecopyresampled($im, $src, 0, 0, 0, 0, round(($ratio/$tableau[1])*$tableau[0]), $ratio, $tableau[0], $tableau[1]);
			}
			else {
			$im = imagecreatetruecolor($ratio, round(($ratio/$tableau[0])*$tableau[1]));
			imagecopyresampled($im, $src, 0, 0, 0, 0, $ratio, round($tableau[1]*($ratio/$tableau[0])), $tableau[0], $tableau[1]);
			}
			// on copie notre fichier généré dans le répertoire des miniatures
			imagejpeg ($im, $dir_mini.'/'.$file_upload);
		}
		elseif ($tableau[2] == 3) {
			$src = imagecreatefrompng($dir.'/'.$file_upload);
			if ($tableau[0] > $tableau[1]) {
			$im = imagecreatetruecolor(round(($ratio/$tableau[1])*$tableau[0]), $ratio);
			imagecopyresampled($im, $src, 0, 0, 0, 0, round(($ratio/$tableau[1])*$tableau[0]), $ratio, $tableau[0], $tableau[1]);
			}
			else {
			$im = imagecreatetruecolor($ratio, round(($ratio/$tableau[0])*$tableau[1]));
			imagecopyresampled($im, $src, 0, 0, 0, 0, $ratio, round($tableau[1]*($ratio/$tableau[0])), $tableau[0], $tableau[1]);
			}
			imagepng ($im, $dir_mini.'/'.$file_upload);
		}
		// on redirige l'administrateur vers l'accueil de la partie admin
		header('location: index.php');
		exit();
		}
		else {
		// si notre image n'est pas de type jpeg ou png, on supprime le fichier uploadé et on affiche un petit message d'erreur
		unlink($_FILES['mon_image']['tmp_name']);
		$erreur = 'Votre image est d\'un format non supporté.';
		}
	}
	}
}

// on teste si le formulaire permettant de supprimer un fichier à été soumis
if (isset($_GET['del'])) {
	if (empty($_GET['del'])) {
	// si le paramètre n'est pas renseignée, on affiche un petit message d'erreur
	$erreur = 'Aucune image à supprimer';
	}
	else {
	$pic_a_zapper = $_GET['del'];
	// si l'image existe ainsi que sa miniature, on les supprime
	if (is_file('../mini/'.$pic_a_zapper) && is_file('../pics/'.$pic_a_zapper)) {
		unlink('../mini/'.$pic_a_zapper);
		unlink('../pics/'.$pic_a_zapper);
	}
	// si l'image ou la miniature n'existe pas, on affiche un message d'erreur
	else {
		$erreur = 'Image non reconnue';
	}
	}
}
?>
<html>
<body>

<!-- on affiche un formulaire permettant d'uploader une image -->
Ajouter une photo à la galerie :<br /><br />

<form action="index.php" method="post" enctype="multipart/form-data">
<input type="file" name="mon_image" /> <input type="submit" name="go" value="Envoyer" />
</form>

<hr />

<!-- on affiche toutes les miniatures munies d'un lien permettant de supprimer les images -->
Supprimer une photo de la galerie (cliquer sur la miniature pour supprimer la photo) :<br /><br />
<?php
// l'étude de cette portion de code a déjà été faite plus haut
$tableau = array();
$dossier = opendir ('../mini/');
while ($fichier = readdir ($dossier)) {
	if ($fichier != '.' && $fichier != '..' && $fichier != 'index.php') {
	$tableau[] = $fichier;
	}
}
closedir ($dossier);

$nbcol=2;
$nbpics = count($tableau);

if ($nbpics != 0) {
	echo '<table>';
	for ($i=0; $i<$nbpics; $i++){
	if($i%$nbcol==0) echo '<tr>';
	// on affiche un lien sur la photo permettant de la supprimer
	echo '<td><a href="index.php?del=' , $tableau[$i] , '"><img src="../mini/' , $tableau[$i] , '" alt="Image" /></a></td>';
	if($i%$nbcol==($nbcol-1)) echo '</tr>';
	}
	echo '</table>';
}
else echo 'Aucune image à afficher';

// si un message d'erreur est défini, on l'affiche
if (isset($erreur)) echo '<br />' , $erreur;
?>
</body>


</html>
