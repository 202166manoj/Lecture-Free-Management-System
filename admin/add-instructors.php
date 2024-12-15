<?php
    session_start();
    error_reporting(0);
    include('../includes/dbconn.php');
    if(strlen($_SESSION['alogin'])==0){   
    header('location:index.php');
    } else {
    if(isset($_POST['add'])){
    $fname=$_POST['fullname'];  
    $email=$_POST['email']; 
    $sport=$_POST['sport']; 
    $password=md5($_POST['password']);  
    $mobileno=$_POST['mobileno']; 
    $status=1;

    $sql="INSERT INTO instructors(FullName,EmailId,Sport,Password,Phonenumber,Status) VALUES(:fname,:email,:sport,:password,:mobileno,:status)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':fname',$fname,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':sport',$sport,PDO::PARAM_STR);
    $query->bindParam(':password',$password,PDO::PARAM_STR);
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
    <title>Admin Panel - Instructor Section</title>
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

    <!-- Custom form script -->
    <script type="text/javascript">
        function valid(){
            if(document.addins.password.value!= document.addins.confirmpassword.value) {
            alert("New Password and Confirm Password Field do not match  !!");
            document.addins.confirmpassword.focus();
            return false;
                } return true;
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
                        $page='instructor';
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
                            <h4 class="page-title pull-left">Sport Instructors</h4>
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
                <div class="col-lg-6 col-ml-12">
                        <div class="row">
                            <!-- Input form start -->
                            <div class="col-12 mt-5">
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
                                <div class="card">
                                <form name="addins" method="POST">

                                    <div class="card-body">
                                        <p class="text-muted font-14 mb-4">Please fill up the form in order to add instructor records</p>
                                        <center><a href="upload-instructors.php" class="btn btn-sm btn-info">Add Multiple Instructors</a></center>

                                        <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Full Name</label>
                                            <input class="form-control" name="fullname"  type="text" required id="example-text-input">
                                        </div>


                                        <div class="form-group">
                                            <label for="example-email-input" class="col-form-label">Email</label>
                                            <input class="form-control" name="email" type="email"  autocomplete="off" required id="example-email-input">
                                        </div>

                                        <div class="form-group">
                                            <label class="col-form-label">Name of the Sport</label>
                                            <select class="custom-select" name="sport" autocomplete="off">
                                                <option value="">Click here to select any ...</option>

                                                <?php $sql = "SELECT SportName from sports";
                                                    $query = $dbh -> prepare($sql);
                                                    $query->execute();
                                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                    $cnt=1;
                                                    if($query->rowCount() > 0) {
                                                        foreach($results as $result)
                                                {   ?> 
                                                <option value="<?php echo htmlentities($result->SportName);?>"><?php echo htmlentities($result->SportName);?></option>
                                                <?php }
                                            } ?>
                                            </select>
                                        </div>

                                        

                                        <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Contact Number</label>
                                            <input class="form-control" name="mobileno" type="tel"  maxlength="10" autocomplete="off" required>
                                        </div>

                                        <h4>Set Password for Instructor Login</h4>

                                        <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Password</label>
                                            <input class="form-control" name="password" type="password" autocomplete="off" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Confirmation Password</label>
                                            <input class="form-control" name="confirmpassword" type="password" autocomplete="off" required>
                                        </div>

                        

                                        <button class="btn btn-primary" name="add" id="update" type="submit" onclick="return valid();">PROCEED</button>
                                        
                                    </div>
                                </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- Input Form Ending point -->
                    
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
    
    <!-- others plugins -->
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>

</html>

<?php } ?>