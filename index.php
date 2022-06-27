<?php
declare(strict_types=1);
//START SESSION TO KEEP GAME
if(!isset($_SESSION)){
    session_start();
}
//REQUIRE BLACKJACK CLASS
require_once __DIR__ . "/Classes/Blackjack.php";

//REQUIRE PAGE HEAD - DOCTYPE/HEAD/META/HEADER
require_once __DIR__ . "/Partials/head.php";

//--------LOAD PAGE CONTENT--------
//IF GAME WAS NOT STARTED && GAME IS NOT RUNNING
if(!isset($_POST['startgame']) && !isset($_SESSION['game'])){
require_once __DIR__ . "/Partials/rules.php";
//IF GAME WAS STARTED
}else if(isset($_POST['startgame'])){
    //CREATE NEW GAME
    $game = new Blackjack();
    $serialized = serialize($game);
    $_SESSION['game'] = $serialized;
    //REQUIRE GAME VIEW
    require_once __DIR__ . "/Partials/blackjack_view.php";
}else if(isset($_SESSION['game'])){
    //IF THERE IS AN ACTIVE GAME
    require_once __DIR__ . "/Partials/blackjack_view.php";
}

//LOAD PAGE TAIL = FOOTER//SCRIPTTAGS//ENDTAGS
require_once __DIR__ . "/Partials/tail.php";
?>
