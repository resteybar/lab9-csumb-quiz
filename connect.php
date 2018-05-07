<?php

function getDBConnection() {
    
    //C9 db info
    //  mysql://bee7d16b7ed3b1:e5a73cbf@us-cdbr-iron-east-04.cleardb.net/heroku_a34c6cafde8b0d2?reconnect=true
    // $host = "localhost";
    // $dbName = "csumb_quiz";
    // $username =  "root";
    // $password = "";
    
    $host = "us-cdbr-iron-east-04.cleardb.net";
    $dbName = "heroku_a34c6cafde8b0d2";
    $username =  "bee7d16b7ed3b1";
    $password = "e5a73cbf";
    
    //when connecting from Heroku
    if  (strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $host = $url["host"];
        $dbName = substr($url["path"], 1);
        $username = $url["user"];
        $password = $url["pass"];
    } 
    
    try {
        //Creates a database connection
        $dbConn = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    
        // Setting Errorhandling to Exception
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }
    catch (PDOException $e) {
       echo "Problems connecting to database!";
       exit();
    }
    
    
    return $dbConn;
}

?>