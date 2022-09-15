<?php
    session_start();
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

    <title>Hierachy</title>

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
                <a class="navbar-brand" href="index.php">Epi Use</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="profile.php?id=<?php echo $_SESSION['UserID']; ?>">View profile</a></li>
                    <?php if($_SESSION['UserType'] == 1){ ?>
                    <li><a href="adddetails.php">New Profile</a></li>
                    <li><a href="manage.php">Manage Employees</a></li>
                    <?php } ?>
                    <li><a href="assets/php/SessionEnd.php">log out</a></li>
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
                <form action="assets/php/add.php" method="post">
                    <div class="form-group">
                        <label for="email">Employee First Name </label>
                        <input type="name" class="form-control" name="EMPNAME" placeholder="E.g. Sandra" required>
                        <br>
                    </div>
                    <div class="form-group">
                        <label for="email">Employee Surname</label>
                        <input type="name" class="form-control" name="EMPSURNAME" placeholder="E.g. Boston" required>
                        <br>
                    </div>
                    <div class="form-group">
                        <label for="DOB">Date of Birth</label>
                        <input type="date" class="form-control" name="DOB" placeholder="Employee Date Of Birth"
                            required>
                        <br>
                    </div>
                    <div class="form-group">
                        <label for="email">Cell Phone Number</label>
                        <input type="tel" class="form-control" name="phone" placeholder="0630462549"
                            pattern="[0]+[0-9]{9}" required>
                        <br>
                    </div>
                    <div class=" form-group ">
                        <label for="Salary">Salary(R)</label>
                        <input type="number " class="form-control " name="EmployeeSalary" placeholder="40 000" required>
                        <br>
                    </div>
                    <div class="form-group ">
                        <label for="email ">Email Addresss</label> <input type="email " class="form-control "
                            name="email" id="NameInputEmail1 " placeholder="James203@epiuse.co.za " required>
                        <br>
                    </div>
                    <div class="form-group ">
                        <label for="password ">Default Password</label> <input type="password" class="form-control "
                            name="password" id="Inputpassword " placeholder="" required>
                        <br>
                    </div>
                    <button type="submit" name="submit" id="submit" class="btn btn-success ">SUBMIT</button>
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
        // }else{
        //     header("location: index.php");
        // }}else{
        //     header("location: signin.php");
        // }
?>

</html>