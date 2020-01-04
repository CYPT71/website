<?php

require 'vendor/config.php';

session_start();

if (isset($_SESSION['user_id'])) {
    
	
	
    $stmt = $link->prepare('SELECT * FROM users WHERE id = :id');
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $user = $stmt->fetch();
	
} else {
    $user = null;
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Ineria - Serveur mini-jeux</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- Navbar -->
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
            <li class="nav-item">
                <a class="nav-link" href="blog.php">blog</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="photo.php">photo</a>
            </li>

        </ul>
		<div>
            <?php if ($user): ?>
                <a class="btn btn-outline-primary" href="logout.php">Logout</a>
                <?php if($_SESSION['user_admin'] == 1):?>
                <a class="btn btn-outline-primary" href="admin/index.php">Accès à la gestion des photos</a>
                <?php endif ?>
            <?php else: ?>
                <a class="btn btn-outline-primary" href="login.php">Login</a>
                <a class="btn btn-outline-primary" href="register.php">Register</a>
            <?php endif ?>
            <a class="btn btn-outline-primary" href="contact.php">contact</a>
        </div>
    </div>
</nav>
<div>
<?php

	$destinataire =

	if (!isset($_POST['envoi']))
	{
		eccho '
			<form method="POST">
					<div class="form-group row">
						<label for="email" class="col-3 col-form-label">Email</label>
					<div class="col-9">
						<input class="form-control" type="email" id="email" name="email" required value="<?= $email ?? '' ?>">
						</div>
					</div>

						
					<hr>
						<button type="submit" class="btn btn-primary">
						<i class="fas fa-user"></i> valider
						</button>
					<a class="btn btn-secondary" href="/">Back</a>
					</hr>
			</form>';
	};



?>
</div>
<!-- Footer -->
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
</body>
</html>