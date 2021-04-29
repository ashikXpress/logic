<?php

namespace App\Http\Controllers;

use App\Model\Department;
use App\Model\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index() {
        $designations = Designation::with('department')->get();

        return view('administrator.designation.all', compact('designations'));
    }

    public function add() {
        $departments = Department::orderBy('name')->get();

        return view('administrator.designation.add', compact('departments'));
    }

    public function addPost(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required',
            'status' => 'required'
        ]);

        $designation = new Designation();
        $designation->department_id = $request->department;
        $designation->name = $request->name;
        $designation->status = $request->status;
        $designation->save();

        return redirect()->route('designation')->with('message', 'Designation add successfully.');
    }

    public function edit(Designation $designation) {
        $departments = Department::orderBy('name')->get();

        return view('administrator.designation.edit', compact('departments', 'designation'));
    }

    public function editPost(Designation $designation, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required',
            'status' => 'required'
        ]);

        $designation->department_id = $request->department;
        $designation->name = $request->name;
        $designation->status = $request->status;
        $designation->save();

        return redirect()->route('designation')->with('message', 'Designation edit successfully.');
    }
}
