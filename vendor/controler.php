<?php

	require 'vendor/config/config.php';

	session_start();

	if (isset($_SESSION['user_id'])) {
		
		
		
		$stmt = $link->prepare('SELECT * FROM users WHERE id = :id');
		$stmt->execute(['id' => $_SESSION['user_id']]);
		$user = $stmt->fetch();
		
	} else {
		$user = null;
	}
	
	?>
	<html>
	<head><meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Ineria - Serveur mini-jeux</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
	<link rel="stylesheet" href="assets/css/style.css">
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">	
    
	</head>
	
	<!-- Navigation -->
	
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="index.php">
            <img src="assets/img/logo.png" width="30" height="30" alt="Logo de Ineria">
        </a>
    </nav>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Accueil</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="photo.php">photo</a>
            </li>
			
			<li class="nav-item active">
                <a class="nav-link" href="forum.php">forum</a>
            </li>

        </ul>
		<ul>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
			Session
			</a>
			<div class="dropdown-menu">
			<?php
				if($user){
						echo '<a class="btn btn-outline-primary dropdown-item" href="logout.php">Logout</a>';
					if($_SESSION['user_admin'] == 1){
					  echo '<a class="btn btn-outline-primary dropdown-item" href="admin/index.php">Accès à la gestion des photos</a>
							<a class="btn btn-outline-primary dropdown-item" href="admin/newcategory.php">Accès à la gestion des Catégories</a>
					  ';
					  
					}
				}
				else{
				   echo '<a class="btn btn-outline-primary dropdown-item" href="login.php">Login</a>
					<a class="btn btn-outline-primary dropdown-item" href="register.php">Register</a>';
				};
			   
				?>
			 </div>
			</li>
			</ul>
			<a class="btn btn-outline-primary" href="contact.php">contact</a>
        </div>
    </div>
	</nav>
	

	</head>
	<body>
	
	<footer class="bg-light">
		<div class="container">
			<p>
				&copy; Ineria 2019 - Site crée par <a href="https://www.paypal.me/Cypt91">CYPT</a>.
			</p>
		</div>
	</footer>

	<!-- Scripts -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/popper.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
	<script src="assets/js/script.js"></script>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	</body>
</html>
	