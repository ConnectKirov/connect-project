<?php
/**
 * @var $this Template
 */
?>
<?=$this->renderInclude('includes/header');?>
<div class="schedule">
    <div class="schedule-header">
        <h2 class="schedule-header__title">
            <?=$this->getLocaleDate($timefrom)?>

            <p class="schedule-header__subtitle">
                <?=$this->getLocaleTimeAgo($timefrom)?>
            </p>
        </h2>
        <a href="#" class="button button--accent">
            Записаться
        </a>
    </div>
    <div class="schedule-table">
        <div class="schedule-table__numbers">
        </div>
        <div class="schedule-table__content">
            <div class="schedule-table-columns">
                <?php for ($i = $timefrom; $i<= $timeto; $i+=3600): ?>
                    <div class="schedule-table-columns__column" style="width: <?=round(1 / $counthours * 100, 2)?>%;"> <?=date('H:i',$i)?></div>
                <?php endfor; ?>
            </div>
            <div class="schedule-table__users">
                <div class="schedule-table-row">
                    <!-- insert users here -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="window" rel="schedule">
    <div class="in_window">
        <div class="close">
        </div>
        <h2>
            Выберите время
        </h2>
        <form class="form schedule_form" action="/api/schedule/add_person" method="post">
            от
            <select name="time_start">
                <option></option>
                <?php for ($i = $timefrom; $i<= $timeto; $i+=3600): ?>
                   <option value="<?=$i?>"><?=date('H:i',$i)?></option>
                <?php endfor; ?>
            </select>
            до
            <select name="time_end">
                <option></option>
                <?php for ($i = $timefrom; $i<= $timeto; $i+=3600): ?>
                    <option value="<?=$i?>"><?=date('H:i',$i)?></option>
                <?php endfor; ?>
            </select>
            <div class="button schedule_send">Занять</div>
        </form>
    </div>
</div>