<?php 
    session_start();

	try {
		$bdd = new PDO('mysql://bc15657febe502:b9a2f96d@us-cdbr-east-02.cleardb.com/heroku_680327feb49fa0d?reconnect=true', 'bc15657febe502', 'b9a2f96d', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
    }
    
    $delete = $bdd->prepare('DELETE FROM membre WHERE ID=:num LIMIT 1');
    $delete->execute(array('num' => $_SESSION['id']));
    var_dump($_SESSION['id']);

    header('Location: ../index.php');
?>