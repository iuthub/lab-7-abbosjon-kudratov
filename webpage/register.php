<?php  
# copyright © 2019 Abbosjon Kudratov
include('connection.php');
error_reporting(1);
$username=$_REQUEST["username"];
$fullname=$_REQUEST["fullname"];
$email=$_REQUEST["email"];
$pwd=$_REQUEST["pwd"];
$confirm_pwd=$_REQUEST["confirm_pwd"];

$isPost= $_SERVER["REQUEST_METHOD"]=="POST";
$isGet = $_SERVER["REQUEST_METHOD"]=="GET";

$mailPattern='/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';

$isNameError=$isPost && !preg_match('/[\w]{5,}/', $username);
$isMailError=$isPost &&!preg_match($mailPattern, $email);
$isPasswordError=$isPost && ($pwd !=$confirm_pwd);

$isFormError= $isNameError || $isMailError || $isPasswordError;


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>My Blog - Registration Form</title>
		<link href="style.css" type="text/css" rel="stylesheet" />
		<style media="screen">
      .error {
        color: red;
      }
    </style>
	</head>
	
	<body>
		<?php include('header.php'); 
		if($isGet || $isFormError){
			?>

		<h2>User Details Form</h2>
		<h4>Please, fill below fields correctly</h4>
		<form action="register.php" method="post">
				<ul class="form">
					<li>
						<label for="username">Username</label>
						<input type="text" name="username" id="username" value="<?=$username?>"	required/>
						<?php if($isNameError){ ?>
							<p class="error">Username must be at least 5 characters!</p> <br />
						<?php } ?>
					</li>
					<li>
						<label for="fullname">Full Name</label>
						<input type="text" name="fullname" id="fullname"  value="<?=$fullname?>" required/>
					</li>
					<li>
						<label for="email">Email</label>
						<input type="email" name="email" placeholder="example@mail.com" id="email" value="<?=$email?>"/>
						<?php if($isMailError){ ?>
							<p class="error">Not a valid email!</p> <br />
						<?php } ?>

					</li>
					<li>
						<label for="pwd">Password</label>
						<input type="password" name="pwd" id="pwd" value="<?=$pwd?>" required/>
					</li>
					<li>
						<label for="confirm_pwd">Confirm Password</label>
						<input type="password" name="confirm_pwd" id="confirm_pwd" required />
						<?php if($isPasswordError){ ?>
							<p class="error">Passwords do not match!</p> <br />
						<?php } ?>
					</li>
					<li>
						<input type="submit" value="Submit" /> &nbsp; Already registered? <a href="index.php">Login</a>
					</li>
				</ul>
		</form>
	<?php }
if($isPost && !$isFormError)
	{
		require("connection.php");

		$dob="2008-10-10";
		$insertQuery="INSERT INTO users (username, email, password, fullname, dob) VALUES('$username', '$email', '$pwd', '$fullname', '$dob')"; // try to avoid this weak style, 'cause  it's not safe about SQL injections :)
		// $blogg->exec($insertQuery);  // no good style at all 

		$insertQuery1=$blogg->prepare("INSERT INTO users (username, email, password, fullname, dob) VALUES(?, ?, ?, ?, '2008-10-10')");
		$insertQuery1->execute(array($username, $email, $pwd, $fullname)); //a better and safe query
		

	 	header('Location: index.php');
	 } ?>
	</body>
</html>