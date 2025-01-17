<?php

declare(strict_types=1);

use App\Domain\ProjectSystem\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);
it('it loads the export page', function () {
    User::factory()->create();
    Project::create([
        'name' => 'Test Project',
        'user_id' => 1,
    ]);
    $response = $this->get('/export/1');
    $response->assertStatus(200);
    $response->assertViewIs('Domain.ProjectSystem.Views.export');

});
