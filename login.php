<?php 
include 'includes/library.php';
//available only for logged in users
$error=false;
$username = $_POST["username"] ?? null;
$password = $_POST["password"] ?? null;
//$username = RemoveXSS($_POST["username"]) ?? null;

//check if the user name and password is able to login
if (isset($_POST["submit"])) {
	//return the case if it is empty
	$pdo = connectDB();
	$query = " SELECT `username`,`password`,`id`,`email` FROM 3420_project where username = $username";
	$stmt = $pdo->query($query);
	//check if the username is in the database
	if(!$stmt){
		err("username is not exits");
		$error = true;
	}else{
		if(password_verify($password, $stmt->fetch()['password'])){
			session_start();
			$_SESSION['id'] = $stmt->fetch()['id'];
		 }else{
			err("password is not correct");
		   	$error = true;
		 }
		$_SESSION['id'] = $stmt->fetch()['id'];
	}
	$pdo = null;
	if(!$error){
		header("Location: user.php");
		exit();
	}
}
function err($var){
	echo '<script type="text/javascript">';
	echo ' alert("'.$var.'")';  //showing an alert box.
	echo '</script>';
}
//////////////////////////////////////////////////////////////////////////////////////////////

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login - Sweet Registry</title>
	<meta name="keywords" content="Sweet Registry, sweetregistry.com, event registry, wedding registry, babdy registry, myregistry, wedding gift, wedding registry tool, sync wedding registry, Canada wedding registry, The Knot Wedding Registry, Barrel Canada">
	<meta name="description" content="Sweet Registry is	the best event registry for choosing and waitlisting gift">
	<!-- <link rel="canonical" href="https://loki.trentu.ca"> -->
	<link rel="stylesheet" href="assets/style.css">
	<!-- Preconnect for cross-origin assets -->
	<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.cdnfonts.com" crossorigin="anonymous">
	<link rel="preconnect" href="https://files.yyz.design" crossorigin="anonymous">
	<link rel="preload" href="https://fonts.cdnfonts.com/css/calibre" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
	<noscript>
		<link rel="stylesheet" href="https://fonts.cdnfonts.com/css/calibre">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.min.css">
	</noscript>
</head>

<body>
	<!-- Top navbar -->
	<header>
		<nav class="container">
			<h1><a href="index.html">Sweet Registry</a></h1>
			<ul>
				<li><a title="Sweet Registry homepage" href="index.html">Home</a></li>
				<li><a title="Explore popular registry" href="#explore">Explore</a></li>
				<li><a title="See our amazing features" href="feature.html">Feature</a></li>
				<li><div></div><a class="btn dark" title="Sign up to create your own registry" href="signup.html">Create Now</a></li>
			</ul>
			<details>
				<summary>
					<span></span>
				</summary>
				<ul>
					<li><a title="Sweet Registry homepage" href="index.html">Home</a></li>
					<li><a title="Explore popular registry" href="#explore">Explore</a></li>
					<li><a title="See our amazing features" href="feature.html">Feature</a></li>
					<li><a title="Sign up to create your own registry" href="signup.html">Create Now</a></li>
				</ul>
			</details>
		</nav>
	</header>
	<!-- Main content -->
	<main>
		<div class="account float">
			<div>
				<h2>Login</h2>
				<form action="" method="post">
					<div>
						<label for="username">Username</label>
						<div>
							<input type="text" name="username" placeholder="Username">
							<i class="ri-user-3-fill"></i>
							<span class="border"></span>
						</div>
						<label for="password">Password</label>
						<div>
							<input type="password" name="password" placeholder="Password">
							<i class="ri-lock-fill"></i>
							<span class="border"></span>
						</div>
					</div>
					<a href="reset.php">Forget Password?</a>
					<div class="h-captcha" data-sitekey="b5a27318-cdb1-4c68-9ebf-98aca4fc6839" data-size="invisible"></div>
					<button class="btn dark" type="submit">Login</button>
				</form>
			</div>
		</div>
	</main>
	<!-- Footer -->
	<footer>
		<div class="container">
			<ul>
			</ul>
			<ul>
			</ul>
		</div>
		<p><span>&copy;</span>2022 Sweet Registry</p>
	</footer>
	<script async defer src="https://js.hcaptcha.com/1/api.js"></script>
	<script defer src="https://cdn.jsdelivr.net/npm/swiper@8.0.7/swiper-bundle.min.js"></script>
	<script defer src="assets/main.script.js"></script>
</body>

</html>
