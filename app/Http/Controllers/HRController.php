<?php

namespace App\Http\Controllers;
use App\Imports\UsersImport;
use App\Model\AcademicTraining;
use App\Model\AttendanceApplication;
use App\Model\EmployeeAppraisal;
use App\Model\PromotionProposal;
use App\Model\jobInformation;
use App\Model\OvertimeApproved;
use App\Model\TrainingInformation;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AttendanceImport;
use App\Model\AppointmentLetter;
use App\Model\AttendanceProcess;
use App\Model\CandidateInterviewEvalution;
use App\Model\Department;
use App\Model\DesignationLog;
use App\Model\Employee;
use App\Model\EmployeeAttendance;
use App\Model\JobDescription;
use App\Model\Leave;
use App\Model\SalaryChangeLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Compound;
use Ramsey\Uuid\Uuid;
use DataTables;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;



class HRController extends Controller
{
    public function employeeAll() {
        $departments = Department::where('status', 1)
            ->orderBy('name')->get();


            return view('hr.employee.all', compact('departments'));

    }

    public function employeeAdd() {
        $departments = Department::where('status', 1)
            ->orderBy('name')->get();

        $count = Employee::count();
        $employeeId = str_pad($count+1, 4, '0', STR_PAD_LEFT);

        return view('hr.employee.add', compact('departments', 'employeeId'));
    }

