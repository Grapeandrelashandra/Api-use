<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging on...</title>
</head>

<body>
    <?php
        session_start();
        
        require_once("config.php");


        #define("DATABASE","epiz_32570844_XXX");
        $email = $_REQUEST['email'];
        $password = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);

        #establishing a connection
        $conn =  new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE)
                        or die("<p style=\"color: red;\">Could not connect to database!</p>");

        // issue query instructions
        $query = "SELECT * from users WHERE email = '$email' AND password = '$password';";
        
        $result = mysqli_query($conn, $query)
                or die("<p style=\"color: red;\">Could not execute query!</p>");
        
        
        $row = mysqli_fetch_array($result);

        $_SESSION["UserID"] = $row['userID'];
        $_SESSION["UserType"] = $row['userType'];
        
        if(isset($_SESSION["UserID"])){
            header('Location: ../../index.php');
        }else {
            echo "<script> alert('sign in failied');</script>";
        }
?>

</body>

</html>