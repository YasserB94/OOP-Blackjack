<?php
declare(strict_types=1);
//GET GAME FROM SESSION
$unserializedGame = unserialize($_SESSION['game']);
$game = $unserializedGame;
//GAME LOGIC

?>
<div class="container">
<div class="border border-dark border-5 rounded p-2 m-5">
<div class="text-center mx-auto my-5" style="width:80%">
<h1>Welcome to El BlackJackio</h1>
</div>
<!--GAME STATS-->
<div class="row text-center">
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
    <?php if(count($game->getDealer()->getCards())>2):?>
        <p>Score:<?php echo $game->getDealer()->getScore()?></p>
        <?php foreach($game->getDealer()->getCards() as $key =>$value)
        echo '<span style="font-size:6rem">'.$value->getUnicodeCharacter(true).'</span>';
        ?>
    <!--IF DEALER HAS NOT PLAYED-->
    <?php else:?>
        <p>Score:<?php echo $game->getDealer()->getFirstCard()->getValue()?></p>
        <?php echo '<span style="font-size:6rem">'.$game->getDealer()->getFirstCard()->getUnicodeCharacter(true).'</span>'?>
        <?php endif?>
    </div>
</div>
<!---GAME CONTROLS-->
<div class="text-center mx-auto mt-5 row" style="width:50%">
    <form  method="post">
        <h3>Please Choose your next move:</h3>
        <input type="submit" value="Hit" name="hit" class="btn btn-warning" style="width:25%"></input>
        <input type="submit" value="Stand" name ="stand" class="btn btn-success" style="width:25%"></input>
        <input type="submit" value="Surrender" name="surrender"class="btn btn-danger" style="width:25%"></input>
    </form>
</div>

<!---SERIALIZE GAME-->
<?php 
$_SESSION['game'] = serialize($game);
?>