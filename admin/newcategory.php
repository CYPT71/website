<?php
	require 'vendor/controler.php';
	require 'vendor/config/config.php';

	
	if($_SESSION['user_admin'] == 1) {
	if(isset($_POST['name'])){
		if(isset($_POST['description'])){
		
			$stmt = $link->prepare('INSERT INTO `category`(`titre`, `description`, `date`) VALUES (:titre, :description, NOW())');
            $stmt->execute([
                'titre' => $_POST['name'],
                'description' => $_POST['description']
                			
            ]);
			echo 'subject créé
			<a href=newcategory.php>Un autre ?</a>
			';
			
		}
		
	}
	else
	{
		echo'
		<form method="post">
		<label for="name">Nom</label>
			<input type="text" name="name" id="name" /><br />
			<label for="description">Description</label>
			<textarea name="description" id="description" cols="70" rows="6"></textarea><br />
			<input type="submit" value="Créer" />
			
	</form>';
	}
	}
	else
	{
	echo "bien essayé mais vous n'avais pas les permission";
	}
	

	
	
	
	
	$category = $link->query('SELECT * FROM `category` ORDER BY `id` ASC');
	
	
	
	
	while($titre= $category->fetch()) {
	
		?>
		<div class="news">
			<h3>
			<?php echo htmlspecialchars($titre['titre']); ?>
			<em>créé le <?php $titre['date']; ?></em>
			</h3>
		
		<p>
		<?php
		// On affiche le contenu du billet
		echo nl2br(htmlspecialchars($titre['description']));
		?>
		<br />
		<em><a href="sujets.php?category=<?php echo $titre['id']; ?>">Sujet</a></em>
		</p>
		<a href="delete.php?category=<?php echo $titre['id']; ?>">Delete</a>
		</div>
	<?php
		
		
	}
?>
