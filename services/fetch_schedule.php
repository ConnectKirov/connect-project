<?php
/**
 *
 * @var $date
 *
 * @return Schedule[]
 */
function fetch_schedule($date = null)
{
    $mysqli = mysqli_connect("localhost", "root", "", "connect")
    or die('Connection failure');

    if (!$date) {
        $date = date('Y-m-d');
    }

    $query = "SELECT *, DATE_FORMAT(schedule.time_start, '%Y-%m-%d') 
FROM schedule 
WHERE DATE(time_start) = CURDATE()";
    $result = mysqli_query($mysqli, $query);

    // mysqli_query возвращает true если ничего не найдено
    if (is_bool($result)) {
        return [];
    }

    $schedule = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $schedule = array_map(function ($record) {
        return new Schedule(
            new User(null, 'Donald', 'Trump', 'https://randomuser.me/api/portraits/thumb/women/7.jpg'),
            $record['time_start'],
            $record['time_end'],
            $record['id']
        );
    }, $schedule);

    return $schedule;
}
