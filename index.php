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
  //LOG OUT
  if($_POST['logout_submit']){
    if(isset($_SESSION['username']))
        unset($_SESSION['username']);
    if(isset($_SESSION['password']))
        unset($_SESSION['password']);
    if(isset($_SESSION['logged_in']))
        unset($_SESSION['logged_in']);
    session_destroy();
    header("Location:index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task Manager</title>

  <!-- Local CSS -->
  <link rel="stylesheet" href="/css/styles.css">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- GOOGLE FONTS -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&family=Montserrat:wght@300;400;500;600&family=Oswald:wght@400;500;600;700&family=Raleway:wght@300;400&display=swap"
    rel="stylesheet">
</head>

<body>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="http://localhost/2.LearnPHPandMySQLDevelopmentFromScratch/project/">Task Manager</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page"
              href="http://localhost/2.LearnPHPandMySQLDevelopmentFromScratch/project/">Home</a>
          </li>
          <?php if($_SESSION['logged_in']) : ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=new_list">Add List</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=new_task">Add Task</a>
          </li>
          <?php endif; ?>
        </ul>

        <?php if($_SESSION['logged_in']) : ?>
        <span class="navbar-text me-2">
          Hello, <?php echo $_SESSION['username']; ?>
        </span>

        <!-- Signout Form -->
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
          <input type="submit" class="btn btn-danger" value="Sign Out" name="logout_submit" />
        </form>
        <?php else : ?>
        <a href="index.php?page=register" class="btn btn-warning me-2" tabindex="-1" role="button">Sign Up</a>
        <a href="index.php?page=login" class="btn btn-primary" tabindex="-1" role="button">Sign In</a>
        <?php endif; ?>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <img src="<?php
          if($_GET['page'] == 'welcome' || $_GET['page'] == ""){
            echo 'img/welcome.svg';
          } elseif($_GET['page'] == 'list'){
            echo '';
          } elseif($_GET['page'] == 'login'){
            echo '';
          } elseif($_GET['page'] == 'task'){
            echo '';
          } elseif($_GET['page'] == 'new_task'){
            echo '';
          } elseif($_GET['page'] == 'new_list'){
            echo '';
          } elseif($_GET['page'] == 'edit_task'){
            echo '';
          } elseif($_GET['page'] == 'edit_list'){
            echo '';
          } elseif($_GET['page'] == 'register'){
            echo '';
          } elseif($_GET['page'] == 'delete_list'){
            echo '';
          }
        ?>" class="contact__img" alt="Todo welcome illustration" title="Todo welcome illustration" loading="eager"
          width="400" height="400" />
      </div>

      <div class="col-md-7">
        <?php
          if($_GET['msg'] == 'listdeleted'){
            echo '<p class="msg">Your list has been deleted</p>';
          }
          if($_GET['page'] == 'welcome' || $_GET['page'] == ""){
            include 'pages/welcome.php';
          } elseif($_GET['page'] == 'list'){
            include 'pages/list.php';
          } elseif($_GET['page'] == 'login'){
            include 'pages/login.php';
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