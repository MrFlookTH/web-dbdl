<?php
    session_start();
    if(!isset($_SESSION["AccountUsername"])){
        echo "<script>window.location='login.php'</script>";
        exit();
    }

    //Get Data
    if(isset($_GET["id"])){
        require("php/connect.php");
        $id = trim(htmlentities($_GET["id"]));
        $sql = "SELECT * FROM items WHERE ItemId = '$id'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) <= 0){
            header('Location: items.php');
            $conn->close();
            exit();
        }
        $itemData = mysqli_fetch_assoc($result);
        $conn->close();
    }else{
        header('Location: items.php');
        exit();
    }

    //Edit Character
    if(isset($_POST["submit-edit"])){
        $itemName = trim(htmlentities($_POST["itemname"]));
        $description = trim(htmlentities($_POST["description"]));
        $description = nl2br($description);
        $itemRarity = htmlentities($_POST["rarity"]);
        $itemDurability = htmlentities($_POST["durability"]);
        $uploadOk = 1;
        $itemId = $itemData["ItemId"];

        //Check input
        if(empty($itemName) || empty($description) || empty($itemDurability) || empty($itemRarity)){
            $_SESSION["alert_error"] =  "Please enter the item data.";
            $uploadOk = 0;
        }

        //Check file upload
        if($_FILES["itemImage"]["tmp_name"] != ""){
            $hasImageUpload = true;
            $target_dir = "img/unlockable/items/";
            $originalFileName = basename($_FILES["itemImage"]["name"]);
            $imageFileType = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));

            //Rename file
            $itemNameReplace = preg_replace("/&#?[a-z0-9]+;/i","",$itemName);
            $itemNameReplace = str_replace(" ","_",$itemNameReplace);
            $target_file = $target_dir . $itemNameReplace . "." . $imageFileType;

            // Check if file already exists
            if (file_exists($target_file)) {
                $_SESSION["alert_error"] =  "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["itemImage"]["size"] > 1048576) {
                $_SESSION["alert_error"] =  "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                $_SESSION["alert_error"] =  "Only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

        }         

        // Check $uploadOk is set to 0 by an error
        if ($uploadOk != 0) {
            require("php/connect.php");
            if($hasImageUpload){
                if(file_exists($itemData["ItemImage"])) unlink("../".$itemData["ItemImage"]);
                if(move_uploaded_file($_FILES["itemImage"]["tmp_name"], "../".$target_file_p)){
                    $sql = "UPDATE items SET ItemImage = '$target_file' WHERE ItemId = '$itemId' LIMIT 1";
                    if(!mysqli_query($conn, $sql)) $uploadOk = 0;
                }
            }
            
            //Save to database
            if($uploadOk != 0){
                    $sql = "UPDATE items SET ItemImage = '$target_file' WHERE ItemId = '$itemId' LIMIT 1";
                $stmt = $conn->prepare("UPDATE items SET ItemName=?,ItemDescription=?,ItemDurability=?,ItemRarity=? WHERE ItemId=? LIMIT 1");
                $stmt->bind_param("sssss", $itemName, $description, $itemDurability, $itemRarity, $itemId);
                $stmt->execute();
                $stmt->close();
                $conn->close();
                $_SESSION["alert_success"] = $itemName." has been updated.";
            }  
        }
        header("Location: ".$_SERVER["HTTP_REFERER"]);
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Dead by Daylight Wiki">
    <meta name="keywords" content="Dead by Daylight Wiki">

    <!-- Title Page-->
    <title>Items - Dead by Daylight</title>

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
                            <a class="js-arrow" href="./">Overview</a>
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
                        <li>
                            <a href="./"><img src="images/icon/icon_logo.png" width="30"/> Overview</a>
                        </li>
                        <li>
                            <a href="characters.php"><img src="images/icon/icon_characters.png" width="30"/> Characters</a>
                        </li>
                        <li>
                            <a href="perks.php"><img src="images/icon/icon-perk.png" width="30"/> Perks</a>
                        </li>
                        <li class="active">
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
                                <h2>Edit -> <?=$itemData["ItemName"]?></h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <?php
                                    //Alert
                                    if(isset($_SESSION["alert_error"])){
                                ?>
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                <span class="badge badge-pill badge-danger">Error</span> <?php echo $_SESSION["alert_error"]; unset($_SESSION["alert_error"]); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php }
                                    if(isset($_SESSION["alert_success"])){
                                ?>
                                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                <span class="badge badge-pill badge-success">Success</span> <?php echo $_SESSION["alert_success"]; unset($_SESSION["alert_success"]); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php } ?>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 m-b-25">
                            <form action="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="itemname" class="form-control-label">Item name</label>
                                    <input type="text" name="itemname" id="itemname" class="form-control" maxlength="100" autocomplete="off" value="<?=$itemData["ItemName"]?>" Required>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="form-control-label">Description</label>
                                    <textarea rows="4" name="description" id="description" class="form-control" style="resize:none" Required><?=$itemData["ItemDescription"]?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="durability" class="form-control-label">Durability</label>
                                    <input type="text" name="durability" id="durability" class="form-control" maxlength="50" autocomplete="off" value="<?=$itemData["ItemDurability"]?>" Required>
                                </div>
                                <div class="form-group">
                                    <label for="rarity" class="form-control-label">Rarity</label>
                                    <select name="rarity" id="rarity" class="form-control" Required>
                                        <option value="Common" <?php if($itemData["ItemRarity"]=="Common") echo "selected"; ?>>Common</option>
                                        <option value="Uncommon" <?php if($itemData["ItemRarity"]=="Uncommon") echo "selected"; ?>>Uncommon</option>
                                        <option value="Rare" <?php if($itemData["ItemRarity"]=="Rare") echo "selected"; ?>>Rare</option>
                                        <option value="Very Rare" <?php if($itemData["ItemRarity"]=="Very Rare") echo "selected"; ?>>Very Rare</option>
                                    </select>
                                </div>
                                <img src="../<?=$itemData["ItemImage"]?>" width="80" />
                                <div class="form-group">
                                    <label for="itemImage" class="form-control-label">Item image</label>
                                    <input type="file" name="itemImage" accept="image/*" id="perkImage" class="form-control">
                                </div>
                                <button name="submit-edit" type="submit" class="btn btn-lg btn-info btn-block">
                                    <i class="fa fa-floppy-o fa-md"></i>&nbsp; Update
                                </button>
                            </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->

        </div><!-- END PAGE CONTAINER-->

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
