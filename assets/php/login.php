<?php
    #Aquiring required information
    include_once("config.php");

    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    #establishing a connection

    
    $conn = sqlsrv_connect($serverName, $connectionOptions) 
                die("Connection failed: " . $conn->connect_error);

    $query = "";

    $getResults= sqlsrv_query($conn, $query);


?>