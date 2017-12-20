<?php
/**
 * @var $this Template
 */
?>
<?=$this->renderInclude('includes/header');?>
<div class="step time_line">
    <div class="table">
        <?php
        $width =  round(1 / $counthours * 100, 2);
        $i = $timefrom;
        while ($i<= $timeto) {?>
            <div class="hour_table" style="width: <?=$width?>%;"></div>
            <?php
            $i+=3600;}
        ?>
        <div style="clear: both;"></div>
    </div>
    <div class="time_header">

        <div class="date"><?=getmyDate($timefrom)?></div>
        <div class="wdate"><?=getMyTitleDate($timefrom)?></div>
        <div class="hours">
            <?php
            $width =  round(1 / $counthours * 100, 2);
            $i = $timefrom;
            while ($i<= $timeto) {
                ?>
                <div class="hour" style="width: <?=$width?>%;"> <?=date('H:i',$i)?></div>
                <?php
                $i+=3600;
            }
            ?>
        </div>
        <div style="clear: both;"></div>
    </div>
    <div style="clear: both;"></div>

    <div style="clear: both;"></div>
    <div class="schedule">
        <div class="row">
            <div class="number"></div>
        </div>
    </div>
</div>