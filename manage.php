<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://kit.fontawesome.com/15f4b1a016.js" crossorigin="anonymous"></script>
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
<style>
table.dataTable thead .sorting:after,
table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_desc_disabled:after,
table.dataTable thead .sorting_desc_disabled:before {
    bottom: .5em;
}
</style>

<?php
        session_start();
        if (isset($_SESSION['UserID'])) {
?>
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
                <a class="navbar-brand" href="index.php">EPI USE</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">

                    <li><a href="profile.html">View profile</a></li>
                    <li>
                        <a href="manage.php">Manage Employees</a>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>

    <!-- +++++ Welcome Section +++++ -->
    <div id="ww">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 centered">
                    <h3>Our Team</h3>
                    <span id="search" style=" display: flex;">
                        <input type="text" class="form-control border-light" id="myInput"
                            style="padding:10px 10px; border-radius: 2px;" width="10px"
                            placeholder="Search for Employee">
                        <button onclick="myFunction()">Search</button>
                    </span>
                </div>
            </div>
            <br>



            <!-- +++++ Projects Section +++++ -->
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <table id="myTable" class="table table-striped table-bordered table-sm" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th class="th-sm">EmployeeID
                                    </th>
                                    <th class="th-sm">Employees Names
                                    </th>
                                    <th class="th-sm">Manager
                                    </th>
                                    <th class="th-sm">Position
                                    </th>
                                    <th class="th-sm">Manage detail
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                require_once('assets/php/config.php');

                                $conn =  new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE)
                                        or die("<p style=\"color: red;\">Could not connect to database!</p>");

                                // issue query instructions
                                $query = "SELECT concat(t1.firstName , \" \",  t1.lastName) as employee , concat( t3.firstName , \" \", t3.lastName) as manager , t2.employeeRole, t1.employeeID from employees as t1
                                            INNER JOIN employeeroles as t2  ON t1.employeeRole = t2.employeeRoleID
                                            INNER JOIN employees as t3 ON t1.manager = t3.employeeID or t1.manager = 0;";
                                
                                $result = mysqli_query($conn, $query)
                                        or die("<p style=\"color: red;\">Could not find employees</p>");
                                while($row = mysqli_fetch_array($result)){
                            ?>
                                <tr>
                                    <td><?php echo $row['employeeID'] ?></td>
                                    <td><?php echo $row['employee'] ?></td>
                                    <td><?php if($row['manager'] != $row['employee'] ){echo $row['manager'];} ?></td>
                                    <td><?php echo $row['employeeRole'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="tooltip"
                                            data-placement="top" title="View employee profile"><i class="fa-solid fa-eye"></i></button>
                                        <button type="button" class="btn btn-success" data-toggle="tooltip"
                                            data-placement="top" title="Edit employee profile"><i class="fa-light fa-pen-to-square"></i></button>
                                        <button type="button" class="btn btn-danger" data-toggle="tooltip"
                                            data-placement="top" title="Delete employee profile"><i class="fa-regular fa-trash"></i></button>
                                    </td>
                                </tr>
                                <?php }?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>EmployeeID
                                    </th>
                                    <th>Employees Names
                                    </th>
                                    <th>Manager
                                    </th>
                                    <th>Position
                                    </th>
                                    <th>Manage detail
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>



            <!-- +++++ Footer Section +++++ -->

            
            <!-- Bootstrap core JavaScript
    ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="assets/js/bootstrap.min.js"></script>
</body>
<?php
        mysqli_close($conn);
    } else {
        header('Location: signin.html');
    }   
?>

<script>
function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
</script>

</html>