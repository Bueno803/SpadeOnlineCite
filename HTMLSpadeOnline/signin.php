<?php
session_start();
	include("connection.php");
	
	if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['user_name']) && !empty($_POST['password']))
	{
		//SOMETHING MOSTED
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
		
		//if(!empty($user_name) && !empty($password))
		//{
		//	//save to database
		//	$password = md5($password);
		//	$InsertUser = $Account->prepare("INSERT INTO tUser (sUserID, sUserName, sUserPW, nAuthID, sUserIP) VALUES (:userName, :userName2, :password, :authid, :ip)");
		//		$InsertUser->execute(array(":userName" => $user_name, ":userName2" => $user_name, ":password" => $password, ":authid" => 1, ":ip" => Functions::GetIp()));
		//
		//	echo "Account Created";
		//}
		//else
		//{
		//	echo "Please enter valid info";
		//}
		
		if(isset($user_name) && isset($password) ) {
		try {
			$password = md5($password);
			$CheckUsername = $Account->prepare("SELECT * FROM tUser WHERE sUserID = :userID");
				$CheckUsername->execute(array(":userID" => $user_name));
				$UserResult = $CheckUsername->fetch(PDO::FETCH_ASSOC);
				
			$CheckPassword = $Account->prepare("SELECT * FROM tUser WHERE sUserPW = :userPW");
				$CheckPassword->execute(array(":userPW" => $password));
				$PassResult = $CheckPassword->fetch(PDO::FETCH_ASSOC);

				array('username' => $_POST['user_name']);
				
			if(empty($UserResult))
				echo "<script type='text/javascript'>alert('Username does not exist!');</script>";
			else if (empty($PassResult))
				echo "<script type='text/javascript'>alert('Password does not match the Username input!');</script>";
			else {
				echo "<script type='text/javascript'>alert('Account Found');</script>";
				$_SESSION['username'] = $_POST['user_name'];
				//echo $_SESSION['username'];
				header("location:index.php");
			}
		} catch(PDOException $ex) {
			echo $ex->getMessage();
		}
		}
	}
	
//?>

<!DOCTYPE html>
<html>
<head>

<link href="CSS/Main.css" rel="stylesheet" type="text/css" />
<link href="CSS/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<script src="CSS/JS/main.js"></script>
<script src="css/js/bootstrap.min.js"></script>

<title> Spade Online Sign In</title>
</head>

<body>
<style type="text/css">
	#text{
		
		height: 5px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}

	#button{

		border-radius: 10px;
		padding: 10px;
		width: 150px;
		color: white;
		background-color: grey;
		border: none;
	}

	#box{

		background-color: grey;
		margin: auto;
		width: 300px;
		padding: 20px;
	}

	.Home_TTL{
		text-align: center;
		margin-bottom: 50px;
	}
	</style>

	<div class="outer-wrap">
		<div class="logo"></div>
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;text-align: center;"></div>

			<div style="text-align: center;">
						<label for="user_name">Username</label><br>
						<input type="text" class="form-control" id="iUsername" name="user_name" style="padding: 7px;">
					</div>
					<div style="text-align: center;">
						<label for="password">Password</label><br>
						<input type="password" class="form-control" id="iPassword" name="password" style="padding: 7px;">
					</div>
				<div style="text-align: center; position: relative; top: 200px;">
			<input id="button" type="submit" value="Sign In"><br><br>
			</div>
		</form>
		</div>
	</div>
</style>

</body>
</html>