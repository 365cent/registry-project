<?php 
$page = "My Lists";
include 'includes/dash.header.php';
include 'includes/library.php';

$listId = $_GET['id'] ?? null;

function alert($var){
	echo '<script>alert("'.$var.'")</script>';
}

if(empty($listId)): 

	$pdo = connectDB();
	$stmt = $pdo->prepare("SELECT * FROM lists where ownerId = ?");
	$stmt->execute([$id]);
	$rows = $stmt->rowCount();
	$result = $stmt->fetchAll()
	?>

	<main>
		<div class="list">
			<div>
				<h2>My Lists</h2>
				<div>
					<ul>
						<li></li>
						<li><button class="btn round" name="create">Create</button></li>
						<li><button class="btn round" name="delete">Delete</button></li>
					</ul>
				</div>
				<ul>
					<?php if($rows> 0){
					foreach ($rows as $row):?>
					<a href="list.php?id=<?php echo $row['id']?>">	
						<li>
							<input type="checkbox" name="<?php echo $row['id']?>">
							<p><?php echo $row['listname']?></p>
							<button class="btn round" name="edit">Edit</button>
							<button class="btn round" name="delete">Delete</button>
						</li>
					</a>
					<?php endforeach;}
					else{?>
					<a href="list.php?id=1">	
						<li>
							<input type="checkbox" name="">
							<p>Sample List</p>
						</li>
					</a>
					<?php };?> 
				</ul>
			</div>
		</div>
	</main>
<?php else: 
	$pdo = connectDB();
	$stmt = $pdo->prepare("SELECT * FROM lists where id = ?");
	$stmt->execute([$listId]);
	$result = $stmt->fetch();
	if($result) {
		if($result['ownerId'] != $id) {
			echo 'You are not the owner of this list';
			echo '<script>window.location.href = "user.php"</script>';
		}
		else {
			$stmt = $pdo->prepare("SELECT username FROM users where id = ?");
			$stmt->execute([$result['ownerId']]);
			$owner = $stmt->fetch()['username'];
		}
	} else {
		alert("list not found");
		echo '<script>window.location.href = "user.php"</script>';
	}
?>
	<main>
		<div class="list">
			<div>
				<h2><?php echo $result['listname'] ?></h2>
				<p><i class="ri-user-fill">Owner: </i><span><?php echo $owner ?></span></p>
				<div>
					<ul>
						<li></li>
						<li><button class="btn round" name="edit">Edit</button></li>
						<li><button class="btn round" name="delete">Delete</button></li>
					</ul>
				</div>
				<ul>
					<a href="list.php?id=1">	
						<li>
							<input type="checkbox" name="">
							<p>List 1</p>
							<button class="btn round" name="edit">Edit</button>
							<button class="btn round" name="delete">Delete</button>
						</li>
					</a>
					<a href="list.php?id=2">	
						<li>
							<input type="checkbox" name="">
							<p>List 2</p>
							<button class="btn round" name="edit">Edit</button>
							<button class="btn round" name="delete">Delete</button>
						</li>
					</a>
					<a href="list.php?id=3">	
						<li>
							<input type="checkbox" name="">
							<p>Long long long long long long long long long long long long long long long long long long long list test</p>
							<button class="btn round" name="edit">Edit</button>
							<button class="btn round" name="delete">Delete</button>
						</li>
					</a>
				</ul>
			</div>
		</div>
	</main>
<?php endif; ?>
<?php include 'includes/dash.footer.php'; ?>