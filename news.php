<?php 
	require_once("creds.php");
	$link = mysql_connect(MYSQL_HOSTNAME, MYSQL_USERNAME, MYSQL_PASSWORD)
		or die("Impossible de se connecter : " . mysql_error());
	echo 'Connexion réussie';
	
	if(!mysql_select_db('crep', $link)){
		echo 'Selection de la base de données impossible';
		exit;
	}
	
	$requete = "select title content user.name as userName from news, user where news.fk_author==user.pk;";
	$resultat = mysql_query($requete);
	
	//Pour debugger
	if (!$resultat) {
		$message  = 'Requête invalide : ' . mysql_error() . "\n";
		$message .= 'Requête complète : ' . $query;
		die($message);
	}
	
	while ($row = mysql_fetch_assoc($resultat)) {
		echo '<div class="panel panel-default">';
		echo '<div class="panel-heading">';
		echo '<h3 class="panel-title">'.$row['title'].'</h3>';
		echo '</div>';
		echo '<div class="panel-body">';
		echo '<p>'.$row['content'].'</p>';
		echo '</div>';
		echo '<div class="panel-footer">';
		echo '<p>'.$row['userName'].'</p>';
		echo '</div></div>';
	}
	
	//On libere l'espace de resultat.
	mysql_free_result($result);
	mysql_close($link);
?>

