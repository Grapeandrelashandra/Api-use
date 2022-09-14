<?php
    session_start();
    if(isset($_SESSION['UserID'])){ 
        if($_SESSION['UserType'] == 1){ 
    // Connect to database
    require_once('assets/php/config.php');

    $conn =  new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE)
            or die("<p style=\"color: red;\">Could not connect to database!</p>");
  
    // Get all the categories from category table
    $userTypeQuery = "SELECT * FROM userTypes";
    $UserTypes = mysqli_query($conn,$userTypeQuery);

    $employeeRoleQuery = "SELECT * FROM employeeRoles;";
    $employeeRole = mysqli_query($conn,$employeeRoleQuery) 
                        or die("couldn't find Roles");

    $managersQuery = "SELECT employeeID, concat(firstName, ' ', lastName) as name FROM employees;";
    $managers = mysqli_query($conn,$managersQuery)
                    or die("Couldn't find manager names");
    

    // The following code checks if the submit button is clicked
    // and inserts the data in the database accordingly
    if(isset($_POST['submit']))
    {
        // Store variables
        $id = $_SESSION['UserID'];
        $fname = $_REQUEST['EMPNAME'];
        $lname = $_REQUEST['EMPSURNAME'];
        $dob = $_REQUEST['DOB'];
        $phone = $_REQUEST['phone'];
        $salary = $_REQUEST['EmployeeSalary'];
        $pos = $_REQUEST['position'];
        $manager = $_REQUEST['manager'];
        $userTyper = $_REQUEST['userType'];
        $email = $_REQUEST['email'];
        $password = password_hash($_REQUEST['password'],PASSWORD_DEFAULT);

        
        $userQ = "INSERT INTO `users` (`email`, `password`, `userType`, `firstTimeLogin`, `activeInd`, `createdBy`, `createdDate`, `modifiedBy`, `modifiedDate`, `deletedBy`, `deletedDate`) 
        VALUES ('$email', '$password', '1', b'1', b'1', '$id', current_timestamp(), NULL, NULL, NULL, NULL)";

        $addedUser = mysqli_query($conn, $userQ) 
                    or die("<h2>add user failed</h2>");

        $getID ="SELECT userID from users WHERE email = '$email';";

        $Uid = (mysqli_fetch_array(mysqli_query($conn, $getID)))['userID'];

        // Creating an insert query using SQL syntax and
        // storing it in a variable.
        $sql_insert_employee = "INSERT INTO `employees` (`userID`, `firstName`, `lastName`, `dob`, `contactNumber`, `salary`, `employeeRole`, `manager`, `activeInd`, `createdBy`) 
        VALUES ('$Uid', '$fname', '$lname', '$dob', '$phone', '$salary', '$pos', '$manager', b'1', '$id');";
          
          // The following code attempts to execute the SQL query
          // if the query executes with no errors
          // a javascript alert message is displayed
          // which says the data is inserted successfully
          if(mysqli_query($con,$sql_insert_employee))
        {
            echo '<script>alert("Empoyee added successfully")</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>STANLEY - Free Bootstrap Theme </title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="assets/css/main.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="assets/js/hover.zoom.js"></script>
    <script src="assets/js/hover.zoom.conf.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <!-- Static navbar -->
    <div class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
                <a class="navbar-brand" href="index.html">Epi Use</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="contact.html">Admin</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>


    <!-- +++++ Contact Section +++++ -->

    <div class="container pt">
        <div class="row mt">
            <div class="col-lg-6 col-lg-offset-3 centered">
                <h3>Manage name details</h3>
                <hr>

            </div>
        </div>
        <div class="row mt">
            <div class="col-lg-8 col-lg-offset-2">
                <form role="form">
                    <div class="form-group">
                        <label for="email">Employee First Name </label>
                        <input type="name" class="form-control" id="EMPNAME" placeholder="E.g. Sandra" required>
                        <br>
                    </div>
                    <div class="form-group">
                        <label for="email">Employee Surname</label>
                        <input type="name" class="form-control" id="EMPSURNAME" placeholder="E.g. Boston" required>
                        <br>
                    </div>
                    <div class="form-group">
                        <label for="DOB">Date of Birth</label>
                        <input type="date" class="form-control" id="DOB" placeholder="Employee Date Of Birth" required>
                        <br>
                    </div>
                    <div class="form-group">
                        <label for="email">Cell Phone Number</label>
                        <input type="tel" class="form-control" id="phone" placeholder="0630462549" pattern="[0]+[0-9]{9}" required>
                        <br>
                    </div>
                    <div class=" form-group ">
                        <label for="Salary">Salary(R)</label>
                        <input type="number " class="form-control " id="EmployeeSalary" placeholder="40 000" required>
                        <br>
                    </div>
                    <div class="form-group ">
                        <label for="position ">Employee Position</label><br>
                        <select name="position" id="position">
                            <?php
                                // use a while loop to fetch data
                                // from the $all_categories variable
                                // and individually display as an option
                                while ($position = mysqli_fetch_array(
                                        $employeeRole,MYSQLI_ASSOC)):;
                            ?>
                                <option value="<?php echo $position['employeeRoleID'];
                                    // The value we usually set is the primary key
                                ?>">
                                    <?php echo $position["employeeRole"];
                                        // To show the category name to the user
                                    ?>
                                </option>
                            <?php
                                endwhile;
                                // While loop must be terminated
                            ?>
                        </select>
                        <br>
                    </div>
                    <div class="form-group ">
                    <label for="manager ">Manager</label><br>
                    <select name="manager">
                        <?php
                            // use a while loop to fetch data
                            // from the $all_categories variable
                            // and individually display as an option
                            while ($manage = mysqli_fetch_array(
                                    $managers,MYSQLI_ASSOC)):;
                        ?>
                            <option value="<?php echo $manage["employeeID"];
                                // The value we usually set is the primary key
                            ?>">
                                <?php echo $manage["name"];
                                    // To show the category name to the user
                                ?>
                            </option>
                        <?php
                            endwhile;
                            // While loop must be terminated
                        ?>
                    </select>
                    <br>
                    </div>
                    <div class="form-group ">
                        <label for="email ">Email Addresss</label> <input type="email " class="form-control " id="NameInputEmail1 " placeholder="James203@epiuse.co.za " required>
                        <br>
                    </div>
                    <div class="form-group ">
                        <label for="password ">Default Password</label> <input type="password" class="form-control " id="Inputpassword " placeholder="" required>
                        <br>
                    </div>
                    <button type="submit" name = "submit" id= "submit" class="btn btn-success ">SUBMIT</button>
                </form>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/bootstrap.min.js "></script>
</body>
<?php
        }else{
            header("location: index.php");
        }}else{
            header("location: signin.php");
        }
?>

</html>