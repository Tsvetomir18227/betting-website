<?php
date_default_timezone_set('Europe/Sofia');

function selectC()
{
  if (isset($_POST['premier_league'])) {
    $champ = 'Премиър Лийг';
    //  $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.championship = 'Premier League'";
  } else if (isset($_POST['championship'])) {
    $champ = 'Чемпиъншип';
    // $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.championship = 'Championship'";
  } else if (isset($_POST['league1'])) {
    $champ = 'Ла Лига';
    //  $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.championship = 'League 1'";
  } else if (isset($_POST['league2'])) {
    $champ = 'Ла Лига 2';

    //  $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.championship = 'League 1'";
  } else if (isset($_POST['seriaA'])) {
    $champ = 'Сериа А';
    //  $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.championship = 'League 1'";
  } else if (isset($_POST['seriaB'])) {
    $champ = 'Сериа Б';
    //  $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.championship = 'League 1'";
  } else {
    $champ = "nothing";
  }

  return $champ;
}

function selectN()
{
  if (isset($_POST['allE'])) {
    $name = 'Англия';
    //  $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.championship = 'League 1'";
  } else if (isset($_POST['allS'])) {
    $name = 'Испания';
    //  $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.championship = 'League 1'";
  } else if (isset($_POST['allI'])) {
    $name = 'Италия';
    //  $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.championship = 'League 1'";
  } else {
    $name = "nothing";
  }

  return $name;
}




//START OF TODAY EVENTS--------------------------------------------------------------------------------------------------------------------------------------------



