<?php
function getDateTimeDiff($date) {
    $now_timestamp = strtotime(date('Y-m-d H:i:s'));
    $diff_timestamp = $now_timestamp - strtotime($date);

    if ($diff_timestamp < 60) {
        return 'few seconds ago';
    } else if ($diff_timestamp >= 60 && $diff_timestamp < 3600) {
        return round($diff_timestamp / 60) . ' mins ago';
    } else if ($diff_timestamp >= 3600 && $diff_timestamp < 86400) {
        return round($diff_timestamp / 3600) . ' hours ago';
    } else if ($diff_timestamp >= 86400 && $diff_timestamp < (86400 * 30)) {
        return round($diff_timestamp / (86400)) . ' days ago';
    } else if ($diff_timestamp >= (86400 * 30) && $diff_timestamp < (86400 * 365)) {
        return round($diff_timestamp / (86400 * 30)) . ' months ago';
    } else {
        return round($diff_timestamp / (86400 * 365)) . ' years ago';
    }
}

echo '<p>Current Time is: <strong>' . date('Y-m-d H:i:s') . '</strong></p>';
echo '<p>' . getDateTimeDiff('2018-09-09 16:55:03') . '</p>';
echo '<p>' . getDateTimeDiff('2018-09-09 11:51:00') . '</p>';
echo '<p>' . getDateTimeDiff('2011-09-09 11:51:00') . '</p>';
echo '<p>' . getDateTimeDiff('2018-04-09 11:51:00') . '</p>';
echo '<p>' . getDateTimeDiff('2015-04-09 11:51:00') . '</p>';
?>
