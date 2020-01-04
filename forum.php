<?php
	require 'vendor/controler.php';
	require 'vendor/config/config.php';
	
	
	
	$category = $link->query('SELECT * FROM `category` ORDER BY `id` ASC');
	$titres = $category->fetchALL()
	
	
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
        
			<th scope="row"><?= $titre['titre'] ?></th>
		
			<th scope="row"><?= $titre['date'] ?></th>
		
			<th scope="row"><?= $titre['description'] ?></th>
		
			<th scope="row"><a href="sujets.php?category=<?php echo $titre['id']; ?>">Vers les sujets de la catégory : <?php echo $titre['titre'];?> </a></th>
		</tr>
    <?php endforeach ?>

    </tbody>
</table>