<?php

namespace App\Http\Controllers;

use App\Model\TrainingBatch;
use App\Model\TrainingCourse;
use Illuminate\Http\Request;

class TrainingCourseController extends Controller
{
    public function all(){
        $courses=TrainingCourse::orderBy('sort')->get();
        return view('training.course.all',compact('courses'));
    }
    public function createCourse(){
        //$projects=TrainingCourse::where('status',1)->get();

        return view('training.course.add');
    }
    public function createCoursePost(Request $request){

        $request->validate([
            'name' => 'required',
            'course_code' => 'required|string|max:255',
            'sort' => 'required',
            'status' => 'required'
        ]);
        $course = new TrainingCourse();
        $course->name = $request->name;
        $course->course_code = $request->course_code;
        $course->sort = $request->sort;
        $course->status = $request->status;
        $course->save();

        return redirect()->route('all_course')->with('message', 'Course add successfully.');
    }
    public function editCourse(TrainingCourse $course){

        //$projects=TrainingCourse::where('status',1)->get();

        return view('training.course.edit',compact('course'));
    }
    public function editCoursePost(TrainingCourse $course,Request $request){
        //dd($request->all());
        $request->validate([
            'name' => 'required',
            'course_code' => 'required|string|max:255',
            'sort' => 'required',
            'status' => 'required'
        ]);

        $course->name = $request->name;
        $course->course_code = $request->course_code;
        $course->sort = $request->sort;
        $course->status = $request->status;
        $course->save();

        return redirect()->route('all_course')->with('message', 'Course edit successfully.');

    }
}
