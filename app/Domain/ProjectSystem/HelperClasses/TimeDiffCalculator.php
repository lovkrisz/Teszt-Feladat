<?php

declare(strict_types=1);

namespace App\Domain\ProjectSystem\HelperClasses;

use Carbon\Carbon;

final class TimeDiffCalculator
{
    private mixed $result;

    public function calculate($start, $end): TimeDiffCalculator
    {
        $start = Carbon::parse($start);
        $end = Carbon::parse($end);
        $this->result = (int)$start->diffInSeconds($end);

        return $this;
    }

    public function formatSeconds(int $seconds = -1): TimeDiffCalculator
    {
        if ($seconds === -1) {
            $seconds = $this->result;
        }
        $hours = intdiv($seconds, 3600);
        $minutes = intdiv($seconds % 3600, 60);
        $seconds %= 60;
        $this->result = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

        return $this;
    }

    public function getResult(): mixed
    {
        return $this->result;
    }
}
