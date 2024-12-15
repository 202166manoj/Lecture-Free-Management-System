<?php
    session_start();
    error_reporting(0);
    include('../includes/dbconn.php');
    $error='';
    $msg='';
    if(strlen($_SESSION['stulogin'])==0){   
        header('location:../student-login.php');
    } else {

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Lecture-free Request Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/metisMenu.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <!-- others css -->
    <link rel="stylesheet" href="../assets/css/typography.css">
    <link rel="stylesheet" href="../assets/css/default-css.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="dashboard.php"><img src="../assets/images/logo.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <?php
                        $page='history';
                        include '../includes/student-sidebar.php';
                    ?>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            
            <div class="main-content-inner">
                <!-- page title area start -->
                <div class="page-title-area">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="breadcrumbs-area clearfix">
                                <div class="nav-btn pull-left">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <h4 class="page-title pull-left">Pending Forms</h4>
                                <ul class="breadcrumbs pull-left">
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-6 clearfix">
                            <?php include 'student-profile-section.php'; ?>
                        </div> 
                    </div>
                </div>
                <!-- page title area end -->
                <div class="row">
                    <!-- data table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Pending Forms</h4>
                                <?php if($error){?>
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <strong>Info: </strong><?php echo htmlentities($error); ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php } else if($msg){ ?>
                                    <div class="alert alert-success alert-dismissible fade show">
                                        <strong>Info: </strong><?php echo htmlentities($msg); ?> 
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php }?>

                                <div class="data-tables datatable-dark">
                                    <table id="dataTable3" class="table table-hover table-striped text-center">
                                        <thead class="text-capitalize">
                                            <tr>
                                                <th>#</th>
                                                <th>Subject</th>
                                                <th>Sport</th>
                                                <th>Date</th>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Instructor Approval</th>
                                                <th>Lecturer Approval</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $eid=$_SESSION['eid'];
                                        // Select forms approved by either instructor or lecturer
                                        $sql = "SELECT Subject, Sport, Date, FromTime, ToTime, AdminStatus, TeacherStatus FROM forms WHERE stuid=:eid AND (AdminStatus=0 OR TeacherStatus=0)";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if($query->rowCount() > 0){
                                            foreach($results as $result){  
                                        ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($result->Subject); ?></td>
                                                <td><?php echo htmlentities($result->Sport); ?></td>
                                                <td><?php echo htmlentities($result->Date); ?></td>
                                                <td><?php echo htmlentities($result->FromTime); ?></td>
                                                <td><?php echo htmlentities($result->ToTime); ?></td>
                                                <td>
                                                    <?php if($result->AdminStatus == 1){ ?>
                                                        <span style="color: green">Approved</span>
                                                    <?php } else { ?>
                                                        <span style="color: red">Not Approved</span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if($result->TeacherStatus == 1){ ?>
                                                        <span style="color: green">Approved</span>
                                                    <?php } else { ?>
                                                        <span style="color: red">Not Approved</span>
                                                    <?php } ?>
                                                </td>
                                                <td><a href="view-details.php?formid=<?php echo htmlentities($result->lid); ?>" class="btn">View Details</a></td>
                                            </tr>
                                        <?php $cnt++; } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- data table end -->
                </div>
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <?php include '../includes/footer.php'; ?>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->
    <div class="offset-area">
        <div class="offset-close"><i class="ti-close"></i></div>
    </div>
    <!-- offset area end -->
    <!-- jquery latest version -->
    <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/metisMenu.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/jquery.slicknav.min.js"></script>

    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

    <!-- others plugins -->
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>

</html>

<?php } ?>