<?php


function leaderboard()
{
    @include 'connection.php';

    if(!isset($_SESSION['champ'])){
      $_SESSION['champ'] = "premier_league";
    }
    $champ = $_SESSION['champ'];
    if (isset($_POST['premier_league'])) {
        $champ = 'premier_league';
        //  $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.championship = 'Premier League'";
      } else if (isset($_POST['championship'])) {
        $champ = 'championship';
        // $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.championship = 'Championship'";
      } else if (isset($_POST['league1'])) {
        $champ = 'la_liga';
        //  $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.championship = 'League 1'";
      } else if (isset($_POST['league2'])) {
        $champ = 'la_liga_2';
        //  $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.championship = 'League 1'";
      } else if (isset($_POST['seriaA'])) {
        $champ = 'seria_a';
        //  $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.championship = 'League 1'";
      } else if (isset($_POST['seriaB'])) {
        $champ = 'seria_b';
        //  $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.championship = 'League 1'";
      } else if (isset($_POST['allE'])) {
        $champ = 'premier_league';
        //  $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.championship = 'League 1'";
      } else if (isset($_POST['allS'])) {
        $champ = 'la_liga';
        //  $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.championship = 'League 1'";
      } else if (isset($_POST['allI'])) {
        $champ = 'seria_a';
        //  $sql = "SELECT * FROM schedule AS s INNER JOIN countries AS c ON s.country_id = c.id WHERE c.championship = 'League 1'";
      } 


    $sql = "SELECT * FROM " . $champ . " order by points desc, gd desc, g desc, d asc";
    $all = $conn->query($sql);
    $result = '<div class="table-responsive">';
    $result .= '<table class="table table-striped table-bordered table-hover">';
    $result .= '<thead class="bg-dark text-white">';
    $result .= '<tr>';
    $result .= '<th style="width: 5%; color: white;">ПОЗИЦИЯ</th>';
    $result .= '<th style="width: 15%; color: white;">ОТБОР</th>';
    $result .= '<th style="width: 5%; color: white;">МАЧОВЕ</th>';
    $result .= '<th style="width: 5%; color: white;">ПОБЕДИ</th>';
    $result .= '<th style="width: 5%; color: white;">РАВЕНСТВА</th>';
    $result .= '<th style="width: 5%; color: white;">ЗАГУБИ</th>';
    $result .= '<th style="width: 5%; color: white;">ГОЛОВА РАЗЛИКА</th>';
    $result .= '<th style="width: 5%; color: white;">ГОЛОВЕ</th>';
    $result .= '<th style="width: 5%; color: white;">ДОПУСНАТИ ГОЛОВЕ</th>';
    $result .= '<th style="width: 5%; color: white;">ПРЕДСТОЯЩИ МАЧОВЕ</th>';
    $result .= '<th style="width: 5%; color: white;">ТОЧКИ</th>';
    $result .= '</tr>';
    $result .= '</thead>';

    $result .= '<tbody>';
    $position = 1;
    while ($row = mysqli_fetch_assoc($all)) {
        $team = $row['team'];
        $matches = $row['matches'];
        $points = $row['points'];
        $gd = $row['gd'];
        $g = $row['g'];
        $d = $row['d'];
        $wins = $row['wins'];
        $ties = $row['ties'];
        $loses = $row['loses'];
        $nextMatches = $row['nextMatches'];

        $result .= '<tr>';
        $result .= '<td>' . $position . '</td>';
        $result .= '<td>' . $team . '</td>';
        $result .= '<td>' . $matches . '</td>';
        $result .= '<td>' . $wins . '</td>';
        $result .= '<td>' . $ties . '</td>';
        $result .= '<td>' . $loses . '</td>';
        $result .= '<td>' . $gd . '</td>';
        $result .= '<td>' . $g . '</td>';
        $result .= '<td>' . $d . '</td>';
        $result .= '<td>' . $nextMatches . '</td>';
        $result .= '<td><strong>' . $points . '</strong></td>';        
        $result .= '</tr>';

        $position = $position + 1;
    }

    $result .= '</tbody>';
    $result .= '</table>';
    $result .= '</div>';


    return $result;

}
?>