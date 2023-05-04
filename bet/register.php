<?php
@include 'connection.php';


if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($conn, $_POST["username"]);
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $pass = md5($_POST["password"]);
  $cpass = md5($_POST["cpassword"]);
  $ownMoney = $_POST['ownmoney'];
  $deposited = 0;

  $select = "SELECT * FROM users WHERE email = '$email' OR username = '$username'";

  $result = mysqli_query($conn, $select);

  if (mysqli_num_rows($result) > 0) {
    $error[] = 'Вече има такъв потребител!';
  } else {
    if ($pass != $cpass) {
      $error[] = 'Паролите не съвпаднаха!';
    } else {
      $emailLength = strlen($email);
      $passLength = strlen($pass);
      $usernameLength = strlen($username);

      if ($emailLength > 0 && $passLength > 0 && $usernameLength > 0) {
        $insert = "INSERT into users(username,email, password, ownMoney, moneyInPage) VALUES ('$username','$email', '$pass', '$ownMoney', '$deposited')";
        $_SESSION['ownMoney'] = $ownMoney;
        mysqli_query($conn, $insert);
        header('location: loginPage.php');
      } else {
        $error[] = 'Въведи данни!';
      }
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>

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
                  <h2 class="text-uppercase text-center mb-5">Създайте профил</h2>


                  <div class="form-outline mb-4">
                    <?php
                    if (isset($error)) {
                      foreach ($error as $error) {
                        echo '<p style = "text-align: center">' . $error . '</p>';
                      }
                    }
                    ?>
                    <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="username"
                      required placeholder="въведете потребителско име" />
                  </div>

                  <div class="form-outline mb-4">
                    <input type="email" id="form3Example3cg" class="form-control form-control-lg" name="email" required
                      placeholder="въведете имейл" />
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="form3Example4cg" class="form-control form-control-lg" name="password"
                      required placeholder="въведете парола" />
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="form3Example4cdg" class="form-control form-control-lg" name="cpassword"
                      required placeholder="потвърдете парола" />
                  </div>
                  <div class="form-outline mb-4">
                    <input type="number" id="form3Example3cg" class="form-control form-control-lg" name="ownmoney" required
                      placeholder="въведете личен баланс" />
                  </div>

                  <div class="d-flex justify-content-center">
                  <button type="submit" class="btn btn-lg btn-secondary me-2 regLogButtons"
                      name="submit">Регистрация</button>
                  </div>

                  <p class="text-center text-muted mt-3 mb-0">Вече имате профил? <a href="loginPage.php"
                      class="fw-bold text-body"><u>Влезте от тук!</u></a></p>
                </form>

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