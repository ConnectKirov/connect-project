<h1>Пользователи</h1>

<?php foreach ($users as $user): ?>
<div class="user">
    <img src="<?=$user['picture']['thumbnail']?>" alt="" class="user-avatar">
    <?=$user['name']['first']?>
    <?=$user['name']['last']?>
</div>
<?php endforeach;?>