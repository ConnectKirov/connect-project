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

        <div class="date">17 ноября, пятница</div>
        <div class="wdate">сегодня</div>
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
            <?php
            foreach ($users as $user){
                $seconds = $user['to'] - $user['from'];
                $hours = $seconds / 3600;
                $width =  round($hours / $counthours * 100, 2);
                $seconds = $user['from'] - $timefrom;
                $hours = $seconds / 3600;
                $magin =  round($hours / $counthours * 100, 2);
                ?>
                <div class="user" style="margin-left: <?=$magin?>%;width: <?=$width ?>%;">
                    <div class="avatar"
                         style="background-image: url('<?=$user['avatar']?>')"></div>
                    <div class="name"><?=$user['name']?> <?=$user['lastName']?></div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>