function todayEvents()
{

  require 'connection.php';
  $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id";
  $champ = 'nothing';
  $champ = selectC();
  $name = 'nothing';
  $name = selectN();


  if ($champ != 'nothing') {
    $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.championship = '$champ'";
  }
  if ($name != 'nothing') {
    $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.name = '$name'";


  }

  $todayDate = date("Y-m-d");
  $timeInTheMoment = date("H:i:s");

  $all = $conn->query($sql);

  $count = 0;

  //$result = '<table class = "border" style="width: 100%;>';
  // $result = '<form action = ""; method = "post">';
  $result = '<table class="table table-striped table-bordered table-hover">';
  //echo $timeInTheMoment;
  $result .= '<tr>';
  $result .= '<th>ПЪРВЕНСТВО</th>';
  $result .= '<th>МАЧ</th>';
  $result .= '<th> ДОМАКИН | РАВЕН | ГОСТ </th>';
  $result .= '<th>НАЧАЛО</th>';
  $result .= "</tr>";



  

  while ($row = mysqli_fetch_assoc($all)) {
    $country = $row["name"];
    $championship = $row["championship"];
    $team1 = $row["team1"];
    $team2 = $row["team2"];
    $startDate = $row["date"];
    $startTime = $row["time"];
    $score1 = rand(0, 4);
    $score2 = rand(0, 4);
    $countryId = $row['id'];

    if($countryId == 1){
      $championship_table = 'premier_league';
    } else if ($countryId == 2){
      $championship_table = 'championship';
    } else if ($countryId == 3){
      $championship_table = 'la_liga';
    } else if ($countryId == 4){
      $championship_table = 'la_liga_2';
    } else if ($countryId == 5){
      $championship_table = 'seria_a';
    } else if ($countryId == 6){
      $championship_table = 'seria_b';
    }



    if ($todayDate == $startDate) {
      if ($timeInTheMoment <= $startTime) { //Преди да започне мача
        $_SESSION['index'] = $row['index'];
        $count++;
        $result .= '<tr bgcolor="yellow" class="hoverColorYellow">';
        $result .= '<td>' . $championship . '</td>';
        $result .= '<td>' . $team1 . ' срещу ' . $team2 . '</td>';
        $result .= '<td>
<form method="POST" class="bet-form" id="bet-form_' . $row['index'] . '">
  <div class="button-container">
    <button class="btn btn-secondary btn-sm button bet-button" name="bet1_' . $row['index'] . '" id="bet1" onclick="updateChosenTeam(' . $row['index'] . ', 1)">1</button>
    <button class="btn btn-secondary btn-sm button bet-button" name="betx_' . $row['index'] . '" id="betx" onclick="updateChosenTeam(' . $row['index'] . ', \'x\')">X</button>
    <button class="btn btn-secondary btn-sm button bet-button" name="bet2_' . $row['index'] . '" id="bet2" onclick="updateChosenTeam(' . $row['index'] . ', 2)">2</button>
  </div>';
        if (isset($_SESSION['loggedIn'])) {
          $result .= '<div class="bet-amount-container">
    <input type="number" id="submittedNumber" name="betAmount_' . $row['index'] . '" placeholder="Заложена сума" required>
    <input type="hidden" name="chosenTeam_' . $row['index'] . '" id="chosenTeam_' . $row['index'] . '" value="">
    <input type="hidden" name="matchId_' . $row['index'] . '" value="' . $row['index'] . '">
    <button class="btn btn-secondary btn-sm submit-button" type="submit" name="submitBet_' . $row['index'] . '">Създай залог</button>
  </div>';

          $result .= '</form></td>';

          //to update chosenTeam value
          $result .= '<script>
  function updateChosenTeam(matchId, chosenTeam) {
    document.getElementById("chosenTeam_" + matchId).value = chosenTeam;
  }

  document.addEventListener("DOMContentLoaded", function() {
    const forms = document.getElementsByClassName("bet-form");
    for (let i = 0; i < forms.length; i++) {
      forms[i].addEventListener("submit", function(event) {
        const betAmount = event.target.elements.submittedNumber;
        if (betAmount.value < 1) {
          event.preventDefault();
          alert("Въведете валидна сума.");
        }
        else if (betAmount.value > ' . $_SESSION['moneyInPage'] . ') {
          event.preventDefault();
          alert("Нямате достатъчно баланс.");
        } 
      });
    }
  });
</script>';
        }

        $result .= '<td class="align-middle">' . $startTime . '</td>';
        $result .= '</tr>';

        if (isset($_SESSION['loggedIn'])) {
          $id = $_SESSION['id'];
      
          if (isset($_POST['submitBet_' . $row['index']])) {
            if ($_POST['chosenTeam_' . $row['index']] === '') {
              $result .= '<script>
              document.addEventListener("DOMContentLoaded", function() {
                event.preventDefault();
                alert("Изберете за кой отбор искате да заложите или за равенство.");
                });
              </script>';
            } else {
              

              $betAmount = $_POST['betAmount_' . $row['index']];
             // $_SESSION['bettedMoney'][$id] = $betAmount;
              $chosenTeam = $_POST['chosenTeam_' . $row['index']];
              $matchId = $_POST['matchId_' . $row['index']];
      
      
      
              // Check if the user has already placed a bet for this match
              // $query = "SELECT * FROM bets  AS s INNER JOIN schedule AS c ON s.matchid = c.index WHERE matchid = '$matchId' AND userid = '$id'";
              $query = "SELECT * FROM bets WHERE matchid = '$matchId' AND userid = '$id'";
              $res = mysqli_query($conn, $query);
      
              if (mysqli_num_rows($res) == 0) {
                // Insert the new bet
                
                $insert = "INSERT INTO bets (team1, team2, winner, bet_amount, userid, matchid,betDate) VALUES ('$team1', '$team2', '$chosenTeam', '$betAmount', '$id', '$matchId','$todayDate')";
                mysqli_query($conn, $insert);
      
                $myMoney = $_SESSION['moneyInPage'];
      
                $query = "UPDATE users SET moneyInPage = moneyInPage - ? WHERE id = ?";
                $statement = $conn->prepare($query);
                $statement->bind_param("ii", $betAmount, $id);
                $statement->execute();
      
                $select = "SELECT * FROM users WHERE id = '$id'";
                $res = mysqli_query($conn, $select);
      
                if (mysqli_num_rows($res) > 0) {
                  $row = mysqli_fetch_assoc($res);
                  $_SESSION['moneyInPage'] = $row['moneyInPage'];
      
                }
                $result .= '<script>
                document.addEventListener("DOMContentLoaded", function() {
                event.preventDefault();
                alert("Успешен залог!");
                });
                </script>';
      
              } else {
                $result .= '<script>
              document.addEventListener("DOMContentLoaded", function() {
              event.preventDefault();
              alert("Вече заложихте на този мач.");
              });
              </script>';
              }
              
            }
      
           
          }
      
      
      
      
      
        }

      } else { // След като е завършил мача

        $query = "UPDATE schedule SET score1 = ?, score2 = ? WHERE '$timeInTheMoment' > '$startTime' AND team1 = '$team1'  AND team2 = '$team2' AND score1 IS NULL";
        $statement = $conn->prepare($query);
        $statement->bind_param("ii", $score1, $score2);
        $statement->execute();
        $statement->close();

        $select = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE '$timeInTheMoment' > '$startTime' AND team1 = '$team1'  AND team2 = '$team2' AND score1 IS not NULL";
        $result1 = mysqli_query($conn, $select);

        

        if (mysqli_num_rows($result1) > 0) {
          $row = mysqli_fetch_assoc($result1);
          $championship = $row["championship"];
          $team1 = $row["team1"];
          $team2 = $row["team2"];
          $first = $row['score1'];
          $second = $row['score2'];
          


        }

        // echo 'Executed';
        // $result .= '<tr>';
        // $result .= "<td>" . $championship . "</td>";
        // $result .= "<td>" . $team1 . " vs " . $team2 . "</td>";
        // $result .= "<td></td>";
        // $result .= '<td>' . "Приключил: " . '</td>';
        // $result .= '<td>' . $first . ':' . $second . '</td>';
        // $result .= "</tr>";

        $match = 1;



        if ($first > $second) {
          $points1 = 3;
          $points2 = 0;
          $win1 = 1;
          $win2 = 0;
          $tie1 = 0;
          $tie2 = 0;
          $lose1 = 0;
          $lose2 = 1;
        } else if ($first < $second) {
          $points1 = 0;
          $points2 = 3;
          $win1 = 0;
          $win2 = 1;
          $tie1 = 0;
          $tie2 = 0;
          $lose1 = 1;
          $lose2 = 0;
        } else {
          $points1 = 1;
          $points2 = 1;
          $win1 = 0;
          $win2 = 0;
          $tie1 = 1;
          $tie2 = 1;
          $lose1 = 0;
          $lose2 = 0;
        }



        $gd1 = $first - $second;
        $gd2 = $second - $first;

        $nextMatches = 1;
        //  echo $points1,$points2;
        if ($points1 < 5 && $timeInTheMoment > $startTime && $todayDate == $startDate) {
          if (!isset($_SESSION['addedtoleaderboard'][$team1][$team2])) {
          //  $query = "UPDATE " . $championship_table . " SET matches = matches + ?, points = points + ?, gd = gd + ?, g = g + ?, d = d + ?, wins = wins + ?, ties = ties + ?, loses = loses + ? WHERE team = ?";
           $query = "UPDATE " . $championship_table . " SET matches = matches + ?, wins = wins + ?, ties = ties + ?, loses = loses + ?, gd = gd + ?, g = g + ?, d = d + ?, points = points + ?, nextMatches = nextMatches - ? WHERE team = ?";
            $statement = $conn->prepare($query);
            //  echo $win1, $tie1, $lose1;
            // echo $query1;
            $statement->bind_param("iiiiiiiiis", $match, $win1, $tie1, $lose1, $gd1, $first, $second, $points1, $nextMatches, $team1);
            $statement->execute();
            $statement->bind_param("iiiiiiiiis", $match, $win2, $tie2, $lose2, $gd2, $second, $first, $points2, $nextMatches, $team2);
            $statement->execute();
            $statement->close();

            $_SESSION['addedtoleaderboard'][$team1][$team2] = true;
          }
        }
      }

    }
  }
  
  $result .= '</table>';
  if ($count === 0) {
    $result .= '<strong>Днес няма мачове!</strong>';
  }
  if(isset($_SESSION['loggedIn']) && $_SESSION['adminId'] == 1){
    $result .= '<div class="d-flex justify-content-center">
                    <button class="btn btn-lg btn-secondary me-2 dtbutton" onclick="location.href=\'addMatch.php\'">Добави мач</button>
                  </div>';

  }
  $result .= '<form>';





  



  return $result;
}






