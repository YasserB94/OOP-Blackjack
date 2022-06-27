<?php
declare(strict_types=1);

class Player
{
    //Properties
    protected array $cards;
    protected bool $lost;
    
    function __construct(Deck $deck){
        //Draw starting hand
        $this->cards[] = $deck->drawCard();
        $this->cards[] = $deck->drawCard();

    }
    function hit(){
        //Add a card
        $this->cards = $deck->drawCard();
        //If new score is too high, surrender
        if(getScore()>21){
            $this->surrender();
        }
    }
    function surrender(){
        $this->lost = true;
    }
    function getScore(){
        //Loop over cards and make sum of card values
        $score;
        foreach($this->cards as $key => $value){
            $score+=$value->getValue();
        }
        return $score;
    }
    function hasLost(){
        return $this->lost;
    }
    function getCards(){
        return $this->cards;
    }
}
class Dealer extends Player{
    function __construct(Deck $deck){
        parent::__construct($deck);
    }
    function hit(){
        parent::hit();
        //Keep drawing untill score >=15
        if(parent::getScore()<15){
            $this->hit();
        }
    }
}
?>