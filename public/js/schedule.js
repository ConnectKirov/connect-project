$(function () {
    $.post('/ajax',{
        'date':'18.12.2017'
    },function(r){
        var a = jQuery.parseJSON(r);
            $.each(a['users'],function (i,val) {
                var $seconds = val['to'] - val['from'];
                var $hours = $seconds / 3600;
                var $width =  Math.round($hours / a['counthours'] * 10000)/100;
                $seconds = val['from'] - a['timefrom'];
                $hours = $seconds / 3600;
                var $magin =  Math.round($hours / a['counthours']  * 10000)/100;
                var user =
                    '<div class="user" style="margin-left: '+$magin+'%;width:'+$width +'%;">'+
                    '   <div class="avatar"'+
                    '       style="background-image: url('+val['avatar']+')"></div>'+
                    '   <div class="name">'+val['name']+' '+val['lastName']+'</div>'+
                    '</div>';
                $('.schedule .row').append(user);
            });

    });
});
