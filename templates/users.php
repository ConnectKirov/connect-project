<h1>Пользователи</h1>

<?php
/**
 * Это поможет PHPSTORM'у понять, что такое $users
 *
 * @var $users User[]
 */
foreach ($users as $user):
?>
<div class="user">
    <img src="<?=$user->avatar?>" class="user-avatar">
    <?=$user->fullName()?>
</div>
<?php endforeach;?>