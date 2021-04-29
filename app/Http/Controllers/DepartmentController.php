<?php

namespace App\Http\Controllers;

use App\Model\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index() {
        $departments = Department::all();

        return view('administrator.department.all', compact('departments'));
    }

    public function add() {
        return view('administrator.department.add');
    }

    public function addPost(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required'
        ]);

        $department = new Department();
        $department->name = $request->name;
        $department->status = $request->status;
        $department->save();

        return redirect()->route('department')->with('message', 'Department add successfully.');
    }

    public function edit(Department $department) {
        return view('administrator.department.edit', compact('department'));
    }

    public function editPost(Department $department, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required'
        ]);

        $department->name = $request->name;
        $department->status = $request->status;
        $department->save();

        return redirect()->route('department')->with('message', 'Department edit successfully.');
    }
}
