<?php
declare(strict_types=1);
require_once __DIR__ . '/../Classes/Blackjack.php';
$blackjack = new Blackjack();
?>
<div class="border border-dark border-5 rounded p-2 m-5">
<div class="text-center mx-auto my-5" style="width:80%">
<h1>It's okay to give up!</h1>
</div>
<div class="text-center mx-auto mt-5" style="width:50%">
    <form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <input type="submit" value="Hit" name="hit" class="btn btn-warning" style="width:30%"></input>
    <input type="submit" value="Stand" name ="stand" class="btn btn-success" style="width:30%"></input>
    <input type="submit" value="Surrender" name="surrender"class="btn btn-danger" style="width:30%"></input>
</form>
</div>

</div>