<!DOCTYPE html>
<html lang="en">
<head>
	<title>TODO LIST</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
<!-- FAVICON -->
    <!-- <link rel='shortcut icon' type='image/x-icon' href='images/favicon/favicon.png' />   -->
<!--===============================================================================================-->	

	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

</head>
<body>
<?php
	require 'php/conf/config.php';
	$mysqli = new mysqli($servername,$username,$password,$dbname);
	
	// echo uniqid("");

	if(isset($_POST['name_singup'])){

	    $result = $mysqli->query("SELECT id FROM Users WHERE mail='".$_POST['mail_singup']."'");
	    $res1 = $result->fetch_assoc();
	    if(empty($res1['id'])){

	    $result = $mysqli->query("INSERT INTO Users ( username,mail,passwd)
							VALUES ('".$_POST['name_singup']."','".$_POST['mail_singup']."','".hash('sha512', $_POST['pass_singup']).uniqid()."');");
		}
		else {
			echo '<script>alert("account with '.$_POST['mail_singup'].' alredy exists")</script>';
		}
	}

	if(isset($_POST['login_mail'])){
		echo $_POST['login_mail'];
	    $result = $mysqli->query("SELECT mail, passwd FROM Users WHERE mail='".$_POST['login_mail']."'");
	    $res1 = $result->fetch_assoc();
	    echo '<br>'.$res1['mail'].'<br>';
	    if(!empty($res1['mail'])){

	   	$password = $res1['passwd'];
	   	echo $password;
	   	echo '<br>';
	   	$pass_len = count($password);
	   	echo $pass_len;
	   	echo '<br>';
	   	$shorten_pass = substr($password, 0, $pass_len-14);
	   	echo $shorten_pass;
	   	if($shorten_pass == hash('sha512', $_POST['login_pass'])){
			echo '<script>alert("Good login")</script>';
	   	}
		}
		else {
			echo '<script>alert("Account does not exist")</script>';
		}
	}

?>
	<!-- <div id="particles-js" style="z-index: 2;width: 100%;height: 99%;position: absolute;top: 0;"></div> -->

	<div class="limiter" style="z-index: 3">
		<div class="container-login100" style="background-image: url('images/bg-03.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="index.php" method="post" >
					<span class="login100-form-logo">
						<i class="zmdi zmdi-alarm-check"></i>
					</span>
				<?php
				if(isset($_POST['signup_click']) ){
					echo '<span class="login100-form-title p-b-34 p-t-27">
						Sign Up
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter your name">
						<input class="input100" type="text" name="name_singup" placeholder="Your name">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter your email adress">
						<input class="input100" type="text" name="mail_singup" placeholder="Email">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass_singup" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="singup" method="post">
							Sign Up
						</button> 					
					</div>

					
				</form>
				<div class="text-center p-t-2">
						<br>
						<span class="" style="color: white">OR</span> 
						<br>
						<form  method="POST">
						<input type="hidden" name="login_click">
						<button type="POST" class="" style="color: white">
							Login
						</button>
					</form>
					</div>
				';

				// $_POST = array();				
				}
				if(isset($_POST['login_click']) || !isset($_POST['signup_click'])){					
				echo '<span class="login100-form-title p-b-34 p-t-27">
						Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter email">
						<input class="input100" type="text" name="login_mail" placeholder="Email">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="login_pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button> 					
					</div>

					
				</form>
				<div class="text-center p-t-50">
						<a class="" href="" style="color: white">
							Forgot Password?
						</a>
						<br>
						<span class="" style="color: white">OR</span> 
						<br>
						<form  method="POST">
						<input type="hidden" name="signup_click">
						<button type="POST" class="" style="color: white">
							Sign Up
						</button>
					</form>
					</div>
				';
				}

				?>
					
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
<!--===============================================================================================-->
	<script src="js/particles.js"></script>
	<script src="js/app.js"></script>

	<script src="js/lib/stats.js"></script>

</body>
</html>