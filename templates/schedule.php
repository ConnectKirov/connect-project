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
            $i = $timefrom;
            while ($i<= $timeto) {
                ?>
                <div class="hour"> <?=date('H:i',$i)?></div>
                <?php
                $i+=3600;
            }
            ?>
        </div>
        <div style="clear: both;"></div>
    </div>
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
                echo $seconds;
                $hours = $seconds / 3600;
                $magin =  round($hours / $counthours * 100, 2);
                ?>
                <div class="user" style="margin-left: <?=$magin?>%;width: <?=$width ?>%">
                    <div class="avatar"
                         style="background-image: url('<?=$user['avatar']?>')"></div>
                    <div class="name"><?=$user['name']?> <?=$user['lastName']?></div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>