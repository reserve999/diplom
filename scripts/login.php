<?php
    
    // session start
    session_start();

    // include DB connection
    include('./db.php');

    // declaring variables
    $email = "";
    $password = "";

    // getting form data!
    if(isset($_POST['email'])) {
        $email = $_POST['email'];
    }

    if(isset($_POST['password'])) {
        $password = $_POST['password'];
    }

    //$npassword = password_hash($password, PASSWORD_DEFAULT);


    if($email != "" && $password != "") { // if the fields are not empty!
         
        $checkUser = "SELECT * FROM `users` WHERE `email` = '$email'";
        $checkUserStatus = mysqli_query($conn,$checkUser) or die(mysqli_error($conn));

        if(mysqli_num_rows($checkUserStatus) > 0) { // if user exists!

            // условие с логином правильное = проверил!

            // проблема в том что нужно брать значение пароля из базы данных, 
            // делать какую-то выборку
            // а у меня берется единичное значение

            $result = mysqli_query ($conn, "SELECT password FROM users WHERE `email` = '$email'"); 
          // может здесь добавить еще условие WHERE `email` = '$email'
            //$npassword = array();
            
            while ($row = mysqli_fetch_assoc ($result))
           {
                $npassword = $row['password'];
               global $npassword;
            }

            //!!!!!кажется заработало!!!!! только старые записи с другим шифрованием уже не работают
            // надо будет создать побольше новых и все проверить!!!!!

           //$sql = mysqli_query($conn, 'SELECT password FROM `users`');
          // while ($npassword = mysqli_fetch_array($sql)) {
         //  echo "{$npassword['password']}";
       // }

            //$npassw = array_map(function($item) { return $item->password; }, $conn);

        
               // $npassword = "SELECT 'password' FROM `users` WHERE `email` = '$email'";
               //$row = users[];

            //$getSalt = "SELECT * FROM `users` WHERE `email` = '$email'";
            //$getSaltStatus = mysqli_query($conn,$getSalt) or die(mysqli_error($conn));
           // $getSaltRow = mysqli_fetch_assoc($getSaltStatus);

           // $salt = $getSaltRow['salt'];
           // $dbPassword = $getSaltRow['password'];
            //$ePassword = md5(md5($password).$salt);

           // $salt = $user['salt']; // соль из БД
		//$hash = $user['password']; // соленый пароль из БД

      //  $password = md5($salt . $_POST['password']); // соленый пароль от юзера
      //$numRows = mysqli_num_rows($conn);

      //$npassword = password_hash($password, PASSWORD_DEFAULT); это закомментил
      //$row = mysqli_fetch_assoc($conn);

      //$npassword = '$2y$10$jxFR5Vu6XaucOIQZ9gVkfuW.kXvaJqSRfooFz7cCp2lZoNzA2bIkS'; //если сделать так, то работает
      if(password_verify( $_POST['password'], $npassword)){ // if password entered is correct!
              

                $_SESSION['email'] = $email;
                header('Location: ../chats.php?message=Вы успешно авторизовались!');

            } else {

                header('Location: ../main.php?message=Неправильный логин или пароль!');

            }


        } else {

            header('Location: ../main.php?message=Невозможно войти в аккаунт!');

        }

    } else { // if the fields are empty!

        header('Location: ../main.php?message=Заполните все поля!');

    }

?>