<?php

declare(strict_types=1);

namespace App\Domain\ProjectSystem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'start_time',
        'end_time',
        'memo',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    protected function casts()
    {
        return [
            'start_time' => 'datetime:Y-m-d H:i:s',
            'end_time' => 'datetime:Y-m-d H:i:s',
        ];
    }
}
