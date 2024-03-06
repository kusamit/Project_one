<?php
if (!function_exists('getDateTimeDiff')) 
        {
            function getDateTimeDiff($end_date_time) {
                date_default_timezone_set("Asia/Kathmandu");
                $now_timestamp = strtotime(date('Y-m-d H:i:s'));
                $end_timestamp = strtotime($end_date_time);
                $diff_timestamp = $end_timestamp - $now_timestamp;

                if ($diff_timestamp < 0) {
                    return 'expired';
                } elseif ($diff_timestamp < 60) {
                    return 'few seconds left';
                } elseif ($diff_timestamp >= 60 && $diff_timestamp < 3600) {
                    return round($diff_timestamp / 60) . ' mins left';
                } elseif ($diff_timestamp >= 3600 && $diff_timestamp < 86400) {
                    return round($diff_timestamp / 3600) . ' hours left';
                } elseif ($diff_timestamp >= 86400 && $diff_timestamp < (86400 * 30)) {
                    return round($diff_timestamp / (86400)) . ' days left';
                } elseif ($diff_timestamp >= (86400 * 30) && $diff_timestamp < (86400 * 365)) {
                    return round($diff_timestamp / (86400 * 30)) . ' months left';
                } else {
                    return round($diff_timestamp / (86400 * 365)) . ' years left';
                }
            }
        } 
?>