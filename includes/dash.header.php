<?php
session_start();
$id = $_SESSION['id'] ?? null;
$username = $_SESSION['username'] ?? null;
// var_dump($id);
if(!$id){
	//header("Location: login.php");
	//exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $page ?> - Sweet Registry</title>
	<meta name="keywords" content="Sweet Registry, sweetregistry.com, event registry, wedding registry, babdy registry, myregistry, wedding gift, wedding registry tool, sync wedding registry, Canada wedding registry, The Knot Wedding Registry, Barrel Canada">
	<meta name="description" content="Sweet Registry is	the best event registry for choosing and waitlisting gift">
	<!-- Use emoji as favicon: https://css-tricks.com/emoji-as-a-favicon/ -->
	<link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>&#x1F4DD;</text></svg>">
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
			<h1><a href="/">Sweet Registry</a></h1>
			<ul>
				<li><a title="Edit my profile" href="user.php">User Profile</a></li>
				<li><a title="View my list" href="list.php">My List</a></li>
				<li><a title="Explore popular registry" href="#explore">Explore</a></li>
				<li><div></div><a class="btn dark" href="javascript:void(0)"><?php echo $username ?></a></li>
			</ul>
			<div class="dropdown">
				<ul>
					<li><a title="Sweet Registry homepage" href="/"><i class="ri-home-line"></i>Home</a></li>
					<li><a title="Edit my profile" href="user.php"><i class="ri-user-line"></i>User Profile</a></li>
					<li><a href="user.php?logout=1"><i class="ri-logout-circle-line"></i>Logout</a></li>
				</ul>
			</div>
			<details>
				<summary>
					<span></span>
				</summary>
				<ul>
					<a title="Edit my profile" href="user.php">User Profile</a></li>
					<li><a title="View my list" href="list.php">My List</a></li>
					<li><a title="Explore popular registry" href="#explore">Explore</a></li>
					<li><a href="user.php"><?php echo $username ?></a></li>
					<li><a href="user.php?logout=1">Logout</a></li>
				</ul>
			</details>
		</nav>
	</header>