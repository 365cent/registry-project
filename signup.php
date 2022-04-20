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
<?php include 'includes/header.php'; ?>
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
					<a href="login.php">Already have account?</a>
					<button class="btn dark h-captcha" data-sitekey="b5a27318-cdb1-4c68-9ebf-98aca4fc6839" data-callback="onSubmit">Sign Up</button>
				</form>
			</div>
		</div>
	</main>
<?php include 'includes/footer.php'; ?>
