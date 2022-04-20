<?php
require 'includes/library.php';
$pdo = connectDB();
if(isset($_GET['username'])){
        
    //query for record matching user name 
    $statement = $pdo->prepare("SELECT username FROM `users` WHERE username = ?");
    $statement->execute([$username]);
    
    //remember fetch returns false when there were no records
    if ($statement->fetch()) {
        echo 'true'; //username found
    } else {
        echo 'false'; //user name not exists
    }
    exit();
}
else if(!empty($_GET['popular'])){
    $popular = $_GET['popular'];
    //query for record matching top lists
    $statement = $pdo->query("SELECT * FROM `lists` WHERE public = 1 AND disable = 0 ORDER BY `lists`.`views` DESC LIMIT $popular");
    $result = $statement->fetchAll();
    echo json_encode($result);
    exit();
}
else{
}
    

?>
