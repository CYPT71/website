<?php
	require 'vendor/controller.php';
	require 'vendor/config/config.php';
	
	$stmt = $link->query('SELECT * FROM `category` WHERE titre');
	$category = $stmt->fetchALL();
	
	echo $category;
	
	

?>

	