<?php 
    session_start();

	try {
		$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
    }
    
    $delete = $bdd->prepare('DELETE FROM membre WHERE ID=:num LIMIT 1');
    $delete->execute(array('num' => $_SESSION['id']));
    var_dump($_SESSION['id']);

    header('Location: ../index.php');
?>