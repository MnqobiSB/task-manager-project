<h1>Welcome to Task Manager</h1>

<?php
  if($_SESSION['logged_in']){
    //Instantiate Database object
    $database = new Database;

    //Get logged in user
    $list_user = $_SESSION['username'];

    //Query
    $database->query('SELECT * FROM lists WHERE list_user=:list_user');
    $database->bind(':list_user',$list_user);
    $rows = $database->resultset();
  }
?>

<?php if($_SESSION['logged_in']) : ?>
<h3>Here are your current lists:</h3>
<?php if($rows) : ?>
<ul class="items">
  <?php
    foreach($rows as $list){
      echo '<li><a href="?page=list&id='.$list['id'].'">'.$list['list_name'].'</a></li>';
    }
  ?>
</ul>
<?php endif; ?>
<?php else : ?>
<h2>This App Helps You Plan Your Daily Tasks</h2>
<p>Task Manager is a small but helpful application where you can create and manage tasks to make your life easier.
  Just register and login and you can start adding tasks</p>
<?php endif; ?>