// END OF TODAY EVENTS------------------------------------------------------------------------------------------------------------------------------------------



function pastEvents()
{
  require 'connection.php';
  $count = 0;
  $matchCounter = 0;
  $todayDate = date("Y-m-d");
  $timeInTheMoment = date("H:i:s");
  $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id 
  WHERE date < '$todayDate' OR date = '$todayDate' AND time < '$timeInTheMoment' ORDER BY date DESC, time DESC";
  $champ = 'nothing';
  $champ = selectC();
  $name = 'nothing';
  $name = selectN();

  if ($champ != 'nothing') {
    $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.championship = '$champ' AND ((date < '$todayDate') OR (date = '$todayDate' AND time < '$timeInTheMoment')) ORDER BY date DESC, time DESC";

  }
  if ($name != 'nothing') {
    $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.name = '$name' AND ((date < '$todayDate') OR (date = '$todayDate' AND time < '$timeInTheMoment')) ORDER BY date DESC, time DESC";

  }
  if(isset($_POST['submitDate'])){
    $selectedDate = $_POST['pastDate'];
    $formatted_date = date('Y-m-d', strtotime($selectedDate));
    $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE date = '$formatted_date' ORDER BY date DESC, time DESC";  
  }
  $all = $conn->query($sql);

  //$result = '<table class = "border" style="width: 100%;>';
   
$result = '<table class="table table-striped table-bordered table-hover">';
$result .= '<tr>';
$result .= '<th>ПЪРВЕНСТВО</th>';
$result .= '<th>МАЧ</th>';
$result .= '<th>ДАТА</th>';
$result .= '<th>ЗАВЪРШИЛ (ЧАС)</th>';
$result .= '<th>РЕЗУЛТАТ</th>';
$result .= '</tr>';

  $matchCounter = 0;
  while ($row = mysqli_fetch_assoc($all)) {
    $count++;
    $matchCounter++;
    if ($matchCounter > 10) {
      break;
    }

    $country = $row["name"];
    $championship = $row["championship"];
    $team1 = $row["team1"];
    $team2 = $row["team2"];
    $startDate = $row["date"];
    $startTime = $row["time"];
    $first = $row['score1'];
    $second = $row['score2'];
    $score1 = rand(0, 4);
    $score2 = rand(0, 4);
    $query = "UPDATE schedule SET score1 = ?, score2 = ? WHERE '$timeInTheMoment' > '$startTime' AND team1 = '$team1'  AND team2 = '$team2' AND score1 IS NULL";
    $statement = $conn->prepare($query);
    $statement->bind_param("ii", $score1, $score2);
    $statement->execute();
    $statement->close();

    $select = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE '$timeInTheMoment' > '$startTime' AND team1 = '$team1'  AND team2 = '$team2' AND score1 IS not NULL";
    
    
    $result1 = mysqli_query($conn, $select);
    if (mysqli_num_rows($result1) > 0) {
      $row = mysqli_fetch_assoc($result1);
      $first = $row['score1'];
      $second = $row['score2'];


    }
    $result .= '<tr>';
    $result .= '<td>' . $championship . '</td>';
    $result .= '<td>' . $team1 . " срещу " . $team2 . '</td>';
    $result .= '<td>' . $startDate . '</td>';
    $result .= '<td>' . $startTime . '</td>';
    $result .= '<td>' . $first . ':' . $second . '</td>';
    $result .= '</tr>';


  }
  $result .= '</table>';
  if ($count === 0) {
    $result .= '<strong>Скоро не са излъчвани мачове.</strong>';
  }
  $result .= '<form method="post">
<div class="form-outline mb-6 mt-2 d-flex align-items-center align-middle justify-content-center">
  <input type="date" id="form3Example4cg" name="pastDate" style="margin-right: 10px;"/> <button class="btn btn-secondary btn-sm submit-button" type="submit" name="submitDate">Избери дата</button>
  </div>
</form>';

  

  return $result;


}


