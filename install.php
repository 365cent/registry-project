<?php 
include 'includes/library.php';
$pdo = connectDB();
$query = "show tables like 'users'";
$stmt = $pdo->query($query);
if($stmt->rowCount() == 0){
    $query = "CREATE TABLE `users` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `username` varchar(255) NOT NULL,
        `password` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        PRIMARY KEY (id)
        );";
    $stmt = $pdo->query($query);
    $query = "CREATE TABLE `lists` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `listname` text NOT NULL,
        `owner_id` int NOT NULL,
        `public` boolean NOT NULL,
        `disable` boolean NOT NULL,
        `featureImage` varchar(255) NOT NULL,
        `password` varchar(255) NOT NULL,
		`views` int NOT NULL,
        `expiryDate` datetime NOT NULL,
        `content` longtext NOT NULL,
        PRIMARY KEY(id),
        FOREIGN KEY(owner_id) REFERENCES users(id)
        );";
    $stmt = $pdo->query($query);
}else{
    echo '<script type="text/javascript">';
	echo ' alert("table already exists")';  //showing an alert box.
	echo '</script>';
    header("Location: index.html");
}
?>