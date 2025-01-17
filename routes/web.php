<?php

use App\Domain\ProjectSystem\Controllers\ProjectController;
use App\Domain\ProjectSystem\Controllers\RouteController;
use Illuminate\Support\Facades\Route;

Route::get("/", [RouteController::class, "index"]);
Route::post('/project-save', [ProjectController::class, 'save'])->name("project.save");
//Route::post('/project-save', [ProjectController::class, 'save'])->name("project.save")->middleware(['auth']);

Route::get('/project/{id}', [ProjectController::class, 'show'])->name("project.show");
