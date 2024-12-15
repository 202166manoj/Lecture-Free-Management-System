<?php
    session_start();
    error_reporting(0);
    include('../includes/dbconn.php');
    $error='';
    $msg='';
    if(strlen($_SESSION['inslogin'])==0){   
    header('location:../instructor-login.php');
    } else {

    // code for update the read notification status
    $isreadbyadmin=1;
    $did=intval($_GET['formid']);  
    date_default_timezone_set('Asia/Kolkata');
    $adminactiondate=date('Y-m-d G:i:s ', strtotime("now"));
    $sql="UPDATE forms set IsReadByAdmin=:isreadbyadmin where id=:did";
    $query = $dbh->prepare($sql);
    $query->bindParam(':isreadbyadmin',$isreadbyadmin,PDO::PARAM_STR);
    $query->bindParam(':did',$did,PDO::PARAM_STR);
    $query->execute();

    // code for action taken on leave
    if(isset($_POST['update'])){ 
    $did=intval($_GET['formid']);
    $adminstatus=$_POST['status'];  
    $adminremark=$_POST['adminremark'];
    date_default_timezone_set('Asia/Kolkata');
    $adminactiondate=date('Y-m-d G:i:s ', strtotime("now"));

    $sql="UPDATE forms set AdminRemark=:adminremark, AdminStatus=:adminstatus,AdminActionDate=:adminactiondate where id=:did";
    $query = $dbh->prepare($sql);
    $query->bindParam(':adminremark',$adminremark,PDO::PARAM_STR);
    $query->bindParam(':adminstatus',$adminstatus,PDO::PARAM_STR);
    $query->bindParam(':adminactiondate',$adminactiondate,PDO::PARAM_STR);
    $query->bindParam(':did',$did,PDO::PARAM_STR);
    $query->execute();
    $msg="Form updated Successfully";
    } ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin Panel -  View Forms</title>
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
                    <?php $page="employee";
                    include '../includes/instructor-sidebar.php'
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
                            <h4 class="page-title pull-left">view Forms</h4>
                            <ul class="breadcrumbs pull-left">
                            </ul>
                        </div>
                    </div> 

                    <div class="col-sm-6 clearfix">
                         <?php include 'instructor-profile-section.php'; ?>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
                
                <!-- row area start -->
                <div class="row">
                    
                    <!-- Striped table start -->
                    <div class="col-lg-12 mt-5">
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
                            <div class="card-body">
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover text-center">
                                            
                                            <tbody>

                                            <?php 
                                            $lid=intval($_GET['formid']);
                                            $sql = "SELECT forms.id as lid,students.FullName,students.StuId,students.id,forms.Subject,forms.Teacher,forms.Sport,forms.Reason,forms.Date,forms.FromTime,forms.ToTime,forms.PostingDate,forms.AdminStatus,forms.TeacherStatus,forms.AdminActionDate,forms.TeacherActionDate,forms.AdminRemark,forms.TeacherRemark from forms join students on forms.stuid=students.id where forms.id=:lid";
                                            $query = $dbh -> prepare($sql);
                                            $query->bindParam(':lid',$lid,PDO::PARAM_STR);
                                            $query->execute();
                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt=1;
                                            if($query->rowCount() > 0)
                                            {
                                            foreach($results as $result)
                                            {         
                                                ?>

                                            <tr>
                                                <td ><b>Student Id</b></td>
                                                <td colspan="1"><?php echo htmlentities($result->StuId);?></td>

                                                <td> <b>Student Name</b></td>
                                                <td colspan="1"><?php echo htmlentities($result->FullName);?></td>

                                                <td ><b>Sport</b></td>
                                                <td colspan="1"><?php echo htmlentities($result->Sport);?></td>
                                          </tr>

                                          <tr>
                                             <td ><b>Subject</b></td>
                                             <td colspan="1"><?php echo htmlentities($result->Subject);?></td>


                                             <td ><b>Lecturer</b></td>
                                             <td colspan="1"><?php echo htmlentities($result->Teacher);?></td>
                                            
                                        </tr>

                                        <tr>
                                            <td ><b>Date</b></td>
                                            <td colspan="1"><?php echo htmlentities($result->Date);?></td>
                                             
                                            <td ><b>From</b></td>
                                            <td colspan="1"><?php echo htmlentities($result->FromTime);?></td>

                                            <td><b>To</b></td>
                                            <td colspan="1"><?php echo htmlentities($result->ToTime);?></td>
                                            
                                        </tr>

                                    

                                        <tr>
                                        <td ><b>Request Applied</b></td>
                                        <td><?php echo htmlentities($result->PostingDate);?></td>
                                        </tr>

                                        <tr>
                                            <td ><b>Reason</b></td>
                                            <td colspan="5"><?php echo htmlentities($result->Reason);?></td>
                                                
                                        </tr>

                                
                                        <tr>
                                        <td ><b>Instructor Approval</b></td>
                                        <td><?php $stats=$result->AdminStatus;
                                        if($stats==1){
                                        ?>
                                            <span style="color: green">Approved</span>
                                            <?php } if($stats==2)  { ?>
                                            <span style="color: red">Declined</span>
                                            <?php } if($stats==0)  { ?>
                                            <span style="color: blue">Pending</span>
                                            <?php } ?>
                                        </td>

                                        <td ><b>Instructor Approval Date</b></td>
                                            <td><?php
                                            if($result->AdminActionDate==""){
                                            echo "NA";  
                                            }
                                            else{
                                            echo htmlentities($result->AdminActionDate);
                                            }
                                            ?></td>
                                        </tr>
                                        
                                        
                                        <?php if($stats == 2) { // Check if the status is pending or declined ?>
                                            <tr>
                                                <td><b>Instructor Remark: </b></td>
                                                <td colspan="12"><?php
                                                if($result->AdminRemark==""){
                                                echo "NA";  
                                                }
                                                else{
                                                echo htmlentities($result->AdminRemark);
                                                }
                                                ?></td>
                                            </tr>
                                        <?php } ?>

                                        <tr>
                                        <td ><b>Lecturer Approval</b></td>
                                        <td><?php $stats=$result->TeacherStatus;
                                        if($stats==1){
                                        ?>
                                            <span style="color: green">Approved</span>
                                            <?php } if($stats==2)  { ?>
                                            <span style="color: red">Declined</span>
                                            <?php } if($stats==0)  { ?>
                                            <span style="color: blue">Pending</span>
                                            <?php } ?>
                                        </td>

                                        <td ><b>Lecturer Approval Date</b></td>
                                            <td><?php
                                            if($result->TeacherActionDate==""){
                                            echo "NA";  
                                            }
                                            else{
                                            echo htmlentities($result->TeacherActionDate);
                                            }
                                            ?></td>
                                        </tr>

                                        <?php if($stats == 2) { // Check if the status is pending or declined ?>
                                            <tr>
                                                <td><b>Lecturer Remark: </b></td>
                                                <td colspan="12"><?php
                                                if($result->TeacherRemark==""){
                                                echo "NA";  
                                                }
                                                else{
                                                echo htmlentities($result->TeacherRemark);
                                                }
                                                ?></td>
                                            </tr>
                                        <?php } ?>

                                
                                        <?php 
                                if($result->AdminStatus==0)
                                {

                                ?>
                            <tr>
                            <td colspan="12">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">SET ACTION</button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">SET ACTION</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                <form method="POST" name="adminaction">
                                <div class="modal-body">
                                
                                    <select class="custom-select" name="status" id="statusSelect" required="">
                                        <option value="">Choose...</option>
                                        <option value="1">Approve</option>
                                        <option value="2">Decline</option>
                                    </select>
                                    <br></br>
                                    <p><textarea id="textarea1" name="adminremark" class="form-control" placeholder="Description" row="5" maxlength="500" style="display: none;"></textarea></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" name="update">Submit</button>
                                </div>
                                </div>
                            </div>
                            </div>

                            </td>
                            </tr>
                            <?php } ?>
                            </form>
                             </tr>
                                         <?php $cnt++;} }?>
                                    </tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Striped table end -->
                    
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
    <script>
    document.getElementById('statusSelect').onchange = function() {
        var textarea = document.getElementById('textarea1');
        if (this.value == '2') {
            textarea.style.display = 'block';
        } else {
            textarea.style.display = 'none';
        }
    };
    </script>
</body>

</html>

<?php } ?>


                  