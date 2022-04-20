<?php 
include 'includes/library.php';
$username = $_POST['username']??null;
$password = $_POST['password'] ??null;
$errors = array();
$iserror= $username =="" || $password=="";
$whitepattern="/^[a-z\d]*$/i";
$blackpattern="/\*|'|\"|#|;|,|or|\^|=|<|>|and/i";

if(isset($_POST['submit'])){
	if(!$iserror){
		if(preg_match($blackpattern, $username)){
			err("username is not valid");
			$errors['username'] = true;
		}
		if(!preg_match($whitepattern, $_POST['password'])){
			err("password is not valid");
			$errors['password'] = true;
		}
		$pdo = connectDB();
		$query = "SELECT `username` FROM users WHERE username = '$username'";
		$stmt = $pdo->query($query);
		if($stmt){
			err("username is already exists");
			$errors['username'] = true;
		}
	}else{
		err("username or password is not exists");
		$errors['contents'] = true;
	}
	if(count($errors) == 0){
		header("Location: user.php");
	}
}
function err($var){
	echo '<script type="text/javascript">';
	echo ' alert("'.$var.'")';  //showing an alert box.
	echo '</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Signup - Sweet Registry</title>
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
				<h2>Sign Up</h2>
				<form action="" method="post">
					<div>
						<label for="username">Username</label>
						<div>
							<input type="text" name="username" placeholder="Username">
							<i class="ri-user-3-fill"></i>
							<span class="border"></span>
						</div>
						<label for="username">Email Address</label>
						<div>
							<input type="email" name="email" placeholder="Username">
							<i class="ri-mail-fill"></i>
							<span class="border"></span>
						</div>
						<label for="password">Password</label>
						<div>
							<input type="password" name="password" placeholder="Password">
							<i class="ri-lock-fill"></i>
							<span class="border"></span>
						</div>
						<label for="password">Repeat Password</label>
						<div>
							<input type="password" name="password" placeholder="Password">
							<i class="ri-lock-fill"></i>
							<span class="border"></span>
						</div>
					</div>
					<a href="login.html">Already have account?</a>
					<button class="btn dark h-captcha" data-sitekey="b5a27318-cdb1-4c68-9ebf-98aca4fc6839" data-callback="onSubmit">Sign Up</button>
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
