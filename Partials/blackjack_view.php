<?php
declare(strict_types=1);
//GET GAME FROM SESSION
$unserializedGame = unserialize($_SESSION['game']);
$game = $unserializedGame;
//GAME LOGIC

//If Player Chose hit
if(!$game->checkForGameOver()){
if(isset($_POST['hit'])){
    //Draw Card for player
    $game->getPlayer()->hit($game->getDeck());
}else if(isset($_POST['stand'])){
    //Draw Card for Dealer
    $game->getDealer()->hit($game->getDeck());
}
}else if(isset($_POST['surrender'])){
    //Player Surrenders
    unset($_SESSION['game']);
}
?>
<div class="container">
<div class="border border-dark border-5 rounded p-2 m-5">
<div class="text-center mx-auto my-5" style="width:80%">
<h1>Welcome to El BlackJackio</h1>
</div>
<!--GAME CONTROL FORM-->
<div class="row text-center">
    <div class="col border-bottom border-top border-dark border-1 p-5">
        <h3>You</h3>
        <!--Draw Player Score-->
        <p>Score:<?php echo $game->getPlayer()->getScore()?></p>
        <!--Draw Player Cards UNICODE-->
        <?php foreach($game->getPlayer()->getCards() as $key =>$value):?>
                <?php echo '<span style="font-size:6rem">'.$value->getUnicodeCharacter(true).'</span>'?>
        <?php endforeach?>
    <div class="col border-bottom border-top border-dark border-1 p-5" >
    <h3>Dealer</h3>
<!--Draw Dealer Score-->
    <?php if(count($game->getDealer()->getCards())>2):?>
    <p>Score:<?php echo $game->getDealer()->getScore()?></p>
    <!--Draw Dealer Cards UNICODE-->
    <?php foreach($game->getDealer()->getCards() as $key =>$value):?>
        <?php echo '<span style="font-size:6rem">'.$value->getUnicodeCharacter(true).'</span>'?>
    <?php endforeach?>
    <?php else:?>
        <p>Score:<?php echo $game->getDealer()->getFirstCard()->getValue()?></p>
        <?php echo '<span style="font-size:6rem">'.$game->getDealer()->getFirstCard()->getUnicodeCharacter(true).'</span>'?>
        <?php endif?>
</div>
<!---SHOW CONTROLS IF GAME NOT OVER--->
<?php if(!$game->checkForGameOver()&&!(isset($_POST['stand']))&&!(isset($_POST['surrender']))):?>
<div class="text-center mx-auto mt-5 row" style="width:50%">
    <form  method="post">
        <h3>Please Choose your next move:</h3>
    <input type="submit" value="Hit" name="hit" class="btn btn-warning" style="width:25%"></input>
    <input type="submit" value="Stand" name ="stand" class="btn btn-success" style="width:25%"></input>
    <input type="submit" value="Surrender" name="surrender"class="btn btn-danger" style="width:25%"></input>
</form>
</div>
<!--- IF GAME OVER SHOW:--->
<?php else:?>
    <h1>GAME OVER YOU LOSE</h1>
<?php 
    unset($_SESSION['game']);
endif?>

<!--- CLOSE CONTAINERS/SERIALIZE GAME--->
</div>
</div>
<?php 
if(!$game->checkForGameOver()){
$_SESSION['game'] = serialize($game);
}else{
    unset($_SESSION['game']);
}
?>