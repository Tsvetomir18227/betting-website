<?php

function depositWithdrawal()
{
    if (isset($_SESSION['loggedIn'])) {
        $result = '<form action="" method="post">';
$result .= '<div class="border p-3 rounded">';
$result .= '<div class="d-flex justify-content-center mb-3">';
$result .= '<div class="btn-group flex-wrap" role="group" style="flex-wrap: nowrap; justify-content: center;">';
$result .= '<a class="active" href="deposit.php"><button type="button" name="depositSum" class="btn btn-secondary me-2 dtbutton text-wrap">Депозиране</button></a>';
$result .= '<a class="active" href="withdrawal.php"><button type="button" button name="withdrawal" class="btn btn-secondary dtbutton text-wrap">Теглене</button></a>';
$result .= '</div>';
$result .= '</div>';
$result .= '<hr class="my-3">';
$result .= '<div class="d-flex justify-content-center align-items-center">';
$result .= '<span class="fs-5 d-lg-inline align-middle "><strong class = "spanSize">БАЛАНС: '. $_SESSION["moneyInPage"] .'лв.</strong></span>';
//$result .= '<span class="fs-5 d-lg-inline">' . $_SESSION["moneyInPage"] . ' ЛВ.</span>';
$result .= '</div>';
$result .= '</div>';


return '<div class="container">' . $result . '</div>';


    }
    if (!isset($_SESSION['loggedIn'])) {
        $result = '<div class="border p-3 rounded">';
        $result .= '<div class="d-flex justify-content-center mb-3">';
        $result .= '<div class="btn-group flex-wrap" role="group" style="flex-wrap: nowrap; justify-content: center;">';
        $result .= '<h2 class="mt-4"><strong class = "regSize">РЕГИСТРИРАЙ СЕ!</strong></h2>';
        $result .= '</div>';
        $result .= '</div>';
        $result .= '<hr class="my-4">';
        $result .= '<div class="d-flex justify-content-center align-items-center">';
        $result .= '<span class="fw-bold fs-5 me-2"><strong class = "textSize">БАЛАНС: -  ЛЕВА</strong></span>';
        $result .= '</div>';
        $result .= '</div>';
    
        return '<div class="container">' . $result . '</div>';
       
    }

}
?>