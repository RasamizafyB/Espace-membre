<?php
	session_start();
	try {
		$bdd = new PDO('mysql:host=eu-cdbr-east-02.cleardb.com;dbname=heroku_680327feb49fa0d;charset=utf8', 'bc15657febe502', 'b9a2f96d', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}
	if(isset($_POST['formLog'])){
		$pseudolog = htmlspecialchars($_POST['usernameLog']);
		$passwordlog = sha1($_POST['passwordLog']);
		if(!empty($pseudolog) AND !empty($passwordlog)){
			$requser = $bdd->prepare('SELECT * FROM membre WHERE pseudo = ? AND password = ?');
			$requser->execute(array($pseudolog, $passwordlog));
			$userexist = $requser->rowCount();
			if($userexist == 1){
				$userinfo = $requser->fetch();
				$_SESSION['id'] = $userinfo['id'];
				$_SESSION['pseudo'] = $userinfo['pseudo'];
				$_SESSION['email'] = $userinfo['email'];
				header("Location: app/profil.php?id=".$_SESSION['id']);
			}else{
				$error = "Incorrect USERNAME or PASSWORD";
			}
		}else{
			$error = "Complet the form please!";
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
	<link rel="stylesheet" href="app/style.css">
</head>
<body>
	<div class="container">
		<div class="d-flex justify-content-center h-100">
			<div class="card log">
				<div class="card-header">
					<h3>Log In</h3>
				</div>
				<div class="card-body">
					<form action="" method="POST">
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" class="form-control" placeholder="username" name="usernameLog">

						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" class="form-control" placeholder="password" name="passwordLog">
						</div>
						<div class="form-group">
							<a href="app/sign.php" class="btn float-right login_btn">Sign</a>
							<input type="submit" value="Login" name="formLog" class="btn float-right login_btn">
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
	    ?>
	</div>
</body>
</html>