    public function employeeAddPost(Request $request) {


        $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'joining_date' => 'nullable|date',
            'confirmation_date' => 'nullable|date',
            'department' => 'required',
            'designation' => 'required',
            'education_qualification' => 'nullable|max:255',
            'employee_type' => 'required',
            'gender' => 'required',
            'marital_status' => 'required',
            'mobile_no' => 'nullable|digits:11',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'emergency_contact' => 'required|string|max:255',
            'signature' => 'nullable|image',
            'photo' => 'nullable|image',
            'present_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'religion' => 'required',
            'cv' => 'nullable|mimes:doc,pdf,docx',
            'gross_salary' => 'required',
            'previous_salary' => 'nullable',
            //'gross_salary' => 'required',
            'salary_offered' => 'required',
            'status' => 'required',

        ]);

        // Upload Signature
        $signature=null;
        if ($request->signature) {

            $file = $request->file('signature');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/employee/signature';
            $file->move($destinationPath, $filename);

            $signature = 'uploads/employee/signature/'.$filename;

        }

        // Upload Photo
        $photo=null;
        if ($request->photo) {

            $file = $request->file('photo');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/employee/photo';
            $file->move($destinationPath, $filename);

            $photo = 'uploads/employee/photo/'.$filename;
        }


        // Upload CV
        $cv = null;
        if ($request->cv) {
            $file = $request->file('cv');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/employee/cv';
            $file->move($destinationPath, $filename);

            $cv = 'uploads/employee/cv/'.$filename;
        }

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->employee_id = $request->employee_id;
        $employee->dob = $request->date_of_birth;
        $employee->joining_date = $request->joining_date;
        $employee->confirmation_date = $request->confirmation_date;
        $employee->department_id = $request->department;
        $employee->designation_id = $request->designation;
        $employee->education_qualification = $request->education_qualification;
        $employee->employee_type = $request->employee_type;
        $employee->gender = $request->gender;
        $employee->marital_status = $request->marital_status;
        $employee->mobile_no = $request->mobile_no;
        $employee->father_name = $request->father_name;
        $employee->mother_name = $request->mother_name;
        $employee->emergency_contact = $request->emergency_contact;
        $employee->signature = $signature;
        $employee->photo = $photo;
        $employee->present_address = $request->present_address;
        $employee->permanent_address = $request->permanent_address;
        $employee->email = $request->email;
        $employee->religion = $request->religion;
        $employee->cv = $cv;
        //new
        $employee->expected_salary = $request->expected_salary;
        $employee->salary_offered = $request->salary_offered;
        $employee->other_benefits = $request->other_benefits;
        $employee->any_condition = $request->any_condition;
        $employee->expected_joining_date = $request->expected_joining_date;
        $employee->interview_date = $request->interview_date;
        $employee->required_company_unit = $request->required_company_unit;
        $employee->job_description = $request->job_description;
        //point section
        $employee->dress_up = $request->dress_up;
        $employee->grooming_up = $request->grooming_up;
        $employee->body_language = $request->body_language;
        $employee->attitude = $request->attitude;
        $employee->personality = $request->personality;
        $employee->cv_status = $request->cv_status;
        $employee->educational_qualification = $request->educational_qualification;
        $employee->professional_qualification = $request->professional_qualification;
        $employee->training_and_others = $request->training_and_others;
        $employee->award_recogntion = $request->award_recogntion;
        $employee->relevent_experience = $request->relevent_experience;
        $employee->professional_achievements = $request->professional_achievements;
        $employee->potentiality = $request->potentiality;
        $employee->oral_communication = $request->oral_communication;
        $employee->eye_contact = $request->eye_contact;
        $employee->language_proficiency = $request->language_proficiency;
        $employee->computer_skill = $request->computer_skill;
        $employee->interpersonal_skill = $request->interpersonal_skill;
        $employee->job_knowledge = $request->job_knowledge;
        $employee->general_knowledge = $request->general_knowledge;
        $employee->family_background = $request->family_background;
        $employee->wllingness_to_learn = $request->wllingness_to_learn;
        $employee->long_term_objectives = $request->long_term_objectives;
        $employee->team_skill = $request->team_skill;
        $employee->working_planing_skill = $request->working_planing_skill;
        $employee->status = $request->status;


        $employee->previous_salary = $request->previous_salary ? $request->previous_salary : 0;
        $employee->gross_salary = $request->gross_salary;

        $employee->medical = round($request->gross_salary * .04);
        $employee->travel = round($request->gross_salary * .12);
        $employee->house_rent = round($request->gross_salary * .24);
        $employee->basic_salary = round($request->gross_salary * .60);
        $employee->tax = 0;
        $employee->others_deduct =0;

        $employee->save();

        $designationLog = new DesignationLog();
        $designationLog->employee_id = $employee->id;
        $designationLog->department_id = $request->department;
        $designationLog->designation_id = $request->designation;
        $designationLog->date = date('Y-m-d');
        $designationLog->save();
        $salaryChangeLog = new SalaryChangeLog();
        $salaryChangeLog->employee_id = $employee->id;
        $salaryChangeLog->date = date('Y-m-d');
        $salaryChangeLog->basic_salary = round($request->gross_salary * .60);
        $salaryChangeLog->house_rent = round($request->gross_salary * .24);
        $salaryChangeLog->travel = round($request->gross_salary * .12);
        $salaryChangeLog->medical = round($request->gross_salary * .04);
        $salaryChangeLog->tax = 0;
        $salaryChangeLog->others_deduct = 0;
        $salaryChangeLog->gross_salary = round($request->gross_salary);
        $salaryChangeLog->type = 5;
        $salaryChangeLog->save();



        return redirect()->route('employee.all')->with('message', 'Employee add successfully.');
    }

    public function employeeEdit(Employee $employee) {
        $departments = Department::where('status', 1)
            ->orderBy('name')->get();

        return view('hr.employee.edit', compact('departments', 'employee'));
    }

    public function employeeEditPost(Employee $employee, Request $request) {

        $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'joining_date' => 'nullable|date',
            'confirmation_date' => 'nullable|date',
            'education_qualification' => 'nullable|max:255',
            'department' => 'required',
            'designation' => 'required',
            'employee_type' => 'required',
            'gender' => 'required',
            'marital_status' => 'required',
            'mobile_no' => 'nullable|digits:11',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'emergency_contact' => 'required|string|max:255',
            'signature' => 'nullable|image',
            'photo' => 'nullable|image',
            'present_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'religion' => 'required',
            'cv' => 'nullable|mimes:doc,pdf,docx',
            'salary_offered' => 'required',
            'status' => 'required',
        ]);

        $signature = $employee->signature;
        if ($request->signature) {
            // Previous Photo
            $previousPhoto = public_path($employee->signature);
            unlink($previousPhoto);

            $file = $request->file('signature');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/employee/signature';
            $file->move($destinationPath, $filename);

            $signature = 'uploads/employee/signature/'.$filename;
        }

        $photo = $employee->photo;
        if ($request->photo) {
            // Previous Photo
            if ($employee->photo){
                unlink(public_path($employee->photo));
            }


            $file = $request->file('photo');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/employee/photo';
            $file->move($destinationPath, $filename);

            $photo = 'uploads/employee/photo/'.$filename;
        }

        // Upload CV
        $cv = $employee->cv;
        if ($request->cv) {
            // Previous CV
            if ($employee->cv) {
                $previousCV = public_path($employee->cv);
                unlink($previousCV);
            }

            $file = $request->file('cv');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/employee/cv';
            $file->move($destinationPath, $filename);

            $cv = 'uploads/employee/cv/'.$filename;
        }

        $employee->name = $request->name;
        $employee->dob = $request->date_of_birth;
        $employee->joining_date = $request->joining_date;
        $employee->confirmation_date = $request->confirmation_date;
        $employee->education_qualification = $request->education_qualification;
        $employee->department_id = $request->department;
        $employee->designation_id = $request->designation;
        $employee->employee_type = $request->employee_type;
        $employee->gender = $request->gender;
        $employee->marital_status = $request->marital_status;
        $employee->mobile_no = $request->mobile_no;
        $employee->father_name = $request->father_name;
        $employee->mother_name = $request->mother_name;
        $employee->emergency_contact = $request->emergency_contact;
        $employee->signature = $signature;
        $employee->photo = $photo;
        $employee->present_address = $request->present_address;
        $employee->permanent_address = $request->permanent_address;
        $employee->email = $request->email;
        $employee->religion = $request->religion;
        $employee->cv = $cv;

        //new
        $employee->expected_salary = $request->expected_salary;
        $employee->salary_offered = $request->salary_offered;
        $employee->other_benefits = $request->other_benefits;
        $employee->any_condition = $request->any_condition;
        $employee->expected_joining_date = $request->expected_joining_date;
        $employee->interview_date = $request->interview_date;
        $employee->required_company_unit = $request->required_company_unit;
        $employee->job_description = $request->job_description;
        //point section
        $employee->dress_up = $request->dress_up;
        $employee->grooming_up = $request->grooming_up;
        $employee->body_language = $request->body_language;
        $employee->attitude = $request->attitude;
        $employee->personality = $request->personality;
        $employee->cv_status = $request->cv_status;
        $employee->educational_qualification = $request->educational_qualification;
        $employee->professional_qualification = $request->professional_qualification;
        $employee->training_and_others = $request->training_and_others;
        $employee->award_recogntion = $request->award_recogntion;
        $employee->relevent_experience = $request->relevent_experience;
        $employee->professional_achievements = $request->professional_achievements;
        $employee->potentiality = $request->potentiality;
        $employee->oral_communication = $request->oral_communication;
        $employee->eye_contact = $request->eye_contact;
        $employee->language_proficiency = $request->language_proficiency;
        $employee->computer_skill = $request->computer_skill;
        $employee->interpersonal_skill = $request->interpersonal_skill;
        $employee->job_knowledge = $request->job_knowledge;
        $employee->general_knowledge = $request->general_knowledge;
        $employee->family_background = $request->family_background;
        $employee->wllingness_to_learn = $request->wllingness_to_learn;
        $employee->long_term_objectives = $request->long_term_objectives;
        $employee->team_skill = $request->team_skill;
        $employee->working_planing_skill = $request->working_planing_skill;
        $employee->status = $request->status;

        $employee->save();

        return redirect()->route('employee.all')->with('message', 'Employee edit successfully.');
    }

    public function employeeDetails(Employee $employee) {
        $leaves = Leave::where('employee_id', $employee->id)
            ->where('year', date('Y'))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('hr.employee.details', compact('employee', 'leaves'));
    }

    public function getLeave(Request $request) {
        $leaves = Leave::where('employee_id', $request->employeeId)
            ->where('year', $request->year)
            ->orderBy('created_at', 'desc')
            ->get();

        $html = view('partials.leave_table', compact('leaves'))->render();

        return response()->json(['html' => $html]);
    }

    public function employeeDesignationUpdate(Request $request) {
        $rules = [
            'hr' => 'required',
            'villaeg' => 'required',
            'post_office' => 'required',
            'police_station' => 'required',
            'post_office' => 'required',
            'district' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $candidate = CandidateInterviewEvalution::find($request->id);
        $candidate->hr = $request->hr;
        $candidate->villaeg = $request->villaeg;
        $candidate->post_office = $request->post_office;
        $candidate->police_station = $request->police_station;
        $candidate->district = $request->district;
        $candidate->save();

//        $log = new DesignationLog();
//        $log->employee_id = $employee->id;
//        $log->department_id = $request->department;
//        $log->designation_id = $request->designation;
//        $log->date = $request->date;
//        $log->save();

        return response()->json(['success' => true, 'message' => 'Update has been completed.']);
    }

    public function employeeDatatable() {
    $query = CandidateInterviewEvalution::with('department', 'designation','leaves')->where('selected', 1);

    return DataTables::eloquent($query)
        ->addColumn('department', function(CandidateInterviewEvalution $candidate) {
            return $candidate->department->name;
        })
        ->addColumn('designation', function(CandidateInterviewEvalution $candidate) {
            return $candidate->designation->name;
        })
        ->addColumn('action', function(CandidateInterviewEvalution $candidate) {
            return '
                        <a class="btn btn-primary btn-sm" href="'.route('candidate_evalution_form.details', ['candidate' => $candidate->id]).'">Details</a>
                        <a class="btn btn-info btn-sm" href="'.route('candidate_evalution_form.edit', ['candidate' => $candidate->id]).'">Edit</a>';
        })
        ->editColumn('image', function(CandidateInterviewEvalution $candidate) {
            if ($candidate->image)
                return '<img src="'.asset($candidate->image).'" height="50px">';
            else
                return '<img src="'.asset('img/no_image.png').'" height="50px">';
        })
        ->editColumn('employee_type', function(CandidateInterviewEvalution $candidate) {
            if ($candidate->employee_type == 1)
                return '<span class="label label-success">Permanent</span>';
            else
                return '<span class="label label-warning">Temporary</span>';
        })
        ->editColumn('selection', function(CandidateInterviewEvalution $candidate) {
            if ($candidate->selected == 1)
                return '<span class="label label-success">Selected</span>';
            else
                return '<span class="label label-warning">Rejected</span>';
        })
        ->addColumn('action_agreement', function(CandidateInterviewEvalution $candidate) {
            return '<a class="btn btn-primary btn-sm" href="'.route('candidate_agreement_letter', ['candidate' => $candidate->id]).'">Agreem.Letter</a>';
        })
        ->addColumn('action_resignation', function(CandidateInterviewEvalution $candidate) {
            return '<a class="btn btn-primary btn-sm" href="'.route('resignation_letter_input', ['candidate' => $candidate->id]).'">Acceptance Resignation</a>';
        })
        ->addColumn('action_experience', function(CandidateInterviewEvalution $candidate) {
            return '<a class="btn btn-primary btn-sm" href="'.route('experience_certificate_input', ['candidate' => $candidate->id]).'">Experience Certificate</a>';
        })
        ->addColumn('action_information', function(CandidateInterviewEvalution $candidate) {
            return '<a class="btn btn-primary btn-sm" href="'.route('employee_information_details', ['candidate' => $candidate->id]).'">Employee Information</a>';
        })
        ->addColumn('action_job_description', function(CandidateInterviewEvalution $candidate) {
            return '<a class="btn btn-primary btn-sm" href="'.route('job_description_input', ['candidate' => $candidate->id]).'">Job Description</a>';
        })
        ->addColumn('action_leave_application', function(CandidateInterviewEvalution $candidate) {
            return '<a class="btn btn-primary btn-sm" href="'.route('leave_application_form', ['candidate' => $candidate->id]).'">Approved</a>';
        })
        ->addColumn('action_warning_letter', function(CandidateInterviewEvalution $candidate) {
            return '<a class="btn btn-primary btn-sm" href="'.route('warning_letter_input', ['candidate' => $candidate->id]).'">Warning Letter</a>';
        })
        ->addColumn('academic_and_training', function(CandidateInterviewEvalution $candidate) {
            return '<a class="btn btn-primary btn-sm" href="'.route('academic_and_training_form', ['candidate' => $candidate->id]).'">Add Academic Information</a>
                    <a class="btn btn-info btn-sm" href="'.route('academic_and_training.details', ['candidate' => $candidate->id]).'">Details</a>
                    <a class="btn btn-warning btn-sm" href="'.route('academic_and_training.edit', ['candidate' => $candidate->id]).'">Edit</a>';
        })
        ->addColumn('training_information', function(CandidateInterviewEvalution $candidate) {
            return '<a class="btn btn-primary btn-sm" href="'.route('training_information_form', ['candidate' => $candidate->id]).'">Add Training Information</a>
                    <a class="btn btn-info btn-sm" href="'.route('training_information.details', ['candidate' => $candidate->id]).'">Details</a>
                    <a class="btn btn-warning btn-sm" href="'.route('training_information.edit', ['candidate' => $candidate->id]).'">Edit</a>';
        })
        ->addColumn('job_information', function(CandidateInterviewEvalution $candidate) {
            return '<a class="btn btn-primary btn-sm" href="'.route('job_information_form', ['candidate' => $candidate->id]).'">Add job Information</a>
                    <a class="btn btn-info btn-sm" href="'.route('job_information.details', ['candidate' => $candidate->id]).'">Details</a>
                    <a class="btn btn-info btn-sm" href="'.route('job_information.edit', ['candidate' => $candidate->id]).'">Edit</a>';
        })
        ->editColumn('status', function(CandidateInterviewEvalution $candidate) {
            if ($candidate->status == 1)
                return '<span class="label label-success">active</span>';
            else
                return '<span class="label label-warning">inactive</span>';
        })


        ->rawColumns(['action','action_agreement','action_resignation','action_experience',
            'action_information','academic_and_training','action_warning_letter','action_job_description',
            'action_leave_application','image','employee_type','selection','job_information','status',
            'training_information'])
        ->toJson();
}

    public function employeeAttendance(Request $request)
    {


         $employees = CandidateInterviewEvalution::with('department', 'designation')->get();
         return view('hr.attendance.add',compact('employees'));

    }



    public function employeeAttendancePost(Request $request)
    {

        $this->validate($request,[
            'attend_date'=>'required'
        ]);

        $attendance_date=date('d-m-y',strtotime($request->attend_date));
        $error=$attendance_date.' Attendance Already Done';

        $employees = CandidateInterviewEvalution::where('status', 1)->get();

            foreach ($employees as $employee) {
                // Present

//                    $this->validate($request,[
//                        'present_time_'.$employee->id=>'required'
//                    ]);

                    $presentId = 'present_'.$employee->id;
                    $noteId = 'note_'.$employee->id;
                    //$lateId = 'late_'.$employee->id;
                    //$lateTimeId = 'late_time_'.$employee->id;
                    $presentTimeId = 'present_time_'.$employee->id;

                    $attendance = new EmployeeAttendance();
                    $attendance->employee_id = $employee->id;
                    $attendance->date = $request->attend_date;

                    if ($request->$presentId) {
                        // present
                        $attendance->present_or_absent = 1;
                        $attendance->note = $request->$noteId;
                        $attendance->present_time =($request->$presentTimeId) ? date('H:i:s',strtotime($request->$presentTimeId )) : null;

                        if (date('H:i:s',strtotime($request->$presentTimeId ))  > date('H:i:s a',strtotime('09:50:00' )) ) {
                            //dd($request->$presentTimeId);
                            $attendance->late = 1;
                            $attendance->late_time = date('H:i:s',strtotime($request->$presentTimeId ));
                            $attendance->note = $request->$noteId;
                        } else {
                            $attendance->late = 0;
                        }
                    } else {
                        // absent
                        $attendance->present_or_absent = 0;
                        $attendance->late = 0;
                        $attendance->late_time = null;
                        $attendance->note = $request->$noteId;
                    }

                    $attendance->save();
            }

        return redirect()->route('employee.attendance')->with('message','Today Employee Attendance Completed.');


    }

    public function attendanceManuallyInput(CandidateInterviewEvalution $candidate){

        $employee = CandidateInterviewEvalution::with('department', 'designation')->where('id',$candidate->id)->first();
       // dd($employee);
        return view('hr.attendance.manually_attendance_input',compact('employee','candidate'));

    }
    public function attendanceManuallyInputPost(CandidateInterviewEvalution $candidate, Request $request){

        $this->validate($request,[
            'attend_date'=>'required'
        ]);

        $attendance_date=date('d-m-y',strtotime($request->attend_date));
        $error=$attendance_date.' Attendance Already Done';

        $employee = CandidateInterviewEvalution::where('status', 1)->where('id',$candidate->id)->first();
        //dd($employee);

            // Present

//                    $this->validate($request,[
//                        'present_time_'.$employee->id=>'required'
//                    ]);

            $presentId = 'present_'.$employee->id;
            $noteId = 'note_'.$employee->id;
            //$lateId = 'late_'.$employee->id;
            //$lateTimeId = 'late_time_'.$employee->id;
            $presentTimeId = 'present_time_'.$employee->id;

            $attendance = new EmployeeAttendance();
            $attendance->employee_id = $employee->id;
            $attendance->date = $request->attend_date;

            if ($request->$presentId) {
                $attendance->present_or_absent = 1;
                $attendance->note = $request->$noteId;
                $attendance->present_time =($request->$presentTimeId) ? date('H:i:s',strtotime($request->$presentTimeId )) : null;

                if (date('H:i:s',strtotime($request->$presentTimeId ))  > date('H:i:s a',strtotime('09:50:00' )) ) {
                    $attendance->late = 1;
                    $attendance->late_time = date('H:i:s',strtotime($request->$presentTimeId ));
                    $attendance->note = $request->$noteId;
                } else {
                    $attendance->late = 0;
                }
            } else {
                $attendance->present_or_absent = 0;
                $attendance->late = 0;
                $attendance->late_time = null;
                $attendance->note = $request->$noteId;
            }

            $attendance->save();


        return redirect()->route('attendance_manually_input',['candidate' => $employee->id])->with('message','Manually Attendance Process Successfully');

    }


    public function employeeWiseAttendance(CandidateInterviewEvalution $candidate){
        //dd($candidate);
        //$employeeWiseAttendances = AttendanceProcess::where('employee_id',$candidate->id)->get();
        $employeeWiseAttendances = AttendanceProcess::where('employee_id',$candidate->id)->get();
        $total_time = AttendanceProcess::where('employee_id', $candidate->id)->sum(DB::raw("TIME_TO_SEC(total_hours)"));
        //dd($total_time);
        return view('hr.attendance.employee_wise_attendance',compact('employeeWiseAttendances','candidate','total_time'));

    }

    public function overtimeApprovedHoursPost(Request $request){
        //dd($request->overtime);
        $this->validate($request, [
            'for_date' => 'required',
        ]);

        $updateOvertime = AttendanceProcess::where('employee_id',$request->candidate_id)->where('process_date',$request->for_date)->first();
        $updateOvertime->over_time = $request->overtime;
        $updateOvertime->save();

        return response()->json(['success' => true, 'message' => 'Overtime Approved Hours Confirm']);

    }

    public function overtimeRejectdPost(Request $request){
        //dd($request->overtime);
        $this->validate($request, [
            'for_date' => 'required',
        ]);

        $updateOvertime = AttendanceProcess::where('employee_id',$request->candidate_id)->where('process_date',$request->for_date)->first();
        $updateOvertime->overtime_approved_status = 0;
        $updateOvertime->save();

        return response()->json(['success' => true, 'message' => 'Overtime Rejected Confirm']);

    }


    public function overtimeApprovedPost(Request $request){
        //dd($request->all());
        $this->validate($request, [
            'for_date' => 'required',
        ]);

        $updateOvertime = AttendanceProcess::where('employee_id',$request->candidate_id)->where('process_date',$request->for_date)->first();
        $updateOvertime->overtime_approved_status = 1;
        $updateOvertime->save();

        return response()->json(['success' => true, 'message' => 'Overtime Approved Confirm']);

    }
    public function employeeWiseOvertime(CandidateInterviewEvalution $candidate){

        $employeeWiseAttendances = AttendanceProcess::where('employee_id',$candidate->id)->get();
        $total_time = AttendanceProcess::where('employee_id', $candidate->id)->sum(DB::raw("TIME_TO_SEC(total_hours)"));

        return view('hr.overtime.employee_wise_overtime',compact('candidate','employeeWiseAttendances','total_time'));
    }

    public function employeeAttendanceProcess(){
        $employees=null;

        $employees =AttendanceProcess::all();


        return view('hr.attendance.process',compact('employees'));
    }

    // public function employeeAttendanceApplication(){
    //     return view("hr.attendance.attendance_application");
    // }
    public function employeeAttendanceApplicationInCharge(){
        $applications = AttendanceApplication::where("status",1)->get();
        return view("hr.attendance.attendance_application_in_charge",compact("applications"));
    }
    public function employeeAttendanceInCharge(AttendanceApplication $attendanceApplication){
        $attendanceApplication->status = 2;
        $attendanceApplication->save();
        return redirect()->back();
    }
    public function employeeAttendanceStatusHr(AttendanceApplication $attendanceApplication){
        $attendanceApplication->status = 3;
        $attendanceApplication->save();
        return redirect()->back();
    }
    public function employeeAttendanceHr(){
        $applications = AttendanceApplication::where("status",2)->get();
        return view("hr.attendance.attendance_application_hr",compact("applications"));
    }
    public function employeeAttendanceApplicationView(){
        $applications = AttendanceApplication::where("employee_id",Auth()->user()->id)->get();
        return view("hr.attendance.attendance_application_view",compact("applications"));
    }
    public function employeeAttendanceApplicationPost(Request $request){
        //dd($request->all());
        $request->validate([
            'date.*' => 'required|date',
            'in_time.*' => 'required',
            'out_time.*' => 'required',
            'location.*' => 'required',
            'purpose_details.*' => 'required',
        ]);

        $counter = 0;

        foreach ($request->date as $reqDate){
            $application = new AttendanceApplication();
            $application->employee_id = Auth()->user()->id;
            $application->date = date("Y-m-d",strtotime($request->date[$counter]));
            $application->in_time = date("H:i:s",strtotime($request->in_time[$counter]));
            $application->out_time = date("H:i:s",strtotime($request->out_time[$counter]));
            $application->location = $request->location[$counter];
            $application->purpose_details = $request->purpose_details[$counter];
            $application->save();
            $counter++;

        }
            return redirect()->route("employee.attendance_application_view");


    }


    public function employeeAttendanceProcessPost(Request $request){

        $this->validate($request,[
            'process_date'=>'required'
        ]);

//        $attendance_date=EmployeeAttendance::where('date',$request->process_date);
//        $error=$attendance_date.' Attendance Already Done';
//        if ($error){
//            return redirect()->route('employee.attendance.process')->with('error','This Date Attendance Process Already Done OR Attendance Not Found');
//        }

        $employees=CandidateInterviewEvalution::where('status',1)->get();


        foreach ($employees as $employee){

            $attendanceProcessIntime= EmployeeAttendance::where('date',$request->process_date)->where('employee_id', $employee->id )->orderBy('id','asc')->first();
            $attendanceProcessOutTime= EmployeeAttendance::where('date',$request->process_date)->where('employee_id', $employee->id)->orderBy('id','desc')->first();


            $attendanceProcess = new AttendanceProcess();
            $attendanceProcess->employee_id = $employee->id;

            if ($attendanceProcessIntime && $attendanceProcessIntime->present_or_absent == 1){

                $attendanceProcess->intime = $attendanceProcessIntime->present_time;
                if ($attendanceProcessIntime->present_time < date('H:i:s', strtotime('08:15:00'))){
                    $attendanceProcess-> early_in_time = $attendanceProcessIntime->present_time;
                }
                $earlyLate = \Carbon\Carbon::parse($attendanceProcess->intime)->diff(\Carbon\Carbon::parse('08:15 AM'))->format('%h:%I');
            }

            if ($attendanceProcessIntime && $attendanceProcessOutTime-> present_or_absent == 1){

                $attendanceProcess->outtime = $attendanceProcessOutTime->present_time;
                if ($attendanceProcessIntime->present_time > date('H:i:s', strtotime('17:00:00'))){
                    $attendanceProcess->early_out_time = $attendanceProcessOutTime->present_time;
                }
                $lateOut = \Carbon\Carbon::parse($attendanceProcess->outtime)->diff(\Carbon\Carbon::parse('5:30 PM'))->format('%h:%I');

            }

            if ($attendanceProcessIntime && $attendanceProcessOutTime-> present_or_absent == 1){

                $attendanceProcess->status = 1;
            }
            else{
                $attendanceProcess->status = 0;
            }
            $total_hours =(new Carbon($attendanceProcessOutTime->present_time??''))->diff(new Carbon($attendanceProcessIntime->present_time??''))->format('%h:%I');
            $attendanceProcess->total_hours = $total_hours;
            $attendanceProcess->late_time= $earlyLate;
            $attendanceProcess->over_time= $lateOut;
            $attendanceProcess->process_date = $request->process_date;
            $attendanceProcess->remark = $attendanceProcessIntime->note??'';
            $attendanceProcess->save();

        }

        return redirect()->route('employee.attendance.process')->with('message',' Attendance Process Successfully');
    }

    public function employeeExcelFileImport(){

        return view('hr.attendance.excelFileImport');
    }

    public function employeeExcelFileImportPost(Request $request){

        Excel::import(new AttendanceImport, $request->excel_import);


        return redirect()->route('employee.excelfileimport')->with('message',' Excel File Import Successfully');
    }

    public function employeeAttendanceApplication(){

        return view('hr.attendance.attendance_application');
    }

    public function appointmentLetter(Employee $employee){

        return view('hr.employee.appointment_letter',compact('employee'));
    }

    public function candidateEvalutionFormIndex(){

        $departments = Department::where('status', 1)
            ->orderBy('name')->get();

        return view('hr.evalution.candidate_evalution_all',compact('departments'));
    }

    public function candidateEvalutionAdd(){

        $departments = Department::where('status', 1)
            ->orderBy('name')->get();
        $count = CandidateInterviewEvalution::count();
        $employeeId = str_pad($count+1, 4, '0', STR_PAD_LEFT);

        return view('hr.evalution.candidate_evalution_form',compact('departments','employeeId'));
    }

    public function candidateEvalutionPost(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'interview_date' => 'date',
            'department' => 'required',
            'designation' => 'required',
            'mobile_no' => 'required|digits:11',
            'email' => 'required|string|email|max:255',
            'expected_salary' => 'required',
            'current_salary' => 'required',
            'employee_type' => 'required',
            'image' => 'required',
            'status' => 'required',

        ]);

        $photo=null;
        if ($request->image) {

            $file = $request->file('image');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/candidate/image';
            $file->move($destinationPath, $filename);

            $image = 'uploads/candidate/image/'.$filename;
        }


        $candidate = new CandidateInterviewEvalution();
        $candidate->name = $request->name;
        $candidate->employee_id = $request->employee_id;
        $candidate->department_id = $request->department;
        $candidate->designation_id = $request->designation;
        $candidate->mobile_no = $request->mobile_no;
        $candidate->email = $request->email;
        $candidate->fathers_name = $request->fathers_name;
        $candidate->current_salary = $request->current_salary;

        //new
        $candidate->expected_salary = $request->expected_salary;
        $candidate->salary_offered = $request->salary_offered;
        $candidate->others_benefits = $request->others_benefits;
        $candidate->any_condition = $request->any_condition;
        $candidate->expected_joining_date = $request->expected_joining_date;
        $candidate->interview_date = $request->interview_date;
        $candidate->required_company_unit = $request->required_company_unit;
        $candidate->job_description = $request->job_description;
        $candidate->reference = $request->reference;
        $candidate->employee_type = $request->employee_type;
        $candidate->image = $image;
        //point section
        $candidate->dress_up = ($request->dress_up ? $request->dress_up : 0);
        $candidate->dress_up_remarks = $request->dress_up_remarks;
        $candidate->grooming_up = ($request->grooming_up ? $request->grooming_up : 0);
        $candidate->grooming_up_remarks = $request->grooming_up_remarks;
        $candidate->body_language = ($request->body_language ? $request->body_language : 0);
        $candidate->body_language_remarks = $request->body_language_remarks;
        $candidate->attitude_remarks = $request->attitude_remarks;
        $candidate->attitude = ($request->attitude ? $request->attitude : 0);
        $candidate->personality = ($request->personality ? $request->personality : 0);
        $candidate->personality_remarks = $request->personality_remarks;
        $candidate->cv_status = ($request->cv_status ? $request->cv_status : 0);
        $candidate->cv_status_remarks = $request->cv_status_remarks;
        $candidate->educational_qualification = ($request->educational_qualification ? $request->educational_qualification : 0);
        $candidate->educational_qualification_remarks = $request->educational_qualification_remarks;
        $candidate->professional_qualification = ($request->professional_qualification ? $request->professional_qualification : 0);
        $candidate->professional_qualification_remarks = $request->professional_qualification_remarks;
        $candidate->training_and_others = ($request->training_and_others ? $request->training_and_others : 0);
        $candidate->training_and_others_remarks = $request->training_and_others_remarks;
        $candidate->award_recogntion_remarks = $request->award_recogntion_remarks;
        $candidate->award_recogntion = ($request->award_recogntion ? $request->award_recogntion : 0);
        $candidate->relevent_experience = ($request->relevent_experience ? $request->relevent_experience : 0);
        $candidate->relevent_experience_remarks = $request->relevent_experience_remarks;
        $candidate->professional_achievements = ($request->professional_achievements ? $request->professional_achievements : 0);
        $candidate->professional_achievements_remarks = $request->professional_achievements_remarks;
        $candidate->potentiality = ($request->potentiality ? $request->potentiality : 0);
        $candidate->potentiality_remarks = $request->potentiality_remarks;
        $candidate->oral_communication = ($request->oral_communication ? $request->oral_communication : 0);
        $candidate->oral_communication_remarks = $request->oral_communication_remarks;
        $candidate->eye_contact = ($request->eye_contact ? $request->eye_contact : 0);
        $candidate->eye_contact_remarks = $request->eye_contact_remarks;
        $candidate->language_proficiency = ($request->language_proficiency ? $request->language_proficiency : 0);
        $candidate->language_proficiency_remarks = $request->language_proficiency_remarks;
        $candidate->computer_skill = ($request->computer_skill ? $request->computer_skill : 0);
        $candidate->computer_skill_remarks = $request->computer_skill_remarks;
        $candidate->interpersonal_skill = ($request->interpersonal_skill ? $request->interpersonal_skill : 0);
        $candidate->interpersonal_skill_remarks = $request->interpersonal_skill_remarks;
        $candidate->job_knowledge = ($request->job_knowledge ? $request->job_knowledge : 0);
        $candidate->job_knowledge_remarks = $request->job_knowledge_remarks;
        $candidate->general_knowledge = ($request->general_knowledge ? $request->general_knowledge : 0);
        $candidate->general_knowledge_remarks = $request->general_knowledge_remarks;
        $candidate->family_background = ($request->family_background ? $request->family_background : 0);
        $candidate->family_background_remarks = $request->family_background_remarks;
        $candidate->wllingness_to_learn_remarks = $request->wllingness_to_learn_remarks;
        $candidate->wllingness_to_learn = ($request->wllingness_to_learn ? $request->wllingness_to_learn : 0);
        $candidate->long_term_objectives = ($request->long_term_objectives ? $request->long_term_objectives : 0);
        $candidate->long_term_objectives_remarks = $request->long_term_objectives_remarks;
        $candidate->team_skill = ($request->team_skill ? $request->team_skill : 0);
        $candidate->team_skill_remarks = $request->team_skill_remarks;
        $candidate->working_planing_skill = ($request->working_planing_skill ? $request->working_planing_skill : 0);
        $candidate->selected = $request->selected;
        $candidate->short_Listed = $request->short_Listed;
        $candidate->may_be_Call_later = $request->may_be_Call_later;
        $candidate->rejected = $request->rejected;
        $candidate->status = $request->status;

        $candidate->save();

        $designationLog = new DesignationLog();
        $designationLog->department_id = $request->department;
        $designationLog->designation_id = $request->designation;
        $designationLog->date = date('Y-m-d');
        $designationLog->save();


        return redirect()->route('candidate_evalution_form.all')->with('message', 'Candiadate add successfully.');

    }


    public function candidateEvalutionEdit(CandidateInterviewEvalution $candidate){

        $departments = Department::where('status', 1)
            ->orderBy('name')->get();




        return view('hr.evalution.candidate_evalution_form_edit',compact('departments', 'candidate'));
    }

    public function candidateEvalutionEditPost(CandidateInterviewEvalution $candidate, Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'interview_date' => 'date',
            'department' => 'required',
            'designation' => 'required',
            'mobile_no' => 'required|digits:11',
            'email' => 'required|string|email|max:255',
            'expected_salary' => 'required',
            'current_salary' => 'required',
            //'image' => 'nullable|required',
            'status' => 'required',
        ]);

        $image = $candidate->image;
        if ($request->image) {
            // Previous Photo
            if ($candidate->image){

                unlink(public_path($candidate->image));
            }



            $file = $request->file('image');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/candidate/image';
            $file->move($destinationPath, $filename);

            $image = 'uploads/candidate/image/'.$filename;
        }

