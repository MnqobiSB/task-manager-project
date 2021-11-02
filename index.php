<?php
  //Start Session
  session_start();
  //Config File
  require 'config.php';

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
        <p class="navbar-text pull-right">
          <?php if($_SESSION['logged_in']) : ?>
          Hello, <?php echo $_SESSION['username']; ?>
          <?php endif; ?>
        </p>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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

        <form>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
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