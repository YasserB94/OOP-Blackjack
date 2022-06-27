## Object Oriented Blackjack - PHP
A Becode learning challenge to get familiar with the concepts of Object Oriented Programming in PHP.

### Objective
Creating a blackjack game with structured code by using classes and objects.

Some code was provided by the exercise:
- Card class
- Deck class
- Suit class

### Blackjack rules
- A card is worth it's value
- Faces are **all** worth 10
- An Ace is **always** worth 11
- If you go over 21 you lose!
- If you have more points than the dealer you win!
- The dealer has to keep drawing untill they have at least 15 points

### Expected flow of the game
1. A deck is shuffled
2. Both the dealer and the player get 2 random cards
    - The dealer only shows the first card to the player
3. The player has 2 options:
    - Hit: Get another card
    - Stay: The game resolves with the player's current cards
4. The dealer takes cards untill his total >= 15
5. The winner is decided
!
>If either player has over 21 points they lose.
 
### Classes to create according to instructions:
1. [ ] Player
    - [ ] Properties
        - cards     :Array
        - won/lost  :Boolean
    -  [ ] Methods
        - hit
            - adds a card to the player and resolves score && ?>21
        - surrender
            - The dealer won _($lost=true;)_
        - stand
            - stay/dealer's turn
        - getScore
            - returns the player's current score
        - hasLost
            - return lost
    - [ ] Constructor
        - Take active deck on creation
        - Draws 2 cards
2. [ ] Blackjack
    - [ ] Properties
        - player    :Player
        - dealer    :Player
        - deck      :Deck
    - [ ] Methods
        - getPlayer
        - getDealer
        - getDeck
    - [ ] Constructor
        - Initiates dealer:Player,player:Player,deck:Deck
        - Shuffles deck
### Index.php
- [ ] Start game
    - Creates new Blackjack object
        - Shows Player side
        - Shows Dealer side
- [ ] Add buttons for actions with php
    - Hit
    - Stand
    - Surrender