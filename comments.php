<?php

	require 'vendor/controler.php';
	require 'vendor/config/config.php';
	
	
	$stmt = $link->prepare('SELECT * FROM `sujets` WHERE id = ?');
	$stmt->execute(array($_GET['sujet']));
	$donnees = $stmt->fetch();
	
	?>
	
	<div class="news">
    <h3>
        <?php echo htmlspecialchars($donnees['title']); ?>
        <em>créé le <?php echo $donnees['date']; ?></em>
    </h3>
    
    <p>
    <?php
    echo nl2br(htmlspecialchars($donnees['description']));
    ?>
    </p>
	</div>

	<h2>comments</h2>
	
	<?php

	$stmt->closeCursor();
	
	$stmt = $link->prepare('SELECT * FROM comments WHERE id_subject = ? ORDER BY id DESC');
	$stmt->execute(array($_GET['sujet']));	
	$titres = $stmt->fetchALL();
	
	
?>

<table class="table table-striped table-dark">
	<thead>
		<th scope="cole">#</th>
		<th scope="cole">date</th>
		<th scope="cole">user : </th>
		<th scope="cole">commentaires </th>		
	</thead>
	<tbody>
	<?php foreach ($titres as $titre): ?>
        <tr>
            <th scope="row"><?= $titre['id'] ?></th>
        
			<th scope="row"><?= $titre['date'] ?></th>
		
			<th scope="row"><?php 
				echo $comments['id_user'];
				$req = $link->prepare('SELECT username FROM users WHERE id = :id');
				$req->execute(['id' => $comments['id_user']]);
				$username = $req->fetch();
				echo $username; ?></th>
		
			<th scope="row"><?= $titre['comments'] ?></th>
			
		</tr>
    <?php endforeach ?>

    </tbody>
</table>

<?php
	
	$stmt->closeCursor();
	
	
	if(isset($user)){
		
				
		if(isset($_POST['comments'])){
				
				echo $_GET['sujet'];
				$stmt = $link->prepare('INSERT INTO `comments`(`id_user`, `id_subject`, `comments`, `date`) VALUES (:user, :subject, :comments, NOW())');
				$stmt->execute([
					'user' => $_SESSION['user_id'],
					'subject' => $_GET['sujet'],					
					'comments' => $_POST['comments']
								
				]);
				?>
				commentaires créé
				<a href="comments.php?sujet=<?= $_GET['sujet'] ?>"> Un autre ?</a>
		<?php
				
			
			
		}
		else
		{
			?>
			<form method="post">
			<label for="name" align="center">Comments</label>			
				<textarea name="comments" id="comments" cols="70" rows="6" require></textarea><br />
				<input type="submit" value="envoyer" href="comments.php/sujet=<?= $_GET['sujet'] ?>" />
				
			</form>
<?php
		}
		}
		else{
		echo "merci de vous connecter pour utiliser l'espaces commentaires";
	};
	echo $_GET['category'];
?>