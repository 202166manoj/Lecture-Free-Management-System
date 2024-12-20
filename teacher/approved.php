
<?php
    session_start();
    error_reporting(0);
    include('../includes/dbconn.php');
    $error='';
    $msg='';
    if(strlen($_SESSION['tealogin'])==0){   
        header('location:../teacher-login.php');
    } else {

 ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Teacher Panel - Approved History</title>
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
                        $page='approved';
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
                            <h4 class="page-title pull-left">Approved History</h4>
                        </div>
                    </div> 

                    <div class="col-sm-6 clearfix">
                         <?php include 'teacher-profile-section.php'; ?>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
                
                <!-- row area start -->
                <div class="row">
                    
                    <!-- trading history area start -->
                    
                                
                                <div class="col-12 mt-5">
                                    <div class="card">
                                        <div class="card-body">
                                        <h4 class="header-title">Approved Forms</h4>
                                        <?php if($error){?><div class="alert alert-danger alert-dismissible fade show"><strong>Info: </strong><?php echo htmlentities($error); ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        
                                        </div><?php } 
                                            else if($msg){?><div class="alert alert-success alert-dismissible fade show"><strong>Info: </strong><?php echo htmlentities($msg); ?> 
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div><?php }?>

                                            <div class="data-tables datatable-dark">
                                                <table id="dataTable3" class="table table-hover table-striped text-center">
                                                     <thead class="text-capitalize">

                                                <tr> 
                                                        <td>#</td>
                                                        <td>Student ID</td>
                                                        <td>Subject</td>
                                                        <td>Sport</td>
                                                        <td>Date</td>
                                                        <td>Lecturer Approval</td>
                                                        <td>Instructor Approval</td>
                                                        <td></td>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                <?php 
                                                    $status=1;
                                                    $sql = "SELECT forms.id as lid, students.StuId, forms.Subject, forms.Sport, forms.Date, forms.PostingDate, forms.TeacherStatus,forms.AdminStatus
                                                            FROM forms
                                                            JOIN students ON forms.stuid = students.id
                                                            JOIN teachers ON forms.Teacher = teachers.FullName
                                                            WHERE teachers.EmailId = :email
                                                            AND forms.TeacherStatus=:status
                                                            ORDER BY lid DESC";

                                                    $query = $dbh->prepare($sql);
                                                    $query->bindParam(':email', $_SESSION['tealogin'], PDO::PARAM_STR);
                                                    $query->bindParam(':status',$status,PDO::PARAM_STR);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                                    $cnt=1;
                                                    if($query->rowCount() > 0){
                                                    foreach($results as $result)
                                                    {         
                                                ?>  

                                        <tr>
                                            <td> <b><?php echo htmlentities($cnt);?></b></td>
                                            <td><?php echo htmlentities($result->StuId);?></td>
                                            <td><?php echo htmlentities($result->Subject);?></td>
                                            <td><?php echo htmlentities($result->Sport);?></td>
                                            <td><?php echo htmlentities($result->Date);?></td>
                                            
                                            <td><?php $stats=$result->TeacherStatus;

                                                if($stats==1){
                                                ?>
                                                    <span style="color: green">Approved <i class="fa fa-check-square-o"></i></span>
                                                    <?php } if($stats==2)  { ?>
                                                    <span style="color: red">Declined <i class="fa fa-times"></i></span>
                                                    <?php } if($stats==0)  { ?>
                                                <span style="color: blue">Pending <i class="fa fa-spinner"></i></span>
                                                <?php } ?>
                                            </td>

                                            <td><?php $stats=$result->AdminStatus;

                                                if($stats==1){
                                                ?>
                                                    <span style="color: green">Approved <i class="fa fa-check-square-o"></i></span>
                                                    <?php } if($stats==2)  { ?>
                                                    <span style="color: red">Declined <i class="fa fa-times"></i></span>
                                                    <?php } if($stats==0)  { ?>
                                                <span style="color: blue">Pending <i class="fa fa-spinner"></i></span>
                                                <?php } ?>
                                            </td>
                                        
                                            <td><a href="view-details.php?formid=<?php echo htmlentities($result->lid);?>" class="btn btn-primary btn-sm">View Details</a></td>
                                            </tr>
                                                <?php $cnt++;} }?>
                                            </tbody>
                                                </table>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                          
                    <!-- trading history area end -->
                    
                </div>
                <!-- row area end -->
                
                </div>
                
                <!-- row area start-->
            </div>
            <?php include '../includes/footer.php' ?>
        <!-- footer area end-->
        </div>
        <!-- main content area end -->

        
        

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