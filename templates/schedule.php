<?php
/**
 * @var $this Template
 */
?>
<?=$this->renderInclude('includes/header');?>
<div class="schedule">
    <div class="schedule-header">
        <div class="button schedule_add">
            Записаться
        </div>
        <h2 class="schedule-header__title">
            <?=$this->getLocaleDate($timefrom)?>
        </h2>
        <p class="schedule-header__subtitle">
            <?=$this->getLocaleTimeAgo($timefrom)?>
        </p>
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
        Hello!!!
        <div class="close">
        </div>
    </div>
</div>