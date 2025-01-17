<?php

namespace App\Domain\ProjectSystem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'project_id',
		'start_time',
		'end_time',
		'memo',
	];

	protected function casts()
	{
		return [
			'start_time' => 'datetime',
			'end_time' => 'datetime',
		];
	}

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
