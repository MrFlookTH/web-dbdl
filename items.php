<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Dead by Daylight Wiki">

    <title>Items - Dead by Daylight</title>

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

    <!-- Perks -->
    <section class="bg-dark" id="character_detail">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h2 class="section-heading"><img src="img/unlockable/icon-item.png" width="60"> Items</h2>
          </div>
        </div>

        <h3 class="section-subheading">Item Tiers</h3>
        <div class="row">
          <div class="col-12">
            <p>Item สำหรับผู้รอดชีวิตและสามารถใช้เพื่อช่วยในการหลบหนี.</p>
          </div>
        </div>
        <h3 class="section-subheading mt-40">Rarities</h3>
        <div class="row">
          <div class="col-12">
            <p class="text-muted">Item มีระดับความหายากที่แตกต่างกัน</p>
            <ul class="text-muted">
              <li><span class="text-brown">Common</span> Items</li>
              <li><span class="text-yellow">Uncommon</span> Items</li>
              <li><span class="text-green">Rare</span> Items</li>
              <li><span class="text-purple">Very Rare</span> Items</li>
            </ul>
          </div>
        </div>
        <h3 class="section-subheading mt-40">Survivor Items</h3>
        <table class="table table-bordered table-dark">
          <thead>
            <tr>
              <th class="text-center">Icon</th>
              <th class="text-center">Name</th>
              <th class="text-center">Description</th>
              <th class="text-center">Durability</th>
              <th class="text-center">Rarity</th>
            </tr>
          </thead>
          <tbody>
            <?php
                require("php/connect.php");
                $sql = "SELECT ItemImage,ItemName,ItemDescription,ItemDurability,ItemRarity FROM items";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    while($data = mysqli_fetch_assoc($result)){
            ?>
              <tr>
                  <td class="text-center"><img class="img-fluid" width="80" src="<?=$data["ItemImage"]?>"></td>
                  <td class="text-center"><?=$data["ItemName"]?></td>
                  <td><?=$data["ItemDescription"]?></td>
                  <td class="text-center"><?=$data["ItemDurability"]?></td>
                  <td class="text-center">
                    <?php 
                        switch($data["ItemRarity"]){
                            case "Common" : echo '<span class="text-brown">Common</span>'; break;
                            case "Uncommon" : echo '<span class="text-yellow">Uncommon</span>'; break;
                            case "Rare" : echo '<span class="text-green">Rare</span>'; break;
                            case "Very Rare" : echo '<span class="text-purple">Very Rare</span>'; break;
                            default : echo "Not set";
                        }
                    ?>
                  </td>
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
