<?php

function loginLogOut(){
    if(isset($_POST['logout'])) {
        // Log out the user
        unset($_SESSION["loggedIn"]);
       // session_unset();
       // session_destroy();
        $result = '<form action="" method="post">';
        $result .= '<div class="d-inline-block">';
        $result .= '<li class="nav-item-1">';
        $result .= '<a class="active" href="register.php"><button type="button" class="btn btn-sm dtbutton">Регистрация</button></a>';
        $result .= '</li>';
        $result .= '</div>';
        $result .= '<div class="d-inline-block">';
        $result .= '<li class="nav-item-1">';
        $result .= '<a class="active" href="loginPage.php"><button type="button" class="btn btn-sm dtbutton">Вход</button></a>';
        $result .= '</li>';
        $result .= '</div>';
        $result .= '</form>';

        
        header('location: index.php'); 
        return $result; 
        
        
    }
    if(!isset($_SESSION['loggedIn'])){
        // session_unset();
        // session_destroy();
         $result = '<form action="" method="post">';
         $result .= '<div class="d-inline-block">';
         $result .= '<li class="nav-item-1">';
         $result .= '<a class="active" href="register.php"><button type="button" class="btn btn-sm dtbutton">Регистрация</button></a>';
         $result .= '</li>';
         $result .= '</div>';
         $result .= '<div class="d-inline-block">';
         $result .= '<li class="nav-item-1">';
         $result .= '<a class="active" href="loginPage.php"><button type="button" class="btn btn-sm dtbutton">Вход</button></a>';
         $result .= '</li>';
         $result .= '</div>';
         $result .= '</form>';

         return $result;
         
    } 
     if (isset($_SESSION['loggedIn'])) {
        $result =  '<form action="" method="post">';
        $result .= '<li class="nav-item-1">';
        $result .= '<div class="d-inline-block mr-2 align-middle">';
        $result .= '<span style="color: white; margin-right: 2px;"> Добре дошъл, ' . $_SESSION["username"] .'</span>';
        $result .= '</div>';
        $result .= '<div class="d-inline-block align-middle">';
        $result .= '<a class="active btn-logout" href="index.php"><button name="logout" class="btn btn-sm dtbutton">Изход</button></a>';
        $result .= '</div>';
        $result .= '</li>';
        $result .= '</form>';

        return $result;
    
    }
}

?>





