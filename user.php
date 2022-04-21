<?php include 'includes/dash.header.php'; 
include 'includes/library.php';
$pdo = connectDB();
$stmt = $pdo->prepare('SELECT * FROM users where id = ?');
$stmt->execute([$id]);
$results = $stmt->fetch();
$Cname = $_POST['username']??null;
$Cemail = $_POST['email']??null;
$Cpassword = $_POST['password']??null;
$usernamevalid = '/^[0-9a-zA-Z_.-]+$/';
$passwordvalid = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/';
$emailvalid = '/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/';

function update($new,$place){
    try{
        $pdo = connectDB();
        $sql = "UPDATE users set ?= ? WHERE id = ?";
        $stmt = $pdo ->prepare($sql)->execute([$place,$new,$id]);  
        alert("update successful!!");
    }catch(PDOException $e){
       alert($e->getmessage());
    }
}

function alert($var){
	echo '<script>alert("'.$var.'")</script>';
}

if(isset($_GET['id'])){
    if($_GET['id'] = $id){
        
    }
}

if(isset($_POST['username'])){
    if (preg_match($usernamevalid, $Cname)) {
        update($Cname,username);
    }else{
        alert('new user name is not valid');
    }
}
if(isset($_POST['email'])){
    
    //update the datebase of new user name 
    if (preg_match($emailvalid, $Cemail)) {
        update($Cemail,email);
    }else{
        alert('new email name is not valid');
    }
    
}
if(isset($_POST['password'])){
    //update the datebase of new user name 
    if (preg_match($passwordvalid, $Cpassword)) {
        update($Cpassword,password);
    }else{
        alert('new password is not valid');
    }
}


?>



		<main>
            <div class="profile">
                <span><?php echo $results['username']?></span>
                <span><?php echo $results['email']?></span>
            </div> 
				<button name ="edit" value="1">edit</button>
			
		</main>

<?php include 'includes/dash.footer.php'; ?>