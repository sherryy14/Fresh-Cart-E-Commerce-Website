<?php
include 'config.php';
session_start();

if (isset($_SESSION['user'])) {
	header("Location: dashboard.php");
}



if (isset($_POST['btn'])) {

	$uname = $_POST['user'];

	$password = $_POST['pass'];


	$query = "SELECT * FROM `admin` WHERE (`username` = '$uname') AND `password` = '$password'";

    $result = mysqli_query($conn, $query);

    $row = mysqli_fetch_assoc($result);
    // print_r($row);

    // $_SESSION['email'] = $row['email'];
    
	$users = mysqli_num_rows($result);
	// echo $users;
	if($users === 1 ){
		$_SESSION['user'] = $uname;
		
		// echo "<script> setTimeout(()=>{
		// 	window.location.href = 'dashboard.php'
		// },1000) </script>";
		header("Location: dashboard.php");
	} else {
		$faildLogin = "Incorrect Credential";
	}
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="admin.css">
	<!-- Favicon icon-->
	<link rel="shortcut icon" type="image/x-icon" href="../assets/images/favicon/favicon.ico">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>Admin Login</title>
</head>

<body>
	
	<div class="container">
		<div class="screen">
			<div class="screen__content">
				<form class="login" method="post">
					<div class="login__field">
						<i class="login__icon fas fa-user"></i>
						<input type="text" name="user" class="login__input" value="<?php echo @$uname; ?>" placeholder="User name / Email" autocomplete="off">
					</div>
					<div class="login__field">
						<i class="login__icon fas fa-lock"></i>
						<input type="password" name="pass" class="login__input" placeholder="Password">
					</div>
					<button class="button login__submit" type='submit' name="btn">
						<span class="button__text">Log In Now</span>
						<i class="button__icon fas fa-chevron-right"></i>
					</button>
					<p style='margin: 10px 0px;'></p><?php echo @$faildLogin; ?></p>
				</form>
				<div class="social-login">
					<h3>log in via</h3>
					<div class="social-icons">
						<a href="#" class="social-login__icon fab fa-instagram"></a>
						<a href="#" class="social-login__icon fab fa-facebook"></a>
						<a href="#" class="social-login__icon fab fa-twitter"></a>
					</div>
				</div>
			</div>
			<div class="screen__background">
				<span class="screen__background__shape screen__background__shape4"></span>
				<span class="screen__background__shape screen__background__shape3"></span>
				<span class="screen__background__shape screen__background__shape2"></span>
				<span class="screen__background__shape screen__background__shape1"></span>
			</div>
		</div>
	</div>
</body>

</html>