<?php
declare(strict_types=1);

class Player
{
    //Properties
    protected array $cards;
    protected bool $lost;
    protected int $score;
    
    function __construct(Deck $deck){
        //Draw starting hand
        $this->cards[] = $deck->drawCard();
        $this->cards[] = $deck->drawCard();
        $this->lost = false;
    }
    function hit($deck){
        //Add a card
        $this->cards[] = $deck->drawCard();
        //If new score is too high, surrender
        if($this->getScore()>21){
            $this->surrender();
        }else{
            return;
        }
    }
    function surrender(){
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
    function hasLost():bool{
        return $this->lost;
    }
    function getCards():array{
        return $this->cards;
    }
}
class Dealer extends Player{
    function __construct(Deck $deck){
        parent::__construct($deck);
    }
    function hit($deck){
        //Keep drawing untill score >=15
        if(parent::getScore()<15){
        parent::hit($deck);
        }
    }
    function getFirstCard():Card{
        return parent::getCards()[0];
    }
}
?>