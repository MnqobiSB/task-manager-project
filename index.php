<?php
  //Start Session
  session_start();
  //Config File
  require 'config.php';
  //Database Class
  require 'classes/database.php';

  $database = new Database;

  //Set Timezone
  date_default_timezone_set('Africa/Harare');
?>

<?php
  //LOG IN
  if($_POST['login_submit']){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $enc_password = md5($password);
    //Query
    $database->query("SELECT * FROM users WHERE username = :username AND password = :password");
    $database->bind(':username',$username);
    $database->bind(':password',$enc_password);
    $rows = $database->resultset();
    $count = count($rows);
    if($count > 0){
      session_start();
      //Assign session variables
      $_SESSION['username']   = $username;
      $_SESSION['password']   = $password;
      $_SESSION['logged_in']  = 1;
    } else {
      $login_msg[] = 'Sorry, username or password is incorrect';
    }
  }


  //LOG OUT
  if($_POST['logout_submit']){
    if(isset($_SESSION['username']))
        unset($_SESSION['username']);
    if(isset($_SESSION['password']))
        unset($_SESSION['password']);
    if(isset($_SESSION['logged_in']))
        unset($_SESSION['logged_in']);
    session_destroy();
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task Manager</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>

<body>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="http://localhost/2.LearnPHPandMySQLDevelopmentFromScratch/project/">My Tasks</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <?php if($_SESSION['logged_in']) : ?>
              Hello, <?php echo $_SESSION['username']; ?>
              <?php endif; ?>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page"
              href="http://localhost/2.LearnPHPandMySQLDevelopmentFromScratch/project/">Home</a>
          </li>
          <?php if(!$_SESSION['logged_in']) : ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=register">Register</a>
          </li>
          <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=new_list">Add List</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=new_task">Add Task</a>
          </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <h1>Task Manager</h1>
    <div class="row">
      <div class="col-md-3">
        <h2>Login Form</h2>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
          <?php if(!$_SESSION['logged_in']) : ?>
          <?php foreach($login_msg as $msg) : ?>
          <?php echo $msg.'<br />'; ?>
          <?php endforeach; ?>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username">
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password">
          </div>

          <div class="mb-3">
            <input type="submit" class="btn btn-success" value="Sign In" name="login_submit" />
          </div>
          <?php else : ?>
          <div class="mb-3">
            <input type="submit" class="btn btn-danger" value="Sign Out" name="logout_submit" />
          </div>
          <?php endif; ?>
        </form>
      </div>

      <div class="col-md-9">
        <?php
          // if($_GET['msg'] == 'listdeleted'){
          //   echo '<p class="msg">Your list has been deleted</p>';
          // }
          if($_GET['page'] == 'welcome' || $_GET['page'] == ""){
            include 'pages/welcome.php';
          } elseif($_GET['page'] == 'list'){
            include 'pages/list.php';
          } elseif($_GET['page'] == 'task'){
            include 'pages/task.php';
          } elseif($_GET['page'] == 'new_task'){
            include 'pages/new_task.php';
          } elseif($_GET['page'] == 'new_list'){
            include 'pages/new_list.php';
          } elseif($_GET['page'] == 'edit_task'){
            include 'pages/edit_task.php';
          } elseif($_GET['page'] == 'edit_list'){
            include 'pages/edit_list.php';
          } elseif($_GET['page'] == 'register'){
            include 'pages/register.php';
          } elseif($_GET['page'] == 'delete_list'){
            include 'pages/delete_list.php';
          }
        ?>
      </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>