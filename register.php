<?php



session_start();
require 'vendor/config/config.php';

if (isset($_SESSION['user_id'])) {
    header('Location: /');
    exit;
}

if (! empty($_POST['email']) && ! empty($_POST['password']) && ! empty($_POST['confirm']) && ! empty(($_POST['username'])) && ! empty(($_POST['age']))) {
    $email = $_POST['email'];
    $username = $_POST['username'];
	$age = $_POST['age'];
	if(isset($_POST['discord'])){
		$discord = $_POST['discord'];
	}
	else {
		$discord = 'blank';
	};
	
	
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm'];

    if (! preg_match("/^[A-Za-z0-9_]{3,50}$/", $username)) {
        $error = 'Invalid username';
    } else if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email';
    } else if ($password !== $confirmPassword) {
        $error = 'Passwords did not match';
    } else {
        

        $stmt = $link->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);

        if ($stmt->rowCount() > 0) {
            $error = 'Email already taken';
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
			

            $stmt = $link->prepare('INSERT INTO `users`(`email`, `username`, `password`, `Date_de_Creation`, `ages`,`grade`, `discord`) VALUES (:email, :username, :password, NOW(), :age, :grade, :discord)');
            $stmt->execute([
                'email' => $email,
                'username' => $username,
				'age' => $age,
				'grade' => '1',
				'discord' => $discord,
                'password' => $passwordHash				
            ]);

            $_SESSION['success'] = 'Account created, you can login!';

            header('Location: login.php');
            exit;
        }
    }
}

if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}


$email = $_POST['email'];
$username = $_POST['username'];

//$cle = md5(microtime(TRUE)*100000);
//$stmt = $link->prepare("UPDATE uesrs SET cle=:cle WHERE username like :username");
//$stmt->bindParam(':cle', $cle);
//$stmt->bindParam(':username', $username);
//$stmt->execute();
// https://devoirs.mtxserv.com/validation.php?log=.'urlencode($username)'.'&cle='.'urlencode($cle)'.

$destinataire = $email;
$sujet = "Biencenue su IMD" ;
entete = "From: inscription@CYPT.fr" ;

$message = 'Bienvenue sur Le site de rendus de devoir,
 
	Pour activer votre compte, veuillez cliquer sur le lien ci dessous
	ou copier/coller dans votre navigateur internet.
	 
	
	 
	 
	 ---------------
	Ceci est un mail automatique, Merci de ne pas y répondre.';


mail($destinataire, $sujet, $message, $entete) ;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Register - Ineria</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
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
</nav>

<body>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i><?= $error ?>
                    </div>
                <?php endif ?>

                <?php if (isset($success)): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-exclamation-triangle"></i><?= $success ?>
                    </div>
                <?php endif ?>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Register a new account</h5>

                        <hr>

                        <form method="POST">
                            <div class="form-group row">
							<div class="form-group row">
                                <label for="username" class="col-3 col-form-label">Username</label>
                                <div class="col-9">
                                    <input class="form-control" type="text" id="username" name="username" required value="<?= $username ?? '' ?>">
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="confirm" class="col-3 col-form-label">Votre âge</label>
                                <div class="col-9">
                                    <input class="form-control" type="age" id="age" name="age">
                                </div>
                            </div>
                                <label for="email" class="col-3 col-form-label">Email</label>
                                <div class="col-9">
                                    <input class="form-control" type="email" id="email" name="email" required value="<?= $email ?? '' ?>">
                                </div>
                            </div>                           
							<div class="form-group row">
                                <label for="confirm" class="col-3 col-form-label">Pseudo discord</label>
                                <div class="col-9">
                                    <input class="form-control" type="discord" id="discord" name="discord">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-3 col-form-label">Password</label>
                                <div class="col-9">
                                    <input class="form-control" type="password" id="password" name="password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="confirm" class="col-3 col-form-label">Confirm</label>
                                <div class="col-9">
                                    <input class="form-control" type="password" id="confirm" name="confirm">
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-user"></i> Signup
                            </button>
                            <a class="btn btn-secondary" href="/">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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



