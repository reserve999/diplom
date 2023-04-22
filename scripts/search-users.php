<?php

    // session start
    session_start();

    // include DB connection
    include('./db.php');

    // declaring variables
    $search = "";

    // get form data
    if(isset($_POST['search'])) {

        $search = $_POST['search'];

    }

    if($search != "") { // if the field is not empty!

        // search for user!
        $searchUser = "SELECT * FROM users WHERE name = '$search' OR email = '$search'";
        $searchUserStatus = mysqli_query($conn,$searchUser) or die(mysqli_error($conn));
        
        if(mysqli_num_rows($searchUserStatus) > 0) { // if there is an user!

            header('Location: ../search-results.php?message=Пользователь найден!');

        } else {

            header('Location: ../search-results.php?message=Пользователь не найден!');

        }
        

    } else { // if the fields is empty!

        header('Location: ../chats.php?message=Пожалуйста, введите что-нибудь!');

    }

    $_SESSION['search'] = $search;
?>