<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Support;

class SupportController extends Controller
{
    public function index($id_project)
    {

    }

    public function create(Request $request, $id_project)
    {
        $request->merge([
            'id_user'    => auth()->user()->id,
            'id_project' => $id_project
        ]);

        return response()->json(Support::create($request->input()), 201);
    }

    public function show($id_project, $id_support_message)
    {

    }
}
