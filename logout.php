<?php

    session_start();
    unset($_SESSION["email"]);
    session_destroy();
    header("Location:./main.php?message=Вы вышли из аккаунта!");

?>