<header class="<?=$this->cs('header', [
        'header--transparent' => @$transparent,
])?>">
    <div style="width: 100%;
    max-width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;">
        <a href="/" class="brand">CONNECT</a>
    </div>
    <nav class="header-links">
        <a href="/schedule" class="header-links__link">Расписание</a>
        <a href="https://yandex.ru/maps/-/CBajyMV5cD" class="header-links__link">Где мы</a>
        <a href="/sign-in" class="header-links__link">Вход</a>
        <a href="/sign-up" class="header-links__link">Регистрация</a>
    </nav>
</header>
