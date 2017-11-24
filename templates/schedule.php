<?php
/**
 * @var $this Template
 */
?>

<div class="step time_line">
    <div class="time_header">
        <?=$this->renderInclude('includes/header');?>
        <div class="date">17 ноября, пятница</div>
        <div class="wdate">сегодня</div>
        <div class="hours">
            <?php
            $i = 10;
            while ($i <= 1 || $i >= 10) {
                ?>
                <div class="hour"> <?= str_pad($i, 2, 0, STR_PAD_LEFT) ?>:00</div>
                <?php $i++;
                if ($i == 24) $i = 0;
            }
            ?>
        </div>
        <div style="clear: both;"></div>
    </div>
    <div class="schedule">
        <div class="row">
            <div class="number"></div>
            <div class="user" style="margin-left: 200px;width: 500px">
                <div class="avatar"
                     style="background-image: url('https://randomuser.me/api/portraits/thumb/men/15.jpg')"></div>
                <div class="name">Иван Ургант</div>
            </div>
            <div class="user" style="margin-left: 0;width: 200px">
                <div class="avatar"
                     style="background-image: url('https://randomuser.me/api/portraits/thumb/men/65.jpg')"></div>
                <div class="name">Юрий Дуть</div>
            </div>
        </div>
        <div style="clear: both"></div>
        <div class="row">
            <div class="number"></div>
            <div class="user" style="margin-left: 100px;width: 500px">
                <div class="avatar"
                     style="background-image: url('https://randomuser.me/api/portraits/thumb/men/86.jpg')"></div>
                <div class="name">Павел Дуров</div>
            </div>
        </div>
        <div style="clear: both"></div>
        <div class="row">
            <div class="number"></div>
            <div class="user" style="margin-left: 20px;width: 600px">
                <div class="avatar"
                     style="background-image: url('https://randomuser.me/api/portraits/thumb/men/93.jpg')"></div>
                <div class="name">Владимир Путин</div>
            </div>
        </div>
        <div style="clear: both"></div>
        <div class="row">
            <div class="number"></div>
            <div class="user" style="margin-left: 300px;width: 900px">
                <div class="avatar"
                     style="background-image: url('https://randomuser.me/api/portraits/thumb/men/75.jpg')"></div>
                <div class="name">Алексей Навальный</div>
            </div>
        </div>
        <div style="clear: both"></div>
        <div class="row">
            <div class="number"></div>
            <div class="user" style="margin-left: 200px;width: 700px">
                <div class="avatar"
                     style="background-image: url('https://randomuser.me/api/portraits/thumb/men/17.jpg')"></div>
                <div class="name">Никита Белых</div>
            </div>
        </div>
        <div style="clear: both"></div>
        <div class="row">
            <div class="number"></div>
            <div class="user" style="margin-left: 500px;width: 400px">
                <div class="avatar"
                     style="background-image: url('https://randomuser.me/api/portraits/thumb/men/56.jpg')"></div>
                <div class="name">Дмитрий Медведев</div>
            </div>
        </div>
        <div style="clear: both"></div>
        <div class="row">
            <div class="number"></div>
            <div class="user" style="margin-left: 300px;width: 900px">
                <div class="avatar"
                     style="background-image: url('https://randomuser.me/api/portraits/thumb/men/64.jpg')"></div>
                <div class="name">Марк Цукерберг</div>
            </div>
        </div>

    </div>
</div>