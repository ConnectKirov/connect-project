<?php
/**
 * @var $this Template
 */
?>
<link rel="stylesheet" href="<?= $this->getFile('/styles/sign-in.css')?>">
<?= $this->renderInclude('includes/header') ?>
<main class="container">
    <section class="sign-in page">
        <div class="sign-in__block">
            <h2 class="heading">Войти</h2>
            <?php if(isset($errors)): ?>
                <div class="messages">
                    <?php foreach ($errors as $error): ?>
                        <div class="message message--error"><?=$error?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form action="/sign-in" method="post">
                <div class="input-container">
                    <input class="input" type="email" name="email" placeholder="Email" required />
                </div>
                <div class="input-container">
                    <input class="input" type="password" name="password" placeholder="Пароль" required minlength="6" />
                </div>
                <div class="input-container">
                    <button type="submit" class="button">Войти</button>
                </div>
            </form>
        </div>
        <div class="sign-in__block">
            <h2 class="heading">Войти через соцсети</h2>
            <div>
                <a class="button button--vk" href="<?=$vkUrl?>">
                    <i class="fa fa-vk"></i> Войти через ВКонтакте
                </a>
            </div>
        </div>
    </section>
</main>