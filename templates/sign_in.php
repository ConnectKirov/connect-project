<?php
/**
 * @var $this Template
 */
?>
<?= $this->renderInclude('includes/header') ?>

<section>
    <h1>Вход</h1>
    <?php if(isset($errors)): ?>
        <div class="messages">
            <?php foreach ($errors as $error): ?>
                <div class="message message--error"><?=$error?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form action="/sign-in" method="post">
        <div class="input-container">
            <input type="email" name="email" placeholder="Email" required />
        </div>
        <div class="input-container">
            <input type="password" name="password" placeholder="Пароль" required minlength="6" />
        </div>
        <div class="input-container">
            <button type="submit">Войти</button>
        </div>
    </form>
</section>