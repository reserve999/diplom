<?php
    $servername='localhost';
    $username='root';
    $password='';
    $dbname = "form";
    $con=mysqli_connect($servername,$username,$password, $dbname);
      if(!$con){
          die('Could not Connect MySql Server:' .mysql_error());
        }
?>