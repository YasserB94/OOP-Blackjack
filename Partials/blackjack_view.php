<?php
declare(strict_types=1);
//GET GAME FROM SESSION
$unserializedGame = unserialize($_SESSION['game']);
$game = $unserializedGame;
//GAME LOGIC
if(!$game->checkForLoser()){
    //If There is no loser
    $game->resolvePlayerAction();
}else{
    //If there is a loser
    if($game->getPlayer()->hasLost()){
        //IF Player lost
    }else if($game->getDealer()->hasLost()){
        //IF DEALER LOST
    }
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
        <?php
        //If the player is still playing only show the dealer's first card and value
        if(!$game->getPlayer()->didTurnEnd()):?>
        <p>Score: <?=$game->getDealer()->getCards()[0]->getValue();?></p>
        <span style="font-size:6rem"><?=$game->getDealer()->getCards()[0]->getUnicodeCharacter(true)?></span>
        <span style="font-size:6rem">&#127136;</span>
        <!--If The player ended their turn already show all the dealers cards-->
        <?php elseif($game->getPlayer()->didTurnEnd()):?>
            <p>Score:<?php echo $game->getDealer()->getScore()?></p>
        <?php foreach($game->getDealer()->getCards() as $key =>$value){
                echo '<span style="font-size:6rem">'.$value->getUnicodeCharacter(true).'</span>';
        }?>
        <?php endif?>
    </div>
</div>
<!---GAME CONTROLS-->
<!--BETTING-->
<!--IF PLAYER HAS NO BET YET-->
<?php if(!$game->getPlayer()->hasBet()):?>
    <div class="text-center mx-auto row border border-danger border-2 p-2 rounded m-3" style="width:80%">
        <label for="bettingRange" class="form-label">Please place your Bet</label>
        <form method="post">
            <input class="row mx-auto"type="range" name="bettingRange" id="bettingRange" value="5" min="5" max="<?=$game->getPlayer()->getChips()?>" step="5"  onchange="updateBettingSliderIndicator(this.value);"></input>
            <input class="row mx-auto btn btn-warning" style="width:30%" type="submit" value="Bet!" name="bet">
        </form>
        <p>Your current Bet:<span id="bettingSliderIndicator">5</span></p>
    </div>
<?php endif?>
<!--If No one lost-->
<?php if(!$game->checkForLoser()) :?>
<div class="text-center mx-auto mt-5 row" style="width:80%">
    <form  method="post">
        <h3>Please Choose your next move:</h3>
        <input type="submit" value="Hit" name="hit" class="btn btn-warning" style="width:25%"></input>
        <input type="submit" value="Stand" name ="stand" class="btn btn-success" style="width:25%"></input>
        <input type="submit" value="Surrender" name="surrender"class="btn btn-danger" style="width:25%"></input>
    </form>
</div>
<!--If there is a loser-->
<?php else:?>
<div class="text-center mx-auto mt-5 row" style="width:80%">
    <h3>GAME OVER</h3>
    <!-- if the player lost -->
    <?php if($game->getPlayer()->hasLost()):?>
    <div class="alert alert-danger"><p>The Dealer Won</p></div>
    <!--If The Dealer Lost-->
    <?php elseif($game->getDealer()->hasLost()):?>
        <div class="alert alert-success"><p>Congratulations, you won!</p></div>
    <?php endif?>
    <!--RESTART BUTTON-->
    <form method="post">
        <input type="submit" value="restart" name='restart' class="btn btn-success">
    </form>
</div>
<?php endif?>
<!--CLOSE CONTAINER BOOTSTRAP-->
</div>
<!---SERIALIZE GAME-->
<?php 
if(isset($_SESSION['game'])){
$_SESSION['game'] = serialize($game);
}
?>