<?php foreach ($users as $user){
?>
    <div class="user">
        <img src=<?=$user['picture']['thumbnail']?>><div class="user_name"><?=$user['name']['first']?> <?=$user['name']['last']?></div>
    </div>
<?php
}?>