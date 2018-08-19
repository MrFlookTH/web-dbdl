<?php
    session_start();
    if(!isset($_SESSION["AccountUsername"])){
        echo "<script>window.location='login.php'</script>";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Dead by Daylight Wiki">
    <meta name="keywords" content="Dead by Daylight Wiki">

    <!-- Title Page-->
    <title>Dead by Daylight</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="./">
                            <img src="images/icon/logo2.png" alt="Dead by Daylight" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li>
                            <a href="./">Overview</a>
                        </li>
                        <li>
                            <a href="characters.php">Characters</a>
                        </li>
                        <li>
                            <a href="perks.php">Perks</a>
                        </li>
                        <li>
                            <a href="items.php">Items</a>
                        </li>
                        <li>
                            <a href="logout.php"><i class="fas fa-power-off"></i>Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="./">
                    <img src="images/icon/logo2.png" alt="Dead by Daylight" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active">
                            <a href="./"><img src="images/icon/icon_logo.png" width="30"/> Overview</a>
                        </li>
                        <li>
                            <a href="characters.php"><img src="images/icon/icon_characters.png" width="30"/> Characters</a>
                        </li>
                        <li>
                            <a href="perks.php"><img src="images/icon/icon-perk.png" width="30"/> Perks</a>
                        </li>
                        <li>
                            <a href="items.php"><img src="images/icon/icon-item.png" width="30"/> Items</a>
                        </li>       
                        <li>
                            <a href="logout.php"><i class="fas fa-power-off"></i>Logout</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row m-b-25">
                            <div class="col-md-12">
                                <h2>The Characters</h2>
                            </div>
                        </div>
                        <h4>The Survivors</h4>
                        <div class="row m-t-15">
                            <?php
                                require("php/connect.php");
                                $sql = "SELECT CharacterId,CharacterPortraitImage,CharacterName FROM characters WHERE CharacterRole='Survivor'";
                                $result = mysqli_query($conn, $sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($data = mysqli_fetch_assoc($result)){
                            ?>
                            <div class="col-4 col-md-2 col-lg-1">
                                <a href="character-detail.php?id=<?=$data["CharacterId"]?>" target="_blank"><img src="../<?=$data["CharacterPortraitImage"]?>" alt="<?=$data["CharacterName"]?>"></a>
                                <p class="text-center text-small"><?=$data["CharacterName"]?></p>
                            </div>
                            <?php }} ?>
                        </div>
                        <h4 class="m-t-25">The Killers</h4>
                        <div class="row m-t-15">
                            <?php
                                $sql = "SELECT CharacterId,CharacterPortraitImage,CharacterName FROM characters WHERE CharacterRole='Killer'";
                                $result = mysqli_query($conn, $sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($data = mysqli_fetch_assoc($result)){
                            ?>
                            <div class="col-4 col-md-2 col-lg-1">
                                <a href="character-detail.php?id=<?=$data["CharacterId"]?>" target="_blank"><img src="../<?=$data["CharacterPortraitImage"]?>" alt="<?=$data["CharacterName"]?>"></a>
                                <p class="text-center text-small"><?=$data["CharacterName"]?></p>
                            </div>
                            <?php }} ?>
                        </div>
                        <hr />
                        <div class="row m-t-25">
                            <div class="col-md-12">
                                <h2>Perks</h2>
                            </div>
                        </div>
                        <div class="row m-t-15">
                            <?php
                                $sql = "SELECT PerkId,PerkImage,PerkName FROM perks";
                                $result = mysqli_query($conn, $sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($data = mysqli_fetch_assoc($result)){
                            ?>
                            <div class="col-4 col-md-2 col-lg-1">
                                <a href="perk-detail.php?id=<?=$data["PerkId"]?>" target="_blank"><img src="../<?=$data["PerkImage"]?>" alt="<?=$data["PerkName"]?>"></a>
                                <p class="text-center text-small"><?=$data["PerkName"]?></p>
                            </div>
                            <?php }} ?>
                        </div>
                        <hr />
                        <div class="row m-t-25">
                            <div class="col-md-12">
                                <h2>Items</h2>
                            </div>
                        </div>
                        <div class="row m-t-15">
                            <?php
                                $sql = "SELECT ItemId,ItemImage,ItemName FROM items";
                                $result = mysqli_query($conn, $sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($data = mysqli_fetch_assoc($result)){
                            ?>
                            <div class="col-4 col-md-2 col-lg-1">
                                <a href="item-detail.php?id=<?=$data["ItemId"]?>" target="_blank"><img src="../<?=$data["ItemImage"]?>" alt="<?=$data["ItemName"]?>"></a>
                                <p class="text-center text-small"><?=$data["ItemName"]?></p>
                            </div>
                            <?php }} $conn->close(); ?>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright"></div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js"></script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/select2/select2.min.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
