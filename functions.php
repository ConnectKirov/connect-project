<?php
function getmyDate($date){
    $month=['','января','Февраля','марта','апреля','мая','июня','июля','августа','сентября','октября','ноября','декабря'];
    $day=['Воскресенье','Понедельник','Вторник','Среда','Четверг','Пятница','Суббота'];
    return date('d',$date).' '.$month[date('n',$date)].', '.$day[date('w',$date)];
}


function getMyTitleDate($date){
    $d = date('Y-m-d');
    $d1 = date('Y-m-d',$date);
    $dz = date('Y-m-d',time()+3600*24);
    $dw = date('Y-m-d',time()-3600*24);
    if ($d==$d1){
        return 'сегодня';
    }
    elseif ($d==$dz){
        return 'завтра';
    }
    elseif ($d==$dw){
        return 'вчера';
    }
    else return '';
}