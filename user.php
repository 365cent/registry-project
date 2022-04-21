<?php include 'includes/dash.header.php'; 

$Cname = $_POST['username']??null;
$Cemail = $_POST['email']??null;
$Cpassword = $_POST['password']??null;
$confirm = true;
$usernamevalid = '/^[0-9a-zA-Z_.-]+$/';
$passwordvalid = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/';
$emailvalid = '/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/';

function update($new,$place){
    try{
        $pdo = connectDB();
        $sql = "UPDATE users set ?= ? WHERE id = ?";
        $stmt = $pdo ->prepare($sql)->execute([$place,$new,$id]);  
    }catch(PDOException $e){
        echo alert($e->getmessage());
    }
	
}

function confirm($var,$confirm){
	echo '<script> if(confirm("'.$var.'")){'$confirm = true' }else{'$confirm = false' }</script>';
}
function alert($var){
	echo '<script>alert("'.$var.'")</script>';
}
$_POST['username'] =1;
if(isset($_POST['username'])){
    confirm("Are your sure change your user name?",$confirm);
	// if(confirm("Are your sure change your user name?")){
	// 	//update the datebase of new user name 
	// 	if (preg_match($usernamevalid, $Cname)) {
	// 		//update($Cname,username);
    //         var_dump($confirm);
	// 	}else{
    //         var_dump($confirm);
	// 		alert('new user name is not valid');
	// 	}
	// }
	
}
// if(isset($_POST['email'])){
// 	if(confirm("Are your sure change your email?")){
// 		//update the datebase of new user name 
// 		if (preg_match($emailvalid, $Cemail)) {
// 			update($Cemail,email);
// 		}else{
// 			alert('new email name is not valid');
// 		}
// 	}
// }
// if(isset($_POST['password'])){
// 	if(confirm("Are your sure change your password?")){
// 		//update the datebase of new user name 
// 		if (preg_match($passwordvalid, $Cpassword)) {
// 			update($Cpassword,password);
// 		}else{
// 			alert('new user name is not valid');
// 		}
// 	}
// }
?>



		<main>
        <button name ="username">username</button>
		</main>

<?php include 'includes/dash.footer.php'; ?>