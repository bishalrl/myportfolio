<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order')->get();
        return view('welcome', compact('projects'));
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        $relatedProjects = Project::where('id', '!=', $id)
            ->orderBy('order')
            ->limit(3)
            ->get();
        
        return view('projects.show', compact('project', 'relatedProjects'));
    }
}
