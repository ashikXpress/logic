<?php

namespace App\Http\Controllers;

use App\Model\Project;
use App\Model\SisterConcern;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index() {
        $projects = Project::with('sisterConcern', 'client')->get();

        return view('administrator.project.all', compact('projects'));
    }

    public function add() {
        $sisterConcerns = SisterConcern::orderBy('name')->get();

        return view('administrator.project.add', compact('sisterConcerns'));
    }

    public function addPost(Request $request) {
        $request->validate([
            'sister_concern' => 'required',
            'client' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'deadline' => 'required|date',
            'work_order' => 'nullable|image',
        ]);

        $path = null;
        if ($request->work_order) {
            $file = $request->file('work_order');
            $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/work_order';
            $file->move($destinationPath, $filename);
            $path = 'uploads/work_order/'.$filename;
        }

        $project = new Project();
        $project->sister_concern_id = $request->sister_concern;
        $project->client_id = $request->client;
        $project->name = $request->name;
        $project->description = $request->description;
        $project->amount = $request->amount;
        $project->due = $request->amount;
        $project->deadline = $request->deadline;
        $project->work_order = $path;
        $project->save();

        return redirect()->route('project')->with('message', 'Project add successfully.');
    }

    public function edit(Project $project) {
        $sisterConcerns = SisterConcern::orderBy('name')->get();

        return view('administrator.project.edit', compact('sisterConcerns', 'project'));
    }

    public function editPost(Project $project, Request $request) {
        $request->validate([
            'sister_concern' => 'required',
            'client' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'deadline' => 'required|date',
            'work_order' => 'nullable|image',
        ]);

        if ($request->work_order) {
            if ($project->work_order)
                unlink(public_path($project->work_order));

            $file = $request->file('work_order');
            $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/work_order';
            $file->move($destinationPath, $filename);
            $path = 'uploads/work_order/'.$filename;
            $project->work_order = $path;
        }

        $project->sister_concern_id = $request->sister_concern;
        $project->client_id = $request->client;
        $project->name = $request->name;
        $project->description = $request->description;
        $project->amount = $request->amount;
        $project->deadline = $request->deadline;
        $project->save();

        return redirect()->route('project')->with('message', 'Project edit successfully.');
    }
}
