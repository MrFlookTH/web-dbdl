<?php
    session_start();
    if(isset($_POST['submit'])){
        $username = trim(htmlentities($_POST["username"]));
        $password = trim(htmlentities($_POST["password"]));
        $fullname = trim(htmlentities($_POST["fullname"]));
        //Check null
        if($username=="" || $password=="" || $fullname==""){
            echo "<script>alert('Please enter data'); window.location='register.php'</script>";
            exit();
        }

        //Check user exists
        require("php/connect.php");
        $sql = "SELECT AccountUsername FROM account WHERE AccountUsername = '$username'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Username is already exists'); window.location='register.php'</script>";
            mysqli_close($conn);
            exit();
        }else{
            $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO account(AccountUsername,AccountPassword,AccountName) VALUES('$username','$encrypted_password','$fullname')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Create account successfully'); window.location='login.php'</script>";
            } else {
                die("Error: ". mysqli_error($conn));
            }
            mysqli_close($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

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
                            <h2>Register</h2>
                        </div>
                        <div class="login-form">
                            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full" type="text" name="username" placeholder="Username" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input class="au-input au-input--full" type="text" name="fullname" placeholder="Full Name" autocomplete="off" required>
                                </div>             
                                <button class="au-btn au-btn--block au-btn--blue m-b-20 m-t-30" type="submit" name="submit">Register</button>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="button" onclick="location.href='login.php'">Back to Login</button>
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