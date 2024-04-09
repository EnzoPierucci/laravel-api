<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectControllerApi extends Controller
{
    public function index(){

        $projects = Project::all();
        
        return response()->json([

            'success' => true,
            'projects' => $projects,
        ]);
    }
}
