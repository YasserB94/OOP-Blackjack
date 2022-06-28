<?php
declare(strict_types=1);
//GET GAME FROM SESSION
$unserializedGame = unserialize($_SESSION['game']);
$game = $unserializedGame;
//GAME LOGIC
//PLAYER CHOSES HIT
if(isset($_POST['hit'])){
    //DRAW CARD
    $game->getPlayer()->hit($game->getDeck());
    //CHECK IF PLAYER LOST
    if($game->getPlayer()->hasLost()){
        $winner = 'Dealer';
        unset($_SESSION['game']);
    };
}
//PLAYER CHOSES STAND
else if(isset($_POST['stand'])){
    $game->getDealer()->hit($game->getDeck());
    //Check If Dealer lost
    if($game->getDealer()->hasLost()){
        $winner = 'Player';
        unset($_SESSION['game']);
    }
    //Resolve Winner
    else{
    $winner = $game->getWinner();
    unset($_SESSION['game']);
    }
}
//PLAYER SURRENDERS
else if(isset($_POST['surrender'])){
    $winner = 'Dealer';
    unset($_SESSION['game']);
}
?>
<!--END LOGIC-->
<div class="container">
<div class="border border-dark border-5 rounded p-2 m-5">
    <div class="text-center mx-auto my-5" style="width:80%">
    <h1>Welcome to El BlackJackio</h1>
    </div>
<!--GAME STATS-->
<div class="row text-center mx-auto mt-5">
    <!--PLAYER STATS-->
    <div class="col border-bottom border-top border-dark border-1 p-5">
        <h3>You</h3>
        <p>Score:<?php echo $game->getPlayer()->getScore()?></p>
        <?php foreach($game->getPlayer()->getCards() as $key =>$value){
                echo '<span style="font-size:6rem">'.$value->getUnicodeCharacter(true).'</span>';
        }?>
    </div>
    <!--DEALER STATS-->
    <div class="col border-bottom border-top border-dark border-1 p-5" >
    <h3>Dealer</h3>
    <!--IF DEALER HAS PLAYER-->
        <?php
        //IF PLAYER DID NOT CHOSE STAND - Show 1 card and it's value
            if(!isset($_POST['stand'])):?>
        <p>Score: <?=$game->getDealer()->getCards()[0]->getValue();?></p>
        <span style="font-size:6rem"><?=$game->getDealer()->getCards()[0]->getUnicodeCharacter(true)?></span>
        <?php else:
        //SHOW ALL CARDS AND TOTAL SCORE
        ?>
            <p>Score:<?php echo $game->getDealer()->getScore()?></p>
        <?php foreach($game->getDealer()->getCards() as $key =>$value){
                echo '<span style="font-size:6rem">'.$value->getUnicodeCharacter(true).'</span>';
        }?>
        <?php endif?>
    </div>
</div>
<!---GAME CONTROLS-->
<?php if(isset($_SESSION['game'])) :?>
<div class="text-center mx-auto mt-5 row" style="width:80%">
    <form  method="post">
        <h3>Please Choose your next move:</h3>
        <input type="submit" value="Hit" name="hit" class="btn btn-warning" style="width:25%"></input>
        <input type="submit" value="Stand" name ="stand" class="btn btn-success" style="width:25%"></input>
        <input type="submit" value="Surrender" name="surrender"class="btn btn-danger" style="width:25%"></input>
    </form>
</div>
<?php else:?>
<div class="text-center mx-auto mt-5 row" style="width:80%">
    <h3>GAME OVER</h3>
    <?php if(isset($winner)):?>
        <div class="alert <?php if($winner!=='Dealer'){echo 'alert-success';}else{echo 'alert-danger';}?>" role="alert">
        <h2><?=$winner?> has won!</h2>
    </div>
    <?php endif?>
    <form method="post">
        <input type="submit" value="restart" name='restart' class="btn btn-success">
    </form>
</div>
<?php endif?>
<!---SERIALIZE GAME-->
<?php 
if(isset($_SESSION['game'])){
$_SESSION['game'] = serialize($game);
}
?>