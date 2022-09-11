<?php
    #Aquiring required information
    include_once("config.php");

    #$email = $_REQUEST['email'];
    #$password = $_REQUEST['password'];

    #establishing a connection

    
    $conn =  mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
                    or die("<p style=\"color: red;\">Could not connect to database!</p>");

    // issue query instructions
    $query = "SELECT * from employees";
    
    $result = mysqli_query($conn, $query)
            or die("<p style=\"color: red;\">Could not execute query!</p>");
    
    session_start();
    while ($row = mysqli_fetch_array($result)) {
        $_SESSION["UserID"] = $row['userID'];
        $_SESSION["UserType"] = $row['userTypeID'];
    }
    mysqli_close($conn);
    header('Location: ../index.html');
            // display message to user
    echo "<p style=\"color: blue;\">the new product line was addded</p>";
?>