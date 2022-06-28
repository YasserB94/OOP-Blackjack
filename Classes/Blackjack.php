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
        }else if(isset($_POST['surrender'])){
            $this->player->lose();
        }
    }
    function resolveGame(){
       if($this->player->hasLost()){
        return;
       }else if ($this->dealer->hasLost()){
        return;
       }else{
        if($this->player->getScore()>$this->dealer->getScore()){
            $this->dealer->lose();
        }else{
            $this->player->lose();
        }
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
}
?>