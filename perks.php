<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Dead by Daylight Wiki">

    <title>Perks - Dead by Daylight</title>

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
            <h2 class="section-heading"><img src="img/unlockable/icon-perk.png" width="60"> Perks</h2>
          </div>
        </div>

        <h3 class="section-subheading">Perk Tiers</h3>
        <div class="row">
          <div class="col-12">
            <p>Perk ทุกตัวมีสามระดับหรือ Perk Tiers ซึ่งระบุด้วยเครื่องหมายที่ด้านขวาบนของไอคอน</p>
          </div>
        </div>
        <h3 class="section-subheading mt-40">Rarities</h3>
        <div class="row">
          <div class="col-12">
            <p class="text-muted">Perks มีระดับความหายากที่แตกต่างกัน</p>
            <ul class="text-muted">
              <li>Tier I Perks: Uncommon (<span class="text-yellow">Yellow</span>) or Rare (<span class="text-green">Green</span>)</li>
              <li>Tier II Perks: Uncommon (<span class="text-yellow">Yellow</span>), Rare (<span class="text-green">Green</span>) or Very Rare (<span class="text-purple">Purple</span>)</li>
              <li>Tier III Perks: Rare (<span class="text-green">Green</span>) or Very Rare (<span class="text-purple">Purple</span>)</li>
              <li>Teachable Perks: Teachable (<span class="text-orange">Orange</span>)</li>
            </ul>
            
          </div>
        </div>
        <h3 class="section-subheading mt-40">Unique &amp; Teachable Perks</h3>
        <div class="row">
          <div class="col-12">
            <p>ตัวละครทุกตัวมี Perks ที่ไม่ซ้ำกันสามตัวที่สามารถปลดล็อกได้
              Bloodweb ที่ระดับ <span class="text-orange">30, 35, &amp; 40</span> ตัวอักษรจะพบรุ่น Teachable หนึ่งใน
              Perks ที่ไม่ซ้ำกันของพวกเขาใน Bloodweb ของพวกเขา เมื่อปลดล็อคแล้วอักขระอื่น ๆ จะสามารถหา Perk ใน Bloodwebs ได้</p>
          </div>
        </div>
        <h3 class="section-subheading mt-40">Perks</h3>
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
                $sql = "SELECT PerkImage,PerkName,PerkDescription FROM perks";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    while($data = mysqli_fetch_assoc($result)){
            ?>
            <tr>
              <td class="text-center"><img class="img-fluid" width="80" src="<?=$data["PerkImage"]?>"></td>
              <td class="text-center"><?=$data["PerkName"]?></td>
              <td><?=$data["PerkDescription"]?></td>
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