//END OF PAST EVENTS----------------------------------------------------------------------------------------------------------


function nextEvents(){
  require 'connection.php';
  $count = 0;
  $todayDate = date("Y-m-d");
  $timeInTheMoment = date("H:i:s");
  $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id
   WHERE '$todayDate' < date or '$todayDate' = date and '$timeInTheMoment' < time";
  $champ = 'nothing';
  $champ = selectC();
  $name = 'nothing';
  $name = selectN();

  if ($champ != 'nothing') {
    $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.championship = '$champ' AND (date > '$todayDate' OR (date = '$todayDate' AND time > '$timeInTheMoment')) ORDER BY date, time";
  }
  if ($name != 'nothing') {
    $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.name = '$name' AND (date > '$todayDate' OR (date = '$todayDate' AND time > '$timeInTheMoment')) ORDER BY date, time";
  }

  if(isset($_POST['submitDate'])){
    $selectedDate = $_POST['pastDate'];
    $formatted_date = date('Y-m-d', strtotime($selectedDate));
  //  $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE date = '$formatted_date' and '$timeInTheMoment' < time";
    $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE '$formatted_date' = date and (date > '$todayDate' OR (date = '$todayDate' AND time > '$timeInTheMoment'))";
    
  }
  $all = $conn->query($sql);

  //$result = '<table class = "border" style="width: 100%;>';
  $result = '<table class="table table-striped table-bordered table-hover">';
  $result .= '<tr>';
  $result .= '<th>ПЪРВЕНСТВО</th>';
  $result .= '<th>МАЧ</th>';
  $result .= '<th>ДОМАКИН | РАВЕН | ГОСТ</th>';
  $result .= '<th>ДАТА</th>';
  $result .= '<th>ЧАС</th>';
  $result .= "</tr>";

  $matchCounter = 0;
  while ($row = mysqli_fetch_assoc($all)) {
    $matchCounter++;
    if ($matchCounter > 10) {
      break;
    }

    $country = $row["name"];
    $championship = $row["championship"];
    $team1 = $row["team1"];
    $team2 = $row["team2"];
    $startDate = $row["date"];
    $startTime = $row["time"];
    $first = $row['score1'];
    $second = $row['score2'];

    $_SESSION['index'] = $row['index'];
    $count++;
    $result .= '<tr bgcolor="yellow" class="hoverColorYellow">';
    $result .= '<td>' . $championship . '</td>';
    $result .= '<td>' . $team1 . ' срещу ' . $team2 . '</td>';
    $result .= '<td>
<form method="POST" class="bet-form" id="bet-form_' . $row['index'] . '">
<div class="button-container">
<button class="btn btn-secondary btn-sm button bet-button" name="bet1_' . $row['index'] . '" id="bet1" onclick="updateChosenTeam(' . $row['index'] . ', 1)">1</button>
<button class="btn btn-secondary btn-sm button bet-button" name="betx_' . $row['index'] . '" id="betx" onclick="updateChosenTeam(' . $row['index'] . ', \'x\')">X</button>
<button class="btn btn-secondary btn-sm button bet-button" name="bet2_' . $row['index'] . '" id="bet2" onclick="updateChosenTeam(' . $row['index'] . ', 2)">2</button>
</div>';
    if (isset($_SESSION['loggedIn'])) {
      $result .= '<div class="bet-amount-container">
<input type="number" id="submittedNumber" name="betAmount_' . $row['index'] . '" placeholder="Заложена сума" required>
<input type="hidden" name="chosenTeam_' . $row['index'] . '" id="chosenTeam_' . $row['index'] . '" value="">
<input type="hidden" name="matchId_' . $row['index'] . '" value="' . $row['index'] . '">
<button class="btn btn-secondary btn-sm submit-button" type="submit" name="submitBet_' . $row['index'] . '">Създай залог</button>
</div>';

      $result .= '</form></td>';

      // Add JavaScript to update chosenTeam value
      $result .= '<script>
function updateChosenTeam(matchId, chosenTeam) {
document.getElementById("chosenTeam_" + matchId).value = chosenTeam;
}

document.addEventListener("DOMContentLoaded", function() {
const forms = document.getElementsByClassName("bet-form");
for (let i = 0; i < forms.length; i++) {
  forms[i].addEventListener("submit", function(event) {
    const betAmount = event.target.elements.submittedNumber;
    if (betAmount.value < 1) {
      event.preventDefault();
      alert("Въведете валидна сума.");
    }
    else if (betAmount.value > ' . $_SESSION['moneyInPage'] . ') {
      event.preventDefault();
      alert("Нямате достатъчно баланс.");
    } 
  });
}
});
</script>';
    }
    $result .= '<td>' . $startDate . '</td>';
    $result .= '<td>' . $startTime . '</td>';
    $result .= '</tr>';

    if (isset($_SESSION['loggedIn'])) {
      $id = $_SESSION['id'];
  
      if (isset($_POST['submitBet_' . $row['index']])) {
        if ($_POST['chosenTeam_' . $row['index']] === '') {
          $result .= '<script>
          document.addEventListener("DOMContentLoaded", function() {
            event.preventDefault();
            alert("Изберете за кой отбор искате да заложите или за равенство.");
            });
          </script>';
        } else {
  
          $betAmount = $_POST['betAmount_' . $row['index']];
          $chosenTeam = $_POST['chosenTeam_' . $row['index']];
          $matchId = $_POST['matchId_' . $row['index']];
  
  
  
          // Check if the user has already placed a bet for this match
          $query = "SELECT * FROM bets  AS s INNER JOIN schedule AS c ON s.matchid = c.index WHERE matchid = '$matchId' AND userid = '$id'";
          $res = mysqli_query($conn, $query);
  
          if (mysqli_num_rows($res) == 0) {
            // Insert the new bet
            $insert = "INSERT INTO bets (team1, team2, winner, bet_amount, userid, matchid) VALUES ('$team1', '$team2', '$chosenTeam', '$betAmount', '$id', '$matchId', '$todayDate')";
            mysqli_query($conn, $insert);
  
            $myMoney = $_SESSION['moneyInPage'];
  
            $query = "UPDATE users SET moneyInPage = moneyInPage - ? WHERE id = ?";
            $statement = $conn->prepare($query);
            $statement->bind_param("ii", $betAmount, $id);
            $statement->execute();
  
            $select = "SELECT * FROM users WHERE id = '$id'";
            $res = mysqli_query($conn, $select);
  
            if (mysqli_num_rows($res) > 0) {
              $row = mysqli_fetch_assoc($res);
              $_SESSION['moneyInPage'] = $row['moneyInPage'];
  
            }
            $result .= '<script>
                document.addEventListener("DOMContentLoaded", function() {
                event.preventDefault();
                alert("Успешен залог!");
                });
                </script>';
  
          } else {
            $result .= '<script>
          document.addEventListener("DOMContentLoaded", function() {
          event.preventDefault();
          alert("Вече заложихте на този мач.");
          });
          </script>';
          }
        }
  
       
      }
  
  
  
  
  
    }

  }
  $result .= '</table>';
  if ($count === 0) {
    $result .= '<strong>Няма мачове в този ден.</strong>';
  }
  $result .= '<form method="post">
<div class="form-outline mb-6 mt-2 d-flex align-items-center align-middle justify-content-center">
  <input type="date" id="form3Example4cg" name="pastDate" style="margin-right: 10px;"/> <button class="btn btn-secondary btn-sm submit-button" type="submit" name="submitDate">Избери дата</button>
  </div>
</form>';

  



  return $result;


}






