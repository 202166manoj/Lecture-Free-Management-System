
<?php
    session_start();
    error_reporting(0);
    include('../includes/dbconn.php');
    $error='';
    $msg='';
    if(strlen($_SESSION['stulogin'])==0)
        {   
    header('location:../student-login.php');
    }   else    {
        if(isset($_POST['apply']))
        {

        $stuid=$_SESSION['eid'];
        $subject=$_POST['subject'];
        $teacher=$_POST['teacher'];
        $sport=$_POST['sport'];
        $reason=$_POST['reason'];  
        $date=$_POST['date'];
        $fromtime=$_POST['fromtime'];  
        $totime=$_POST['totime'];
        $adminstatus=0;
        $isreadbyadmin=0;
        $teacherstatus=0;
        $isreadbyteacher=0;

       

        $sql="INSERT INTO forms(Subject,Teacher,Sport,Reason,Date,FromTime,ToTime,AdminStatus,IsReadByAdmin,TeacherStatus,IsReadByTeacher, stuid) VALUES(:subject,:teacher,:sport,:reason,:date,:fromtime,:totime,:adminstatus,:isreadbyadmin,:teacherstatus,:isreadbyteacher,:stuid)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':subject',$subject,PDO::PARAM_STR);
        $query->bindParam(':teacher',$teacher,PDO::PARAM_STR);
        $query->bindParam(':sport',$sport,PDO::PARAM_STR);
        $query->bindParam(':reason',$reason,PDO::PARAM_STR);
        $query->bindParam(':date',$date,PDO::PARAM_STR);
        $query->bindParam(':fromtime',$fromtime,PDO::PARAM_STR);
        $query->bindParam(':totime',$totime,PDO::PARAM_STR);
        $query->bindParam(':adminstatus',$adminstatus,PDO::PARAM_STR);
        $query->bindParam(':isreadbyadmin',$isreadbyadmin,PDO::PARAM_STR);
        $query->bindParam(':teacherstatus',$teacherstatus,PDO::PARAM_STR);
        $query->bindParam(':isreadbyteacher',$isreadbyteacher,PDO::PARAM_STR);
        $query->bindParam(':stuid',$stuid,PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();

        if($lastInsertId)
        {
             $msg="Your Request has been applied, Thank You!";
        }   else    {
            $error="Sorry, couldn't process. Please try again later.";
        }
    }
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
                    <a href="forms.php"><img src="../assets/images/logo.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <?php
                        $page='form';
                        include '../includes/student-sidebar.php';
                    ?>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
           
            <div class="main-content-inner">
                <div class="page-title-area">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="breadcrumbs-area clearfix">
                                <div class="nav-btn pull-left">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <h4 class="page-title pull-left">Lecture Free Form</h4>
                                <ul class="breadcrumbs pull-left">
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-6 clearfix">
                            <?php include 'student-profile-section.php'; ?>
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-ml-12">
                        <div class="row">
                            <!-- Textual inputs start -->
                            <div class="col-12 mt-5">
                            <?php if ($error) { ?>
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <strong>Info: </strong><?php echo htmlentities($error); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } elseif ($msg) { ?>
                                <div class="alert alert-success alert-dismissible fade show">
                                    <strong>Info: </strong><?php echo htmlentities($msg); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>


                                <div class="card">
                                <form name="addstu" method="POST">

                                    <div class="card-body">
                                        <h4 class="header-title">Lecture-free Form</h4>
                                        <p class="text-muted font-14 mb-4">Please fill up the form below.</p>

                                        <div class="form-group">
                                            <label class="col-form-label">Subject</label>
                                            <select class="custom-select" name="subject" autocomplete="off">
                                                <option value="">Click here to select any ...</option>

                                                <?php $sql = "SELECT SubjectCode from subjects";
                                                    $query = $dbh -> prepare($sql);
                                                    $query->execute();
                                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                    $cnt=1;
                                                    if($query->rowCount() > 0) {
                                                        foreach($results as $result)
                                                {   ?> 
                                                <option value="<?php echo htmlentities($result->SubjectCode);?>"><?php echo htmlentities($result->SubjectCode);?></option>
                                                <?php }
                                            } ?>
                                            </select>
                                        </div>

                                        
                                        
                                        <div class="form-group">
                                            <label class="col-form-label">Name of the Lecturer/ Demonstrator/ Tutor</label>
                                            <select class="custom-select" name="teacher" autocomplete="off">
                                                <option value="">Click here to select any ...</option>

                                                <?php $sql = "SELECT FullName from Teachers";
                                                    $query = $dbh -> prepare($sql);
                                                    $query->execute();
                                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                    $cnt=1;
                                                    if($query->rowCount() > 0) {
                                                        foreach($results as $result)
                                                {   ?> 
                                                <option value="<?php echo htmlentities($result->FullName);?>"><?php echo htmlentities($result->FullName);?></option>
                                                <?php }
                                            } ?>
                                            </select>
                                        </div>

                                       

                                        <div class="form-group">
                                            <label class="col-form-label">Name of the Sport</label>
                                            <select class="custom-select" name="sport" autocomplete="off">
                                                <option value="">Click here to select any ...</option>

                                                <?php 
                                                // Get the student's ID from the session
                                                $stuid = $_SESSION['eid'];

                                                // Query to get sports registered by the student
                                                $sql = "SELECT sports.SportName FROM student_sports 
                                                        JOIN sports ON student_sports.sport_id = sports.id 
                                                        WHERE student_sports.student_id = :stuid";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':stuid', $stuid, PDO::PARAM_INT);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);

                                                // Check if the query returns any result
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {
                                                        ?> 
                                                        <option value="<?php echo htmlentities($result->SportName);?>">
                                                            <?php echo htmlentities($result->SportName); ?>
                                                        </option>
                                                        <?php 
                                                    }
                                                } else {
                                                    echo '<option value="">No sports registered</option>';
                                                } 
                                                ?>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Describe Your Reason</label>
                                            <textarea class="form-control" name="reason" type="text" name="reason" length="200" id="example-text-input" rows="2"></textarea>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label for="example-date-input" class="col-form-label">Date</label>
                                            <input class="form-control" type="date"  required id="example-date-input" name="date">
                                        </div>

                                        <div class="form-group">
                                            <label for="example-email-input" class="col-form-label">Starting Time</label>
                                            <input class="form-control" name="fromtime" type="text" autocomplete="off" required id="example-email-input" >
                                        </div>

                                        <div class="form-group">
                                            <label for="example-email-input" class="col-form-label">Ending Time</label>
                                            <input class="form-control" name="totime" type="text" autocomplete="off" required id="example-email-input" >
                                        </div>

                                        <button class="btn btn-primary" name="apply" id="apply" type="submit">SUBMIT</button>
                                        
                                    </div>
                                </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <?php include '../includes/footer.php' ?>
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

    <!-- others plugins -->
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>

</html>

<?php } ?> 