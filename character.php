<?php
    //Get Data
    if(isset($_GET["id"])){
        require("php/connect.php");
        $id = trim(htmlentities($_GET["id"]));
        $sql = "SELECT * FROM characters WHERE CharacterId = '$id'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) <= 0){
            header('./');
            $conn->close();
            exit();
        }
        $characterData = mysqli_fetch_assoc($result);
        $conn->close();
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

    <title><?=$characterData["CharacterName"]?> - Dead by Daylight</title>

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
              <a class="nav-link" href="index.php#character">Characters</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php#unlockable">Unlockable</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php#HowToPlay">How To Play</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://store.steampowered.com/app/381210/Dead_by_Daylight/" target="_blank">Buy a game</a>
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

    <!-- Character Detail -->
    <section class="bg-dark" id="character_detail">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h2 class="section-heading"><img src="img/characters/icon.png" width="60"> <?=$characterData["CharacterName"]?></h2>
          </div>
        </div>

        <h3 class="section-subheading">Overview</h3>
        <div class="row">
          <div class="col-12">
            <p><?=$characterData["CharacterOverview"]?></p>
          </div>
        </div>
        <h3 class="section-subheading mt-40">Background</h3>
        <div class="row">
          <div class="col-12 col-md-2"><img class="img-fluid" src="<?=$characterData["CharacterFullImage"]?>"></div>
          <div class="col-12 col-md-10">
            <p><?=$characterData["CharacterBackground"]?></p>
          </div>
        </div>
        <h3 class="section-subheading mt-40"><?=$characterData["CharacterName"]?>'s Perks</h3>
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
                $characterId = $characterData["CharacterId"];
                $sql = "SELECT PerkImage,PerkName,PerkDescription FROM perks WHERE CharacterUnique='$characterId'";
                $result_perk = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result_perk) > 0){
                    while($perkData = mysqli_fetch_assoc($result_perk)){
            ?>
              <tr>
                <td class="text-center"><img class="img-fluid" src="<?=$perkData["PerkImage"]?>" width="80"></td>
                <td class="text-center"><?=$perkData["PerkName"]?></td>
                <td><?=$perkData["PerkDescription"]?></td>
              </tr>
            <?php }} $conn->close(); ?>
            </tbody>
          </table>

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