//END OF NEXT EVENTS-------------------------------------------------------------------------------------------

// function showBet($team1, $team2,$row,$result)
// {
//   require 'connection.php';
//   if (isset($_SESSION['loggedIn'])) {
//     $id = $_SESSION['id'];

//     if (isset($_POST['submitBet_' . $row['index']])) {
//       if ($_POST['chosenTeam_' . $row['index']] === '') {
//         $result .= '<script>
//         document.addEventListener("DOMContentLoaded", function() {
//           event.preventDefault();
//           alert("Изберете за кой отбор искате да заложите или за равенство.");
//           });
//         </script>';
//       } else {

//         $betAmount = $_POST['betAmount_' . $row['index']];
//         $chosenTeam = $_POST['chosenTeam_' . $row['index']];
//         $matchId = $_POST['matchId_' . $row['index']];



//         // Check if the user has already placed a bet for this match
//         $query = "SELECT * FROM bets  AS s INNER JOIN schedule AS c ON s.matchid = c.index WHERE matchid = '$matchId' AND userid = '$id'";
//         $res = mysqli_query($conn, $query);

//         if (mysqli_num_rows($res) == 0) {
//           // Insert the new bet
//           $insert = "INSERT INTO bets (team1, team2, winner, bet_amount, userid, matchid) VALUES ('$team1', '$team2', '$chosenTeam', '$betAmount', '$id', '$matchId')";
//           mysqli_query($conn, $insert);

//           $myMoney = $_SESSION['moneyInPage'];

//           $query = "UPDATE users SET moneyInPage = moneyInPage - ? WHERE id = ?";
//           $statement = $conn->prepare($query);
//           $statement->bind_param("ii", $betAmount, $id);
//           $statement->execute();

//           $select = "SELECT * FROM users WHERE id = '$id'";
//           $res = mysqli_query($conn, $select);

//           if (mysqli_num_rows($res) > 0) {
//             $row = mysqli_fetch_assoc($res);
//             $_SESSION['moneyInPage'] = $row['moneyInPage'];

//           }
//           $result .= '<script>
//               document.addEventListener("DOMContentLoaded", function() {
//               event.preventDefault();
//               alert("Успешен залог!");
//               });
//               </script>';

//         } else {
//           $result .= '<script>
//         document.addEventListener("DOMContentLoaded", function() {
//         event.preventDefault();
//         alert("Вече заложихте на този мач.");
//         });
//         </script>';
//         }
//       }

     
//     }





//   }
// }

?>