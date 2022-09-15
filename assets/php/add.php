<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    session_start();
    // The following code checks if the submit button is clicked
    // and inserts the data in the database accordingly
    if (isset($_POST['submit'])) {
        require_once('config.php');

        $conn =  new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE)
            or die("<p style=\"color: red;\">Could not connect to database!</p>");
        // Store variables
        $id = $_SESSION['UserID'];
        $fname = $_REQUEST['EMPNAME'];
        $lname = $_REQUEST['EMPSURNAME'];
        $dob = $_REQUEST['DOB'];
        $phone = $_REQUEST['phone'];
        $salary = $_REQUEST['EmployeeSalary'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];


        $userQ = "INSERT INTO `users` (`email`, `password`, `userType`, `firstTimeLogin`, `activeInd`, `createdBy`, `createdDate`, `modifiedBy`, `modifiedDate`, `deletedBy`, `deletedDate`) 
        VALUES ('$email', '$password', '1', b'1', b'1', '$id', current_timestamp(), NULL, NULL, NULL, NULL)";

        $addedUser = mysqli_query($conn, $userQ)
            or die("<h2>add user failed</h2>");

        $getID = "SELECT userID from users WHERE email = '$email';";

        $Uid = (mysqli_fetch_array(mysqli_query($conn, $getID)))['userID'];

        // Creating an insert query using SQL syntax and
        // storing it in a variable.
        $sql_insert_employee = "INSERT INTO `employees` (`userID`, `firstName`, `lastName`, `dob`, `contactNumber`, `salary`, `employeeRole`, `manager`, `activeInd`, `createdBy`) 
        VALUES ('$Uid', '$fname', '$lname', '$dob', '$phone', '$salary', '2', '1', b'1', '$id');";

        // The following code attempts to execute the SQL query
        // if the query executes with no errors
        // a javascript alert message is displayed
        // which says the data is inserted successfully
        if (mysqli_query($conn, $sql_insert_employee)) {
            echo '<script>alert("Empoyee added successfully")</script>';
            header("location: ../../manage.php");
        }
    }
    ?>


</body>

</html>