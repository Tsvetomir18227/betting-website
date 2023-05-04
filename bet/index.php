<?php
include 'functions.php';
include 'login_logout.php';
include 'depositWithdrawalButtons.php';
include 'leaderboard.php';
include 'bets.php';

session_start();

?>

<!doctype html>
<html lang="en">

<head>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="shortcut icon" type="image/x-icon" href="images/bet-logo.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BET WEBSITE</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">

</head>

<body>
  <script src="script.js"></script>
  <!--NAVBAR-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light py-3 example">
    <div class="container-fluid">
      <!-- <a class="navbar-brand" href="index.php" style="color: #fff"><strong>bet555</strong></a> -->
      <a href="index.php"><img src="images/bet555.png" style="height: 50px; margin-right: 10px;"></a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="?past=true" aria-current="page" style="color: #fff">Изминали събития</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php" style="color: #fff">Събития днес</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="?next=true" aria-current="page" style="color: #fff">Предстоящи събития</a>
          </li>

        </ul>

        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <?php
          if (isset($_SESSION['loggedIn'])) {
            ?>
            <li class="nav-item">
              <a class="nav-link active" href="?bets=true" aria-current="page" style="color: #fff">Мои залози</a>
            </li>
          </ul>

          <?php
          }
          ?>
        <ul class="navbar-nav mb-2 mb-lg-0">
          <?php echo loginLogOut(); ?>
        </ul>

      </div>
    </div>
  </nav>

  <!--//NAVBAR-->


  <div class="row">

    <!-- SPORT TYPE -->
    <div class="dropdown col divstyle">
      <a href="/" class="d-flex align-items-center pb-0 mb-0 link-body-emphasis text-decoration-none">

      </a>

      <ul class="list-unstyled ps-0 m-0">
        <li class="mb-1">
          <button class="btn dropdown-toggle selectors" data-bs-toggle="collapse" data-bs-target="#england-collapse"
            aria-expanded="false" style="letter-spacing: 2px; font-weight: bold;">
            Англия
          </button>
          <div class="collapse" id="england-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
              <form action="" method="post">
                <li>
                  <button class="dropdown-item selectors" name="allE"
                    style="letter-spacing: 2px; font-weight: bold;">Всички</button>
                </li>
                <li>
                  <button class="dropdown-item selectors" name="premier_league"
                    style="letter-spacing: 2px; font-weight: bold;">Премиър Лийг</button>
                </li>
                <li>
                  <button class="dropdown-item selectors" name="championship"
                    style="letter-spacing: 2px; font-weight: bold;">Чемпиъншип</button>
                </li>
              </form>

            </ul>
          </div>
        </li>
        <li class="mb-1">
          <button class="btn dropdown-toggle selectors" data-bs-toggle="collapse" data-bs-target="#spain-collapse"
            aria-expanded="false" style="letter-spacing: 2px; font-weight: bold;">
            Испания
          </button>
          <div class="collapse" id="spain-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
              <form action="" method="post">
                <li>
                  <button class="dropdown-item selectors" name="allS"
                    style="letter-spacing: 2px; font-weight: bold;">Всички</button>
                </li>
                <li>
                  <button class="dropdown-item selectors" name="league1"
                    style="letter-spacing: 2px; font-weight: bold;">Лига 1</button>
                </li>
                <li>
                  <button class="dropdown-item selectors" name="league2"
                    style="letter-spacing: 2px; font-weight: bold;">Лига 2</button>
                </li>
              </form>
            </ul>
          </div>
        </li>


        <li class="mb-1">
          <button class="btn dropdown-toggle selectors" data-bs-toggle="collapse" data-bs-target="#italy-collapse"
            aria-expanded="false" style="letter-spacing: 2px; font-weight: bold;">
            Италия
          </button>
          <div class="collapse" id="italy-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
              <form action="" method="post">
                <li>
                  <button class="dropdown-item selectors" name="allI"
                    style="letter-spacing: 2px; font-weight: bold;">Всички</button>
                </li>
                <li>
                  <button class="dropdown-item selectors" name="seriaA"
                    style="letter-spacing: 2px; font-weight: bold;">Сериа А</button>
                </li>
                <li>
                  <button class="dropdown-item selectors" name="seriaB"
                    style="letter-spacing: 2px; font-weight: bold;">Сериа Б</button>
                </li>
              </form>


            </ul>
          </div>
        </li>
      </ul>
    </div>





    <!-- //SPORT TYPE -->


    <!-- FOOTBALL MATCHES -->
    <div class="col-md-7 py-3 table-container text-center">
      <div class="table-responsive">
        <?php
        if (isset($_GET['past'])) {
          echo pastEvents();
        } else if (isset($_GET['next'])) {
          echo nextEvents();
        } else if (isset($_GET['bets'])) {
          echo bets();
        } else {
          echo todayEvents();
        }
        ?>
      </div>
    </div>
    <!-- //FOOTBALL MATCHES -->

    <div class="col order-last">
      <!-- Large button groups (default and split) -->
      <?php echo depositWithdrawal(); ?>
    </div>




  </div>


  <div class="row">
    <div class="container mt-3">
      <!-- <div class="col"> -->
        <?php echo leaderboard(); ?>
      <!-- </div> -->
    </div>
  </div>









  </div>

  <div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
      <p class="col-md-4 mb-0 text-muted">&copy; 2023 bet-555</p>

      <a href="/"
        class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
          <use xlink:href="#bootstrap" />
        </svg>
      </a>

      <p class="col-md-4 mb-0 text-muted">За контакти: cvetomirmutashki123@gmail.com</p>
      <a href="#">Отиди към началото</a>
    </footer>

  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>

</body>

</html>