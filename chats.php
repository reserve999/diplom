<?php

// session start
session_start();

// include DB connection
include('scripts/db.php');

if (isset($_SESSION['email'])) { // if user not logged in!

  $email = $_SESSION['email'];
} else {

  header('Location: /main.php?message=Please login first!');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
  <title>Личный кабинет</title>
  <!-- external stylesheets -->
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/snackbar.css">
  <!--  <link rel="stylesheet" href="/styles/reset.min.css" />
    <link rel="stylesheet" href="/styles/style.css" /> 
    <link rel="stylesheet" href="/styles/header-9.css" /> -->
  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body onLoad="myFunction()">

  <!-- Navbar -->



  <nav class="navbar navbar-expand-lg navbar-light aqua" style="padding: 1% 11%; font-size: 20px;">
    <a href="index.html" class="brand"> <img src="img/logo_cvs.svg" width="240px" border="0" alt="Новые Технологии :: Системы CVS (Computer Video Security)" align="left"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <!-- <li class="nav-item active">
        <a class="nav-link" href="./chats.php">Home <span class="sr-only">(current)</span></a>
      </li> -->
        
        <li class="nav-item">
          <a class="nav-link" href="/knowledge_base/dist/knowledge_base.html">База знаний</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./contacts/contacts.php">Контакты</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="./logout.php">Выход</a>
        </li>
        <?php
        $getUser = "SELECT * FROM users WHERE email = '$email'";
        $getUserStatus = mysqli_query($conn, $getUser) or die(mysqli_error($conn));
        $getUserRow = mysqli_fetch_assoc($getUserStatus);
        ?>
        <li class="nav-item">
          <img src="./dp/<?= $getUserRow['dp'] ?>" alt="Profile image" width="40" class="dropdown" />
        </li>
    </div>
  </nav>




  <!-- chats section -->
  <div class="container mt-4">
    <?php
    include "common/snackbar.php";
    ?>
    <div class="card" style="margin: 3% 3%; ">
      <div class="card-title text-center">
        <form class="form-inline mt-4" style="display : inline-block" method="POST" action="scripts/search-users.php">
          <input class="form-control mr-sm-2" type="search" name="search" placeholder="Введите e-mail" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск</button>
        </form>
      </div>
      <div class="card-body mb-4">
        <?php
        $lastMessage = "SELECT DISTINCT sent_by FROM messages WHERE received_by = '$email'";
        $lastMessageStatus = mysqli_query($conn, $lastMessage) or die(mysqli_error($conn));
        if (mysqli_num_rows($lastMessageStatus) > 0) {
          while ($lastMessageRow = mysqli_fetch_assoc($lastMessageStatus)) {
            $sent_by = $lastMessageRow['sent_by'];
            $getSender = "SELECT * FROM users WHERE email = '$sent_by'";
            $getSenderStatus = mysqli_query($conn, $getSender) or die(mysqli_error($conn));
            $getSenderRow = mysqli_fetch_assoc($getSenderStatus);
        ?>
            <div class="card">
              <div class="card-body">
                <h6><strong><img src="./dp/<?= $getSenderRow['dp'] ?>" alt="dp" width="40" /> <?= $lastMessageRow['sent_by']; ?></strong><a href="./message.php?receiver=<?= $sent_by ?>" class="btn btn-outline-primary" style="float:right">Отправить сообщение</a></h6>
              </div>
            </div><br />
          <?php
          }
        } else {
          ?>
          <div class="card-body text-center">
            <h6><strong>Диалогов пока не было!</strong></h6>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>

  <!-- Bootstrap scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <!-- Scripts -->
  <script src="assets/js/snackbar.js"></script>
  <script src="js/header-9.js"></script>
</body>

</html>