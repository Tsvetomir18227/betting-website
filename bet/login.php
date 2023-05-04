<?php
@include 'connection.php';
session_start();

if(isset($_POST['loginSubmit'])){
  $username = mysqli_real_escape_string($conn, $_POST["username"]);
  $pass = md5($_POST["password"]);
  
  $select = "SELECT * FROM users WHERE username = '$username' AND password = '$pass'";

  $result = mysqli_query($conn, $select);

  if(mysqli_num_rows($result) > 0){
    $_SESSION['username'] = $username;
    $_SESSION['loggedIn'] = true;
    $row = mysqli_fetch_assoc($result);
    
    $_SESSION['id'] = $row['id'];
    $_SESSION['moneyInPage'] = $row['moneyInPage'];
    $_SESSION['ownMoney'] = $row['ownMoney'];
    $_SESSION['adminId'] = $row['adminId'];
    
    header('location: index.php'); 

  }
   else {
    $error[] = 'Грешни данни!';
      
  }
  
}
?>
