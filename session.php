<?php
   session_start();
    include 'functions.php';
    $con = getDB();

   
   $user_check = $_SESSION['login_user'];
   
   $sql = $con->prepare("SELECT id, name, email, password FROM clientList WHERE name = ?");

    $sql->bind_param("s",$user_check);

    $sql->execute();

    $sql->bind_result($user_id,$user_name,$user_email,$hashed_password);

    $sql->fetch();
   
   $login_session = $user_name;
   
   if(!isset($_SESSION['login_user'])){
      header("location:index2.php");
      die();
   }
?>
