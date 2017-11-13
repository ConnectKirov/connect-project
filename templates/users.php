<?=$this->renderInclude('includes/header')?>
<?php
/**
 * Это поможет PHPSTORM'у понять, что такое $users
 *
 * @var $users User[]
 */
foreach ($users as $user): ?>
    <a href="/user?name=<?= $user->firstName ?>">
        <div class="user">
            <img src="<?= $user->avatar ?>" class="user-avatar">
            <?= $user->fullName() ?>
        </div>
    </a>
<?php endforeach; ?>