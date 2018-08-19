<?php
    //Get Data
    if(isset($_POST["keyword"])){
        $keyword = trim(htmlspecialchars($_POST["keyword"]));
        if(empty($keyword)){
            header('Location: ./');
            exit();
        }
    }else{
        header('Location: ./');
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Dead by Daylight Wiki">

    <title>Dead by Daylight</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="./"><img src="img/logo.png" width="50"> Dead by Daylight</a>
        <span class="navbar-toggler" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars fa-2x"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive"> 
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.php#character">Characters</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.php#unlockable">Unlockable</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.php#HowToPlay">How To Play</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="https://store.steampowered.com/app/381210/Dead_by_Daylight/" target="_blank">Buy a game</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
      <div class="container">
        <div class="intro-text">
          <div class="intro-lead-in"></div>
          <div class="intro-heading"></div>
        </div>
      </div>
    </header>

    <section class="bg-dark" id="search">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <form action="search.php" method="post" class="form-inline">
              <div class="form-group">
                <label class="sr-only" for="search">Search:</label>
                <input class="form-control search-box" id="search" type="text" name="keyword" maxlength="50" placeholder="Search for..." value="<?=$keyword?>" autocomplete="off" required />
              </div>
              &nbsp;<button type="submit" class="btn btn-default" name="submit-search"><i class="fa fa-search"></i> Search</button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- Character -->
    <section class="bg-dark pt-0 pb-0">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h2 class="section-heading"><i class="fa fa-search"></i>&nbsp; Search Result</h2>
          </div>
        </div>
    </section>

    <section class="bg-dark pt-0">
      <div class="container">
        <div class="row">
        <div class="col-12">
            <table class="table table-bordered table-dark">
            <thead>
                <tr>
                <th class="text-center">Icon</th>
                <th class="text-center">Name</th>
                <th class="text-center">Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require("php/connect.php");
                    $keyword = "%".$keyword."%";
                    $stmt = $conn->prepare("(SELECT PerkImage as ResultImage, PerkName as ResultName, PerkDescription as ResultDescription FROM perks ".
                            "WHERE PerkName LIKE ?) ".
                            "UNION (SELECT CharacterPortraitImage as ResultImage, CharacterName as ResultName, CharacterOverview as ResultDescription FROM characters ".
                            "WHERE CharacterName LIKE ?) ".
                            "UNION (SELECT ItemImage as ResultImage, ItemName as ResultName, ItemDescription as ResultDescription FROM items ".
                            "WHERE ItemName LIKE ?) ");
                    $stmt->bind_param('sss', $keyword,$keyword,$keyword);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if(mysqli_num_rows($result) > 0){
                        while($data = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                <td width="10%" class="text-center"><a href=""><img class="img-fluid" width="80" src="<?=$data["ResultImage"]?>"></a></td>
                <td width="20%" class="text-center"><?=$data["ResultName"]?></td>
                <td><?=$data["ResultDescription"]?></td>
                </tr>
                <?php } $conn->close(); 
                    }else{
                        echo '<td colspan="3" class="text-center" height="200" style="vertical-align:middle">No Result</td>';
                    }     
                ?>
            </tbody>
            </table>
        </div>   
        </div>
      </div>
    </section>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/agency.min.js"></script>

  </body>

</html>
