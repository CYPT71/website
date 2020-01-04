<?php
/******************************************************
----------------Configuration Obligatoire--------------
Veuillez modifier les variables ci-dessous pour que le
forum puisse fonctionner correctement.
******************************************************/

//On se connecte a la base de donnee
define('HOST', 'sql.mtxserv.com');
define('DB_NAME', '222505_sql');
define('USER', 'w_222505');
define('PASS', 'Poulpito67');

try {
    $db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USER, PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e;
}
//Nom dutilisateur de ladministrateur
$admin='admin';

/******************************************************
----------------Configuration Optionelle---------------
******************************************************/

//Nom du fichier de laccueil
$url_home = 'index.php';

//Nom du design
$design = 'default';


/******************************************************
----------------------Initialisation-------------------
******************************************************/
include('init.php');
?>