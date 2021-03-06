<?php
declare(strict_types=1);?>
<div class="text-center">
<div class="mx-auto my-5" style="width:50%">
    <h3>The Rules:</h3>
    <ul class="list-group">
        <li class="list-group-item">The closest one to 21 wins!</li>
        <li class="list-group-item">All faces are worth 10</li>
        <li class="list-group-item">An ace is always worth 11</li>
        <li class="list-group-item">If you go over 21 you lose!</li>
        <li class="list-group-item">The dealer will always have at least 15</li>
        <li class="list-group-item">If it's a draw the dealer wins!</li>
        <li class="list-group-item">The dealer shows you 1 card when the game starts</li>
    </ul>
    </div>
    <h5>Press the button to play whenever you are ready!</h5>
<form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<input class="btn btn-success" type="submit" value="--- PLAY NOW ---" name="startgame">
</form>
</div>