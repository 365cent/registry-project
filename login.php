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
	$query = " SELECT `username`,`password`,`id`,`email` FROM users where username = $username";
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
	if(!$error){
		header("Location: user.php");
		exit();
	}
}
function err($var){
	echo '<script type="text/javascript">alert("'.$var.'")</script>';
}

?>
<?php include 'includes/header.php'; ?>
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
					<div class="h-captcha" data-sitekey="b5a27318-cdb1-4c68-9ebf-98aca4fc6839" data-callback="onSubmit" data-size="invisible"></div>
					<button class="btn dark">Login</button>
					<span class="err"></span>
				</form>
			</div>
		</div>
	</main>
<?php include 'includes/footer.php'; ?>
