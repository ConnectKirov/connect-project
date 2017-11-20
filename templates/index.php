<?php
    /**
    * @var $this Templace
    */
?>
<div class="step main">
    <div class="back">
        <?=$this->renderincludes('includes/header')?>
        <div class="content">
            <div class="centered">
                <div class="row connect">
                    <div class="connect_inner">
                    <div class="subject"><i>C</i><i>o</i><i>n</i><i>n</i><i>e</i><i>c</i><i>t</i></div>
                    <div class="text">Творческая IT-среда в Кирове</div>
                    </div>
                </div>
                <div class="row go">Приходи и работай. Бесплатно. Совсем.</div>
                <div class="row view">Смотреть рассписание</div>
                <div class="row down"><i class="fa fa-angle-down" aria-hidden="true"></i></div>
            </div>
        </div>
    </div>
</div>
<div class="step time_line">
    <div class="time_header">
        <div class="date">17 ноября, пятница</div>
        <div class="wdate">сегодня</div>
        <div class="hours">
            <?php
             $i=10;
                while ($i<=1 || $i>=10){
                    ?>
            <div class="hour"> <?=str_pad($i,2,0,STR_PAD_LEFT)?>:00</div>
                    <?php $i++;
                    if ($i==24) $i=0;
                }
            ?>
        </div>
        <div style="clear: both;"></div>
</div>
    <div class="schedule">
        <div class="row">
            <div class="number"></div>
            <div class="user">
                <div class="avatar" style="background-image: url('https://randomuser.me/api/portraits/thumb/men/89.jpg')"></div>
                <div class="name">Alex Naz</div>

            </div>
        </div>
    </div>
</div>
