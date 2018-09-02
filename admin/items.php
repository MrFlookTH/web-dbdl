<?php
    session_start();
    if(!isset($_SESSION["AccountUsername"])){
        echo "<script>window.location='login.php'</script>";
        exit();
    }

    //Add Item
    if(isset($_POST["submit-add"])){
        $itemName = trim(htmlentities($_POST["itemname"]));
        $description = trim(htmlentities($_POST["description"]));
        $description = nl2br($description);
        $itemRarity = htmlentities($_POST["rarity"]);
        $itemDurability = htmlentities($_POST["durability"]);
        $uploadOk = 1;

        //Check input
        if(empty($itemName) || empty($description) || empty($itemDurability) || empty($itemRarity)){
            $_SESSION["alert_error"] =  "Please enter the item data.";
            $uploadOk = 0;
        }

        //Check file upload
        if($_FILES["itemImage"]["tmp_name"] == ""){
            $_SESSION["alert_error"] =  "Please upload item image.";
            $uploadOk = 0;
        }else{           
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

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk != 0) {
            require("php/connect.php");           
            if(!move_uploaded_file($_FILES["itemImage"]["tmp_name"], "../".$target_file)){
                $uploadOk = 0;
            }
            
            //Save to database
            if($uploadOk != 0){
                $stmt = $conn->prepare("INSERT INTO items(ItemName,ItemImage,ItemDescription,ItemRarity,ItemDurability) 
                        VALUES(?,?,?,?,?)");
                $stmt->bind_param("sssss", $itemName, $target_file, $description, $itemRarity,$itemDurability);
                $stmt->execute();
                $stmt->close();
                $conn->close();
                $_SESSION["alert_success"] = $itemName." has been uploaded.";
            }else{
                $_SESSION["alert_error"] =  "Can't add item";
                $conn->close();
            }
        }
        header("Location: ".$_SERVER["HTTP_REFERER"]);
        exit();
    }

    //Remove Perk
    if(isset($_GET["delId"])){
        $del_id = htmlentities($_GET["delId"]);
        $sql = "DELETE FROM items WHERE ItemId = '$del_id'";
        require("php/connect.php");
        if(mysqli_query($conn, $sql) == 1){
            $sql = "SELECT ItemImage FROM items WHERE ItemId='$del_id'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                $perkData = mysqli_fetch_assoc($result);
                if(file_exists($perkData["ItemImage"])) unlink("../".$perkData["ItemImage"]);
            }
            $_SESSION["alert_success"] = "Item ID #".$del_id." has been deleted.";
        }else{
            $_SESSION["alert_error"] = "Can't delete Item ID #".$del_id;
        }
        header("Location: ".$_SERVER["HTTP_REFERER"]);
        $conn->close();
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

    <script type="text/javascript">
        function confirmDelete(delId){
            var result = confirm("Are you sure you want to delete ?");
            if (result) {location.href="perks.php?delId="+delId;}
        }    
    </script>

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
                                <h2>Items</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                                            <input class="au-input" type="text" name="keyword" placeholder="Search for..." value="<?php if(isset($_POST["keyword"])){ echo $_POST["keyword"]; } ?>" autocomplete="off" />
                                            <button class="au-btn-filter" name="submit-search"><i class="zmdi zmdi-search"></i>Search</button>
                                        </form>
                                    </div>
                                    <div class="table-data__tool-right">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#staticModal"><i class="zmdi zmdi-plus"></i>add item</button>
                                    </div>
                                </div>
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
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Item Name</th>
                                                <th>Durability</th>
                                                <th>Rarity</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                require("php/connect.php");
                                                $sql = "SELECT ItemId,ItemName,ItemImage,ItemRarity,ItemDurability FROM items";
                                                if(isset($_POST["submit-search"])){
                                                    $keyword = trim(htmlentities($_POST["keyword"]));
                                                    $sql .= " WHERE ItemName LIKE '%$keyword%'";
                                                }
                                                $sql .= " ORDER BY ItemId DESC";
                                                $result = mysqli_query($conn, $sql);
                                                if(mysqli_num_rows($result) > 0){
                                                    while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                            <tr>
                                                <td><a href="item-edit.php?id=<?=$row["ItemId"]?>"><img src="../<?=$row["ItemImage"]?>" width="80"/></a></td>
                                                <td><a href="item-edit.php?id=<?=$row["ItemId"]?>"><?=$row["ItemName"]?></a></td>
                                                <td><?=$row["ItemDurability"]?></td>
                                                <td>
                                                <?php 
                                                    switch($row["ItemRarity"]){
                                                        case "Common" : echo '<span class="text-brown">Common</span>'; break;
                                                        case "Uncommon" : echo '<span class="text-yellow">Uncommon</span>'; break;
                                                        case "Rare" : echo '<span class="text-green">Rare</span>'; break;
                                                        case "Very Rare" : echo '<span class="text-purple">Very Rare</span>'; break;
                                                        default : echo "Not set";
                                                    }
                                                ?>
                                                </td>
                                                <td>
                                                <div class="table-data-feature">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" onclick="location.href='item-edit.php?id=<?=$row["ItemId"]?>'">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="confirmDelete(<?=$row["ItemId"]?>)">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </div>
                                                </td>
                                            </tr>
                                                <?php 
                                                    }
                                                }else{
                                                    echo '<td colspan="5" class="text-center">No Data Found</td>';
                                                }
                                                $conn->close();
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
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

            <!-- modal static -->
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
			<div class="modal fade" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="staticModalLabel">Add Item</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
                            <div class="form-group">
                                <label for="itemname" class="form-control-label">Item name</label>
                                <input type="text" name="itemname" id="itemname" class="form-control" maxlength="100" autocomplete="off" Required>
                            </div>
                            <div class="form-group">
                                <label for="description" class="form-control-label">Description</label>
                                <textarea rows="4" name="description" id="description" class="form-control" style="resize:none" Required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="durability" class="form-control-label">Durability</label>
                                <input type="text" name="durability" id="durability" class="form-control" maxlength="50" autocomplete="off" Required>
                            </div>
                            <div class="form-group">
                                <label for="rarity" class="form-control-label">Rarity</label>
                                <select name="rarity" id="rarity" class="form-control" Required>
                                    <option value="" disabled selected>Please select item rarity</option>
                                    <option value="Common">Common</option>
                                    <option value="Uncommon">Uncommon</option>
                                    <option value="Rare">Rare</option>
                                    <option value="Very Rare">Very Rare</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="itemImage" class="form-control-label">Item image</label>
                                <input type="file" name="itemImage" accept="image/*" id="perkImage" class="form-control" Required>
                            </div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="submit" name="submit-add" class="btn btn-primary">Upload</button>
						</div>
					</div>
				</div>
            </div>
            </form>
			<!-- end modal static -->
     
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
