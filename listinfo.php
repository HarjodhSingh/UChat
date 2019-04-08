<?php error_reporting(E_ERROR|E_PARSE);
    header("Access-Control-Allow-Origin: *");
    include 'functions.php';
    $con = getDB();


    mysqli_set_charset($con, 'utf8');

    $sql = "SELECT id, name FROM clientlist";
    $result = runQuery($con, $sql);

    $users = array();

    while($user_row = mysqli_fetch_assoc($result)){
        $users[] = $user_row;
    }



    $total_array = array('users' => $users);

    echo json_encode($total_array);
?>