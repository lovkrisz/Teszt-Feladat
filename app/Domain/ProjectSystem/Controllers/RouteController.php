<?php

namespace App\Domain\ProjectSystem\Controllers;

use App\Domain\ProjectSystem\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class RouteController extends Controller
{
    public function index(): View
    {
        // Assuming that there is a login system and the user is authenticated
        //$projects = Project::where('user_id', auth()->id())->orderBy('created_at', 'DESC')->get();
        $projects = Project::where('user_id', '=', '1')->orderBy('created_at', 'DESC')->get();
        return view('Domain.ProjectSystem.Views.index', compact('projects'));
    }
}
