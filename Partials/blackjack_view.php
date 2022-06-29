<?php

declare(strict_types=1);
//GET GAME FROM SESSION
$unserializedGame = unserialize($_SESSION['game']);
$game = $unserializedGame;
//GAME LOGIC
if (!$game->checkForLoser()) {
    //If There is no loser
    $game->resolvePlayerAction();
} else {
    //If there is a loser
    if ($game->getPlayer()->hasLost()) {
        //IF Player lost
        $game->resolvePlayerAction();
    } else if ($game->getDealer()->hasLost()) {
        //IF DEALER LOST

        $game->resolvePlayerAction();
    }
}

?>
<!--END LOGIC-->
<div class="container">
    <div class="border border-dark border-5 rounded p-1 m-1 ">
        <div class="text-center mx-auto my-1 d-none d-lg-block" style="width:80%">
            <h1>Welcome to El BlackJackio</h1>
        </div>
        <!--GAME STATS-->
        <div class="row text-center mx-auto mt-1">
            <!--PLAYER STATS-->
            <div class="col border-bottom border-top border-dark border-1 p-1">
                <h3>You</h3>
                <p>Score:<?= $game->getPlayer()->getScore() ?></p>
                <?php foreach ($game->getPlayer()->getCards() as $key => $value) : ?>
                    <span style="font-size: 6rem;"><?= $value->getUnicodeCharacter(true) ?></span>
                <?php endforeach ?>
            </div>
            <!--DEALER STATS-->
            <div class="col border-bottom border-top border-dark border-1 p-1">
                <h3>Dealer</h3>
                <?php
                //If the player is still playing only show the dealer's first card and value
                if (!$game->getPlayer()->didTurnEnd()) : ?>
                    <p>Score: <?= $game->getDealer()->getCards()[0]->getValue(); ?></p>
                    <span style="font-size:6rem"><?= $game->getDealer()->getCards()[0]->getUnicodeCharacter(true) ?></span>
                    <span style="font-size:6rem">&#127136;</span>
                    <!--If The player ended their turn already show all the dealers cards-->
                <?php elseif ($game->getPlayer()->didTurnEnd()) : ?>
                    <p>Score:<?= $game->getDealer()->getScore() ?></p>
                    <?php foreach ($game->getDealer()->getCards() as $cardIndex => $card) : ?>
                        <span style="font-size:6rem"><?= $card->getUnicodeCharacter(false) ?></span>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        </div>
        <!---GAME CONTROLS-->
        <!--BETTING-->
        <!--IF PLAYER HAS NO BET YET-->
        <?php if ((!$game->getPlayer()->hasBet()) && (!isset($_POST['stand']))) : ?>
            <div class="text-center mx-auto row border border-danger border-2 p-1 rounded m-1" style="width:80%">
                <label for="bettingRange" class="form-label">Please place your Bet, It's double or nothing!</label>
                <form method="post">
                    <input class="row mx-auto mb-1" type="range" name="bettingSlider" id="bettingRange" value="5" min="5" max="<?= $game->getPlayer()->getChips() ?>" step="5" onchange="updateBettingSliderIndicator(this.value);"></input>
                    <input class="row mx-auto btn btn-warning" style="width:30%" type="submit" value="Bet!" name="bet">
                </form>
                <p>Your current Bet:<span id="bettingSliderIndicator">5</span></p>
            </div>
        <?php endif ?>
        <!--If No one lost-->
        <?php if (!$game->checkForLoser() && $game->getPlayer()->hasBet()) : ?>
            <div class="text-center mx-auto mt-1 row" style="width:80%">
                <p>You have Bet: <?= $game->getPlayer()->getBet() ?> credits</p>
                <form method="post">
                    <pody>Please Choose your next move:</pody>
                    <input type="submit" value="Hit" name="hit" class="btn btn-warning" style="width:25%"></input>
                    <input type="submit" value="Stand" name="stand" class="btn btn-success" style="width:25%"></input>
                </form>
            </div>
            <!--If there is a loser-->
        <?php elseif ($game->checkForLoser()) : ?>
            <div class="text-center mx-auto mt-1 row" style="width:80%">
                <!-- if the player lost -->
                <?php if ($game->getPlayer()->hasLost()) : ?>
                    <div class="alert alert-danger">
                        <p>The Dealer Won</p>
                        <p>You lost:<?= $game->getPlayer()->getBet() ?> chips</p>
                    </div>
                    <!--If The Dealer Lost-->
                <?php elseif ($game->getDealer()->hasLost()) : ?>
                    <div class="alert alert-success">
                        <p>Congratulations!</p>
                        <p>You won:<?= $game->getPlayer()->getBet() * 2 ?> chips</p>
                    </div>
                <?php endif ?>
                <?php if ($game->getPlayer()->getChips() > 5) : ?>
                    <form method="post">
                        <input type="submit" value="Play Again" name='nextRound' class="btn btn-success mx-auto">
                    </form>
                <?php endif ?>
            </div>
        <?php endif ?>
        <div class="alert alert-info mx-auto mt-1 text-center" style="width:50%" role="alert">
            <p class="my-auto">You currently have <?= $game->getPlayer()->getChips() ?> chips</p>
        </div>

        <!--CLOSE CONTAINER BOOTSTRAP-->
    </div>
    <!--RESTART IF LOW ON CHIPS-->
    <?php if (($game->getPlayer()->getChips() <= 5) && (isset($_POST['stand']) || (isset($_POST['hit']) && ($game->getPlayer()->hasLost())))) : ?>
        <div class="alert alert-danger mx-auto m-1 text-center">
            <p>It appears you are pretty low on chips, would you like to start a new game ?</p>
            <form method="post">
                <input type="submit" value="Start Over" name='restart' class="btn btn-danger">
            </form>
        </div>
    <?php endif ?>

    <?php
    $_SESSION['game'] = serialize($game);
    ?>