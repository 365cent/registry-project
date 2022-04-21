<?php 
$page = "User Profile";
include 'includes/dash.header.php'; 
include 'includes/library.php';
$Cname = $_POST['username']??null;
$Cemail = $_POST['email']??null;
$Cpassword = $_POST['password']??null;
$usernamevalid = '/^[0-9a-zA-Z_.-]+$/';
$passwordvalid = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-/]).{8,}$/';
$emailvalid = '/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/';
$pdo = connectDB();

function update($new,$place,$id){

    var_dump($new,$place,$id);
    $sql = "UPDATE users set $place = '$new' WHERE id = $id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    var_dump($stmt);
    var_dump($stmt->rowCount());
    if($stmt->rowCount()){
        alert("update successful!!");
    }else {
        alert("error");
    }
     
}
function same($str,$place){
    
    $sql = "SELECT * from users WHERE $place = '$str'";
    $stmt = $pdo ->prepare($sql);
    $stmt->execute();  
    $count = $stmt->rowCount();
    if($count >0){
        return true;
    }else {
        return false;
    }
    
}
function alert($var){
	echo '<script>alert("'.$var.'")</script>';
}

if(isset($_POST['username']) && !empty($_POST['username'])){
    if (preg_match($usernamevalid, $Cname)) {
        if(!same($Cname,'username')){
            update($Cname,'username',$id);
        }else {
            alert("user name exits");
        }
    }else{
        alert('new user name is not valid or repeat');
    }
}
if(isset($_POST['email'])&&!empty($_POST['email'])){
    
    //update the datebase of new user name 
    if (preg_match($emailvalid, $Cemail)) {
        if(!same($Cemail,'email')){
            update($Cemail,'email',$id);
        }else {
            alert("email already used");
        }
    }else{
        alert('new email name is not valid or repeat');
    }
    
}
if(isset($_POST['password'])&&!empty($_POST['email'])){
    //update the datebase of new user name 
    if (preg_match($passwordvalid, $Cpassword)) {
        update(password_hash($Cpassword,PASSWORD_DEFAULT),'password',$id);
    }else{
        alert('new password is not valid');
    }
}
if(isset($_POST['delete'])){
    $sql = "DELETE FROM `users` WHERE `id` = $id";
    $stmt = $pdo ->prepare($sql);
    $stmt->execute();  
    $count = $stmt->rowCount();
    if($count >0){
         alert('delete account successful');
         session_destroy();
         header("Location: login.php");
         exit();
    }else {
        alert('delete account failed!');
    }
}
try{
    $stmt = $pdo->prepare("SELECT * FROM users where id = ?");
    $stmt->execute([$id]);

    $result = $stmt->fetch();
}catch(Exception $e) {
    echo $e;
}
?>
    
		<main>
            <ul>
                <img src = "https://avatars.dicebear.com/api/initials/<?php echo $result['username']?>.svg" width = "200px">
                <li><?php echo $result['username']?></li>
                <li><?php echo $result['email']?></li>
            </ul>
        <form method="post" style="display: none;">
		    <input type="text" name="input">
	    </form>
        <form method="post">
            <input type="text" name="username"><button onclick="sub()" type="button">username change</button>
            <input type="text" name="email"><button onclick="sub()" type="button">email change </button>
            <input type="text" name="password"><button onclick="sub()" type="button">password change </button>
            <button>submit all</button>
        </form>
        <form method="post" id="del";>
		   <button name ="delete">delete your account </button>
	    </form>
        <script>
        function sub() {
            let hiddenForm = document.getElementByName('form')[0];
            let input = hiddenForm.querySelector("input");
            let info = event.target.previousElementSibling;
            input.name = info.name;
            input.value = info.value;
            hiddenForm.submit();
        }
        </script>
		</main>

<?php include 'includes/dash.footer.php'; ?>