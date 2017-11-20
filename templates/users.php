<?=$this->renderincludes('includes/header')?>
<h1>Пользователи</h1>

<?php
/**
 * Это поможет PHPSTORM'у понять, что такое $users
 *
 * @var $users User[]
 */
foreach ($users as $user):
?>

    <a href="/user?name=<?=$user->fistName?>">
        <div class="user">
            <img src="<?=$user->avatar?>" class="user-avatar">
            <?=$user->fullName()?>
        </div>
    </a>
<?php endforeach;?>