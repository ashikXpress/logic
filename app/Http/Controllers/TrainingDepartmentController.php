<?php

namespace App\Http\Controllers;

use App\Model\TrainingCourse;
use App\Model\TrainingDepartment;
use Illuminate\Http\Request;

class TrainingDepartmentController extends Controller
{
    public function all(){
        $departments=TrainingDepartment::orderBy('sort')->get();
        return view('training.department.all',compact('departments'));
    }
    public function createDepartment(){

        return view('training.department.add');
    }
    public function createDepartmentPost(Request $request){

        $request->validate([
            'name' => 'required',
            'department_code' => 'required|string|max:255',
            'sort' => 'required',
            'status' => 'required'
        ]);
        $department = new TrainingDepartment();
        $department->name = $request->name;
        $department->department_code = $request->department_code;
        $department->sort = $request->sort;
        $department->status = $request->status;
        $department->save();

        return redirect()->route('all_department')->with('message', 'Department add successfully.');
    }
    public function editDepartment(TrainingDepartment $department){


        return view('training.department.edit',compact('department'));
    }
    public function editDepartmentPost(TrainingDepartment $department,Request $request){
        //dd($request->all());
        $request->validate([
            'name' => 'required',
            'course_code' => 'required|string|max:255',
            'sort' => 'required',
            'status' => 'required'
        ]);

        $department->name = $request->name;
        $department->department_code = $request->department_code;
        $department->sort = $request->sort;
        $department->status = $request->status;
        $department->save();

        return redirect()->route('all_department')->with('message', 'Department edit successfully.');

    }
}
