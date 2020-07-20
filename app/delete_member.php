<?php 
    session_start();

	try {
		$bdd = new PDO('mysql:host=eu-cdbr-east-02.cleardb.com;dbname=heroku_680327feb49fa0d;charset=utf8', 'bc15657febe502', 'b9a2f96d', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
    }
    
    $delete = $bdd->prepare('DELETE FROM membre WHERE ID=:num LIMIT 1');
    $delete->execute(array('num' => $_SESSION['id']));
    var_dump($_SESSION['id']);

    header('Location: ../index.php');
?>