//        $total = DB::table('CandidateInterviewEvalution')
//            ->select(DB::raw('dress_up + dress_up_remarks + body_language'))
//            ->where('id', $request->employee_id)
//            ->get();
//        //dd($total);

        $candidate->name = $request->name;;
        $candidate->department_id = $request->department;
        $candidate->designation_id = $request->designation;
        $candidate->mobile_no = $request->mobile_no;
        $candidate->email = $request->email;
        $candidate->current_salary = $request->current_salary;
        $candidate->fathers_name = $request->fathers_name;
        //new
        $candidate->expected_salary = $request->expected_salary;
        $candidate->salary_offered = $request->salary_offered;
        $candidate->others_benefits = $request->others_benefits;
        $candidate->any_condition = $request->any_condition;
        $candidate->expected_joining_date = $request->expected_joining_date;
        $candidate->interview_date = $request->interview_date;
        $candidate->required_company_unit = $request->required_company_unit;
        $candidate->job_description = $request->job_description;
        $candidate->reference = $request->reference;
        $candidate->employee_type = $request->employee_type;
        $candidate->image = $image;
        //point section
        $candidate->dress_up = ($request->dress_up ? $request->dress_up : 0);
        $candidate->dress_up_remarks = $request->dress_up_remarks;
        $candidate->grooming_up = ($request->grooming_up ? $request->grooming_up : 0);
        $candidate->grooming_up_remarks = $request->grooming_up_remarks;
        $candidate->body_language = ($request->body_language ? $request->body_language : 0);
        $candidate->body_language_remarks = $request->body_language_remarks;
        $candidate->attitude_remarks = $request->attitude_remarks;
        $candidate->attitude = ($request->attitude ? $request->attitude : 0);
        $candidate->personality = ($request->personality ? $request->personality : 0);
        $candidate->personality_remarks = $request->personality_remarks;
        $candidate->cv_status = ($request->cv_status ? $request->cv_status : 0);
        $candidate->cv_status_remarks = $request->cv_status_remarks;
        $candidate->educational_qualification = ($request->educational_qualification ? $request->educational_qualification : 0);
        $candidate->educational_qualification_remarks = $request->educational_qualification_remarks;
        $candidate->professional_qualification = ($request->professional_qualification ? $request->professional_qualification : 0);
        $candidate->professional_qualification_remarks = $request->professional_qualification_remarks;
        $candidate->training_and_others = ($request->training_and_others ? $request->training_and_others : 0);
        $candidate->training_and_others_remarks = $request->training_and_others_remarks;
        $candidate->award_recogntion_remarks = $request->award_recogntion_remarks;
        $candidate->award_recogntion = ($request->award_recogntion ? $request->award_recogntion : 0);
        $candidate->relevent_experience = ($request->relevent_experience ? $request->relevent_experience : 0);
        $candidate->relevent_experience_remarks = $request->relevent_experience_remarks;
        $candidate->professional_achievements = ($request->professional_achievements ? $request->professional_achievements : 0);
        $candidate->professional_achievements_remarks = $request->professional_achievements_remarks;
        $candidate->potentiality = ($request->potentiality ? $request->potentiality : 0);
        $candidate->potentiality_remarks = $request->potentiality_remarks;
        $candidate->oral_communication = ($request->oral_communication ? $request->oral_communication : 0);
        $candidate->oral_communication_remarks = $request->oral_communication_remarks;
        $candidate->eye_contact = ($request->eye_contact ? $request->eye_contact : 0);
        $candidate->eye_contact_remarks = $request->eye_contact_remarks;
        $candidate->language_proficiency = ($request->language_proficiency ? $request->language_proficiency : 0);
        $candidate->language_proficiency_remarks = $request->language_proficiency_remarks;
        $candidate->computer_skill = ($request->computer_skill ? $request->computer_skill : 0);
        $candidate->computer_skill_remarks = $request->computer_skill_remarks;
        $candidate->interpersonal_skill = ($request->interpersonal_skill ? $request->interpersonal_skill : 0);
        $candidate->interpersonal_skill_remarks = $request->interpersonal_skill_remarks;
        $candidate->job_knowledge = ($request->job_knowledge ? $request->job_knowledge : 0);
        $candidate->job_knowledge_remarks = $request->job_knowledge_remarks;
        $candidate->general_knowledge = ($request->general_knowledge ? $request->general_knowledge : 0);
        $candidate->general_knowledge_remarks = $request->general_knowledge_remarks;
        $candidate->family_background = ($request->family_background ? $request->family_background : 0);
        $candidate->family_background_remarks = $request->family_background_remarks;
        $candidate->wllingness_to_learn_remarks = $request->wllingness_to_learn_remarks;
        $candidate->wllingness_to_learn = ($request->wllingness_to_learn ? $request->wllingness_to_learn : 0);
        $candidate->long_term_objectives = ($request->long_term_objectives ? $request->long_term_objectives : 0);
        $candidate->long_term_objectives_remarks = $request->long_term_objectives_remarks;
        $candidate->team_skill = ($request->team_skill ? $request->team_skill : 0);
        $candidate->team_skill_remarks = $request->team_skill_remarks;
        $candidate->working_planing_skill = ($request->working_planing_skill ? $request->working_planing_skill : 0);
        $candidate->selected = $request->selected;
        $candidate->short_Listed = $request->short_Listed;
        $candidate->may_be_Call_later = $request->may_be_Call_later;
        $candidate->rejected = $request->rejected;
        $candidate->status = $request->status;

        $candidate->save();

        $designationLog = new DesignationLog();
        //$designationLog->id = $candidate->id;
        $designationLog->department_id = $request->department;
        $designationLog->designation_id = $request->designation;
        $designationLog->save();

        return redirect()->route('candidate_evalution_form.all')->with('message', 'Candidate edit successfully.');

    }
    public function candidateEvalutionDetails(CandidateInterviewEvalution $candidate){


        return view('hr.evalution.details',compact('candidate'));
    }

    public function candidateAppointmentLetter(CandidateInterviewEvalution $candidate){

        return view('hr.evalution.appointment_letter',compact('candidate'));
    }

    public function candidateAppointmentLetterAll(){
        return view('hr.appointment_letter.all');
    }

    public function appointmentLetterInput(CandidateInterviewEvalution $candidate){

        return view('hr.appointment_letter.appointment_letter_input',compact('candidate'));
    }

    public function appointmentLetterPost(CandidateInterviewEvalution $candidate, Request $request){

        $request->validate([
            'subject' => 'required',
        ]);

        $candidate->subject = $request->subject;
        $candidate->appointment_letter_body = $request->appointment_letter_body;
        $candidate->address = $request->address;
        $candidate->save();

        return view('hr.appointment_letter.appointment_letter',compact('candidate'));
    }

    public function candidateAppointmentLetterDatatable(){
        $query = CandidateInterviewEvalution::with('department', 'designation');

        return DataTables::eloquent($query)
            ->addColumn('department', function(CandidateInterviewEvalution $candidate) {
                return $candidate->department->name;
            })
            ->addColumn('designation', function(CandidateInterviewEvalution $candidate) {
                return $candidate->designation->name;
            })
            ->addColumn('action', function(CandidateInterviewEvalution $candidate) {
                return '
                        <a class="btn btn-info btn-sm" href="'.route('appointment_letter_input', ['candidate' => $candidate->id]).'">Appoint.Letter</a>
                        <a class="btn btn-primary btn-sm btn-change-designation" role="button" data-id="'.$candidate->id.'">Add Extra Data</a>';


            })

            ->editColumn('status', function(CandidateInterviewEvalution $candidate) {
                if ($candidate->status == 1)
                    return '<span class="label label-success">active</span>';
                else
                    return '<span class="label label-warning">inactive</span>';
            })

            ->rawColumns(['action','status'])
            ->toJson();
    }

    public function candidateEvalutionFormDatatable() {
        $query = CandidateInterviewEvalution::with('department', 'designation');

//        $stats = DB::table('CandidateInterviewEvalution')
//            ->select(DB::raw('dress_up + dress_up_remarks'))
//            ->where('id', '=', '1')
//            ->first();
//        dd($stats);

        return DataTables::eloquent($query)
            ->addColumn('department', function(CandidateInterviewEvalution $candidate) {
                return $candidate->department->name;
            })
            ->addColumn('designation', function(CandidateInterviewEvalution $candidate) {
                return $candidate->designation->name;
            })
            ->addColumn('action', function(CandidateInterviewEvalution $candidate) {
                return '
                        <a class="btn btn-primary btn-sm" href="'.route('candidate_evalution_form.details', ['candidate' => $candidate->id]).'">Details</a>
                        <a class="btn btn-info btn-sm" href="'.route('candidate_evalution_form.edit', ['candidate' => $candidate->id]).'">Edit</a>';
            })
            ->editColumn('image', function(CandidateInterviewEvalution $candidate) {
                if ($candidate->image)
                    return '<img src="'.asset($candidate->image).'" height="50px">';
                else
                    return '<img src="'.asset('img/no_image.png').'" height="50px">';
            })
            ->editColumn('employee_type', function(CandidateInterviewEvalution $candidate) {
                if ($candidate->employee_type == 1)
                    return '<span class="label label-success">Permanent</span>';
                else
                    return '<span class="label label-warning">Temporary</span>';
            })
            ->editColumn('selection', function(CandidateInterviewEvalution $candidate) {
                if ($candidate->selected == 1)
                    return '<span class="label label-success">Selected</span>';
                else
                    return '<span class="label label-warning">Rejected</span>';
            })
            ->addColumn('action_agreement', function(CandidateInterviewEvalution $candidate) {
                return '<a class="btn btn-primary btn-sm" href="'.route('candidate_agreement_letter', ['candidate' => $candidate->id]).'">Agreem.Letter</a>';
            })
            ->addColumn('action_resignation', function(CandidateInterviewEvalution $candidate) {
                return '<a class="btn btn-primary btn-sm" href="'.route('resignation_letter_input', ['candidate' => $candidate->id]).'">Acceptance Resignation</a>';
            })
            ->addColumn('action_experience', function(CandidateInterviewEvalution $candidate) {
                return '<a class="btn btn-primary btn-sm" href="'.route('experience_certificate_input', ['candidate' => $candidate->id]).'">Experience Certificate</a>';
            })
            ->addColumn('action_information', function(CandidateInterviewEvalution $candidate) {
                return '<a class="btn btn-primary btn-sm" href="'.route('employee_information_details', ['candidate' => $candidate->id]).'">Employee Information</a>';
            })
            ->addColumn('action_job_description', function(CandidateInterviewEvalution $candidate) {
                return '<a class="btn btn-primary btn-sm" href="'.route('job_description_input', ['candidate' => $candidate->id]).'">Job Description</a>';
            })
            ->addColumn('action_leave_application', function(CandidateInterviewEvalution $candidate) {
                return '<a class="btn btn-primary btn-sm" href="'.route('leave_application_form', ['candidate' => $candidate->id]).'">Apply Leave</a>';
            })
            ->editColumn('status', function(CandidateInterviewEvalution $candidate) {
                if ($candidate->status == 1)
                    return '<span class="label label-success">active</span>';
                else
                    return '<span class="label label-warning">inactive</span>';
            })

            ->rawColumns(['action','action_agreement','action_resignation','action_experience',
                'action_information','action_job_description','action_leave_application','image','employee_type',
                'selection','status'])
            ->toJson();
    }


    public function candidateAgreementLetterAll(){
        return view('hr.agreement_letter.all');
    }

    public  function candidateAgreementLetter(CandidateInterviewEvalution $candidate){

        return view('hr.agreement_letter.agreement_letter',compact('candidate'));
    }



    public  function employeeIdCard(){

        $employees = CandidateInterviewEvalution::where('selected',1)->get();

        return view('hr.id_card.id_card',compact('employees'));
    }

    public  function employeeIdCardPost( Request $request){

        $employee=CandidateInterviewEvalution::where('id',$request->employee)->first();

        return view('hr.id_card.id_card_print',compact('employee'));
    }

    public function acceptanceOfResignation(){
        return view('hr.acceptance_of_resignation.all');
    }

    public function acceptanceOfResignationLetterInput(CandidateInterviewEvalution $candidate){
        return view('hr.acceptance_of_resignation.resignation_letter_input',compact('candidate'));
    }

    public function acceptanceOfResignationLetterPost(CandidateInterviewEvalution $candidate, Request $request){


        $candidate->resignation_letter_body = $request->resignation_letter_body;
        $candidate->save();

        return view('hr.acceptance_of_resignation.resignation_letter',compact('candidate'));
    }

    public function experienceCertificate(){
        return view('hr.experience_certificate.all');
    }

    public function experienceCertificatePage(CandidateInterviewEvalution $candidate){

        return view('hr.experience_certificate.experience_certificate',compact('candidate'));
    }

    public function experienceCertificateInput(CandidateInterviewEvalution $candidate){

        return view('hr.experience_certificate.experience_certificate_input',compact('candidate'));
    }

    public function experienceCertificatePost(CandidateInterviewEvalution $candidate, Request $request){


        $candidate->experience_certificate_body = $request->experience_certificate_body;
        $candidate->save();

        return view('hr.experience_certificate.experience_certificate',compact('candidate'));
    }

    public function employeeInformation(){
        return view('hr.employee_information.all');
    }

    public function employeeInformationDetails(CandidateInterviewEvalution $candidate){

        return view('hr.employee_information.details',compact('candidate'));
    }

    public function jobDescription(){
        return view('hr.job_description.all');
    }

    public function jobDescriptionPage(){
        return view('hr.job_description.job_description_page');
    }

    public function jobDescriptionInput(CandidateInterviewEvalution $candidate){

        return view('hr.job_description.job_description_input',compact('candidate'));
    }

    public function jobDescriptionPost(CandidateInterviewEvalution $candidate, Request $request){


        $request->validate([
            'section' => 'required',
        ]);

        $jobdescription=new JobDescription();
        $jobdescription->candidate_interview_evalution_id = $candidate->id;
        $jobdescription->section = $request->section;
        $jobdescription->reporting_to = $request->reporting_to;
        $jobdescription->duties_and_responsibilities = $request->duties_and_responsibilities;
        $jobdescription->save();

        return view('hr.job_description.job_description_page',compact('candidate','jobdescription'));

    }

    public function leaveApplication(){


        return view('hr.leave_application.all');
    }

    public function leaveApplicationForm(Leave $candidate){

        $leave = Leave::where('id',$candidate->id)->first();
        //dd($leave->type);
        //$leaveType= Leave::where('employee_id',$leave->employee_id)->get();
        //dd($leaveType);
        $lastDateofLeave = Leave::where('id',$candidate->id)->orderBy('id', 'DESC')->first();

        $annualLeaveSum=Leave::where('employee_id',$candidate->employee_id)->where('type', 1)->where('year', 2021)->sum('total_annual');
        $annualLeaveRemaining = (5 - $annualLeaveSum);

        $casualLeaveSum=Leave::where('employee_id',$candidate->employee_id)->where('type', 2)->where('year', 2021)->sum('total_casual');
        $casualLeaveRemaining = (5 - $casualLeaveSum);

        $medicalLeaveSum=Leave::where('employee_id',$candidate->employee_id)->where('type', 3)->where('year', 2021)->sum('total_medical');
        $medicalLeaveRemaining = (10 - $medicalLeaveSum);


        return view('hr.leave_application.form',compact('candidate','leave','annualLeaveSum','lastDateofLeave',
            'casualLeaveSum','medicalLeaveSum','annualLeaveRemaining','casualLeaveRemaining','medicalLeaveRemaining'));
    }

    public function leaveApplicationConfirm(Request $request){

        Leave::where('id',$request->LeaveId)->update(array('status' => '2'));

        return response()->json(['success' => true, 'message' => 'Leave Confirm']);

    }

    public function leaveApplicationCancel(Request $request){

        Leave::where('id',$request->LeaveId)->update(array('status' => '3'));

        return response()->json(['success' => true, 'message' => 'Leave Cancel Confirm']);

    }

    public function leaveIndex() {
        $employees = CandidateInterviewEvalution::orderBy('employee_id')->get();

        return view('payroll.leave.index', compact('employees'));
    }

    public function leavePost(Request $request) {
        $request->validate([
            'employee' => 'required',
            'from' => 'required|date',
            'to' => 'required|date',
            'note' => 'nullable|max:255',
            'type' => 'required'
        ]);

        $fromObj = new Carbon($request->from);
        $toObj = new Carbon($request->to);
        $totalDays = $fromObj->diffInDays($toObj) + 1;

        $leave = new Leave();
        $leave->employee_id = $request->employee;
        $leave->type = $request->type;
        $leave->year = $toObj->format('Y');
        $leave->from = $request->from;
        $leave->to = $request->to;
        $leave->total_days = $totalDays;
        $leave->note = $request->note;
        $leave->save();

        return redirect()->route('payroll.leave.index')->with('message', 'Leave add successful.');
    }

    public function extensionLetter(){

        return view('hr.extension_letter.all');
    }
    public function extensionLetterDatatable(){

        $query = CandidateInterviewEvalution::with('department', 'designation')->where('employee_type', 2);

        return DataTables::eloquent($query)
            ->addColumn('department', function(CandidateInterviewEvalution $candidate) {
                return $candidate->department->name;
            })
            ->addColumn('designation', function(CandidateInterviewEvalution $candidate) {
                return $candidate->designation->name;
            })
            ->addColumn('action', function(CandidateInterviewEvalution $candidate) {
                return '
                        <a class="btn btn-primary btn-sm" href="'.route('extension_letter_input', ['candidate' => $candidate->id]).'">Extension Letter</a>';
            })
            ->addColumn('action_emploment_offer', function(CandidateInterviewEvalution $candidate) {
                return '
                        <a class="btn btn-primary btn-sm" href="'.route('employment_offer_letter_input', ['candidate' => $candidate->id]).'">Employment Offer</a>';
            })
            ->addColumn('action_job_confirmation', function(CandidateInterviewEvalution $candidate) {
                return '
                        <a class="btn btn-primary btn-sm" href="'.route('job_confirmation_letter_input', ['candidate' => $candidate->id]).'">Job Confirmaton Letter</a>';
            })
            ->editColumn('image', function(CandidateInterviewEvalution $candidate) {
                if ($candidate->image)
                    return '<img src="'.asset($candidate->image).'" height="50px">';
                else
                    return '<img src="'.asset('img/no_image.png').'" height="50px">';
            })
            ->editColumn('employee_type', function(CandidateInterviewEvalution $candidate) {
                if ($candidate->employee_type == 1)
                    return '<span class="label label-success">Permanent</span>';
                else
                    return '<span class="label label-warning">Temporary</span>';
            })
            ->editColumn('selection', function(CandidateInterviewEvalution $candidate) {
                if ($candidate->selected == 1)
                    return '<span class="label label-success">Selected</span>';
                else
                    return '<span class="label label-warning">Rejected</span>';
            })
            ->editColumn('status', function(CandidateInterviewEvalution $candidate) {
                if ($candidate->status == 1)
                    return '<span class="label label-success">active</span>';
                else
                    return '<span class="label label-warning">inactive</span>';
            })

            ->rawColumns(['action','employee_type','image','selection','status','action_emploment_offer','action_job_confirmation'])
            ->toJson();
    }



    public function extensionLetterPage(CandidateInterviewEvalution $candidate){
        return view('hr.extension_letter.page',compact('candidate'));
    }

    public function extensionLetterInput(CandidateInterviewEvalution $candidate){
        return view('hr.extension_letter.input',compact('candidate'));
    }

    public function extensionLetterPost(CandidateInterviewEvalution $candidate, Request $request){


        $candidate->extension_letter_body = $request->extension_letter_body;
        $candidate->save();

        return view('hr.extension_letter.page',compact('candidate'));
    }

    public function warningLetter(){

        return view('hr.warning_letter.all');
    }

    public function warningLetterPage(CandidateInterviewEvalution $candidate){
        return view('hr.warning_letter.page',compact('candidate'));
    }

    public function warningLetterInput(CandidateInterviewEvalution $candidate){
        return view('hr.warning_letter.input',compact('candidate'));
    }

    public function warningLetterPost(CandidateInterviewEvalution $candidate, Request $request){


        $candidate->warning_letter_body = $request->warning_letter_body;
        $candidate->save();

        return view('hr.warning_letter.page',compact('candidate'));
    }

    public function employmentOfferLetter(){

        return view('hr.employment_offer_letter.all');
    }

    public function employmentOfferLetterPage(CandidateInterviewEvalution $candidate){
        return view('hr.employment_offer_letter.page',compact('candidate'));
    }

    public function employmentOfferLetterInput(CandidateInterviewEvalution $candidate){
        return view('hr.employment_offer_letter.input',compact('candidate'));
    }

    public function employmentOfferLetterPost(CandidateInterviewEvalution $candidate, Request $request){


        $candidate->employment_offer_letter_body = $request->employment_offer_letter_body;
        $candidate->save();

        return view('hr.employment_offer_letter.page',compact('candidate'));
    }

    public function jobConfirmationLetter(){

        return view('hr.job_confirmation_letter.all');
    }

    public function jobConfirmationPage(CandidateInterviewEvalution $candidate){
        return view('hr.job_confirmation_letter.page',compact('candidate'));
    }

    public function jobConfirmationInput(CandidateInterviewEvalution $candidate){
        return view('hr.job_confirmation_letter.input',compact('candidate'));
    }

    public function jobConfirmationPost(CandidateInterviewEvalution $candidate, Request $request){


        $candidate->job_confirmation_letter_body = $request->job_confirmation_letter_body;
        $candidate->save();

        return view('hr.job_confirmation_letter.page',compact('candidate'));
    }
    public function academicTraining(){

        return view('hr.academic_training.all');
    }
    public function academicTrainingForm(CandidateInterviewEvalution $candidate){

        return view('hr.academic_training.form',compact('candidate'));
    }
    public function academicTrainingPost(CandidateInterviewEvalution $candidate, Request $request){
        //dd($candidate);
        $request->validate([
            'title' => 'required|max:255',
            'institute' => 'required|max:255',
            'department' => 'required|max:255',
            'passing_year' => 'required|max:255',
            'result' => 'required|max:255',
            'out_off_result' => 'required|max:255',
            'duration' => 'required|max:255',
            'academic_certificate' => 'required',
//            'training_title' => 'nullable|max:255',
//            'training_institute' => 'nullable|max:255',
//            'training_certificate' => 'nullable',
        ]);



        if ($request->academic_certificate) {

            $file = $request->file('academic_certificate');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/candidate/academic_certificate';
            $file->move($destinationPath, $filename);

            $academic_certificate = 'uploads/candidate/academic_certificate/'.$filename;
        }
//        if ($request->training_certificate) {
//
//            $file = $request->file('training_certificate');
//            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
//            $destinationPath = 'public/uploads/candidate/training_certificate';
//            $file->move($destinationPath, $filename);
//
//            $training_certificate = 'uploads/candidate/training_certificate/'.$filename;
//        }
        $academiTraining = new AcademicTraining();
        $academiTraining->employee_id = $candidate->id;
        $academiTraining->title = $request->title;
        $academiTraining->institute = $request->institute;
        $academiTraining->department = $request->department;
        $academiTraining->passing_year = $request->passing_year;
        $academiTraining->result = $request->result;
        $academiTraining->out_off_result = $request->out_off_result;
        $academiTraining->duration = $request->duration;
//        $academiTraining->training_title = $request->training_title;
        $academiTraining->academic_certificate = $academic_certificate;
//        $academiTraining->training_institute = $request->training_institute;
//        $academiTraining->training_certificate = $training_certificate;
        $academiTraining->save();

        //dd($request->all());

        return view('hr.academic_training.all')->with('message', 'Academic And Training Information add successfully.');
    }

    public function academicWiseAdd(AcademicTraining $academicTraining){

        $candidate = CandidateInterviewEvalution::where('id',$academicTraining->employee_id)->first();

        //dd($candidate);

        return view('hr.academic_training.academic_wise_add',compact('academicTraining','candidate'));
    }

    public function academicWiseAddPost(Request $request){

        //dd($request->all());

        $request->validate([
            'title' => 'required|max:255',
            'institute' => 'required|max:255',
            'department' => 'required|max:255',
            'passing_year' => 'required|max:255',
            'result' => 'required|max:255',
            'out_off_result' => 'required|max:255',
            'duration' => 'required|max:255',
            'academic_certificate' => 'required',
//            'training_title' => 'nullable|max:255',
//            'training_institute' => 'nullable|max:255',
//            'training_certificate' => 'nullable',
        ]);



        if ($request->academic_certificate) {

            $file = $request->file('academic_certificate');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/candidate/academic_certificate';
            $file->move($destinationPath, $filename);

            $academic_certificate = 'uploads/candidate/academic_certificate/'.$filename;
        }
//        if ($request->training_certificate) {
//
//            $file = $request->file('training_certificate');
//            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
//            $destinationPath = 'public/uploads/candidate/training_certificate';
//            $file->move($destinationPath, $filename);
//
//            $training_certificate = 'uploads/candidate/training_certificate/'.$filename;
//        }
        $academiTraining = new AcademicTraining();
        $academiTraining->employee_id = $request->employee_id;
        $academiTraining->title = $request->title;
        $academiTraining->institute = $request->institute;
        $academiTraining->department = $request->department;
        $academiTraining->passing_year = $request->passing_year;
        $academiTraining->result = $request->result;
        $academiTraining->out_off_result = $request->out_off_result;
        $academiTraining->duration = $request->duration;
        $academiTraining->academic_certificate = $academic_certificate;
//        $academiTraining->training_title = $request->training_title;
//        $academiTraining->training_institute = $request->training_institute;
//        $academiTraining->training_certificate = $training_certificate;
        $academiTraining->save();

        $candidate = CandidateInterviewEvalution::where('id',$request->employee_id)->first();

        return redirect(route('academic_and_training.details',['candidate'=>$candidate->id]))->with('message', 'Academic And Training Information Add successfully.');
    }

    public function academicTrainingEdit(CandidateInterviewEvalution $candidate){

        $academicTraining = AcademicTraining::where('employee_id',$candidate->id)->first();

        return view('hr.academic_training.edit',compact('candidate','academicTraining'));
    }

    public function academicTrainingEditPost(CandidateInterviewEvalution $candidate, Request $request){

        //dd($request);

        $request->validate([
            'title' => 'required|max:255',
            'institute' => 'required|max:255',
            'department' => 'required|max:255',
            'passing_year' => 'required|max:255',
            'result' => 'required|max:255',
            'out_off_result' => 'required|max:255',
            'duration' => 'required|max:255',
            'academic_certificate' => 'nullable',
//            'training_title' => 'nullable|max:255',
//            'training_institute' => 'nullable|max:255',
//            'training_certificate' => 'nullable',
        ]);

        $academicTraining = AcademicTraining::where('employee_id',$candidate->id)->first();

        if ($request->training_certificate) {
            // Previous Photo

            $file = $request->file('training_certificate');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/candidate/training_certificate';
            $file->move($destinationPath, $filename);

            $training_certificate = 'uploads/candidate/training_certificate/'.$filename;
            $academicTraining->academic_certificate = $training_certificate;
        }

//        if ($request->academic_certificate) {
//            // Previous Photo
//
//            $file = $request->file('academic_certificate');
//            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
//            $destinationPath = 'public/uploads/candidate/academic_certificate';
//            $file->move($destinationPath, $filename);
//
//            $academic_certificate = 'uploads/candidate/academic_certificate/'.$filename;
//            $academicTraining->training_certificate = $academic_certificate;
//        }


        $academicTraining->employee_id = $candidate->id;
        $academicTraining->title = $request->title;
        $academicTraining->institute = $request->institute;
        $academicTraining->department = $request->department;
        $academicTraining->passing_year = $request->passing_year;
        $academicTraining->result = $request->result;
        $academicTraining->out_off_result = $request->out_off_result;
        $academicTraining->duration = $request->duration;
//        $academicTraining->training_title = $request->training_title;
//        $academicTraining->training_institute = $request->training_institute;
        $academicTraining->save();

        return view('hr.academic_training.all')->with('message', 'Academic And Training Information Update successfully.');

    }

    public function academicWiseEdit(AcademicTraining $academicTraining){

        return view('hr.academic_training.academic_wise_edit', compact('academicTraining'));
    }
    public function academicWiseEditPost(AcademicTraining $academicTraining,Request $request){

        //dd($request->all());
        $request->validate([
            'title' => 'required|max:255',
            'institute' => 'required|max:255',
            'department' => 'required|max:255',
            'passing_year' => 'required|max:255',
            'result' => 'required|max:255',
            'out_off_result' => 'required|max:255',
            'duration' => 'required|max:255',
            'academic_certificate' => 'nullable',
//            'training_title' => 'nullable|max:255',
//            'training_institute' => 'nullable|max:255',
//            'training_certificate' => 'nullable',
        ]);

        if ($request->training_certificate) {
            // Previous Photo

            $file = $request->file('training_certificate');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/candidate/training_certificate';
            $file->move($destinationPath, $filename);

            $training_certificate = 'uploads/candidate/training_certificate/'.$filename;
            $academicTraining->academic_certificate = $training_certificate;
        }

        if ($request->academic_certificate) {
            // Previous Photo

            $file = $request->file('academic_certificate');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/candidate/academic_certificate';
            $file->move($destinationPath, $filename);

            $academic_certificate = 'uploads/candidate/academic_certificate/'.$filename;
            $academicTraining->training_certificate = $academic_certificate;
        }


        $academicTraining->employee_id = $request->employee_id;
        $academicTraining->title = $request->title;
        $academicTraining->institute = $request->institute;
        $academicTraining->department = $request->department;
        $academicTraining->passing_year = $request->passing_year;
        $academicTraining->result = $request->result;
        $academicTraining->out_off_result = $request->out_off_result;
        $academicTraining->duration = $request->duration;
//        $academicTraining->training_title = $request->training_title;
//        $academicTraining->training_institute = $request->training_institute;
        $academicTraining->save();

        $candidate = CandidateInterviewEvalution::where('id',$request->employee_id)->first();

        return redirect(route('academic_and_training.details',['candidate'=>$candidate->id]))->with('message', 'Academic And Training Information Update successfully.');
    }

    public function academicWiseDelete(Request $request){

        $academic = AcademicTraining::find($request->academicTrainingId);
        unlink(public_path($academic->academic_certificate));
        unlink(public_path($academic->training_certificate));
        $academic->delete();
        return response()->json(['success' => true, 'message' => 'Job Information Delete successfully']);

    }

    public function academicTrainingDetails(CandidateInterviewEvalution $candidate){

        //dd($candidate);

         $academicTrainings = AcademicTraining::where('employee_id',$candidate->id)->get();
         //dd($academicTraining);
        return view('hr.academic_training.details',compact('academicTrainings','candidate'));
    }


    public function trainingInformation(){

        return view('hr.training_information.all');
    }

    public function trainingInformationForm(CandidateInterviewEvalution $candidate){

        return view('hr.training_information.form',compact('candidate'));
    }

    public function trainingInformationFormPost(CandidateInterviewEvalution $candidate, Request $request){
        //dd($candidate);
        $request->validate([

            'training_title' => 'required|max:255',
            'training_institute' => 'required|max:255',
            'training_certificate' => 'nullable',
        ]);

        if ($request->training_certificate) {

            $file = $request->file('training_certificate');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/candidate/training_certificate';
            $file->move($destinationPath, $filename);

            $training_certificate = 'uploads/candidate/training_certificate/'.$filename;
        }
        $trainingInformation = new TrainingInformation();
        $trainingInformation->employee_id = $candidate->id;
        $trainingInformation->training_title = $request->training_title;
        $trainingInformation->training_institute = $request->training_institute;
        if (!empty($training_certificate)){
            $trainingInformation->training_certificate = $training_certificate;
        }
        $trainingInformation->save();

        return view('hr.training_information.all')->with('message', 'Training Information add successfully.');
    }

    public function trainingInformationEdit(CandidateInterviewEvalution $candidate){

        $trainingInformation = TrainingInformation::where('employee_id',$candidate->id)->first();

        return view('hr.training_information.edit',compact('candidate','trainingInformation'));
    }

    public function trainingInformationEditPost(CandidateInterviewEvalution $candidate, Request $request){

        //dd($request);

        $request->validate([
            'training_title' => 'nullable|max:255',
            'training_institute' => 'nullable|max:255',
            'training_certificate' => 'nullable',
        ]);

        $trainingInformation = TrainingInformation::where('employee_id',$candidate->id)->first();


        if ($request->training_certificate) {

            $file = $request->file('training_certificate');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/candidate/training_certificate';
            $file->move($destinationPath, $filename);

            $training_certificate = 'uploads/candidate/training_certificate/'.$filename;
            $trainingInformation->training_certificate = $training_certificate;
        }


        $trainingInformation->employee_id = $candidate->id;
        $trainingInformation->training_title = $request->training_title;
        $trainingInformation->training_institute = $request->training_institute;
        $trainingInformation->save();

        return view('hr.training_information.all')->with('message', 'Training Information Update successfully.');

    }

    public function trainingInformationDetails(CandidateInterviewEvalution $candidate){

        //dd($candidate);

        $trainingInformations = TrainingInformation::where('employee_id',$candidate->id)->get();
        //dd($academicTraining);
        return view('hr.training_information.details',compact('trainingInformations','candidate'));
    }

    public function employeeWiseTrainingAdd(TrainingInformation $trainingInformation){

        $candidate = CandidateInterviewEvalution::where('id',$trainingInformation->employee_id)->first();

        //dd($candidate);

        return view('hr.training_information.employee_wise_training_information_add',compact('trainingInformation','candidate'));
    }

    public function employeeWiseTrainingAddPost(Request $request){


        $request->validate([
            'training_title' => 'required|max:255',
            'training_institute' => 'required|max:255',
            'training_certificate' => 'nullable',
        ]);
        if ($request->training_certificate) {

            $file = $request->file('training_certificate');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/candidate/training_certificate';
            $file->move($destinationPath, $filename);

            $training_certificate = 'uploads/candidate/training_certificate/'.$filename;
        }
        $trainingInformation = new TrainingInformation();
        $trainingInformation->employee_id = $request->employee_id;
        $trainingInformation->training_title = $request->training_title;
        $trainingInformation->training_institute = $request->training_institute;
        if (!empty($training_certificate)){
            $trainingInformation->training_certificate = $training_certificate;
        }
        $trainingInformation->save();

        $candidate = CandidateInterviewEvalution::where('id',$request->employee_id)->first();

        return redirect(route('training_information.details',['candidate'=>$candidate->id]))->with('message', 'Training Information Add successfully.');
    }

    public function employeeWiseTrainingEdit(TrainingInformation $trainingInformation){

        return view('hr.training_information.employee_wise_training_information_edit', compact('trainingInformation'));
    }

    public function employeeWiseTrainingEditPost(TrainingInformation $trainingInformation,Request $request){

        //dd($request->all());
        $request->validate([

            'training_title' => 'required|max:255',
            'training_institute' => 'required|max:255',
            'training_certificate' => 'nullable',
        ]);

        if ($request->training_certificate) {
            // Previous Photo

            $file = $request->file('training_certificate');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/candidate/training_certificate';
            $file->move($destinationPath, $filename);

            $training_certificate = 'uploads/candidate/training_certificate/'.$filename;
            $trainingInformation->training_certificate = $training_certificate;
        }


        $trainingInformation->training_title = $request->training_title;
        $trainingInformation->training_institute = $request->training_institute;
        $trainingInformation->save();

        $candidate = CandidateInterviewEvalution::where('id',$request->employee_id)->first();

        return redirect(route('training_information.details',['candidate'=>$candidate->id]))->with('message', 'Training Information Update successfully.');
    }
    public function employeeWiseTrainingDelete(Request $request){

        $trainingInformation = TrainingInformation::find($request->TrainingInformationId);
        unlink(public_path($trainingInformation->training_certificate));
        $trainingInformation->delete();
        return response()->json(['success' => true, 'message' => 'Training Information Delete successfully']);

    }




    public function jobInformationAll(){

        return view('hr.job_information.all');
    }
    public function jobInformationForm(CandidateInterviewEvalution $candidate){

        return view('hr.job_information.form',compact('candidate'));
    }
    public function jobInformationPost(CandidateInterviewEvalution $candidate,Request $request){

        $request->validate([
            'previous_company_name' => 'required|max:255',
            'previous_company_designation' => 'required|max:255',
            'from' => 'required|max:255',
            'to' => 'required|max:255',
            'total_duration' => 'required|max:255',
            'major_responsibility' => 'required|max:255',
            'experience_certificate' => 'nullable',
        ]);



        if ($request->experience_certificate) {

            $file = $request->file('experience_certificate');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/candidate/experience_certificate';
            $file->move($destinationPath, $filename);
            $experience_certificate = 'uploads/candidate/experience_certificate/'.$filename;
        }

        $jobInformation = new jobInformation();
        $jobInformation->employee_id = $candidate->id;
        $jobInformation->previous_company_name = $request->previous_company_name;
        $jobInformation->previous_company_designation = $request->previous_company_designation;
        $jobInformation->from = $request->from;
        $jobInformation->to = $request->to;
        $jobInformation->total_duration = $request->total_duration;
        if(!empty($request->experience_certificate)){
            $jobInformation->experience_certificate = $experience_certificate;
        }

        $jobInformation->major_responsibility = $request->major_responsibility;
        $jobInformation->save();

        return redirect(route('job_information.details',['candidate'=>$candidate->id]))->with('message', 'job Information Add successfully.');

    }

    public function jobInformationEdit(CandidateInterviewEvalution $candidate){

        $jobInformation = jobInformation::where('employee_id',$candidate->id)->first();

        return view('hr.job_information.edit',compact('candidate','jobInformation'));
    }

    public function jobInformationEditPost(CandidateInterviewEvalution $candidate, Request $request){

        //dd($request);

        $request->validate([
            'previous_company_name' => 'required|max:255',
            'previous_company_designation' => 'required|max:255',
            'from' => 'required|max:255',
            'to' => 'required|max:255',
            //'total_duration' => 'required|max:255',
            'major_responsibility' => 'required|max:255',
            'experience_certificate' => 'nullable',
        ]);

        $jobInformation = jobInformation::where('employee_id',$candidate->id)->first();

        if ($request->experience_certificate) {

            $file = $request->file('experience_certificate');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/candidate/experience_certificate';
            $file->move($destinationPath, $filename);

            $experience_certificate = 'uploads/candidate/experience_certificate/'.$filename;
            $jobInformation->experience_certificate = $experience_certificate;
        }


        $jobInformation->employee_id = $candidate->id;
        $jobInformation->previous_company_name = $request->previous_company_name;
        $jobInformation->previous_company_designation = $request->previous_company_designation;
        $jobInformation->from = $request->from;
        $jobInformation->to = $request->to;
        $jobInformation->total_duration = $request->total_duration;
        $jobInformation->major_responsibility = $request->major_responsibility;
        $jobInformation->save();

        return view('hr.job_information.details')->with('message', 'job Information Update successfully.');

    }

    public function jobInformationDetails(CandidateInterviewEvalution $candidate){

        $jobInformations = jobInformation::where('employee_id',$candidate->id)->get();
        //dd($academicTraining);
        return view('hr.job_information.details',compact('jobInformations','candidate'));
    }
    public function employeeWisejobInformationAdd(jobInformation $jobInformation){

        $candidate = CandidateInterviewEvalution::where('id',$jobInformation->employee_id)->first();

        //dd($jobInformation);

        return view('hr.job_information.employee_wise_job_information_add',compact('jobInformation','candidate'));
    }
    public function employeeWisejobInformationAddPost(Request $request){

        //dd($request->all());

        $request->validate([
            'previous_company_name' => 'required|max:255',
            'previous_company_designation' => 'required|max:255',
            'from' => 'required|max:255',
            'to' => 'required|max:255',
            'total_duration' => 'required|max:255',
            'major_responsibility' => 'required|max:255',
            'experience_certificate' => 'nullable',
        ]);



        if ($request->experience_certificate) {

            $file = $request->file('experience_certificate');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/candidate/experience_certificate';
            $file->move($destinationPath, $filename);

            $experience_certificate = 'uploads/candidate/experience_certificate/'.$filename;
        }

        $jobInformation = new jobInformation();
        $jobInformation->employee_id = $request->employee_id;
        $jobInformation->previous_company_name = $request->previous_company_name;
        $jobInformation->previous_company_designation = $request->previous_company_designation;
        $jobInformation->from = $request->from;
        $jobInformation->to = $request->to;
        $jobInformation->total_duration = $request->total_duration;
        $jobInformation->major_responsibility = $request->major_responsibility;
        if(!empty($request->experience_certificate)){
            $jobInformation->experience_certificate = $experience_certificate;
        }

        $jobInformation->save();

        $candidate = CandidateInterviewEvalution::where('id',$request->employee_id)->first();

        return redirect(route('job_information.details',['candidate'=>$candidate->id]))->with('message', 'Job Information Add successfully.');
    }

    public function employeeWisejobInformationEdit(jobInformation $jobInformation){

        $candidate = CandidateInterviewEvalution::where('id',$jobInformation->employee_id)->first();

        //dd($jobInformation);

        return view('hr.job_information.employee_wise_job_information_edit',compact('jobInformation','candidate'));
    }


    public function employeeWisejobInformationEditPost(jobInformation $jobInformation, Request $request){

        //dd($request->all());

        $request->validate([
            'previous_company_name' => 'required|max:255',
            'previous_company_designation' => 'required|max:255',
            'from' => 'required|max:255',
            'to' => 'required|max:255',
            //'total_duration' => 'required|max:255',
            'major_responsibility' => 'required|max:255',
            'experience_certificate' => 'nullable',
        ]);

        if ($request->experience_certificate) {
            // Previous Photo

            $file = $request->file('experience_certificate');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/candidate/experience_certificate';
            $file->move($destinationPath, $filename);

            $experience_certificate = 'uploads/candidate/experience_certificate/'.$filename;
            $jobInformation->experience_certificate = $experience_certificate;
        }



        $jobInformation->employee_id = $request->employee_id;
        $jobInformation->previous_company_name = $request->previous_company_name;
        $jobInformation->previous_company_designation = $request->previous_company_designation;
        $jobInformation->from = $request->from;
        $jobInformation->to = $request->to;
        $jobInformation->total_duration = $request->total_duration;
        $jobInformation->major_responsibility = $request->major_responsibility;
        $jobInformation->save();

        $candidate = CandidateInterviewEvalution::where('id',$request->employee_id)->first();

        return redirect(route('job_information.details',['candidate'=>$candidate->id]))->with('message', 'Job Information Edit successfully.');

    }
    public function employeeWisejobInformationDelete(Request $request){

        $jobInformation = jobInformation::find($request->jobInformationId);
        unlink(public_path($jobInformation->experience_certificate));
        $jobInformation->delete();

        return response()->json(['success' => true, 'message' => 'Job Information Delete successfully']);

    }

    public  function candidateEvaluation(CandidateInterviewEvalution $candidate){
        //dd($candidate);
        $appraisals = null;
        $appraisals =  EmployeeAppraisal::where('employee_id',$candidate->employee_id)->first();
        return view("hr.evalution.evaluation",compact("candidate","appraisals"));
    }
    public function candidateEvaluationPost(Request $request,CandidateInterviewEvalution $candidate){
       // dd($request->all());
        $request->validate([
            'jan_jun_work_standards' => 'required',
            'jul_dec_work_standards' => 'required',
            'jan_jun_speed_consider' => 'required',
            'jul_dec_speed_consider' => 'required',
            'jan_jun_quality_of_work' => 'required',
            'jul_dec_quality_of_work' => 'required',
            'jan_jun_care_of_equipment' => 'required',
            'jul_dec_care_of_equipment' => 'required',
            'jan_jun_work_habits' => 'required',
            'jul_dec_work_habits' => 'required',
            'jan_jun_dependability' => 'required',
            'jul_dec_dependability' => 'required',
            'jan_jun_timekeeping' => 'required',
            'jul_dec_timekeeping' => 'required',
            'jan_jun_safety_consciousness' => 'required',
            'jul_dec_safety_consciousness' => 'required',
            'jan_jun_attitude' => 'required',
            'jul_dec_attitude' => 'required',
            'jan_jun_attitude_towards_supervision' => 'required',
            'jul_dec_attitude_towards_supervision' => 'required',
            'jan_jun_attitude_towards' => 'required',
            'jul_dec_attitude_towards' => 'required',
            'jan_jun_attitude_to_words_works' => 'required',
            'jul_dec_attitude_to_words_works' => 'required',
            'jan_jun_personal_behaviour' => 'required',
            'jul_dec_personal_behaviour' => 'required',
            'jan_jun_initiative_ability' => 'required',
            'jul_dec_initiative_ability' => 'required',
            'jan_jun_adaptability' => 'required',
            'jul_dec_adaptability' => 'required',
            'not_doing' => 'required',
            'particularly_weak' => 'required',
            'improvement_plan' => 'required',
        ]);
        $appraisals =  EmployeeAppraisal::where("employee_id",$candidate->employee_id)->first();
        if(!$appraisals){
            $appraisals = new EmployeeAppraisal();
        }
        $appraisals->employee_id = $candidate->employee_id;
        $appraisals->department_id = $candidate->department_id;
        $appraisals->jan_jun_work_standards = $request->jan_jun_work_standards;
        $appraisals->jul_dec_work_standards = $request->jul_dec_work_standards;
        $appraisals->jan_jun_speed_consider = $request->jan_jun_speed_consider;
        $appraisals->jul_dec_speed_consider = $request->jul_dec_speed_consider;
        $appraisals->jan_jun_quality_of_work = $request->jan_jun_quality_of_work;
        $appraisals->jul_dec_quality_of_work = $request->jul_dec_quality_of_work;
        $appraisals->jan_jun_care_of_equipment = $request->jan_jun_care_of_equipment;
        $appraisals->jul_dec_care_of_equipment = $request->jul_dec_care_of_equipment;
        $appraisals->jan_jun_work_habits = $request->jan_jun_work_habits;
        $appraisals->jul_dec_work_habits = $request->jul_dec_work_habits;
        $appraisals->jan_jun_dependability = $request->jan_jun_dependability;
        $appraisals->jul_dec_dependability = $request->jul_dec_dependability;
        $appraisals->jan_jun_timekeeping = $request->jan_jun_timekeeping;
        $appraisals->jul_dec_timekeeping = $request->jul_dec_timekeeping;
        $appraisals->jan_jun_safety_consciousness = $request->jan_jun_safety_consciousness;
        $appraisals->jul_dec_safety_consciousness = $request->jul_dec_safety_consciousness;
        $appraisals->jan_jun_attitude = $request->jan_jun_attitude;
        $appraisals->jul_dec_attitude = $request->jul_dec_attitude;
        $appraisals->jan_jun_attitude_towards_supervision = $request->jan_jun_attitude_towards_supervision;
        $appraisals->jul_dec_attitude_towards_supervision = $request->jul_dec_attitude_towards_supervision;
        $appraisals->jan_jun_attitude_towards = $request->jan_jun_attitude_towards;
        $appraisals->jul_dec_attitude_towards = $request->jul_dec_attitude_towards;
        $appraisals->jan_jun_attitude_to_words_works = $request->jan_jun_attitude_to_words_works;
        $appraisals->jul_dec_attitude_to_words_works = $request->jul_dec_attitude_to_words_works;
        $appraisals->jan_jun_personal_behaviour = $request->jan_jun_personal_behaviour;
        $appraisals->jul_dec_personal_behaviour = $request->jul_dec_personal_behaviour;
        $appraisals->jan_jun_initiative_ability = $request->jan_jun_initiative_ability;
        $appraisals->jul_dec_initiative_ability = $request->jul_dec_initiative_ability;
        $appraisals->jan_jun_adaptability = $request->jan_jun_adaptability;
        $appraisals->jul_dec_adaptability = $request->jul_dec_adaptability;
        $appraisals->not_doing = $request->not_doing;
        $appraisals->particularly_weak = $request->particularly_weak;
        $appraisals->improvement_plan = $request->improvement_plan;
        $appraisals->save();
//        return view('hr.academic_training.all')->with('message', 'Employee Appraisals Insert successfully..');

        return redirect()->route("candidate_evaluation_print",['candidate' => $candidate->id])->with('message', 'Employee Appraisals Insert successfully.');
    }
    public function candidateEvaluationPrint(CandidateInterviewEvalution $candidate){
        $appraisals =  EmployeeAppraisal::where('employee_id',$candidate->employee_id)->first();
        return view("hr.evalution.evaluation_print",compact("candidate","appraisals"));
    }
    public function promotionProposal(CandidateInterviewEvalution $candidate){
        $proposal =null;
        $proposal =  PromotionProposal::where('employee_id',$candidate->employee_id)->first();
        return view("hr.evalution.promotion_proposal",compact("candidate","proposal"));
    }
    public function promotionProposalPost(Request $request,CandidateInterviewEvalution $candidate){
        $request->validate([
            'achievement_in_the_present_job' => 'required',
            'additional_responsibilities' => 'required',
            'extra_training' => 'required',
            'promotion_next_higher_position' => 'required',
            'comments_of_immediate_supervisor' => 'required',
            'comments_of_next_supervisor' => 'required',
            'comments_of_concern_managers' => 'required',
            'comments_of_division_head' => 'required',
            'comments_of_executive_director' => 'required',
            'acknowledgement_from_unit_hr' => 'required',
            'comments_of_head_of_hr' => 'required',
        ]);
        $proposal =  PromotionProposal::where("employee_id",$candidate->employee_id)->first();
        if(!$proposal){
            $proposal = new PromotionProposal();
        }

        $proposal->employee_id = $candidate->employee_id;
        $proposal->achievement_in_the_present_job = $request->achievement_in_the_present_job;
        $proposal->additional_responsibilities = $request->additional_responsibilities;
        $proposal->extra_training = $request->extra_training;
        $proposal->promotion_next_higher_position = $request->promotion_next_higher_position;
        $proposal->comments_of_immediate_supervisor = $request->comments_of_immediate_supervisor;
        $proposal->comments_of_next_supervisor = $request->comments_of_next_supervisor;
        $proposal->comments_of_executive_director = $request->comments_of_executive_director;
        $proposal->comments_of_concern_managers = $request->comments_of_concern_managers;
        $proposal->comments_of_division_head = $request->comments_of_division_head;
        $proposal->acknowledgement_from_unit_hr = $request->acknowledgement_from_unit_hr;
        $proposal->comments_of_head_of_hr = $request->comments_of_head_of_hr;
        $proposal->save();
        return redirect()->route("promotion_proposal_print",['candidate' => $candidate->id])->with('message', 'Promotion Proposal Insert successfully.');

    }
    public function promotionProposalPrint(CandidateInterviewEvalution $candidate){
            $proposal = PromotionProposal::where("employee_id",$candidate->employee_id)->first();
            return view("hr.evalution.promotion_proposal_print",compact("candidate","proposal"));
    }





}
