<?php

include 'functions.php';

$con = getDB();



$name = $_POST['name'];
$pass = $_POST['pass'];

//$passwordHashed = password_hash($pass, PASSWORD_BCRYPT);


$sql = $con->prepare("SELECT id, name, email FROM clientList WHERE name = ? AND password = ?");

$sql->bind_param("ss",$name,$pass);

$sql->execute();

$sql->bind_result($user_id,$user_name,$user_email);

$sql->fetch();

echo $user_name;




    



//                                
                                


   


?>