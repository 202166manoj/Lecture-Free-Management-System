<?php
session_start();
error_reporting(0);
include('includes/dbconn.php');
$msg='';
if(isset($_POST['signin']))
{
    $uname=$_POST['email'];
    $password=md5($_POST['password']);
    $sql ="SELECT EmailId,Password,Status,id FROM teachers WHERE EmailId=:uname and Password=:password";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':uname', $uname, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);

    if($query->rowCount() > 0)
    {
        foreach ($results as $result) {
            $status=$result->Status;
            $_SESSION['eid']=$result->id;
        }
        if($status==0)
        {
            $msg="InActive Account. Please contact your administrator!";
        } else  {
            $_SESSION['tealogin']=$_POST['email'];
            echo "<script type='text/javascript'> document.location = 'teacher/dashboard.php'; </script>";
        }
    } else  {
        echo "<script>alert('Sorry, Invalid Details.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap");


            :root {
            --primary-color: #5A77DF;
            --primary-color-dark: #3E53A0;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --extra-light: #CCD4DE;
            }


            * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            }

            body {
            font-family: "Lato", sans-serif;
            }

            .container {
            display: flex;
            min-height: 100vh;
            min-height: 100svh;
            }

            .container__right {
            flex: 1.5;
            background: url(assets/images/login.jpg);
            background-position: center center;
            background-size: cover;
            background-repeat: no-repeat;
            position: relative;
            }

            .container__right::before {
            content: "";
            position: absolute;
            height: 75%;
            width: 100%;
            left: 0;
            bottom: 0;
            background: linear-gradient(to top, #585555, #00000000);
            }

            .image {
            position: absolute;
            top: 75%;
            left: 50%;
            transform: translateX(-50%);
            display: grid;
            gap: 1rem;
            width: 80%;
            max-width: 30rem;
            color: #ffffff;
            }

            .image h3 {
            font-size: 2rem;
            position: relative;
            }

            .image h3::before {
            content: "";
            position: absolute;
            top: 50%;
            left: -4rem;
            height: 2px;
            width: 3rem;
            background-color: #ffffff;
            }

            .image p {
            font-size: 1rem;
            }

            .container__left {
            flex: 1;
            }

            .content {
            max-width: 450px;
            padding: 1rem;
            margin: auto;
            }

            .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: var(--text-light);
            margin: 1rem 0;
            }

            .header .register {
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            }

            .header .back__btn {
            font-size: 1.2rem;
            cursor: pointer;
            }

            .form__content {
            max-width: 400px;

            margin: 5rem auto 0;
            }

            .form__content .form__title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--text-dark);
            }

            .form__content .form__subtitle {
            font-size: 1rem;
            margin-bottom: 4rem;
            color: var(--text-light);
            }

            .form__content input {
            display: block;
            width: 100%;
            margin-bottom: 1rem;
            outline: none;
            border: none;
            border-radius: 2px;
            padding: 0.75rem;
            font-size: 1rem;
            margin-bottom:30px;
            background-color: var(--extra-light);
            }

            .rmber-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            }

            .custom-control {
            display: flex;
            align-items: center;
            }

            .custom-control-input {
            margin-right: 0.5rem;
            margin-top:20px;
            }

            .custom-control-label {
            font-size: 0.875rem;
            color: var(--text-light);
            }

            .forgot__password {
            text-align: right;
            font-weight: 700;
            cursor: pointer;
            color: var(--text-light);
            }

            .form__content .submit__btn {
            width: 100%;
            padding: 1rem;
            background-color: var(--primary-color);
            color: #ffffff;
            font-size: 1rem;
            border: none;
            border-radius: 5rem;
            cursor: pointer;
            transition: 0.3s;
            margin-top:20px;
            }
            .form__content .submit__btn:hover {
            background-color: var(--primary-color-dark);
            }

            .form__content .bottom__line {
            display: block;
            height: 3px;
            width: 100%;
            background-color: var(--extra-light);
            margin: 2rem 0;
            }

            .footer__title {
            text-align: center;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--text-light);
            }

            .social__icons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            }

            .social__icons i {
            font-size: 1.5rem;
            color: var(--primary-color);
            cursor: pointer;
            transition: 0.3s;
            }
            .social__icons i:hover {
            color: var(--primary-color-dark);
            }

            @media screen and (width < 750px) {
            .container__right {
            display: none;
            }
            }
            </style>
    
    
    <title>WayaSync | Lecturer Login</title>
</head>
<body>
    <div class="container">
        <div class="container__right">
            <div class="image">
                <h3>Lecturer Login </h3>
                <p>Lecture Free Request Management System | Wayamba University of Sri Lanka</p>
            </div>
        </div>
        <div class="container__left">
            <div class="content">
                <div class="header">
                <span class="back__btn">
                    <a href="index.php"><i class="ri-arrow-left-line"></i></a>
                </span>

                </div>
                <div class="form__content">
                    <h3 class="form__title">WayaSync</h3>
                    <p class="form__subtitle">
                        Welcome! Please fill your Email and password to sign in to your account.
                    </p>
                    <form method="POST" name="signin">
                        <input type="email" id="email" name="email" placeholder="Email Address" autocomplete="off" required />
                        <input type="password" id="password" name="password" placeholder="Password" autocomplete="off" required />
                        <?php if($msg){?><div class="errorWrap"><strong>Error</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                        <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                    <label class="custom-control-label" for="customControlAutosizing">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <a href="teacher/tea-password-recovery.php">Forgot Password?</a>
                            </div>
                        </div>
                        <button class="submit__btn" type="submit" name="signin">Login Now</button>
                    </form>
                    <span class="bottom__line"></span>
                    
                    
                </div>
            </div>
        </div>
    </div>
    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>
</html>
