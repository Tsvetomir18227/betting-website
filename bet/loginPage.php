<?php
include 'login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <style>

  </style>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="images/bet-logo.png">
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
                  <h2 class="text-uppercase text-center mb-5">ВХОД</h2>
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
                    <input type="password" id="form3Example4cg" class="form-control form-control-lg" required
                      placeholder="въведете парола" name="password" />
                  </div>

                  <div class="d-flex justify-content-center">
                  <button type="submit" class="btn btn-lg btn-secondary me-2 regLogButtons"
                      name="loginSubmit">Вход</button>
                  </div>

                  <p class="text-center text-muted mt-5 mb-0">Нямате профил? <a href="register.php"
                      class="fw-bold text-body"><u>Регистрирайте се от тук!</u></a></p>

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