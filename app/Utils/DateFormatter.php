<?php

namespace App\Utils;

use Carbon\Carbon;

class DateFormatter
{
    /**
     * <pre>
     *     轉換日期格式
     *     ex: 傳入 2024-09-07 19:00, 2024-09-07 21:00，會轉換成 2024-09-07 19:00 - 21:00
     *
     * </pre>>
     *
     * @param string|Carbon|null $start_date
     * @param string|Carbon|null $end_date
     * @return string
     */
    public static function formatRange(Carbon|string|null $start_date, Carbon|string|null $end_date): string
    {
        // 轉成 Carbon
        $start_date = $start_date instanceof Carbon ? $start_date : Carbon::parse($start_date);
        $end_date = $end_date instanceof Carbon ? $end_date : Carbon::parse($end_date);

        if ($start_date->format('Y.m.d') == $end_date->format('Y.m.d')) {
            // 同一天
            return $start_date->format('Y.m.d H:i') . ' - ' . $end_date->format('H:i');
        } else {
            // 不同天
            return $start_date->format('Y.m.d H:i') . ' - ' . $end_date->format('Y.m.d H:i');
        }
    }
}
