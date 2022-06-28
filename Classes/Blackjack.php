<?php
declare(strict_types=1);
require_once __DIR__ . '/Deck.php';
require_once __DIR__ . '/Player.php';
class Blackjack{
    private Player $player;
    private Dealer $dealer;
    private Deck $deck;
    function __construct(){
        $this->deck = new Deck();
        $this->deck->shuffle();
        $this->player = new Player($this->deck);
        $this->dealer = new Dealer($this->deck);
        //Player gets dealt 21 on start = auto win 50 chips
        $this->checkFor21();
    }
    function getPlayer():Player{
        return $this->player;
    }
    function getDealer():Dealer{
        return $this->dealer;
    }
    function getDeck():Deck{
        return $this->deck;
    }
    function getWinner():string{
        if($this->player->getScore()>$this->dealer->getScore()){
            return 'Player';
        }else{
            return 'Dealer';
        }
    }
    function resolvePlayerAction():void{
        if(isset($_POST['bet'])){
            $bettingValue = intval($_POST['bettingSlider']);
            $this->player->setBet($bettingValue);
        }
        if($this->player->hasBet()){
        if(isset($_POST['hit'])){
            if($this->player->didTurnEnd()){
                return;
            }else{
            $this->player->hit($this->deck);
            }
        }else if(isset($_POST['stand'])){
            $this->player->endTurn();
            $this->dealer->hit($this->deck);
            $this->resolveGame();
        }else if(isset($_POST['nextRound'])){
            $this->startNewRound();
        }
    }
    }
    function startNewRound():void{
        unset($this->deck);
        $this->deck = new Deck();
        $this->deck->shuffle();
        $this->player->startNewRound($this->deck);
        $this->dealer->startNewRound($this->deck);
    }
    function resolveGame(){
       if($this->player->hasLost()){
        return;
       }else if ($this->dealer->hasLost()){
        $this->player->addChips(($this->player->getBet()*2));
        return;
       }else{
        if($this->player->getScore()>$this->dealer->getScore()){
            $this->dealer->lose();
            $this->player->addChips(($this->player->getBet()*2));
        }else{
            $this->player->lose();
        }
       }
    }
    function checkFor21():void{
        if($this->player->getScore()===21){
            $this->player->setBet(100);
            $this->dealer->lose();
            $this->player->addChips(100);

        }
    }
    function checkForLoser():bool{
        if($this->player->hasLost()){
            return true;
        }else if ($this->dealer->hasLost()){
            return true;
        }else{
            return false;
        }
    }
    function checkForGameOver():bool{
        if($this->player->getChips()<=0){
            return true;
        }else{
            return false;
        }
    }
}
?>