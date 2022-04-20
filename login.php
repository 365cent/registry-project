<?php 
include 'includes/library.php';

//$username = RemoveXSS($_POST["username"]) ?? null;

//check if the user name and password is able to login
if ( !empty($_POST)) {

	$error=false;
	$username = $_POST["username"] ?? null;
	$password = $_POST["password"] ?? null;
	//return the case if it is empty
	$pdo = connectDB();
	$query = "SELECT * FROM users where username = '?'";
	//var_dump($query);
	$stmt = $pdo->prepare($query)->execute([$username]);
	//check if the username is in the database
	var_dump($stmt);
	if(!$stmt){
		//err("username is not exits");
		$error = true;
		$msg = "username is not exits";
	}else{
		if(password_verify($password, $stmt['password'])){
			session_start();
			$_SESSION['id'] = $stmt['id'];
		 }else{
			//err("password is not correct");
			$msg = "password or username is not correct";
		   	$error = true;
		 }
	}
	if(!$error){
		header("Location: user.php");
		exit();
	}
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
					<span class="err"><?php echo $msg??null ?></span>
				</form>
			</div>
		</div>
	</main>
<?php include 'includes/footer.php'; ?>
