<?php
    session_start();
    error_reporting(0);
    include('../includes/dbconn.php');
    if(strlen($_SESSION['alogin'])==0){   
    header('location:index.php');
    } else {
    if(isset($_POST['add'])){

        $stuid=$_POST['stucode'];
        $fname=$_POST['fullname'];  
        $email=$_POST['email']; 
        $password=md5($_POST['password']);  
        $dob=$_POST['dob']; 
        $level=$_POST['level']; 
        $mobileno=$_POST['mobileno']; 
        $status=1; 


        $sql="INSERT INTO students(StuId,FullName,EmailId,Password,Dob,level,Phonenumber,Status) VALUES(:stuid,:fname,:email,:password,:dob,:level,:mobileno,:status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':stuid',$stuid,PDO::PARAM_STR);
        $query->bindParam(':fname',$fname,PDO::PARAM_STR);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        $query->bindParam(':password',$password,PDO::PARAM_STR);
        $query->bindParam(':dob',$dob,PDO::PARAM_STR);
        $query->bindParam(':level',$level,PDO::PARAM_STR);
        $query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
        $query->bindParam(':status',$status,PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if($lastInsertId){
        $msg="Record has been added Successfully";
        } else {
        $error="ERROR";
        }

}

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin Panel - Manage Students</title>
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

    <!-- Custom form script -->
    <script type="text/javascript">
        function valid(){
            if(document.addstu.password.value!= document.addstu.confirmpassword.value) {
            alert("New Password and Confirm Password Field do not match  !!");
            document.addstu.confirmpassword.focus();
            return false;
                } return true;
        }
    </script>

    <script>
            function checkAvailabilityStuid() {
                $("#loaderIcon").show();
                jQuery.ajax({
                url: "check_availability.php",
                data:'stucode='+$("#stucode").val(),
                type: "POST",
                success:function(data){
                $("#stuid-availability").html(data);
                $("#loaderIcon").hide();
                },
                error:function (){}
                });
            }
    </script>

    <script>
            function checkAvailabilityEmailid() {
                $("#loaderIcon").show();
                jQuery.ajax({
                url: "check_availability.php",
                data:'emailid='+$("#email").val(),
                type: "POST",
                success:function(data){
                $("#emailid-availability").html(data);
                $("#loaderIcon").hide();
                },
                error:function (){}
                });
            }
    </script>

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
                        $page='subject';
                        include '../includes/admin-sidebar.php';
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
                            <h4 class="page-title pull-left">Students</h4>
                        </div>
                    </div>

                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="../assets/images/admin.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">ADMIN <i class="fa fa-angle-down"></i></h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
                
                <!-- row area start -->
                <div class="row">
                    <!-- Dark table start -->
                    <div class="col-12 mt-5">
                    
                        <div class="card">
                        

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
                                
                                <form method="POST">
                                 <div class="card-body">
                                        
                                 <p class="text-muted font-14 mb-4">Please fill up the form in order to add student records</p>
                                        <center><a href="upload-students.php" class="btn btn-sm btn-info">Add Multiple Students</a></center>

                                        <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Student ID</label>
                                            <input class="form-control" name="stucode" type="text" autocomplete="off" required id="stucode" onBlur="checkAvailabilityStuid()">
                                        </div>
                                    

                                        <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Full Name</label>
                                            <input class="form-control" name="fullname"  type="text" required id="example-text-input">
                                        </div>


                                        <div class="form-group">
                                            <label for="example-email-input" class="col-form-label">Email</label>
                                            <input class="form-control" name="email" type="email"  autocomplete="off" required id="example-email-input">
                                        </div>

                                        <div class="form-group">
                                            <label class="col-form-label">Level</label>
                                            <select class="custom-select" name="level" autocomplete="off">
                                                <option value="">Choose..</option>
                                                <option value="1 Year">1 Year</option>
                                                <option value="2 Year">2 Year</option>
                                                <option value="3 Year">3 Year</option>
                                                <option value="4 Year">4 Year</option>
                                            </select>
                                        </div>

                                        

                                        <div class="form-group">
                                            <label for="example-date-input" class="col-form-label">D.O.B</label>
                                            <input class="form-control" type="date" name="dob" id="birthdate" >
                                        </div>

                                        <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Contact Number</label>
                                            <input class="form-control" name="mobileno" type="tel"  maxlength="10" autocomplete="off" required>
                                        </div>

                                        <h4>Set Password for Student Login</h4>

                                        <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Password</label>
                                            <input class="form-control" name="password" type="password" autocomplete="off" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Confirmation Password</label>
                                            <input class="form-control" name="confirmpassword" type="password" autocomplete="off" required>
                                        </div>

                                        <button class="btn btn-primary" name="add" id="add" type="submit">ADD</button>
                                        
                                    </div>
                                    </form>
                        </div> 
                    </div>
                    <!-- Dark table end -->
                    
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