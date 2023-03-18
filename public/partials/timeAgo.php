<?php
function time_ago($datetime)
{
    $time = strtotime($datetime);
    $now = time();
    $diff = $now - $time;

    if ($diff < 60) {
        return 'bây giờ';
    } elseif ($diff < 3600) {
        $mins = round($diff / 60);
        return "$mins phút"  . ' trước';
    } elseif ($diff < 86400) {
        $hours = round($diff / 3600);
        return "$hours giờ"  . ' trước';
    } elseif ($diff < 604800) {
        $days = round($diff / 86400);
        return "$days ngày"  . ' trước';
    } else {
        return date('M j, Y', $time);
    }
}
