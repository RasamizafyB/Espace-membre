<?php
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
    }
    if(isset($_POST['formInscription'])){
        if(!empty($_POST['username']) AND !empty($_POST['email']) AND !empty($_POST['password']) AND !empty($_POST['confirm_password'])){
            $pseudo = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $password = sha1($_POST['password']);
            $confirm_password = sha1($_POST['confirm_password']);

            $pseudolength = strlen($pseudo);
            if($pseudolength <= 20){
                $reqpseudo = $bdd->prepare("SELECT * FROM membre WHERE pseudo = ?");
                $reqpseudo->execute(array($pseudo));
                $pseudoexist = $reqpseudo->rowCount();
                if($pseudoexist == 0){
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $reqmail = $bdd->prepare("SELECT * FROM membre WHERE email = ?");
                        $reqmail->execute(array($email));
                        $mailexist = $reqmail->rowCount();
                        if($mailexist == 0){
                            if($password == $confirm_password){
                                $insertMember = $bdd->prepare("INSERT INTO membre(pseudo, password, email) VALUE (:pseudo, :password, :email)");
                                $insertMember->execute(array(
                                    'pseudo' => $pseudo,
                                    'password' => $password,
                                    'email' => $email
                                ));
                                $done = "Your account is done!";

                            }else{
                                $error = "Your PASSWORD doesn't match!";
                            }
                        }else{
                            $error = "This EMAIL alrady exists!";
                        }
                    }else{
                        $error = "Your EMAIL isn't valide!";
                    }
                }else{
                    $error = "This USERNAME alrady exists!";
                }
            }else{
                $error = "Your PSEUDO is too long!";
            }
        }else{
            $error = "Complet form please!";
        }
    }
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
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
    		<div class="card">
    			<div class="card-header">
    				<h3>Sign In</h3>
    			</div>
    			<div class="card-body">
    				<form action="" method="POST">
                        <div class="input-group form-group">
    						<div class="input-group-prepend">
    							<span class="input-group-text"><i class="fas fa-user"></i></span>
    						</div>
    						<input type="text" class="form-control" placeholder="username" name="username">
                        </div>
                        <div class="input-group form-group">
    						<div class="input-group-prepend">
    							<span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
    						</div>
    						<input type="email" class="form-control" placeholder="email" name="email">
                        </div>
    					<div class="input-group form-group">
    						<div class="input-group-prepend">
    							<span class="input-group-text"><i class="fas fa-key"></i></span>
    						</div>
    						<input type="password" class="form-control" placeholder="password" name="password">
                        </div>
                        <div class="input-group form-group">
    						<div class="input-group-prepend">
    							<span class="input-group-text"><i class="fas fa-key"></i></span>
    						</div>
    						<input type="password" class="form-control" placeholder="confirm password" name="confirm_password">
    					</div>
    					<div class="form-group">
                            <input type="submit" value="Sign" name="formInscription" class="btn float-right login_btn">
                            <a href="../index.php" class="btn float-right login_btn">Login</a>
    					</div>
                    </form>
    			</div>
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
            if(isset($done)){
        ?>
            <div class="done">
                <p><i class="fas fa-check"></i> <?php echo $done?> <i class="fas fa-check"></i></p>
            </div>
        <?php
            }
        ?>
    </div>
</body>
</html>