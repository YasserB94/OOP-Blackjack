<?php
declare(strict_types=1);

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
    function getPlayer(){
        return $this->player;
    }
    function getDealer(){
        return $this->dealer;
    }
    function getDeck(){
        return $this->deck;
    }
}


?>