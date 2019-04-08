<?php
include 'config.php';
/*
Defines functions to connect to the Database, retrieve the result and 
return them. You need several functions for different questions
*/

function getDB()
{
	$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    return $connection;
}

function runQuery($db, $query) {

	// takes a reference to the DB and a query and returns the results of running the query on the database
    
    $result = mysqli_query($db, $query);  
    
    if (!$result) {
        print "Error - the query could not be executed";
        //$error = mysqli_error();
        //print "<p>" . $error . "</p>";
        exit;
}
    return $result;
    
}
function sessionSet(){
    
    if (!isset($_SESSION)){
        session_start();
    }
}


?>
