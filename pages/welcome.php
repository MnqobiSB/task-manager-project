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
<h2 class="text-center"><em>Here are your current lists:</em></h2>
<div class="row">
  <?php if($rows) : ?>
  <?php
      foreach($rows as $list){
        echo '
          <div class="col-md-6">
            <a href="?page=list&id='.$list['id'].'">
              <div class="card text-white bg-primary mb-3">
                <div class="card-header"><h5 class="card-title mb-0">'.$list['list_name'].'</h5></div>
                <div class="card-body">
                  <p class="card-text">
                  '.$list['list_body'].'
                  </p>
                </div>
              </div>
            </a>
          </div>
        ';
      }
    ?>
  <?php endif; ?>
</div>
<?php else : ?>
<div class="content text-center">
  <h2><em>Get things done with Task Manager!</em></h2>
  <p>Task Manager is a small but helpful application where you can create and manage tasks to make your life easier.
    Just sign-up and sign-in to get started with your daily task planner.</p>
  <a href="index.php?page=register" class="btn btn-success" tabindex="-1" role="button">Get Started</a>
</div>
<?php endif; ?>