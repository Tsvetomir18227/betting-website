<?php
@include 'connection.php';
session_start();
if (isset($_POST['submitDeposit'])) {

  $withdrawaled = $_POST["deposit-sum"];
  $deposited = $_POST["deposit-sum"];
  $username = $_SESSION['username'];

  // Get the deposited sum and username from the POST request and session
  if ($deposited > 9 && $_SESSION['ownMoney'] > 9 && $_SESSION['ownMoney'] - $deposited >= 0) {
    //$query = "UPDATE users SET moneyInPage = moneyInPage + ? WHERE username = ?";
    $query = "UPDATE users SET moneyInPage = moneyInPage + ?, ownMoney = ownMoney - ? WHERE username = ?";
    // Prepare the SQL statement
    $statement = $conn->prepare($query);
    // Bind the parameters to the statement
    $statement->bind_param("iis", $deposited, $withdrawaled, $username);
    $statement->execute();

    $select = "SELECT * FROM users WHERE username = '$username'";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $_SESSION['ownMoney'] = $row['ownMoney'];
      $_SESSION['moneyInPage'] = $row['moneyInPage'];
    }

    //$select = "SELECT * FROM users WHERE username = '$username'";


    //$_SESSION['deposited'] = $deposited;
    header('location: index.php');

  } else if ($_SESSION['ownMoney'] <= 9 || $_SESSION['ownMoney'] - $deposited <= 0) {
    $error[] = 'Нямате достатъчно пари да депозирате!';
  } else {
    $error[] = 'Минимална сума за депозит е 10 лева!';
  }
}





?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Deposit</title>

  <link rel="shortcut icon" type="image/x-icon" href="images/bet-logo.png">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <section class="vh-100 bg-image example">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-9 col-lg-7 col-xl-6">
            <div class="card" style="border-radius: 15px;">
              <div class="card-body p-5">

                <form action="" method="post">
                  <h2 class="text-uppercase text-center mb-5">Депозиране</h2>
                  <div class="form-outline mb-4">
                    <?php
                    if (isset($error)) {
                      foreach ($error as $error) {
                        echo '<p style = "text-align: center">' . $error . '</p>';
                      }
                    }
                    ?>
                    <label class="form-label" for="deposit-sum">Сума за депозиране:</label>
                    <input type="number" id="deposit-sum" class="form-control form-control-lg" name="deposit-sum"
                      required placeholder="въведете сума за депозиране">
                  </div>
                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-lg btn-secondary me-2 dtbutton"
                      name="submitDeposit">Депозирай</button>
                    <button class="btn btn-lg btn-secondary me-2 dtbutton" onclick="location.href='index.php'">Върни
                      се</button>
                  </div>
                </form>
                <div class="container">
                  <p class="position-absolute bottom-0 start-0 mb-1 ms-3">Наличност:
                    <?php echo $_SESSION['ownMoney'] ?> лв.
                  </p>
                  <p class="position-absolute bottom-0 end-0 mb-1 ms-3">Баланс в сайта:
                    <?php echo $_SESSION['moneyInPage'] ?> лв.
                  </p>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>