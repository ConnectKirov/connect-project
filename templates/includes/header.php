<?php
/**
 * @var $this \App\Lib\Template
 * @var $currentUser \App\Lib\Database\Models\User
 */

?>
<link rel="stylesheet" href="<?=$this->getAssetUrl('/styles/header.css')?>">
<header class="<?=$this->cs('header', [
        'header--transparent' => @$transparent,
])?>">
    <div>
        <a href="/" class="link-brand">CONNECT</a>
    </div>
    <nav class="header-links">
        <a class="header-links__link" href="/schedule" class="header-links__link">Расписание</a>
        <a class="header-links__link"  href="https://yandex.ru/maps/-/CBajyMV5cD" class="header-links__link" target="_blank">Где мы</a>
        <?php if($currentUser): ?>
            <a class="header-links__link"  href="/profile/?id=<?=$currentUser->id?>" class="header-links__link">
            <span class="user-block">
                <img src="<?=$currentUser->avatar?>" alt="" class="avatar user-block__avatar">
                    <?=$currentUser->fullName()?>
            </span>
            </a>
        <?php else: ?>
            <a class="header-links__link"  href="/sign-in" class="header-links__link">Войти</a>
        <?php endif; ?>

    </nav>
</header>
