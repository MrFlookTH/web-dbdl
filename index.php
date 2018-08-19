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
              <a class="nav-link js-scroll-trigger" href="#character">Characters</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#unlockable">Unlockable</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#HowToPlay">How To Play</a>
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
                <input class="form-control search-box" id="search" type="text" name="keyword" maxlength="50" placeholder="Search for..." autocomplete="off" required />
              </div>
              &nbsp;<button type="submit" class="btn btn-default" name="submit-search"><i class="fa fa-search"></i> Search</button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- Character -->
    <section class="bg-dark pt-0" id="character">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h2 class="section-heading"><img src="img/characters/icon.png" width="60"> The Characters</h2>
          </div>
        </div>

        <h3 class="section-subheading">The Survivors</h3>
        <div class="row">
          <?php
            require("php/connect.php");
            $sql = "SELECT CharacterId,CharacterPortraitImage,CharacterName FROM characters WHERE CharacterRole='Survivor'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                while($data = mysqli_fetch_assoc($result)){
        ?>
          <div class="col-md-3 col-sm-4 col-lg-2 col-4 card-item">
            <a class="card-link" href="character.php?id=<?=$data["CharacterId"]?>">
              <img class="img-fluid" src="<?=$data["CharacterPortraitImage"]?>" alt="<?=$data["CharacterName"]?>">
              <div class="card-caption">
                <p><?=$data["CharacterName"]?></p>
              </div>
            </a>
          </div>
          <?php }} ?>       
        </div>

        <h3 class="section-subheading">The Killers</h3>

        <div class="row">
          <?php
            $sql = "SELECT CharacterId,CharacterPortraitImage,CharacterName FROM characters WHERE CharacterRole='Killer'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                while($data = mysqli_fetch_assoc($result)){
          ?>
          <div class="col-md-3 col-sm-4 col-lg-2 col-4 card-item">
            <a class="card-link" href="character.php?id=<?=$data["CharacterId"]?>">
              <img class="img-fluid" src="<?=$data["CharacterPortraitImage"]?>" alt="<?=$data["CharacterName"]?>">
            </a>
            <div class="card-caption">
              <p><?=$data["CharacterName"]?></p>
            </div>
          </div> 
          <?php }} ?>
        
        </div>     
      </div>
    </section>

    <!-- Unlockable -->
    <section class="bg-dark" id="unlockable">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h2 class="section-heading">Unlockable</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 col-sm-4 col-lg-2 col-4 card-item">
            <a class="card-link" href="perks.php">
              <img class="img-fluid center" src="img/unlockable/icon-perk.png" alt="Perks">
            </a>
            <div class="card-caption">
              <p>Perks</p>
            </div>
          </div> 
          <div class="col-md-3 col-sm-4 col-lg-2 col-4 card-item">
              <a class="card-link" href="items.php">
                <img class="img-fluid center" src="img/unlockable/icon-item.png" alt="Items">
              </a>
              <div class="card-caption">
                <p>Items</p>
              </div>
          </div>
          <div class="col-md-3 col-sm-4 col-lg-2 col-4 card-item">
            <a class="card-link" href="daily_rituals.html">
              <img class="img-fluid center" src="img/unlockable/icon_dailyRituals.png" alt="daily-rituals">
            </a>
            <div class="card-caption">
              <p>daily-rituals</p>
            </div>
          </div>


        </div> 
        
      </div>
    </section>

    <!-- HowToPlay -->
    <section class="bg-dark" id="HowToPlay">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h2 class="section-heading">How To Play</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <ul class="timeline">
              <li>
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid center" src="img/gen.png" alt="">
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h4>เป้าหมาย</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted">ในแต่ละแผนที่จะมีเครื่องปั่นไฟที่ดับอยู่ทั้งหมด 7 เครื่อง ผู้รอดชีวิตทุกคนต้องช่วยกันทำให้เครื่องปั่นไฟนี้ติดครบ 5 เครื่อง จึงจะสามารถเปิดประตูบานใหญ่ที่ใช้สำหรับหนีออกจากแผนที่นั้นๆ</p>
                  </div>
                </div>
              </li>
              <li class="timeline-inverted">
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid center" src="img/run.png" alt="">
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h4>เอาชีวิตรอด</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted">ฆาตกรจะทำทุกวิถีทางเพื่อทำร้ายเรา ไม่ว่าจะเป็นจากการโจมตีต่างๆ รวมไปถึงกับดักที่แอบซ่อนอยู่ภายในแผนที่ เราต้องคอยสังเกตและวิ่งหนี</p>
                  </div>
                </div>
              </li>
              <li>
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid" src="img/hook.png" alt="">
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h4>ถูกแขวน</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted">เมื่อฆาตกรสามารถโจมตีเราจนล้มหรือจับเราได้ด้วยกับดัก ก็จะสามารถนำเรามาแขวนไว้ที่ Hook ได้ ถ้าปล่อยให้เวลาผ่านโดยไม่มีการช่วยเหลือเราก็จะโดน Hook นี้ทำร้ายจนตาย</p>
                  </div>
                </div>
              </li>
              <li class="timeline-inverted">
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid" src="img/help.png" alt="">
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h4>ช่วยเหลือ</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted">เมื่อเพื่อนถูกแขวนไว้บน Hook เราสามารถที่จะวิ่งไปช่วยอุ้มเพื่อนลงมาได้ โดยที่ผู้รอดชีวิตจะสามารถถูกแขวนได้คนละ 3 ครั้ง ถ้าครบ 3 ครั้งก็จะตายเลย</p>
                  </div>
                </div>
              </li>
              <li class="timeline-inverted">
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid center" src="img/exit.png" alt="">
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section class="bg-dark">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-6 mb-25">
              <div class="embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/hpQM2bgeDeY?rel=0" allowfullscreen></iframe>
              </div>
          </div>
          <div class="col-12 col-md-6">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/cBxAd7_yeeg?rel=0" allowfullscreen></iframe>
              </div>
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
