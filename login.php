<?php


require 'vendor/config/config.php';
require 'vendor/controler.php';

session_start();

if (! empty($_POST['email']) && ! empty($_POST['password'])) {
    

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $link->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();
	
    if ($user) {
        if (password_verify($password, $user['password'])) {

            $_SESSION['success'] = 'User verification successful';
            $_SESSION['user_id'] = $user['id'];
			$_SESSION['user_admin'] = $user['AdminApprouved'];
			$_SESSION['user_mail'] = $user['email'];
			$_SESSION['user_name'] = $$user['email'];
			

            header('Location: /');
            exit;
        }

        $error = 'Invalid password';
    } else {
        $error = 'No account exists with the email';
    }
}

if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

?>
<!DOCTYPE html>
<html lang="fr">


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
                        <h5 class="card-title">Login to your account</h5>

                        <hr>

                        <form method="POST">
                            <div class="form-group row">
                                <label for="email" class="col-3 col-form-label">Email</label>
                                <div class="col-9">
                                    <input class="form-control" type="email" id="email" name="email" required value="<?= $email ?? '' ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-3 col-form-label">Password</label>
                                <div class="col-9">
                                    <input class="form-control" type="password" id="password" name="password" required>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-user"></i> Login
                            </button>
                            <a class="btn btn-secondary" href="/">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
