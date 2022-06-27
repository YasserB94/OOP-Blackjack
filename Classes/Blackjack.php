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
    function getWinner(){
        if($this->player->getScore()>$this->dealer->getScore()){
            return 'player';
        }else{
            return 'dealer';
        }
    }
}

?>