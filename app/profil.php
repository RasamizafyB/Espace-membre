<?php
    session_start();
    try {
		$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
    }
    if(isset($_GET['id']) AND $_GET['id'] > 0){
        $getid = intval($_GET['id']);
        $requser = $bdd->prepare("SELECT * FROM membre WHERE id = ?");
        $requser->execute(array($getid));
        $userinfo = $requser->fetch();
        //var_dump($_SESSION['id']);
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Profil</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-center h-100">   
            <div class="profil">
                <h3>Profil</h3>
                <div class="img">
                    <img src="https://cdn.pixabay.com/photo/2018/04/18/18/56/user-3331256__340.png" alt="John" style="width:100%">
                    <div class="edit">
                        <?php
                            if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']){
                        ?>
                            <a href="edite_member.php"><i class="fas fa-pencil-alt"></i></a>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="info">
                    <h2><b><?php echo $userinfo['pseudo'] ?></b></h2>
                    <p><?php echo $userinfo['email'] ?></p>
                </div>
                <?php
                    if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']){
                ?>
                    <div class="buttom">
                        <a href="log_out.php"><i class="fas fa-sign-out-alt"></i></a>
                        <a href="delete_member.php"><i class="fas fa-trash-alt"></i></a>
                    </div>
                <?php
                    }
                ?>
                
            </div>
        </div>
    </div>
</body>
</html>

<?php
    }else{
        header("Location: ../log.php");
    }
?>
