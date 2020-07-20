<?php
    session_start();
    try {
		$bdd = new PDO('mysql://bc15657febe502:b9a2f96d@us-cdbr-east-02.cleardb.com/heroku_680327feb49fa0d?reconnect=true', 'bc15657febe502', 'b9a2f96d', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
    }
    if(isset($_SESSION['id'])){
        var_dump($_SESSION['id']);
        $requser = $bdd->prepare("SELECT * FROM membre WHERE id = ?");
        $requser->execute(array($_SESSION['id']));
        $useredit = $requser->fetch();
        if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $useredit['pseudo']){
            $newpseudo = htmlspecialchars($_POST['newpseudo']);
            $insertpseudo = $bdd->prepare("UPDATE membre SET pseudo = ? WHERE id = ?");
            $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
            header('Location: profil.php?id='.$_SESSION["id"]);
        }
        if(isset($_POST['newemail']) AND !empty($_POST['newemail']) AND $_POST['newemail'] != $useredit['email']){
            $newemail = htmlspecialchars($_POST['newemail']);
            $insertemail = $bdd->prepare("UPDATE membre SET email = ? WHERE id = ?");
            $insertemail->execute(array($newemail, $_SESSION['id']));
            header('Location: profil.php?id='.$_SESSION["id"]);
        }
        if(isset($_POST['newpassword']) AND !empty($_POST['newpassword']) AND isset($_POST['confirmnewpassword']) AND !empty($_POST['confirmnewpassword'])){
            $newpassword = sha1($_POST['newpassword']);
            $confirmnewpassword = sha1($_POST['confirmnewpassword']);
            if($newpassword == $confirmnewpassword){
                $insertpassword = $bdd->prepare("UPDATE membre SET password = ? WHERE id = ?");
                $insertpassword->execute(array($newpassword, $_SESSION['id']));
                header('Location: profil.php?id='.$_SESSION["id"]);
            }else{
                $error = "Your PASSWORD doesn't match!";
            }
        // }else{
        //     $error = "Complet PASSWORD";
        }
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
                <h2>Edit profil</h2>
                <div class="img">
                    <img src="https://cdn.pixabay.com/photo/2018/04/18/18/56/user-3331256__340.png" alt="John" style="width:100%">
                </div>
                <form action="" method="POST">
                    <div class="input-group form-group">
                        <input type="text" name="newpseudo" class="form-control" value="<?php echo $useredit['pseudo'] ?>">
                    </div>
                    <div class="input-group form-group">
                        <input type="email" name="newemail" class="form-control" value="<?php echo $useredit['email'] ?>">
                    </div>
                    <div class="input-group form-group">
                        <input type="password" name="newpassword" class="form-control">
                    </div>
                    <div class="input-group form-group">
                        <input type="password" name="confirmnewpassword" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Edit" name="formEdit" class="btn float-right login_btn">
                        <a href="profil.php?id=<?php echo $_SESSION['id'] ?>" class="btn float-right login_btn">Back</a>
    				</div>
                </form>                    
            </div>
        </div>
        <?php
            if(isset($error)){
        ?>
            <div class="error">
                <p><i class="fas fa-times"></i> <?php echo $error ?> <i class="fas fa-times"></i></p>
            </div>
        <?php
            }
        ?>
    </div>

</body>
</html>

<?php
    }else{
        header("Location: ../index.php");
    }
?>
