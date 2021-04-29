<?php

namespace App\Http\Controllers;

use App\Model\CandidateInterviewEvalution;
use App\Model\Leave;
use App\Model\StudentAdmission;
use App\Model\TrainingBatch;
use App\Model\TrainingCourse;
use App\Model\TrainingDepartment;
use Illuminate\Http\Request;
use DataTables;

class TrainingStudentController extends Controller
{
    public function all(){
        return view('training.student.all');
    }
    public function newAdmission(){
        $trainingCourses = TrainingCourse::where('status',1)->orderBy('sort')->get();
        $trainingDepartments = TrainingDepartment::where('status',1)->orderBy('sort')->get();
        $trainingBatchs = TrainingBatch::where('status',1)->orderBy('sort')->get();

        return view('training.student.form',compact('trainingCourses','trainingDepartments','trainingBatchs'));
    }
    public function newAdmissionPost(Request $request){

        //dd($request->all());

        $request->validate([
            'training_course' => 'required',
            'training_department' => 'required',
            'training_batch' => 'required',
            'course_code' => 'required',
            'department_code' => 'required',
            'batch_code' => 'required',
            'student_id' => 'nullable',
            'student_name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'gender' => 'required',
            'passing_year' => 'required',
            'batch_fee' => 'required',
            'month' => 'required',
            'date_of_birth' => 'required',
            'mobile_no' => 'required',
            'email' => 'nullable',
            'blood_group' => 'required',
            'admission_roll' => 'nullable',
            'admission_date' => 'required',
            'reference' => 'required',
            'commission' => 'required',
            'balance' => 'required',
            'previous_institute_description' => 'required',
            'village' => 'required',
            'post' => 'required',
            'police_station' => 'required',
            'district' => 'required',
            'present_address' => 'required',
            'father_nid' => 'required',
            'mother_id' => 'required'
        ]);


        $studentAdmission = new StudentAdmission();
        $count = StudentAdmission::count();
        $studentAdmission->training_course_id = $request->training_course;
        $studentAdmission->training_department_id = $request->training_department;
        $studentAdmission->training_batch_id = $request->training_batch;
        $studentAdmission->course_code = $request->course_code;
        $studentAdmission->department_code = $request->department_code;
        $studentAdmission->batch_code = $request->batch_code;
        $studentAdmission->student_id = ($request->course_code).($request->department_code).($request->batch_code).(str_pad($count+1, 4, '0', STR_PAD_LEFT));
        $studentAdmission->student_name = $request->student_name;
        $studentAdmission->father_name = $request->father_name;
        $studentAdmission->mother_name = $request->mother_name;
        $studentAdmission->gender = $request->gender;
        $studentAdmission->passing_year = $request->passing_year;
        $studentAdmission->batch_fee = $request->batch_fee;
        $studentAdmission->month = $request->month;
        $studentAdmission->date_of_birth = $request->date_of_birth;
        $studentAdmission->mobile_no = $request->mobile_no;
        $studentAdmission->email = $request->email;
        $studentAdmission->blood_group = $request->blood_group;
        $studentAdmission->admission_roll = $request->admission_roll;
        $studentAdmission->admission_date = $request->admission_date;
        $studentAdmission->reference = $request->reference;
        $studentAdmission->commission = $request->commission;
        $studentAdmission->balance = $request->balance;
        $studentAdmission->previous_institute_description = $request->previous_institute_description;
        $studentAdmission->village = $request->village;
        $studentAdmission->post = $request->post;
        $studentAdmission->police_station = $request->police_station;
        $studentAdmission->district = $request->district;
        $studentAdmission->present_address = $request->present_address;
        $studentAdmission->father_nid = $request->father_nid;
        $studentAdmission->mother_id = $request->mother_id;
        $studentAdmission->save();

        return view('training.student.all')->with('message', 'Student add successfully.');
    }
    public function newAdmissionEdit(StudentAdmission $studentAdmission){

        $trainingCourses = TrainingCourse::where('status',1)->orderBy('sort')->get();
        $trainingDepartments = TrainingDepartment::where('status',1)->orderBy('sort')->get();
        $trainingBatchs = TrainingBatch::where('status',1)->orderBy('sort')->get();
        //dd($trainingCourses);
        return view('training.student.edit',compact('studentAdmission','trainingCourses','trainingDepartments','trainingBatchs'));
    }
    public function newAdmissionEditPost(StudentAdmission $studentAdmission,Request $request){

        //dd($request->all());
        $request->validate([
            'training_course' => 'required',
            'training_department' => 'required',
            'training_batch' => 'required',
            'course_code' => 'required',
            'department_code' => 'required',
            'batch_code' => 'required',
            'student_id' => 'nullable',
            'student_name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'gender' => 'required',
            'passing_year' => 'required',
            'batch_fee' => 'required',
            'month' => 'required',
            'date_of_birth' => 'required',
            'mobile_no' => 'required',
            'email' => 'nullable',
            'blood_group' => 'required',
            'admission_roll' => 'nullable',
            'admission_date' => 'required',
            'reference' => 'required',
            'commission' => 'required',
            'balance' => 'required',
            'previous_institute_description' => 'required',
            'village' => 'required',
            'post' => 'required',
            'police_station' => 'required',
            'district' => 'required',
            'present_address' => 'required',
            'father_nid' => 'required',
            'mother_id' => 'required'
        ]);

        $studentAdmission->training_course_id = $request->training_course;
        $studentAdmission->training_department_id = $request->training_department;
        $studentAdmission->training_batch_id = $request->training_batch;
        $studentAdmission->course_code = $request->course_code;
        $studentAdmission->department_code = $request->department_code;
        $studentAdmission->batch_code = $request->batch_code;
        $studentAdmission->student_name = $request->student_name;
        $studentAdmission->father_name = $request->father_name;
        $studentAdmission->mother_name = $request->mother_name;
        $studentAdmission->gender = $request->gender;
        $studentAdmission->passing_year = $request->passing_year;
        $studentAdmission->batch_fee = $request->batch_fee;
        $studentAdmission->month = $request->month;
        $studentAdmission->date_of_birth = $request->date_of_birth;
        $studentAdmission->mobile_no = $request->mobile_no;
        $studentAdmission->email = $request->email;
        $studentAdmission->blood_group = $request->blood_group;
        $studentAdmission->admission_roll = $request->admission_roll;
        $studentAdmission->admission_date = $request->admission_date;
        $studentAdmission->reference = $request->reference;
        $studentAdmission->commission = $request->commission;
        $studentAdmission->balance = $request->balance;
        $studentAdmission->previous_institute_description = $request->previous_institute_description;
        $studentAdmission->village = $request->village;
        $studentAdmission->post = $request->post;
        $studentAdmission->police_station = $request->police_station;
        $studentAdmission->district = $request->district;
        $studentAdmission->present_address = $request->present_address;
        $studentAdmission->father_nid = $request->father_nid;
        $studentAdmission->mother_id = $request->mother_id;
        $studentAdmission->save();

        return redirect()->route('all_student')->with('message', 'Student edit successfully.');
    }

