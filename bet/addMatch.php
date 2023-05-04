<?php
date_default_timezone_set('Europe/Sofia');
@include 'connection.php';


if (isset($_POST['submitMatch'])) {
    $match = 1;
    $championship = $_POST["championship"];
    $team1 = $_POST['team1'];
    $team2 = $_POST['team2'];
    $date = $_POST['date'];
    $formatted_date = date('Y-m-d', strtotime($date));

    $timeInTheMoment = date('H:i:s');
    $time = date('H:i:s', strtotime($_POST['time']));

    $todayDate = date("Y-m-d");

    if ($championship == "Premier League") {
        $country_id = 1;
        $champ = "premier_league";
    } else if ($championship == "Championship") {
        $country_id = 2;
        $champ = "championship";
    } else if ($championship == "La Liga") {
        $country_id = 3;
        $champ = "la_liga";
    } else if ($championship == "La Liga 2") {
        $country_id = 4;
        $champ = "la_liga_2";
    } else if ($championship == "Seria A") {
        $country_id = 5;
        $champ = "seria_a";
    } else if ($championship == "Seria B") {
        $country_id = 6;
        $champ = "seria_b";
    }

    $select = "SELECT * FROM schedule";
    $result = mysqli_query($conn, $select);
    $dateCounter = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $dates = $row['date'];
        if ($dates == $todayDate) {
            $dateCounter++;
        }
    }
    if ($dateCounter > 10) {
        $error[] = "Вече са добавени 10 мача в този ден!";
    } else {





        $maxMatches = 0;

        $select = "SELECT * FROM schedule 
    WHERE (team1 = '$team1' OR team2 = '$team1' OR team1 = '$team2' OR team2 = '$team2')
    AND date = '$formatted_date';
    ";
        $result = mysqli_query($conn, $select);

        if (mysqli_num_rows($result) > 0) {
            $error[] = 'Един от отборите вече е играл или ще играе на тази дата!';
        } else {


            $select = "SELECT * FROM schedule WHERE team1 = '$team1' and team2 = '$team2'";

            $result = mysqli_query($conn, $select);

            if (mysqli_num_rows($result) > 0) {
                $error[] = 'Мачът вече се е излъчвал!';
            } else {



                if (($formatted_date < $todayDate) || ($formatted_date < $todayDate && $timeInTheMoment >= $time) || ($formatted_date == $todayDate && $timeInTheMoment >= $time)) {
                    $error[] = 'Въведете днескашна или следваща дата и предстоящ час!!';
                } else {


                    $select = "SELECT * FROM $champ WHERE team = '$team1' OR team = '$team2'";
                    $result = mysqli_query($conn, $select);

                    if (mysqli_num_rows($result) < 2) {
                        $error[] = 'Отборите не са от едно и също първенство или не съществуват!';
                    } else {
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $count++;
                            $matches = $row['matches'];
                            $nextMatches = $row['nextMatches'];
                            $all = $matches + $nextMatches;
                            // $difference = $maxMatches - $all;
                            if ($count == 1) {
                                $_SESSION['firstTeam'] = $all;
                            } else if ($count == 2) {
                                $_SESSION['secondTeam'] = $all;
                            }
                        }
                        if (($_SESSION['firstTeam'] - $_SESSION['secondTeam'] == 0) || ($_SESSION['secondTeam'] - $_SESSION['firstTeam'] == 0)) {
                            $insert = "INSERT INTO schedule(team1, team2, date, time, country_id) VALUES ('$team1', '$team2', '$formatted_date', '$time', '$country_id')";
                            mysqli_query($conn, $insert);
                            $match = 1;
                            $query = "UPDATE " . $champ . " SET nextMatches = nextMatches + ? WHERE team = ?";
                            $statement = $conn->prepare($query);
                            $statement->bind_param("is", $match, $team1);
                            $statement->execute();
                            $statement->bind_param("is", $match, $team2);
                            $statement->execute();
                            $statement->close();
                            // $update = "UPDATE $champ SET matches='$match' WHERE team='$team1' OR team='$team2'";
                            // $result = mysqli_query($conn, $update);;
                            header('location: index.php');

                        } else {
                            $error[] = "Един от отборите има 1 мач повече от другия! Върнете се и проверете класирането!";



                        }

                    }

                }
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
    <title>Add match</title>

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
                                    <h2 class="text-uppercase text-center mb-5">ДОБАВИ МАЧ</h2>

                                    <div class="form-outline mb-4">
                                        <?php
                                        if (isset($error)) {
                                            foreach ($error as $error) {
                                                echo '<p style = "text-align: center">' . $error . '</p>';
                                                break;
                                            }
                                        }

                                        ?>

                                        <select class="form-select" id="championship" name="championship" required>
                                            <option value="" disabled selected>Избери шампионат</option>
                                            <option value="Premier League">Премиър лийг (Англия)</option>
                                            <option value="Championship">Чемпиъншип (Англия)</option>
                                            <option value="La Liga">Ла Лига (Испания)</option>
                                            <option value="La Liga 2">Ла Лига 2 (Испания)</option>
                                            <option value="Seria A">Сериа А (Италия)</option>
                                            <option value="Seria B">Сериа Б (Италия)</option>
                                        </select>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" id="form3Example2cg" class="form-control form-control-lg"
                                            name="team1" required placeholder="Въведи отбор-домакин (с главна буква)" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" id="form3Example3cg" class="form-control form-control-lg"
                                            name="team2" required placeholder="Въведи отбор-гост (с главна буква)" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="date" id="form3Example4cg" class="form-control form-control-lg"
                                            name="date" required placeholder="Въведи дата" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="time" id="form3Example5cg" class="form-control form-control-lg"
                                            name="time" required placeholder="Въведи час" step="1" />
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-lg btn-secondary me-2 dtbutton"
                                            name="submitMatch">Добави мач</button>
                                        <button class="btn btn-lg btn-secondary me-2 dtbutton"
                                            onclick="location.href='index.php'">Върни
                                            се</button>
                                    </div>
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