<?php

// tests/Unit/Domain/ProjectSystem/HelperClasses/TimeDiffCalculatorTest.php

use App\Domain\ProjectSystem\HelperClasses\TimeDiffCalculator;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('calculates the difference in seconds between two times', function () {
    $calculator = new TimeDiffCalculator();
    $calculator->calculate('2023-01-01 08:00:00', '2023-01-01 10:00:00');

    expect($calculator->getResult())->toBe(7200); // 2 hours in seconds
});

it('formats seconds into HH:MM:SS', function () {
    $calculator = new TimeDiffCalculator();
    $calculator->calculate('2023-01-01 08:00:00', '2023-01-01 10:00:00')
        ->formatSeconds();

    expect($calculator->getResult())->toBe('02:00:00');
});

it('formats a given number of seconds into HH:MM:SS', function () {
    $calculator = new TimeDiffCalculator();
    $calculator->formatSeconds(3661); // 1 hour, 1 minute, and 1 second

    expect($calculator->getResult())->toBe('01:01:01');
});
