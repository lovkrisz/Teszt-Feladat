<?php

namespace App\Domain\ProjectSystem\Controllers;

use App\Domain\ProjectSystem\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Validator;

class ProjectController extends Controller
{
    public function save(Request $request): RedirectResponse
    {
        $request->validate([
            'project' => 'required|string|max:255',
        ]);

        // Assuming that there is a login system and the user is authenticated
//        Project::create([
//            'name' => $request->input('project'),
//            'user_id' => auth()->id(),
//        ]);
        Project::create([
            'name' => $request->input('project'),
            'user_id' => 1,
        ]);
        return redirect('/');
    }

    public function show(Request $request): View
    {
        Validator::make(array_merge($request->all(), $request->route()->parameters()), [
            'id' => 'required|integer|exists:projects,id',
        ]);

        $project = Project::find($request->id);

        return view('Domain.ProjectSystem.Views.show', compact('project'));
    }
}
