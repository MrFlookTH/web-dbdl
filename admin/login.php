<?php
    session_start();
    if(isset($_SESSION["AccountUsername"])){
        echo "<script>window.location='index.php'</script>";
        exit();
    }
    if(isset($_POST['submit'])){
        require("php/connect.php");
        $username = trim(htmlentities($_POST["username"]));
        $password = trim(htmlentities($_POST["password"]));
        //Check input
        if($username=="" || $password==""){
            echo "<script>alert('Please enter data'); window.location='login.php'</script>";
            exit();
        }

        //Check username and password
        require("php/connect.php");
        $sql = "SELECT AccountUsername,AccountPassword FROM account WHERE AccountUsername = '$username'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row["AccountPassword"])){
                //Password Correct
                $_SESSION["AccountUsername"] = $row["AccountUsername"];
                echo "<script>window.location='index.php'</script>";
                mysqli_close($conn);
            }else{
                //Password Incorrect
                echo "<script>alert('Password incorrect')</script>";
                mysqli_close($conn);
            }
        }else{
            echo "<script>alert('Username not found'); window.location='login.php'</script>";
            mysqli_close($conn);
            exit();
        }

    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

    <!-- Favicon-->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bgdark">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a>
                                <img src="images/icon/logo.png" alt="Dead by Daylight">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full" type="text" name="username" placeholder="Username" autocomplete="off" Required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password" Required>
                                </div>          
                                <button class="au-btn au-btn--block au-btn--blue m-b-20 m-t-30" type="submit" name="submit">sign in</button>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="button" onclick="location.href='register.php'">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->