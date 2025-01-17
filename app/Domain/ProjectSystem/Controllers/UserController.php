<?php

declare(strict_types=1);

namespace App\Domain\ProjectSystem\Controllers;

use App\Domain\ProjectSystem\Actions\PrepareExportAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

final class UserController extends Controller
{
    public function export(Request $request)
    {
        // No Auth so id will be 1
        $id = 1;
        $exportedData = app(PrepareExportAction::class)->handle($id);

        return view('Domain.ProjectSystem.Views.export')->with('exportedData', $exportedData);

    }
}
