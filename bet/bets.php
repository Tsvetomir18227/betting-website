<?php
date_default_timezone_set('Europe/Sofia');
// function updateResult($team1, $team2, $timeInTheMoment, $startTime)
// {
//   include 'connection.php';

//   $score1 = rand(0, 4);
//   $score2 = rand(0, 4);
//   $query = "UPDATE schedule SET score1 = ?, score2 = ? WHERE '$timeInTheMoment' > '$startTime' AND team1 = '$team1'  AND team2 = '$team2' AND score1 IS NULL";
//   $statement = $conn->prepare($query);
//   $statement->bind_param("ii", $score1, $score2);
//   $statement->execute();
//   $statement->close();

//   $select = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE '$timeInTheMoment' > '$startTime' AND team1 = '$team1'  AND team2 = '$team2' AND score1 IS not NULL";
//   $result1 = mysqli_query($conn, $select);

//   if (mysqli_num_rows($result1) > 0) {
//     $row = mysqli_fetch_assoc($result1);
//     $first = $row['score1'];
//     $second = $row['score2'];


//   }

// }
function bets()
{
  @include 'connection.php';
  if(isset($_SESSION['loggedIn'])){
    
    
  
  $id = $_SESSION['id'];
  $sql = "SELECT * FROM bets AS s INNER JOIN schedule AS c ON s.matchid = c.index where userid = '$id' order by date desc,time desc";
 
  if(isset($_POST['submitDate'])){
    $selectedDate = $_POST['pastDate'];
    $formatted_date = date('Y-m-d', strtotime($selectedDate));
    $sql = "SELECT * FROM bets AS s INNER JOIN schedule AS c ON s.matchid = c.index where userid = '$id' and betDate = '$formatted_date' order by id desc";
  }
  $all = $conn->query($sql);

  $result = '<table class="table table-striped table-bordered table-hover">';
  $result .= '<tr>';
  $result .= '<th>МАЧ</th>';
  $result .= '<th>ДАТА</th>';
  $result .= '<th>ЧАС</th>';
  $result .= '<th>ЗАЛОГ</th>';
  $result .= '<th>РЕЗУЛТАТ</th>';
  $result .= '<th>ПЕЧЕЛИВШ</th>';
  $result .= '<th>ПЕЧАЛБА</th>';
  $result .= "</tr>";

  $todayDate = date("Y-m-d");
  $timeInTheMoment = date("H:i:s");

  $matchCounter = 0;
  $count = 0;
  while ($row = mysqli_fetch_assoc($all)) {
    $count++;
    if ($matchCounter > 4) {
      break;
    }

    $team1 = $row["team1"];
    $team2 = $row["team2"];
    $startDate = $row["date"];
    $startTime = $row["time"];

    $first = $row['score1'];
    $second = $row['score2'];

    // if($startDate <= $todayDate && $startTime < $timeInTheMoment){
    //     echo updateResult($team1,$team2,$timeInTheMoment,$startTime);
    // }

    $winner = $row['winner'];
    $bet = $row['bet_amount'];

    if ($winner == 1) {
      $btn = '<div class="button-container">
        <button class="btn btn-secondary btn-sm button1">1</button>
        </div>';
    } else if ($winner == 0) {
      $btn = '<div class="button-container">
        <button class="btn btn-secondary btn-sm button1 ">X</button>
        </div>';
    } else {
      $btn = '<div class="button-container">
        <button class="btn btn-secondary btn-sm button1 ">2</button>
        </div>';
    }

    
    $result .= '<tr>';
    $result .= '<td>' . $team1 . " срещу " . $team2 . '</td>';
    $result .= '<td>' . $startDate . '</td>';
    $result .= '<td>' . $startTime . '</td>';
    $result .= '<td>' . $btn . $bet .  ' лев/а</td>';




    if ($startDate < $todayDate || ($startDate == $todayDate && $startTime < $timeInTheMoment)) {
      $matchCounter++;
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
      $result .= '<td>' . $first . ':' . $second . '</td>';
      if (($winner == 0 && $first == $second) || ($winner == 1 && $first > $second) || ($winner == 2 && $first < $second)) {
        $result .= '<td>' . "ДА" . '</td>';
        $bet = $bet * 2;
        $result .= '<td>' . $bet . ' лв.</td>';
      } else {
        $bet = 0;
        $result .= '<td>' . "НЕ" . '</td>';
        $result .= '<td>' . $bet . ' лв.</td>';
      }

      // $query = "UPDATE users SET moneyInPage = moneyInPage + ? WHERE id = ?";
      // $statement = $conn->prepare($query);
      // $statement->bind_param("ii", $bet, $id);
      // $statement->execute();
      // $statement->close();
      if(!isset($_SESSION['moneyAdded'][$team1][$team2][$id])){
      $query = "UPDATE users SET moneyInPage = moneyInPage + ? WHERE id = ?";
      $statement = $conn->prepare($query);
      $statement->bind_param("ii", $bet, $id);
      $statement->execute();
      $_SESSION['moneyAdded'][$team1][$team2][$id] = true;
    }

      $select = "SELECT * FROM users WHERE id = '$id'";
      $res = mysqli_query($conn, $select);

      if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['moneyInPage'] = $row['moneyInPage'];
      }

    } else {
      $result .= '<td></td>';
      $result .= '<td></td>';
      $result .= '<td></td>';

    }


    $result .= '</tr>';


  }
  $result .= '</table>';

  if ($count === 0) {
    $result .= '<strong>Нямате залози!</strong>';
  }
  $result .= '<form method="post">
  <div class="form-outline mb-6 mt-2 d-flex align-items-center align-middle justify-content-center">
    <input type="date" id="form3Example4cg" name="pastDate" style="margin-right: 10px;"/> <button class="btn btn-secondary btn-sm submit-button" type="submit" name="submitDate">Избери дата</button>
    </div>
  </form>';

}
  return $result;

}
?>