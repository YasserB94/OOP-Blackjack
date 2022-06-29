<?php
declare(strict_types=1);

class Player
{
    //Properties
    protected array $cards;
    protected bool $lost;
    protected int $score;
    protected bool $turnEnded;
    protected int $chips;
    protected int $bet;
    protected bool $hasBet;
    function __construct(Deck $deck){
        //Draw starting hand
        $this->cards[] = $deck->drawCard();
        $this->cards[] = $deck->drawCard();
        $this->lost = false;
        $this->turnEnded = false;
        $this->chips = 100;
        $this->bet = 5;
        $this->hasBet = false;
        $this->checkForDoubleAce($deck);
    }
    function hit($deck){
        //Has Player ended turn yet ?
        if($this->didTurnEnd()){return;}else{
        //Add a card
        $this->cards[] = $deck->drawCard();
        //If new score is too high, surrender
        if($this->getScore()>21){
            $this->endTurn();
            $this->lose();
        }else{
            return;
        }
    }
    }

    function checkForDoubleAce($deck){
        if($this->getScore()>21){
            array_pop($this->cards);
            $this->cards[]=$deck->drawCard();
        }
    }
    function setBet(int $amount):void{
        $this->bet = $amount;
        $this->removeChips($amount);
        $this->hasBet = true;
    }
    function setBetEdgeCase(int $amount):void{
        $this->bet = $amount;
        $this->hasBet = true;
    }
    function hasBet():bool{
        return $this->hasBet;
    }
    function getBet():int{
        return $this->bet;
    }
    function getChips():int{
        return $this->chips;
    }
    function addChips(int $amount):void{
        if($amount<0){
            return;
        }else{
            $this->chips+=$amount;
        }
    }
    function removeChips(int $amount):void{
        if(($this->chips-$amount)<0){
            $this->chips=0;
        }else{
            $this->chips-=$amount;
        }
    }
    function surrender():void{
        $this->lost = true;
    }
    function getScore():Int{
        //Loop over cards and make sum of card values
        $this->score = 0;
        foreach($this->cards as $key=>$value){
            $this->score += $value->getValue();
        }
        return $this->score;
    }
    function lose():void{
        $this->lost = true;
    }
    function hasLost():bool{
        return $this->lost;
    }
    function getCards():array{
        return $this->cards;
    }
    function startTurn():void{
        $this->turnEnded = false;
    }
    function endTurn():void{
        $this->turnEnded = true;
    }
    function didTurnEnd():bool{
        return $this->turnEnded;
    }
    function startNewRound(Deck $newDeck):void{
        $this->lost = false;
        $this->turnEnded = false;
        $this->hasBet = false;
        $this->cards = [];
        $this->cards[] = $newDeck->drawCard();
        $this->cards[] = $newDeck->drawCard();
        $this->bet=5;
        $this->checkForDoubleAce($newDeck);
    }
}
class Dealer extends Player{
    function __construct(Deck $deck){
        parent::__construct($deck);
    }
    function hit($deck){
        //Keep drawing untill score >=15
        while(parent::getScore()<15){
        parent::hit($deck);
        }
    }
    function getFirstCard():Card{
        return parent::getCards()[0];
    }
}
