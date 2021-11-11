<?php
	if($_POST['task_submit']){
		$task_name = $_POST['task_name'];
		$task_body = $_POST['task_body'];
		$due_date = $_POST['due_date'];
		$list_id = $_POST['list_id'];

		//Instantiate Database object
		$database = new Database;

		$database->query('INSERT INTO tasks (task_name,task_body,due_date,list_id) VALUES(:task_name,:task_body,:due_date,:list_id)');
		$database->bind(':task_name',$task_name);
		$database->bind(':task_body',$task_body);
		$database->bind(':due_date',$due_date);
		$database->bind(':list_id',$list_id);
		$database->execute();
    
		if($database->lastInsertId()){
			echo '<p class="msg">Your task has been created</p>';
		}
	}
?>

<?php
  //Instantiate Database object
  $database = new Database;

  //Get logged in user
  $list_user = $_SESSION['username'];

  //Query
  $database->query('SELECT * FROM lists WHERE list_user = :list_user');
  $database->bind(':list_user',$list_user);
  $rows = $database->resultset();
?>


<p class="lead">Organise your day by adding your tasks</p>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
  <div class="mb-3">
    <label for="task_name" class="form-label">Task Name</label>
    <input type="text" name="task_name" class="form-control" id="task_name"
      value="<?php if($_POST['task_name'])echo $_POST['task_name'] ?>" />
  </div>
  <?php if($_GET['listid']) : ?>
  <input type="hidden" name="list_id" value="<?php echo $_GET['listid']; ?>" />
  <?php else : ?>
  <div class="mb-3">
    <label for="list_id" class="form-label">List</label>
    <select name="list_id" class="form-select" id="list_id">
      <option value="0" disabled selected>--Select List--</option>
      <?php foreach($rows as $list) : ?>
      <option value="<?php echo $list['id']; ?>"><?php echo $list['list_name']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <?php endif; ?>
  <div class="mb-3">
    <label for="task_body" class="form-label">Task Description</label>
    <textarea name="task_body" class="form-control" id="task_body" rows="5"></textarea>
  </div>
  <div class="mb-3">
    <label for="due_date" class="form-label">Due Date</label>
    <input type="date" name="due_date" class="form-control" id="due_date"
      value="<?php if($_POST['due_date'])echo $_POST['due_date'] ?>" />
  </div>
  <div class="mb-3">
    <input type="submit" class="btn btn-primary w-100" value="Create Task" name="task_submit" />
  </div>
</form>