<?php
/**
 * @var $this Template
 */
?>
<?= $this->renderInclude('includes/header') ?>

<section>
    <h1>Вход</h1>
    <form action="/sign-up" method="post">
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