<?php

declare(strict_types=1);

namespace App\Domain\ProjectSystem\DTO;

final readonly class ExportResultDTO
{
    public function __construct(
        public array $projects,
        public array $tasks,
        public array $totalTimes,
    ) {}
}
