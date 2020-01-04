<?php
	require 'vendor/controler.php';
	require 'vendor/config/config.php';
	
	
	$stmt = $link->prepare('SELECT * FROM `category` WHERE id = ?');
	$stmt->execute(array($_GET['category']));
	$donnees = $stmt->fetch();
	
	?>
	
	<div class="news">
    <h3>
        <?php echo htmlspecialchars($donnees['titre']); ?>
        <em>créé le <?php echo $donnees['date']; ?></em>
    </h3>
    
    <p>
    <?php
    echo nl2br(htmlspecialchars($donnees['contenu']));
    ?>
    </p>
	</div>

	<h2>Sujets</h2>
	
	<?php

	$stmt->closeCursor();
	
	$stmt = $link->prepare('SELECT * FROM sujets WHERE id_category = ?');
	$stmt->execute(array($_GET['category']));
	$titres= $stmt->fetchALL();
	
	?>
	<table class="table table-striped table-dark">
	<thead>
		<th scope="cole">#</th>
		<th scope="cole">name</th>
		<th scope="cole">date de création : </th>
		<th scope="cole">description</th>
		<th scope="cole">Voir Les Sujets</th>
	</thead>
	<tbody>
	<?php foreach ($titres as $titre): ?>
        <tr>
            <th scope="row"><?= $titre['id'] ?></th>
        
			<th scope="row"><?= $titre['title'] ?></th>
		
			<th scope="row"><?= $titre['date'] ?></th>
		
			<th scope="row"><?= $titre['description'] ?></th>
		
			<th scope="row"><a href="comments.php?sujet=<?php echo $titre['id']; ?>">Vers les commentaires du Sujets : <?php echo $titre['title'];?> </a></th>
		</tr>
    <?php endforeach ?>

    </tbody>
</table>
<?php
	$stmt->closeCursor();
	
	
	if(isset($user)){
		
				
		if(isset($_POST['name'])){
			if(isset($_POST['description'])){
			
			
				
				
				$stmt = $link->prepare('INSERT INTO `sujets`(`id_category`, `id_user_creator`, `title`, `description`, `date`) VALUES (:category, :user, :titre, :description, NOW())');
				$stmt->execute([
					'user' => $_SESSION['user_id'],
					'category' => $_GET['category'],
					'titre' => $_POST['name'],
					'description' => $_POST['description']
								
				]);
				?>subject créé
				<a href='sujets.php?category=<?php echo $_GET['category']?>'>Un autre ?</a>
				<?php
				
			}
			
		}
		else
		{
			echo'
			<form method="post">
			<label for="name">Nom</label>
				<input type="text" name="name" id="name" required /><br />
				<label for="description">Description</label>
				<textarea name="description" id="description" cols="70" rows="6" require></textarea><br />
				<input type="submit" value="Créer" />
				
		</form>';
		}
		}
		else{
		echo 'merci de vous connecter pour créer un sujet';
	};

?>

