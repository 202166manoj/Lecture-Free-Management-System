<?php
session_start();
error_reporting(0);
include('../includes/dbconn.php');

if (strlen($_SESSION['inslogin']) == 0) {
    header('location:../instructor-login.php');
} else {
    $eid = $_SESSION['inslogin'];

    if (isset($_POST['update'])) {
        $fname = $_POST['fullname'];
        $sport = $_POST['sport'];
        $mobileno = $_POST['mobileno'];
        $profilePicture = $_FILES['profilePicture']['name'];
        $deleteProfilePicture = isset($_POST['deleteProfilePicture']) ? true : false;

        // Handle file upload
        if ($profilePicture) {
            $target_dir = "profile_pictures/";
            $target_file = $target_dir . basename($_FILES["profilePicture"]["name"]);
            move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $target_file);
        }

        // Update the database
        $sql = "UPDATE instructors SET FullName=:fname, Sport=:sport, Phonenumber=:mobileno";

        if ($profilePicture) {
            $sql .= ", ProfilePicture=:profilePicture";
        } elseif ($deleteProfilePicture) {
            $sql .= ", ProfilePicture=NULL";
        }

        $sql .= " WHERE EmailId=:eid";

        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':sport', $sport, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);

        if ($profilePicture) {
            $query->bindParam(':profilePicture', $target_file, PDO::PARAM_STR);
        }

        $query->execute();
        $msg = "Your Profile has been updated Successfully";

        // Delete the profile picture file if requested
        if ($deleteProfilePicture && $result->ProfilePicture) {
            unlink($result->ProfilePicture);
        }
    }
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Student Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/metisMenu.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.min.css">
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <link rel="stylesheet" href="../assets/css/typography.css">
    <link rel="stylesheet" href="../assets/css/default-css.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <div class="page-container">
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="dashboard.php"><img src="../assets/images/logo.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <?php
                    $page = 'settings';
                    include '../includes/instructor-sidebar.php';
                    ?>
                </div>
            </div>
        </div>
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
                                <h4 class="page-title pull-left">My Profile</h4>
                                <ul class="breadcrumbs pull-left">
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6 clearfix">
                            <?php include 'instructor-profile-section.php'; ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-ml-12">
                        <div class="row">
                            <div class="col-12 mt-5">
                                <?php if ($error) { ?><div class="alert alert-danger alert-dismissible fade show"><strong>Info: </strong><?php echo htmlentities($error); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div><?php } else if ($msg) { ?><div class="alert alert-success alert-dismissible fade show"><strong>Info: </strong><?php echo htmlentities($msg); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div><?php } ?>
                                <div class="card">
                                    <form name="addemp" method="POST" enctype="multipart/form-data">
                                        <div class="card-body">
                                            <h4 class="header-title">Update My Profile</h4>
                                            <p class="text-muted font-14 mb-4">Please make changes on the form below in order to update your profile</p>
                                            <?php
                                            $eid = $_SESSION['inslogin'];
                                            $sql = "SELECT * from instructors where EmailId=:eid";
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);

                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) {
                                            ?>

                                                    <div class="form-group">
                                                        <label for="example-text-input" class="col-form-label">Full Name</label>
                                                        <input class="form-control" name="fullname" value="<?php echo htmlentities($result->FullName); ?>" type="text" required id="example-text-input">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="example-email-input" class="col-form-label">Email</label>
                                                        <input class="form-control" name="email" type="email" value="<?php echo htmlentities($result->EmailId); ?>" readonly autocomplete="off" required id="example-email-input">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-form-label">Selected Sport</label>
                                                        <select class="custom-select" name="sport" autocomplete="off">
                                                        <option value="<?php echo htmlentities($result->Sport);?>"><?php echo htmlentities($result->Sport);?></option>

                                                        <?php $sql = "SELECT SportName from sports";
                                                            $query = $dbh -> prepare($sql);
                                                            $query->execute();
                                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                            $cnt=1;
                                                            if($query->rowCount() > 0){
                                                            foreach($results as $resultt)
                                                            {   
                                                        ?>  
                                                            <option value="<?php echo htmlentities($resultt->SportName);?>"><?php echo htmlentities($resultt->SportName);?></option>
                                                    <?php }} ?>
                                                    </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="example-text-input" class="col-form-label">Contact Number</label>
                                                        <input class="form-control" name="mobileno" type="tel" value="<?php echo htmlentities($result->Phonenumber); ?>" maxlength="10" autocomplete="off" required>
                                                    </div>

                                                    <h4 class="header-title">Profile Picture</h4>
                                                    <div class="form-group">
                                                        
                                                        <?php if ($result->ProfilePicture) { ?>
                                                            <img src="<?php echo htmlentities($result->ProfilePicture); ?>" alt="Profile Picture" width="150"><br>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="checkbox" name="deleteProfilePicture" id="deleteProfilePicture">
                                                        <label for="deleteProfilePicture">Delete profile picture</label>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="profilePicture" class="col-form-label">Change the Profile Picture</label><br>
                                                        <input class="form-control" type="file" name="profilePicture" id="profilePicture">
                                                    </div>

                                                    

                                            <?php }
                                            } ?>
                                            <button class="btn btn-primary" name="update" id="update" type="submit">MAKE CHANGES</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../includes/footer.php'; ?>
    </div>
    <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/metisMenu.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/jquery.slicknav.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>

</html>
<?php } ?>
