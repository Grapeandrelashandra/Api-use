<?php
    #Aquiring required information
    include_once("config.php");

    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    #establishing a connection

    
    $conn =  mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
                    or die("<p style=\"color: red;\">Could not connect to database!</p>");

    // issue query instructions
    $query = "SELECT * from employees";
    
    $result = mysqli_query($conn, $query)
            or die("<p style=\"color: red;\">Could not execute query!</p>");


?>