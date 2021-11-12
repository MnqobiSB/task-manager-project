<?php
	if($_POST['submit']){
		$list_name = $_POST['list_name'];
		$list_body = $_POST['list_body'];
		$list_user = $_SESSION['username'];

		//Instantiate Database object
		$database = new Database;

		$database->query('INSERT INTO lists (list_name,list_body,list_user) VALUES(:list_name,:list_body,:list_user)');
		$database->bind(':list_name',$list_name);
		$database->bind(':list_body',$list_body);
		$database->bind(':list_user',$list_user);
		$database->execute();

		if($database->lastInsertId()){
			echo '<p class="msg">Your list has been created</p>';
		}
	}
?>

<p class="lead">Organise your day by adding a category list</p>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
  <div class="mb-3">
    <label for="list_name" class="form-label">List Name</label>
    <input type="text" name="list_name" class="form-control" id="list_name"
      value="<?php if($_POST['list_name'])echo $_POST['list_name'] ?>" />
  </div>
  <div class="mb-3">
    <label for="list_body" class="form-label">List Description</label>
    <textarea name="list_body" class="form-control" id="list_body" rows="5"></textarea>
  </div>
  <div class="mb-3">
    <input type="submit" class="btn btn-primary w-100" value="Create List" name="submit" />
  </div>
</form>