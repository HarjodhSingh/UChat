<?php

include 'functions.php';

$con = getDB();



$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$id = uniqid($name,true);

$passwordHashed = password_hash($pass, PASSWORD_BCRYPT);


$sql = $con->prepare("INSERT INTO clientList (id,name,password,email) VALUES (?, ?, ?, ?)");

$sql->bind_param("ssss",$id,$name,$passwordHashed,$email);

$sql->execute();


    
//$result = runQuery($con, $sql,$params);


//                                
                                

/*for ($x = 0; $x < mysqli_num_rows($result); $x++) {
    $rows = mysqli_fetch_array($result);
    echo $rows[1];
   
}*/


?>