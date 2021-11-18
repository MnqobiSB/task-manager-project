<?php
	if($_POST['submit']){
		$list_id = $_GET['id'];
		$list_name = $_POST['list_name'];
		$list_body = $_POST['list_body'];
		
		//Instantiate Database object
		$database = new Database;
		
		$database->query('UPDATE lists SET list_name = :list_name,list_body = :list_body WHERE id = :id');
		$database->bind(':list_name',$list_name);
		$database->bind(':list_body',$list_body);
		$database->bind(':id',$list_id);
		$database->execute();
    
		if($database->rowCount()){
			echo '<p class="msg">Your list has been updated</p>';
		}
	}
?>

<?php
  $list_id = $_GET['id'];

  //Instantiate Database object
  $database = new Database;
  
  //Query
  $database->query('SELECT * FROM lists WHERE id = :id');
  $database->bind(':id',$list_id);
  $row = $database->single();
?>

<p class="lead">Edit your <?php echo $row['list_name']; ?> list</p>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
  <div class="mb-3">
    <label for="list_name" class="form-label">List Name</label>
    <input type="text" name="list_name" class="form-control" id="list_name" value="<?php echo $row['list_name']; ?>" />
  </div>
  <div class="mb-3">
    <label for="list_body" class="form-label">List Description</label>
    <textarea name="list_body" class="form-control" id="list_body" rows="5"><?php echo $row['list_body']; ?></textarea>
  </div>
  <div class="mb-3">
    <input type="submit" class="btn btn-primary w-100" value="Update List" name="submit" />
  </div>
</form>