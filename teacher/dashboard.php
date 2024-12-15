
<?php
    session_start();
    error_reporting(0);
    include('../includes/dbconn.php');
    if(strlen($_SESSION['tealogin'])==0){   
        header('location:../teacher-login.php');
    } else {
        // Fetch teacher details
        $email = $_SESSION['tealogin'];
        $sql = "SELECT FullName FROM teachers WHERE EmailId = :email";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        $teacherName = $result->FullName;
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Teacher Panel - Dashboard</title>
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
                        $page='dashboard';
                        include '../includes/teacher-sidebar.php';
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
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                            </ul>
                        </div>
                    </div> 

                    <div class="col-sm-6 clearfix">
                    <ul class="notification-area pull-right">
                        <?php include 'teacher-notification.php'?>
                    </ul>
                         <?php include 'teacher-profile-section.php'; ?>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
                <!-- sales report area start -->
                <div class="sales-report-area mt-5 mb-5">
                    <div class="row">
                        <div class="cong-box">
                            <div class="content">
                                <p class="head">Welcome <?php echo htmlspecialchars($teacherName); ?></p><br>
                                <p>Students have submitted their requests for lecture-free time slots<br>Please take a moment to review and approve or respond to these requests</p>
                                <a href="pending.php"><button class="btn">Try it Now</button></a>
                            </div>
                                <img src="../assets/images/cong.png" >
                        </div>   
                    </div>

                        <br>

                    <div class="row">
                        <div class="grammer-course d-grid ">
                            <!-- Pending Card -->
                        <div class="course card-1 d-flex" onclick="window.location.href='pending.php'">
                            <div class="grammer d-flex">
                                <i class="fa-solid fa-spinner grammer-icon"></i>
                                <div>
                                    <h3>Pending</h3>
                                    <p>See all your pending forms</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>

                        <!-- Approved Card -->
                        <div class="course card-1 d-flex" onclick="window.location.href='approved.php'">
                            <div class="dictionary d-flex">
                                <i class="fa-solid fa-circle-check dictionary-icon"></i>
                                <div>
                                    <h3>Approved</h3>
                                    <p>See all your approved forms</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>

                        <!-- Declined Card -->
                        <div class="course card-1 d-flex" onclick="window.location.href='declined.php'">
                            <div class="speech d-flex">
                                <i class="fa-solid fa-circle-xmark speech-icon"></i>
                                <div>
                                    <h3>Declined</h3>
                                    <p>See all your declined forms</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>

                            
                            
                        </div>
                    </div>
                        
                        
                    </div>
                </div>
                <!-- sales report area end -->
                
                
                
                </div>
                <!-- row area start-->
                <?php include '../includes/footer.php' ?>
            </div>
            
        <!-- footer area end-->
        </div>
        <!-- main content area end -->

        

    </div>
    <div class="offset-area">
        <div class="offset-close"><i class="ti-close"></i></div>
        
    </div>
    <!-- jquery latest version -->
    <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/metisMenu.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    
    <!-- others plugins -->
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>

</html>

<?php } ?>