    public function studentDatatable(){
        $query = StudentAdmission::with('trainingDepartment', 'trainingCourse','trainingBatch');

        //with('department', 'designation','leaves')
        return DataTables::eloquent($query)

            ->addColumn('department', function(StudentAdmission $newAdmission) {
                return $newAdmission->trainingDepartment->name;
            })
            ->addColumn('course', function(StudentAdmission $newAdmission) {
                return $newAdmission->trainingCourse->name;
            })
            ->addColumn('batch', function(StudentAdmission $newAdmission) {
                return $newAdmission->trainingBatch->name;
            })


            ->addColumn('action', function(StudentAdmission $studentAdmission) {
                return '
                        <a class="btn btn-info btn-sm" href="'.route('new_admission_edit', ['studentAdmission' => $studentAdmission->id]).'">Edit</a>
                        <a class="btn btn-info btn-sm" href="'.route('new_admission_details', ['studentAdmission' => $studentAdmission->id]).'">Details</a>
                        <a class="btn btn-danger btn-sm btn-delete" role="button" data-id="'.$studentAdmission->id.'">Delete</a>';
            })
            ->rawColumns(['action','department','course','batch'])
            ->toJson();
    }

    public function newAdmissionDetails(StudentAdmission $studentAdmission){

        return view('training.student.details',compact('studentAdmission'));

    }
    public function studentDelete(Request $request){

        StudentAdmission::where('id',$request->studentId)->delete();

        return response()->json(['success' => true, 'message' => 'Delete Confirm']);


    }
}
