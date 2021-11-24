<?php
  $list_id = $_GET['id'];

  //Instantiate Database object
  $database = new Database;
  //Query
  $database->query('SELECT * FROM lists WHERE id = :id');
  $database->bind(':id', $list_id);
  $row = $database->single();

  echo '<p class="lead">'.$row['list_body'].'</p>';

  //Instantiate Database object
  $database = new Database;
  //Query
  $database->query('SELECT * FROM tasks WHERE list_id = :list_id AND is_complete = :is_complete');
  $database->bind(':list_id', $list_id);
  $database->bind(':is_complete',0);
  $rows = $database->resultset();

  echo '<h2>My Tasks</h2>';
  echo '<button onclick="history.go(-1);" class="btn btn-secondary mb-2" tabindex="-1" role="button">Go Back</button>';
  if($rows){
    // Task List
    echo '<ul class="list-group mb-3">';
    foreach($rows as $task){
      echo '
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a href="?page=task&id='.$task['id'].'">'.$task['task_name'].'</a>
          <span class="badge bg-primary rounded-pill">Due: '.$task['due_date'].'</span>
        </li>
      ';
    }
    echo '</ul>';

    // Edit & Delete Buttons
    echo '<a href="?page=edit_list&id='.$row['id'].'" class="btn btn-warning me-2" tabindex="-1" role="button">Edit List</a>';
    echo '<a href="?page=delete_list&id='.$row['id'].'" class="btn btn-danger" tabindex="-1" role="button">Delete List</a>';
  } else {
    // No Tasks - Create One
    echo 'No tasks for this list - <a href="index.php?page=new_task&listid='.$_GET['id'].'">Create One Now</a>';
  }
?>