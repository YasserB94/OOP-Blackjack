# FAQ

## Let's talk about instantiate
To keep it simple stupid: whenever you see this word, you will always have to use the keyword 'new' if we are talking about a class. So for example if I would ask you to instantiate the player class you would do the following:

```php
new Player();
```

this will create an object out of the `player` class, however if I would need this instantiated object, we can do what we've been doing for a long time now: store it somewhere. This can be in variables like we're used to, however we can also store them inside properties of other things. Just like we don't throw our clothes on the floor in our house, we keep them in our closets where they're supposed to be. Now, we will do the same for our blackjack game, storing the player, and the dealer inside the properties of the `blackjack` class. It would look something like this:

```php
$this->propertyName = new ClassName(property1Value, property2Value);
```

## Let's talk about constructors
Remember functions and parameters? We could make stuff travel from one point in our code to another. A constructor is just like that, but first let's take a look at the example of a parameter.

```php
function greet($message) { 
    echo $message; 
}

greet('hello!');
```

Now, a constructor can do the same thing, let's make our message variable travel from one point to another using a constructor:

```php
class GreetMachine
{
  private string $greeting;
  public function __construct(string $message) {
    $this->greeting = $message;
  }
}

$helloGreeting = new GreetMachine('hello!');
```

So what happened there is, where we instantiate our `greetmachine`, we can PASS the string hello to the new `helloGreeting` object we created. This causes the 'hello!' to travel to the `GreetMachine` constructor, in turn that constructor receives the message and can do anything with it. For now, we just put that message in a property.

This doesn't have to be the only thing though, for example when you're passing your deck to the `Player` class through the constructor, you don't need to put that deck inside of a property. Much rather you'd want to use that deck to draw 2 cards out of it and put those cards in your cards property of the player.

## Let's talk about require
Remember when we wanted to use javascript files in our index.html? Making a script tag with the src of the file is kinda the same thing as using require (but not exactly). Using require you can specify a file name and then all the code that is inside of said file will be available to use in the file you require it.

Most of the time, requiring stuff will happen at the top of your code, this applies to step 8 as well. You will require the deck at the top and then make it passable through the constructor, like we did in our talk about constructors.

You might get some errors saying some class names are already taken, this is a requiring problem. What happened there is you probably required some files more than you should, which makes it execute the code twice. This results in a class being made twice with the same name, therefore giving you an error.