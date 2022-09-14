<!DOCTYPE html>
<html lang="en">

<head>
<?php
    session_start();
    if (isset($_SESSION['UserID'])) {
    ?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js">
    </script>
    <script type="text/javascript">
    google.charts.load('current', {
        packages: ["orgchart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');

        // For each orgchart box, provide the name, manager, and tooltip to show.
        data.addRows([
            <?php
                require_once('assets/php/config.php');

                $conn =  new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE)
                        or die("<p style=\"color: red;\">Could not connect to database!</p>");

                // issue query instructions
                $query = "SELECT concat(t1.firstName , \" \",  t1.lastName) as employee , concat( t3.firstName , \" \", t3.lastName) as manager , t2.employeeRole from employees as t1
                            INNER JOIN employeeroles as t2  ON t1.employeeRole = t2.employeeRoleID
                            INNER JOIN employees as t3 ON t1.manager = t3.employeeID or t1.manager = 0;";
                
                $result = mysqli_query($conn, $query)
                        or die("<p style=\"color: red;\">Could not find employees</p>");

                $row = mysqli_fetch_array($result);
                echo '[{\'v\':\''.$row['employee'].'\', \'f\':\''.$row['employee'].'<div style="color:red; font-style:italic">'.$row['employeeRole'].'</div>\'},
                \''.$row['manager'].'\', \''.$row['employeeRole'].'\']';     

                while($row = mysqli_fetch_array($result)){
                    echo ',[{\'v\':\''.$row['employee'].'\', \'f\':\''.$row['employee'].'<div style="color:red; font-style:italic">'.$row['employeeRole'].'</div>\'},
                    \''.$row['manager'].'\', \''.$row['employeeRole'].'\']';
                }
            ?>
        ]);

        // Create the chart.
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        // Draw the chart, setting the allowHtml option to true for the tooltips.
        chart.draw(data, {
            'allowHtml': true
        });
    }
    </script>
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
    <style>
    .dropbtn {
        background-color: #1bc19c;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
        position: right;
    }

    .dropdown {
        position: right;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: right;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown:hover .dropbtn {
        background-color: #3e8e41;
    }
    </style>

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
    </div>
    </div>
    <!--/.nav-collapse -->
    </div>
    </div>


    <!-- +++++ Projects Section +++++ -->

    <div class="container pt ">
        <div class="row mt ">
            <div class="col-lg-6 col-lg-offset-3 centered ">
                <h3>Our Team</h3>
                <input type="text" class="form-control border-light" style="padding:10px 10px; border-radius: 2px;"
                    width="10px" placeholder="Search for Employee">
                <div class="input-group-append">
                    <button class=""
                        style="position:absolute; left:600px; bottom: 2px; height: 35px; width: fit-content;">Search</button>
                </div>
            </div>
        </div>
        <div class="row mt centered ">
            <php?>
                <div id="chart_div"></div>
                </php>
        </div>

        <!-- +++++ Footer Section +++++ -->
        <script src="assets/js/bootstrap.min.js "></script>

        <?php
    } else {
        header('Location: signin.html');
    }
        ?>
</body>

</html>