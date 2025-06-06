<?php

// session start
session_start();

// include DB connection
include('scripts/db.php');

error_reporting(0);
if (!isset($_SESSION['email'])) { // if user not logged in!

  header('Location: /main.php');
} else {

  $email = $_SESSION['email'];
}
$receiver = $_GET['receiver'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
  <title>Диалог</title>
  <!-- external stylesheets -->
  <link rel="stylesheet" href="assets/css/chats.css">
  <link rel="stylesheet" href="assets/css/message.css">
  <!--   <link rel="stylesheet" href="/styles/reset.min.css" />
    <link rel="stylesheet" href="/styles/style.css" /> -->

  <!-- Fontawesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="/styles/header-9.css" />
</head>

<body>


  <nav class="navbar navbar-expand-lg navbar-light aqua" style="padding: 1% 11%; font-size: 20px;">
    <a href="index.html" class="brand"> <img src="img/logo_cvs.svg" width="240px" border="0" alt="Новые Технологии :: Системы CVS (Computer Video Security)" align="left"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <!--  <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li> -->
    
        <li class="nav-item">
          <a class="nav-link" href="/knowledge_base/dist/knowledge_base.html">База знаний</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/contacts/contacts.php">Контакты</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./chats.php">Чаты</a>
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

  <!-- Navbar -->





  <div class="container">
    <?php
    $getReceiver = "SELECT * FROM users WHERE email = '$receiver'";
    $getReceiverStatus = mysqli_query($conn, $getReceiver) or die(mysqli_error($conn));
    $getReceiverRow = mysqli_fetch_assoc($getReceiverStatus);
    $received_by = $getReceiverRow['email'];
    ?>
    <div class="card mt-4">
      <div class="card-header" style="background-color: #def7ff;">
        <h6><img src="./dp/<?= $getReceiverRow['dp'] ?>" alt="Profile image" width="40" /><strong> <?= $receiver ?></strong></h6>
      </div>
      <?php
      $getMessage = "SELECT * FROM messages WHERE sent_by = '$receiver' AND received_by = '$email' OR sent_by = '$email' AND received_by = '$receiver' ORDER BY createdAt asc";
      $getMessageStatus = mysqli_query($conn, $getMessage) or die(mysqli_error($conn));
      if (mysqli_num_rows($getMessageStatus) > 0) {
        while ($getMessageRow = mysqli_fetch_assoc($getMessageStatus)) {
          $message_id = $getMessageRow['id'];
      ?>
          <div class="card-body">
            <h6 style="color: #007bff"><?= $getMessageRow['sent_by'] ?></h6>
            <div class="message-box ml-4">
              <p class="text-center"><?= $getMessageRow['message'] ?></p>
            </div>
          </div>
        <?php
        }
      } else {
        ?>
        <div class="card-body">
          <p class="text-muted">Сообщений еще не было!</p>
        </div>
      <?php
      }
      ?>
      <div class="card-footer text-center" style="background-color: #def7ff; ">
        <form action="scripts/send.php" method="POST" style="display: inline-block">
          <input type="hidden" name="sent_by" value="<?= $email ?>" />
          <input type="hidden" name="received_by" value="<?= $receiver ?>" />
          <div class="row">
            <div class="col-md-10">
              <div class="form-group">
                <input type="text" name="message" id="message" class="form-control" placeholder="Ваше сообщение" required />
              </div>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-primary">Отправить</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap scripts -->
  <!-- Bootstrap scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <!-- Scripts -->
  <script src="assets/js/snackbar.js"></script>
  <script src="js/header-9.js"></script>
</body>

</html>