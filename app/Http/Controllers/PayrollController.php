<?php

namespace App\Http\Controllers;

use App\Enumeration\LeaveStatus;
use App\Model\AttendanceProcess;
use App\Model\Bank;
use App\Model\BankAccount;
use App\Model\CandidateInterviewEvalution;
use App\Model\Employee;
use App\Model\EmployeeAttendance;
use App\Model\ExtraEmployeeData;
use App\Model\Holiday;
use App\Model\Leave;
use App\Model\Loan;
use App\Model\PfLoan;
use App\Model\Salary;
use App\Model\SalaryApproveLog;
use App\Model\SalaryChangeLog;
use App\Model\SalaryPreApproveLog;
use App\Model\SalaryProcess;
use App\Model\SkrpLoan;
use App\Model\TransactionLog;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Null_;

class PayrollController extends Controller
{
    public function salaryUpdateIndex() {
        return view('payroll.salary_update.all');
    }

    public function salaryUpdatePost(Request $request) {

        //dd($request->all());


        $rules = [
            'basic_salary' => 'required|numeric',
            'house_rent' => 'required|numeric',
            'conveyance' => 'required|numeric',
            'medical' => 'required|numeric',
            'others_deduct' => 'nullable|numeric',
            'bonus' => 'nullable|numeric',
            'special_allowance' => 'nullable|numeric',
            'advance' => 'nullable|numeric',
            'ta_da' => 'nullable|numeric',
            'consolidate' => 'nullable|numeric',
            'metro_city' => 'nullable|numeric',
            'factory_allowance' => 'nullable|numeric',
            'other_allowance' => 'nullable|numeric',
            'arrear' => 'nullable|numeric',
            'wppf' => 'nullable|numeric',
            'col' => 'nullable|numeric',
            'special_adjustment' => 'nullable|numeric',
            'mobile_set' => 'nullable|numeric',
            'others' => 'nullable|numeric',
            'others_one' => 'nullable|numeric',
            'others_two' => 'nullable|numeric',
            'others_three' => 'nullable|numeric',
            'pf_loan' => 'nullable|numeric',
            'lwp' => 'nullable|numeric',
            'stuff_bus' => 'nullable|numeric',
            'others_deduction' => 'nullable|numeric',
            'skrp_loan' => 'nullable|numeric',
            'mobile_bill' => 'nullable|numeric',
            'union_fee' => 'nullable|numeric',
            'penalty' => 'nullable|numeric',
            'income_tex' => 'nullable|numeric',
            'revenue_stamp' => 'nullable|numeric',
            'month' => 'nullable',

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $salary = Salary::where('employee_id',$request->id)->where('month',date('m',strtotime($request->month)))->where('year',date('Y',strtotime($request->month)))->first();
        //dd($salary);

        if(empty($salary)){
            $employee = CandidateInterviewEvalution::find($request->id);
            $employee->medical = round($request->gross_salary * .15);
            $employee->conveyance = round($request->gross_salary * .10);
            $employee->house_rent = round($request->gross_salary * .25);
            $employee->basic_salary = round($request->gross_salary * .50);
            $employee->deduction =round($request->gross_salary * .10);
            $employee->gross_salary = $request->gross_salary;
            $employee->save();


            $salaryChangeLog = SalaryChangeLog::where('employee_id', $employee->id)->whereMonth('for_month', date('m' , strtotime($request->month)))->whereYear('for_month', date('Y' , strtotime($request->month)))->first();

            if (empty($salaryChangeLog)){
                $salaryChangeLog = new SalaryChangeLog();
            }
            $salaryChangeLog->employee_id = $employee->id;
            $salaryChangeLog->date = $request->date;
            $salaryChangeLog->for_month = $request->month;
            //$salaryChangeLog->type = $request->type;
            $salaryChangeLog->medical = round($request->gross_salary * .15);
            $salaryChangeLog->conveyance = round($request->gross_salary * .10);
            $salaryChangeLog->house_rent = round($request->gross_salary * .25);
            $salaryChangeLog->basic_salary = round($request->gross_salary * .50);
            $salaryChangeLog->deduction =round($request->gross_salary * .10);

            $salaryChangeLog->bonus = $request->bonus;
            $salaryChangeLog->factory_allowance = $request->factory_allowance;
            $salaryChangeLog->other_allowance = $request->other_allowance;
            $salaryChangeLog->ta_da = $request->ta_da;
            $salaryChangeLog->consolidate = $request->consolidate;
            $salaryChangeLog->metro_city = $request->metro_city;
            $salaryChangeLog->arrear = $request->arrear;
            $salaryChangeLog->wppf = $request->wppf;
            $salaryChangeLog->col = $request->col;
            $salaryChangeLog->special_adjustment = $request->special_adjustment;
            $salaryChangeLog->mobile_set = $request->mobile_set;
            $salaryChangeLog->others = $request->others;
            $salaryChangeLog->others_one = $request->others_one;

            $totalExtraAdd = ($request->bonus+$request->factory_allowance+
                $request->other_allowance+$request->ta_da+$request->consolidate+
                $request->metro_city+$request->arrear+$request->wppf+$request->col+
                $request->mobile_set+$request->others+$request->others_one+
                $request->gross_salary+$request->special_adjustment);

            //dd($totalExtraAdd);

            $salaryChangeLog->others_two = $request->others_two;
            $salaryChangeLog->others_three = $request->others_three;
            //$salaryChangeLog->pf_loan = $request->pf_loan;
            $salaryChangeLog->lwp = $request->lwp;
            $salaryChangeLog->stuff_bus = $request->stuff_bus;
            $salaryChangeLog->others_deduction = $request->others_deduction;
            //$salaryChangeLog->skrp_loan = $request->skrp_loan;
            $salaryChangeLog->union_fee = $request->union_fee;
            $salaryChangeLog->mobile_bill = $request->mobile_bill;
            $salaryChangeLog->penalty = $request->penalty;
            $salaryChangeLog->income_tex = $request->income_tex;
            $salaryChangeLog->revenue_stamp = $request->revenue_stamp;

            $totalExtraSubtract = ($request->others_two+$request->others_three+$request->lwp+
                $request->stuff_bus+$request->others_deduction+$request->union_fee+
                $request->mobile_bill+$request->penalty+$request->income_tex+$request->revenue_stamp);

            $salaryChangeLog->gross_salary = $request->gross_salary;
            $salaryChangeLog->total_extra_add = $totalExtraAdd;
            $salaryChangeLog->total_extra_subtract = $totalExtraSubtract;
            $salaryChangeLog->monthly_gross_salary = $totalExtraAdd - $totalExtraSubtract;

            $salaryChangeLog->save();

            return response()->json(['success' => true, 'message' => 'Updates has been completed.']);
        }

        return response()->json(['reject' => true, 'message' => 'Salary has been already completed.']);

    }

    public function salaryApprovedPost(Request $request){


        $rules = [
            'approved_year' => 'required',
            'approved_month' => 'required',
        ];



        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }


        $counter = 0;

        foreach ($request->approved_month as $reqMonth){


           $checkLog = SalaryPreApproveLog::where('candidate_interview_evalution_id',$request->candidate_id)
                ->where('year',$request->approved_year)
                ->where('month',$request->approved_month[$counter])
                ->first();
           if ($checkLog) {

               $checkLog->status = 1;
               $checkLog->save();

           }else {

               $log =  new SalaryPreApproveLog();
               $log->candidate_interview_evalution_id = $request->candidate_id;
               $log->year = $request->approved_year;
               $log->month = $request->approved_month[$counter];
               $log->status = 1;
               $log->save();

           }

            $counter++;
        }


        return response()->json(['success' => true, 'message' => 'Salary Approved Your Selected Month']);


    }

    public function salaryRejectedPost(Request $request){


        $this->validate($request, [
            'rejected_year' => 'required',
            'rejected_month' => 'required',
        ]);

        $salaryConfirmation = Salary::where('employee_id',$request->candidate_id)->where('month', $request->rejected_month)->where('year',$request->rejected_year)->first();


        if (empty($salaryConfirmation)){

            SalaryPreApproveLog::where('candidate_interview_evalution_id',$request->candidate_id)
                ->where('month', $request->rejected_month)
                ->where('year',$request->rejected_year)
                ->first()
                ->update([
                    'status' => 0
                ]);

            return response()->json(['success' => true, 'message' => 'Salary Rejected Confirm']);
        }
        return response()->json(['reject' => true, 'message' => 'Cannot Reject!! Salary Already Processed ']);

    }

    public function salaryDeletePost(Request $request){

        $this->validate($request, [
            'salary_month' => 'required',
        ]);

        $salaryConfirmation = Salary::where('employee_id',$request->candidate_id)->where('month', date('m',strtotime($request->salary_month)))->where('year', date('Y',strtotime($request->salary_month)))->first();

        if (empty($salaryConfirmation)) {

            SalaryChangeLog::where('employee_id', $request->candidate_id)->whereMonth('for_month', date('m', strtotime($request->salary_month)))->whereYear('for_month', date('Y', strtotime($request->salary_month)))->Delete();

            CandidateInterviewEvalution::where('id',$request->candidate_id)->whereMonth('for_month', date('m',strtotime($request->salary_month)))->whereYear('for_month', date('Y',strtotime($request->salary_month)))->update(array('salary_approve_status' => '0'));

            return response()->json(['success' => true, 'message' => 'Salary Delete Successfully']);
        }
        return response()->json(['reject' => true, 'message' => 'Cannot Delete!! Salary Already Processed']);
    }

    public function salaryProcessIndex() {
        $banks = Bank::where('status', 1)->orderBy('name')->get();

        return view('payroll.salary_process.index', compact('banks'));
    }

    public function salaryProcessPost(Request $request) {


      $approvedEmployee = SalaryPreApproveLog::where('month',$request->month)
                        ->where('year',$request->year)
                        ->where('status',1)
                        ->pluck('candidate_interview_evalution_id')
                        ->toArray();




            $totalSalary=0;
            $totalOverTimeHours=0;
            $employees = CandidateInterviewEvalution::where('id',$approvedEmployee)
                //->where('salary_approve_status', 1)
                //->whereMonth('for_month', $request->month)
                //->whereYear('for_month', $request->year)
                ->get();



            foreach ($employees as $employee){


                $overtimes=AttendanceProcess::where('employee_id',$employee->id)->whereMonth('process_date', $request->month)->whereYear('process_date', $request->year)->where('overtime_approved_status',1)->get();
                if (!empty($overtimes)){
                    foreach($overtimes as $overtime){
                        $totalOverTimeHours += strtotime("1970-01-01 $overtime->over_time UTC");

                    }
                    $over_time = (($totalOverTimeHours/60)/60);
                    $per_day_salary = $employee->expected_salary/26;
                    $totalOverTimePayment = ($per_day_salary/8)* $over_time;
                    //dd($totalOverTimePayment);
                    $totalSalary += $totalOverTimePayment;
                }

                $candidates = CandidateInterviewEvalution::where('status',1)->get();
                //dd($candidates);

                foreach ($candidates as $candidate){
                    $salaryApproveLog = new SalaryApproveLog();
                    $salaryApproveLog->employee_id = $candidate->id;
                    $salaryApproveLog->approved_month = $request->month;
                    $salaryApproveLog->approved_year = $request->year;
                    if ($candidate->id == $employee->id){

                        $salaryApproveLog->salary_approve_status = 1;
                    }
                    else{
                        $salaryApproveLog->salary_approve_status = 0;
                    }
                    $salaryApproveLog->save();


                }

                $absent_count=EmployeeAttendance::where('employee_id',$employee->id)
                    ->where('present_or_absent',0)
                    ->whereYear('date', '=', date('Y'))
                    ->whereMonth('date', '=', $request->month)
                    ->count();
                $late_count=EmployeeAttendance::where('employee_id',$employee->id)
                    ->where('present_or_absent',1)
                    ->where('late',1)
                    ->whereYear('date',date('Y'))
                    ->whereMonth('date',$request->month)
                    ->count();
                $loan=Loan::where('employee_id',$employee->id)->where('due','>', 0)->first();
                $pfloan=PfLoan::where('employee_id',$employee->id)->where('due','>', 0)->first();
                $skrpLoan=SkrpLoan::where('employee_id',$employee->id)->where('due','>', 0)->first();






                $late=(int)($late_count/3);

                $per_day_salary=$employee->expected_salary/26;

                $deduct_absent_salary=$absent_count+$late*$per_day_salary;

                $totalSalary += $employee->gross_salary - $deduct_absent_salary;



                if ($loan && $loan->due > 0){

                    $loan->increment('paid', $loan->per_month_payble_amount);
                    $loan->decrement('due', $loan->per_month_payble_amount);



                    $totalSalary += $loan->per_month_payble_amount;
                 //dd($totalSalary);
                }
                //dd('nhbgf');
                if ($pfloan && $pfloan->due > 0){

                    $pfloan->increment('paid', $pfloan->per_month_payble_amount);
                    $pfloan->decrement('due', $pfloan->per_month_payble_amount);

                    $totalSalary += $pfloan->per_month_payble_amount;

                }
                //dd($totalSalary);
                if ($skrpLoan && $skrpLoan->due > 0){

                    $skrpLoan->increment('paid', $skrpLoan->per_month_payble_amount);
                    $skrpLoan->decrement('due', $skrpLoan->per_month_payble_amount);

                    $totalSalary += $skrpLoan->per_month_payble_amount;
                    //dd($totalSalary);
                }

                //dd($totalSalary);

                // $working_days=cal_days_in_month(CAL_GREGORIAN,$request->month,date('Y'));

                $salarychange = SalaryChangeLog::where('employee_id', $employee->id )->whereMonth('for_month', $request->month)->whereYear('for_month', $request->year)->first();

                if ($salarychange && $salarychange->consolidate){
                    $totalSalary += $salarychange->consolidate;
                }
                if ($salarychange && $salarychange->bonus){
                    $totalSalary += $salarychange->bonus;
                }
                if ($salarychange && $salarychange->others){
                    $totalSalary += $salarychange->others;
                }
                if ($salarychange && $salarychange->others_one){
                    $totalSalary += $salarychange->others_one;
                }
                if ($salarychange && $salarychange->metro_city){
                    $totalSalary += $salarychange->metro_city;
                }
                if ($salarychange && $salarychange->factory_allowance){
                    $totalSalary += $salarychange->factory_allowance;
                }
                if ($salarychange && $salarychange->arrear){
                    $totalSalary += $salarychange->arrear;
                }
                if ($salarychange && $salarychange->wppf){
                    $totalSalary += $salarychange->wppf;
                }
                if ($salarychange && $salarychange->col){
                    $totalSalary += $salarychange->col;
                }
                if ($salarychange && $salarychange->special_adjustment){
                    $totalSalary += $salarychange->special_adjustment;
                }
                if ($salarychange && $salarychange->other_allowance){
                    $totalSalary += $salarychange->other_allowance;
                }
                if ($salarychange && $salarychange->mobile_set){
                    $totalSalary += $salarychange->mobile_set;
                }
                if ($salarychange && $salarychange->ta_da){
                    $totalSalary += $salarychange->ta_da;
                }
                //dd($totalSalary);
                if ($salarychange && $salarychange->stuff_bus){
                    $totalSalary -= $salarychange->stuff_bus;
                }
                if ($salarychange && $salarychange->others_two){
                    $totalSalary -= $salarychange->others_two;
                }
                if ($salarychange && $salarychange->others_three){
                    $totalSalary -= $salarychange->others_three;
                }
                if ($salarychange && $salarychange->union_fee){
                    $totalSalary -= $salarychange->union_fee;
                }
                if ($salarychange && $salarychange->mobile_bill){
                    $totalSalary -= $salarychange->mobile_bill;
                }
                if ($salarychange && $salarychange->others_deduction){
                    $totalSalary -= $salarychange->others_deduction;
                }
                if ($salarychange && $salarychange->penalty){
                    $totalSalary -= $salarychange->penalty;
                }
                if ($salarychange && $salarychange->lwp){
                    $totalSalary -= $salarychange->lwp;
                }
                if ($salarychange && $salarychange->income_tex){
                    $totalSalary -= $salarychange->income_tex;
                }
                if ($salarychange && $salarychange->revenue_stamp){
                    $totalSalary -= $salarychange->revenue_stamp;
                }
                //dd($totalSalary);
            }
            $bankAccount = BankAccount::find($request->account);
            if ($totalSalary > $bankAccount->balance) {
                return redirect()->route('payroll.salary_process.index')->with('error', 'Insufficient Balance.');
            }

            $salaryProcess = new SalaryProcess();
            $salaryProcess->date = $request->date;
            $salaryProcess->month = $request->month;
            $salaryProcess->year = $request->year;
            $salaryProcess->bank_id = $request->bank;
            $salaryProcess->branch_id = $request->branch;
            $salaryProcess->bank_account_id = $request->account;
            $salaryProcess->total = $totalSalary;
            $salaryProcess->save();

        $employees = CandidateInterviewEvalution::where('status',1)
            ->where('salary_approve_status', 1)
            ->whereMonth('for_month', $request->month)
            ->whereYear('for_month', $request->year)->get();

            foreach ($employees as $employee) {

                $absent_count=EmployeeAttendance::where('employee_id',$employee->id)
                    ->where('present_or_absent',0)
                    ->whereYear('date',date('Y'))
                    ->whereMonth('date',$request->month)
                    ->count();
                $late_count=EmployeeAttendance::where('employee_id',$employee->id)
                    ->where('present_or_absent',1)
                    ->where('late',1)
                    ->whereYear('date',date('Y'))
                    ->whereMonth('date',$request->month)
                    ->count();
                $loan=Loan::where('employee_id',$employee->id)->where('due','>', 0)->first();
                $pfloan=PfLoan::where('employee_id',$employee->id)->where('due','>', 0)->first();
                $skrpLoan=SkrpLoan::where('employee_id',$employee->id)->where('due','>', 0)->first();

                if ($loan && $loan->due > 0){
                    $generalLoan = $loan->per_month_payble_amount;
                }
                else{
                    $generalLoan = 0;
                }
                if ($pfloan && $pfloan->due > 0){
                    $pfLoanAmount= $pfloan->per_month_payble_amount;
                }
                else{
                    $pfLoanAmount = 0;
                }
                if ($skrpLoan && $skrpLoan->due > 0){
                    $skrpLoanAmount= $skrpLoan->per_month_payble_amount;
                }
                else{
                    $skrpLoanAmount = 0;
                }

                $per_day_salary=$employee->expected_salary/26;

                $late=(int)($late_count/3);

                $deduct_absent_salary=$absent_count+$late*$per_day_salary;

                $salary = new Salary();
                $salary->salary_process_id = $salaryProcess->id;
                $salary->employee_id = $employee->id;
                $salary->candidate_id = $employee->employee_id;
                $salary->date = $request->date;
                $salary->month = $request->month;
                $salary->year = $request->year;
                $salary->basic_salary = $employee->basic_salary;
                $salary->house_rent = $employee->house_rent;
                $salary->medical = $employee->medical;
                $salary->conveyance = $employee->conveyance;
                $salary->deduction = $employee->deduction;
                $salary->absent_deduct = $deduct_absent_salary;
                $salary->gross_salary = $employee->expected_salary;
                $salary->loan = $generalLoan;
                $salary->pf_loan = $pfLoanAmount;
                $salary->skrp_loan = $skrpLoanAmount;
                $salary->total_overtime = $totalOverTimePayment;
                $salary->save();

            }

            BankAccount::find($request->account)->decrement('balance', $totalSalary);

            $log = new TransactionLog();
            $log->date = $request->date;
            $log->particular = 'Salary';
            $log->transaction_type = 2;
            $log->transaction_method = 2;
            $log->account_head_type_id = 5;
            $log->account_head_sub_type_id = 5;
            $log->bank_id = $request->bank;
            $log->branch_id = $request->branch;
            $log->bank_account_id = $request->account;
            $log->amount = $totalSalary;
            $log->salary_process_id = $salaryProcess->id;
            $log->save();




        return redirect()->route('payroll.salary_process.index')->with('message', 'Salary process successful.');
    }

    public function salaryProcessReport(Request $request){

        $employees = CandidateInterviewEvalution::where('status', 1)->get();

        //$salaries=Salary::all();
        $employee_id=Salary::where('employee_id',$request->employee_id)->first();


        $salaries = Null;

        if ($request->start && $request->start != '' && $request->end && $request->end != '') {
            $salaries=Salary::whereBetween('date', [$request->start, $request->end])->get();
        }


        return view('payroll.salary_process.report',compact('employees','salaries','employee_id'));
    }

    public function employeeWiseDeduction(CandidateInterviewEvalution $candidate, Request $request){

        $employee = CandidateInterviewEvalution::where('id',$candidate->id)->first();
        $employee_id=Salary::where('employee_id',$candidate->id)->first();
        $salaries = Null;

        if ($request->start && $request->start != '' && $request->end && $request->end != '') {
            $salaries=Salary::whereBetween('date', [$request->start, $request->end])->where('employee_id',$candidate->id)->get();

        }

        return view('payroll.salary_process.employee_wise_deduction',compact('employee','employee_id','salaries','candidate'));
    }
    public function employeeWiseAllDue(CandidateInterviewEvalution $candidate, Request $request){


        //dd($request->all());

        $employee = CandidateInterviewEvalution::where('id',$candidate->id)->first();
        $employee_id=Salary::where('employee_id',$candidate->id)->first();
        $salaries = Null;

        if ($request->start && $request->start != '' && $request->end && $request->end != '') {
            $generalLoans=Loan::whereBetween('loan_date', [$request->start, $request->end])->where('employee_id',$candidate->id)->get();

            //dd($generalLoans);

        }
        if ($request->start && $request->start != '' && $request->end && $request->end != '') {
            $pfLoans=PfLoan::whereBetween('pf_loan_date', [$request->start, $request->end])->where('employee_id',$candidate->id)->get();

            //dd($pfLoans);
        }
        if ($request->start && $request->start != '' && $request->end && $request->end != '') {
            $skrpLoans=SkrpLoan::whereBetween('skrp_loan_date', [$request->start, $request->end])->where('employee_id',$candidate->id)->get();

            //dd($skrpLoans);
        }

        if ($request->start && $request->start != '' && $request->end && $request->end != '') {

            $startYear = date('Y',strtotime($request->start));
            $endYear = date('Y',strtotime($request->end));
            $startMonth = date('m',strtotime($request->start));
            $endMonth = date('m',strtotime($request->end));
            $dueSalaries=SalaryApproveLog::where('employee_id',$candidate->id)
                ->whereBetween('approved_year',[$startYear, $endYear])
                ->whereBetween('approved_month',[$startMonth, $endMonth])
                ->where('salary_approve_status',0)->get();
            dd($dueSalaries);
        }

        return view('payroll.report.employee_wise_all_due',compact('employee','employee_id','salaries','candidate'));
    }
    public function employeeWiseAllSalary(CandidateInterviewEvalution $candidate, Request $request){

        $employees = CandidateInterviewEvalution::where('status', 1)->get();

        //$salaries=Salary::all();
        //$employee_id=Salary::where('employee_id',$request->employee_id)->first();


        $salaries = Null;

        if ($request->start && $request->start != '' && $request->end && $request->end != '') {
            $startMonth = date('m',strtotime($request->start));
            $endMonth = date('m',strtotime($request->end));
            $startYear = date('Y',strtotime($request->start));
            $endYear = date('Y',strtotime($request->end));

            $salaries=Salary::where('employee_id',$candidate->id)
                ->where('year','>=' ,$startYear)->where('year','<=' ,$endYear)
                ->where('month','>=' ,$startMonth)->where('month','<=' ,$endMonth)->get();

        }

        return view('payroll.salary_process.employee_wise_all_salary',compact('employees','salaries','candidate'));
    }


    public function employeeWiseSalaryPage(CandidateInterviewEvalution $candidate,Request $request){

        $salarie = Null;
        $salaryChange= Null;
        $leaveInformations= Null;
        $loan=Null;
        $salarie=Salary::where('employee_id',$candidate->id)->first();
        $employee_id=Salary::where('employee_id',$candidate->id)->first();
        $salaryChange=SalaryChangeLog::where('employee_id',$candidate->id)->whereMonth('for_month', $request->month )->whereYear('for_month', $request->year)->first();
        //dd($salaryChange);
        $leaveInformations=Leave::where('employee_id',$candidate->id)->whereMonth('from', date('m' , strtotime($request->month)))->whereYear('from', date('Y' , strtotime($request->year)))->where('status', 2)->get();

        if ($request->year && $request->month != '' && $request->year && $request->month != '') {
            $salarie=Salary::where('employee_id',$candidate->id)->where('year',$request->year)->where('month', $request->month)->first();
            //dd($salarie);

        }

        return view('payroll.employee_wise_salary_page.index',compact('candidate','employee_id','salarie','salaryChange','leaveInformations'));

        //return view('payroll.employee_wise_salary_page.index',compact('candidate'));
    }

    public function employeeWiseReport(CandidateInterviewEvalution $candidate){

        return view('payroll.report.employee_wise_report',compact('candidate'));
    }

    public function employeeWiseDueSalary(CandidateInterviewEvalution $candidate){

        $dueSalaries = SalaryApproveLog::where('salary_approve_status',0)->where('employee_id',$candidate->id)->get();


//        $appovedMonth = date('m',strtotime($candidate->for_month));
//        $appovedYear = date('Y',strtotime($candidate->for_month));
        //dd($appovedYear);

        return view('payroll.employee_wise_due_salary.index',compact('candidate','dueSalaries'));
    }

    public function employeeWiseSalaryReport(CandidateInterviewEvalution $candidate){



        return view('payroll.report.employee_wise_salary_report',compact('candidate'));
    }
    public function employeeWiseLoanReport(CandidateInterviewEvalution $candidate){

        return view('payroll.report.employee_wise_report',compact('candidate'));
    }
    public function employeeWiseAttendanceReport(CandidateInterviewEvalution $candidate){

        return view('payroll.report.employee_wise_report',compact('candidate'));
    }
    public function employeeWiseLeaveReport(CandidateInterviewEvalution $candidate){

        $employee_id=CandidateInterviewEvalution::where('id',$candidate->id)->with('department','designation')->first();
        $approvedLeaves = Leave::where('employee_id',$candidate->id)->where('status',2)->get();
        $pendingLeaves = Leave::where('employee_id',$candidate->id)->where('status',1)->get();
        $cancelLeaves = Leave::where('employee_id',$candidate->id)->where('status',3)->get();

        return view('payroll.report.employee_wise_leave_report',compact('candidate','employee_id','approvedLeaves','pendingLeaves','cancelLeaves'));
    }

    public function deductionHistory(Request $request){

        $employees = CandidateInterviewEvalution::where('status', 1)->get();

        $employee_id=Salary::where('employee_id',$request->employee_id)->first();

        $salaries = Null;

        if ($request->employee_id){

            if ($request->start && $request->start != '' && $request->end && $request->end != '') {
                $salaries=Salary::whereBetween('date', [$request->start, $request->end])->where('employee_id',$request->employee_id)->get();
                //dd($salaries);
            }
        }
        else{
            if ($request->start && $request->start != '' && $request->end && $request->end != '') {
                $salaries=Salary::whereBetween('date', [$request->start, $request->end])->get();
                //dd($salaries);
            }
        }



        return view('payroll.salary_process.deduction_history',compact('employees','employee_id','salaries'));
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
        if ($request->type == 1){
            $leave->total_annual = $totalDays;
        }
        if ($request->type == 2){
            $leave->total_casual = $totalDays;
        }
        if ($request->type == 3){
            $leave->total_medical = $totalDays;
        }
        $leave->type = $request->type;
        $leave->year = $toObj->format('Y');
        $leave->from = $request->from;
        $leave->to = $request->to;
        $leave->total_days = $totalDays;
        $leave->note = $request->note;
        $leave->status = $request->status;
        $leave->save();
        return redirect()->route('payroll.leave.index')->with('message', 'Leave add successful.');
    }




    public function holidayIndex() {

        return view('payroll.holiday.index');
    }

    public function holidayAdd()
    {
        return view('payroll.holiday.add');
    }

    public function holidayPost(Request $request) {
        $request->validate([
            'name' => 'required',
            'from' => 'required|date',
            'to' => 'required|date',
        ]);

        $fromObj = new Carbon($request->from);
        $toObj = new Carbon($request->to);
        $totalDays = $fromObj->diffInDays($toObj) + 1;

        $holiday = new Holiday();
        $holiday->name = $request->name;
        $holiday->year = $toObj->format('Y');
        $holiday->from = $request->from;
        $holiday->to = $request->to;
        $holiday->total_days = $totalDays;
        $holiday->save();

        return redirect()->route('payroll.holiday.index')->with('message', 'Holiday add successful.');
    }

    public function holidayEdit(Holiday $holiday)
    {
        return view('payroll.holiday.edit',compact('holiday'));
    }

    public function holidayEditPost(Holiday $holiday,Request $request)
    {
        $request->validate([
            'name' => 'required',
            'from' => 'required|date',
            'to' => 'required|date',
        ]);

        $fromObj = new Carbon($request->from);
        $toObj = new Carbon($request->to);
        $totalDays = $fromObj->diffInDays($toObj) + 1;

        $holiday->name = $request->name;
        $holiday->year = $toObj->format('Y');
        $holiday->from = $request->from;
        $holiday->to = $request->to;
        $holiday->total_days = $totalDays;
        $holiday->save();

        return redirect()->route('payroll.holiday.index')->with('message', 'Holiday update successful.');
    }

    public function holidayDatatable()
    {
        $query=Holiday::query();
        return DataTables::eloquent($query)
            ->editColumn('from', function(Holiday $holiday) {
                return $holiday->from->format('j F, Y');
            })
            ->editColumn('to', function(Holiday $holiday) {
                return $holiday->to->format('j F, Y');
            })

            ->addColumn('action', function(Holiday $holiday) {
                return '<a href="'.route('payroll.holiday_edit', ['holiday' => $holiday->id]).'" class="btn btn-primary btn-sm">Edit</a>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function salaryUpdateDatatable() {
        $query = CandidateInterviewEvalution::with('department', 'designation');

        return DataTables::eloquent($query)
            ->addColumn('department', function(CandidateInterviewEvalution $employee) {
                return $employee->department->name;
            })
            ->addColumn('designation', function(CandidateInterviewEvalution $employee) {
                return $employee->designation->name;
            })
            ->addColumn('action', function(CandidateInterviewEvalution $candidate) {
                return '<a class="btn btn-info btn-sm btn-update" role="button" data-id="'.$candidate->id.'">Update</a>';
            })
            ->editColumn('photo', function(CandidateInterviewEvalution $employee) {
                if ($employee->photo)
                    return '<img src="'.asset($employee->photo).'" height="50px">';
                else
                    return '<img src="'.asset('img/no_image.png').'" height="50px">';
            })
            ->editColumn('employee_type', function(CandidateInterviewEvalution $employee) {
                if ($employee->employee_type == 1)
                    return '<span class="label label-success">Permanent</span>';
                else
                    return '<span class="label label-warning">Temporary</span>';
            })

            ->editColumn('gross_salary', function(CandidateInterviewEvalution $employee) {
                return '৳ '.number_format($employee->expected_salary, 2);
            })
            ->rawColumns(['action', 'photo', 'employee_type','gross_salary'])
            ->toJson();
    }

    public function employeeWiseLeave(CandidateInterviewEvalution $candidate){
        //dd($candidate);
        //$leaves=Leave::where('employee_id',$candidate->id)->get();
        return view('hr.leave_application.employee_wise_leave',compact('candidate'));
    }

    public function leaveDatatable(Request $request) {
        if ($request->employeeId){
            $query = Leave::where('employee_id',$request->employeeId);
        }
        else{
            $query = Leave::query();
        }

        return DataTables::eloquent($query)
            ->addColumn('department', function(Leave $leave) {
                return $leave->employee->department->name;
            })
            ->addColumn('designation', function(Leave $leave) {
                return $leave->employee->designation->name;
            })

            ->addColumn('employee_id', function(Leave $leave) {
                return $leave->employee->employee_id;
            })
            ->addColumn('employee_name', function(Leave $leave) {
                return $leave->employee->name;
            })
            ->addColumn('year', function(Leave $leave) {
                return $leave->year;
            })
            ->addColumn('total_days', function(Leave $leave) {
                return $leave->total_days;
            })
            ->addColumn('date', function(Leave $leave) {
                return date('Y-m-d', strtotime($leave->created_at));
            })

            ->addColumn('status', function(Leave $leave) {
                if ($leave->status == 1)
                    return '<span class="btn btn-warning btn-xs">Pending</span>';
                elseif($leave->status == 2)

                    return '<span class="btn btn-success btn-xs">Approved</span>';
                else
                    return '<span class="btn btn-danger btn-xs">Canceled</span>';
            })
            ->addColumn('action', function(Leave $leave) {

                if($leave->status == 1)
                    return
                     '<a class="btn btn-primary btn-xs btn-confirm-leave" role="button" data-id="'.$leave->id.'">Confirm</a>
                     <a class="btn btn-danger btn-xs" href="'.route('leave_application_cancel', ['candidate' => $leave->id]).'">Cancel</a>
                     <a class="btn btn-info btn-xs" href="'.route('leave_application_form', ['candidate' => $leave->id]).'">Details</a>
                    ';
                    elseif($leave->status == 2)
                        return
                        '<a class="btn btn-danger btn-xs btn-cancel-leave" role="button" data-id="'.$leave->id.'">Cancel</a>
                         <a class="btn btn-info btn-xs" href="'.route('leave_application_form', ['candidate' => $leave->id]).'">Details</a>';
                else
                    return
                    '<a class="btn btn-primary btn-xs btn-confirm-leave" role="button" data-id="'.$leave->id.'">Confirm</a>
                    <a class="btn btn-info btn-xs" href="'.route('leave_application_form', ['candidate' => $leave->id]).'">Details</a>';


            })

            ->rawColumns(['action','employee_name','department','designation','status'])
            ->toJson();
    }
    public function employeeWisesalarySlip(CandidateInterviewEvalution $candidate,Request $request){
        //dd($candidate);
        $salarie = Null;
        $salaryChange= Null;
        $leaveInformations= Null;
        $loan=Null;
        $salarie=Salary::where('employee_id',$candidate->id)->first();
        $employee_id=Salary::where('employee_id',$candidate->id)->first();
        $salaryChange=SalaryChangeLog::where('employee_id',$candidate->id)->whereMonth('for_month', $request->month )->whereYear('for_month', $request->year)->first();
        //dd($salaryChange);
        $leaveInformations=Leave::where('employee_id',$candidate->id)->whereMonth('from', date('m' , strtotime($request->month)))->whereYear('from', date('Y' , strtotime($request->year)))->where('status', 2)->get();

        if ($request->year && $request->month != '' && $request->year && $request->month != '') {
            $salarie=Salary::where('employee_id',$candidate->id)->where('year',$request->year)->where('month', $request->month)->first();
            //dd($salarie);

        }

        return view('payroll.salary_slip.employee_wise',compact('candidate','employee_id','salarie','salaryChange','leaveInformations'));
    }

    public function employeeWisesalarySlipDetails(CandidateInterviewEvalution $candidate,$month,$year){
        //dd($year);
        $salarie = Null;
        $salaryChange= Null;
        $leaveInformations= Null;
        $loan=Null;
        $salarie=Salary::where('employee_id',$candidate->id)->first();
        $employee_id=Salary::where('employee_id',$candidate->id)->first();
        $salaryChange=SalaryChangeLog::where('employee_id',$candidate->id)->whereMonth('for_month', $month )->whereYear('for_month', $year)->first();
        $leaveInformations=Leave::where('employee_id',$candidate->id)->whereMonth('from', date('m' , strtotime($month)))->whereYear('from', date('Y' , strtotime($year)))->where('status', 2)->get();


        return view('payroll.salary_slip.index_2',compact('candidate','employee_id','salarie','salaryChange','leaveInformations'));
    }

    public function salarySlip(Request $request){

        //dd($request);

        $employees = CandidateInterviewEvalution::where('status', 1)->get();
        $salarie = Null;
        $salaryChange= Null;
        $leaveInformations= Null;
        $loan=Null;

        $employee_id=Salary::where('employee_id',$request->employee_id)->first();
        $salaryChange=SalaryChangeLog::where('employee_id',$request->employee_id)->whereMonth('for_month', $request->month )->whereYear('for_month', $request->year)->first();
        $leaveInformations=Leave::where('employee_id',$request->employee_id)->whereMonth('from', date('m' , strtotime($request->month)))->whereYear('from', date('Y' , strtotime($request->year)))->where('status', 2)->get();
        //dd($leaveInformations);

        if ($request->year && $request->month != '' && $request->year && $request->month != '') {
            $salarie=Salary::where('employee_id',$request->employee_id)->where('year',$request->year)->where('month', $request->month)->first();
            //dd($salarie);

        }

        return view('payroll.salary_slip.index',compact('employees','salarie','employee_id','salaryChange','leaveInformations'));
    }

    public function Consolidation(Request $request){

        //dd($request);

        $salaries = Null;

        if ($request->year && $request->month != '' && $request->year && $request->month != '') {
            $salaries=Salary::where('year',$request->year)->where('month', $request->month)->get();

            //dd($salaries);
        }

        return view('payroll.consolidation.index',compact('salaries'));
    }

    public function salaryApprovedList(Request $request){


        $salaryApproves = Null;
        $appovedMonth = Null;
        $appovedYear = Null;

        if ($request->year && $request->month != '' && $request->year && $request->month != '') {
            $salaryApproves=CandidateInterviewEvalution::whereYear('for_month',$request->year)->whereMonth('for_month', $request->month)->where('salary_approve_status', 1)->get();

            $appovedMonth = $request->month;
            $appovedYear = $request->year;
        }

        return view('payroll.salary_approved_list.all',compact('salaryApproves','appovedMonth','appovedYear'));
    }

    public function EmployeeLeaveInformation(Request $request){

        $employees = CandidateInterviewEvalution::where('status',1)->get();

        $year = $request->year;
        if($request->month){
        $month = $request->month;
        }
        else{
            $month = 0;
        }

        return view('payroll.employee_leave_information.index',compact('employees','year','month'));
    }

    public function EmployeePaymentHistory(){

        $salaries=Salary::get();
        return view('payroll.employee_payment_history.index',compact('salaries'));
    }

    public function employeeWiseLoan(CandidateInterviewEvalution $candidate){

          //dd($candidate);
        $previous_loans= null;
        $previous_pfloans= null;
        $previous_skrploans= null;
        $message= null;

          return view('payroll.create_loan.employee_wise_loan',compact('candidate','previous_loans','message','previous_pfloans','previous_skrploans'));
    }
    public function currentLoan(CandidateInterviewEvalution $candidate){

        $previous_loans= Loan::where('employee_id',$candidate->id)->where('due', '>', 0.00)->get();
        $previous_pfloans= PfLoan::where('employee_id',$candidate->id)->where('due', '>', 0.00)->get();
        $previous_skrploans= SkrpLoan::where('employee_id',$candidate->id)->where('due', '>', 0.00)->get();
        $employee_id=Salary::where('employee_id',$candidate->id)->first();

        return view('payroll.create_loan.employee_wise_loan',compact('previous_loans','employee_id','candidate','previous_pfloans','previous_skrploans'));
    }
    public function previousLoan(CandidateInterviewEvalution $candidate){

        $previous_loans= Loan::where('employee_id',$candidate->id)->where('due', '<=', 0)->get();
        $previous_pfloans= PfLoan::where('employee_id',$candidate->id)->where('due', '<=', 0)->get();
        $previous_skrploans= SkrpLoan::where('employee_id',$candidate->id)->where('due', '<=', 0)->get();
        $employee_id=Salary::where('employee_id',$candidate->id)->first();

        return view('payroll.create_loan.employee_wise_loan',compact('previous_loans','employee_id','candidate','previous_pfloans','previous_skrploans'));
    }

    public function createLoan(){
        $employees = CandidateInterviewEvalution::where('status', 1)->get();
        return view('payroll.create_loan.index',compact('employees'));
    }
    public function createLoanPost(Request $request){

        $request->validate([
            'employee_id' => 'required',
            'amount' => 'required',
            'interest' => 'required',
            'installment_month' => 'required',
            'loan_date' => 'required'
        ]);

        $interest=0;
        if ($request->interest){
            $interestInt = number_format($request->interest);
            $interest = $request->amount * $interestInt/100;

        }
        $payble_amount=0;
        if ($request->amount){
            $payble_amount= ($request->amount + $interest) / ($request->installment_month);
        }

        $loan = new Loan();
        $loan->employee_id = $request->employee_id;
        $loan->amount = $request->amount;
        $loan->interest = $request->interest;
        $loan->installment_month = $request->installment_month;
        $loan->per_month_payble_amount = $payble_amount;
        $loan->total_payble_amount = $request->amount + $interest;
        $loan->paid = 0;
        $loan->due = $request->amount + $interest;
        $loan->loan_date = $request->loan_date;
        $loan->note = $request->note;
        $loan->save();
        return redirect()->route('payroll.create.loan')->with('message', 'Loan add successfully.');
    }

    public function createPfLoan(){
        $employees = CandidateInterviewEvalution::where('status', 1)->get();
        return view('payroll.create_pf_loan.index',compact('employees'));
    }
    public function createPfLoanPost(Request $request){
    //dd($request->all());
        $request->validate([
            'employee_id' => 'required',
            'amount' => 'required',
            'interest' => 'required',
            'installment_month' => 'required',
            'pf_loan_date' => 'required'
        ]);

        $interest=0;
        if ($request->interest){
            $interestInt = number_format($request->interest);
            $interest = $request->amount * $interestInt/100;

        }
        $payble_amount=0;
        if ($request->amount){
            $payble_amount= ($request->amount + $interest) / ($request->installment_month);
        }

        $pfloan = new PfLoan();
        $pfloan->employee_id = $request->employee_id;
        $pfloan->amount = $request->amount;
        $pfloan->interest = $request->interest;
        $pfloan->installment_month = $request->installment_month;
        $pfloan->per_month_payble_amount = $payble_amount;
        $pfloan->total_payble_amount = $request->amount + $interest;
        $pfloan->paid = 0;
        $pfloan->due = $request->amount + $interest;
        $pfloan->pf_loan_date = $request->pf_loan_date;
        $pfloan->note = $request->note;
        $pfloan->save();
        return redirect()->route('payroll.create.pf_loan')->with('message', 'PF Loan add successfully.');
    }
    public function createSkrpLoan(){
        $employees = CandidateInterviewEvalution::where('status', 1)->get();
        return view('payroll.create_skrp_loan.index',compact('employees'));
    }
    public function createSkrpLoanPost(Request $request){

        $request->validate([
            'employee_id' => 'required',
            'amount' => 'required',
            'interest' => 'required',
            'installment_month' => 'required',
            'skrp_loan_date' => 'required'
        ]);

        $interest=0;
        if ($request->interest){
            $interestInt = number_format($request->interest);
            $interest = $request->amount * $interestInt/100;

        }
        $payble_amount=0;
        if ($request->amount){
            $payble_amount= ($request->amount + $interest) / ($request->installment_month);
        }

        $skrpLoan = new SkrpLoan();
        $skrpLoan->employee_id = $request->employee_id;
        $skrpLoan->amount = $request->amount;
        $skrpLoan->interest = $request->interest;
        $skrpLoan->installment_month = $request->installment_month;
        $skrpLoan->per_month_payble_amount = $payble_amount;
        $skrpLoan->total_payble_amount = $request->amount + $interest;
        $skrpLoan->paid = 0;
        $skrpLoan->due = $request->amount + $interest;
        $skrpLoan->skrp_loan_date = $request->skrp_loan_date;
        $skrpLoan->note = $request->note;
        $skrpLoan->save();
        return redirect()->route('payroll.create.skrp_loan')->with('message', 'SKRP Loan add successfully.');
    }

    public function employeeData(){

        $employees = CandidateInterviewEvalution::with('department','designation')->where('status',1)->get();

        return view('payroll.employee_data.all',compact('employees'));
    }

    public function employeeDataPost(Request $request){

        //dd($request->all());
        $rules = [
            //'employee_id' => 'required',
            'date_of_birth' => 'nullable',
            'present_date' => 'nullable',
            'age' => 'nullable',
            'service' => 'nullable',
            'resignation_date' => 'nullable',
            'service_duration' => 'nullable',
            'function_family' => 'nullable',
            'work_place' => 'nullable',
            'employee_group' => 'nullable',
            'employee_subgroup' => 'nullable',
            'employee_category' => 'nullable',
            'position' => 'nullable',
            'company' => 'nullable',
            'gender' => 'nullable',
            'highest_education' => 'nullable',
            'highest_education_passing_year' => 'nullable',
            'major_education' => 'nullable',
            'major_education_passing_year' => 'nullable',
            'blood_group' => 'nullable',
            'nationality' => 'nullable',
            'marital_status' => 'nullable',
            'religion' => 'nullable',
            'no_of_child' => 'nullable',
            'national_id' => 'nullable',
            'mother_name' => 'nullable',
            'home_district' => 'nullable',
            'permanent_address' => 'nullable',
            'present_address' => 'nullable',

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $employee=ExtraEmployeeData::where('employee_id',$request->id)->first();
        if (empty($employee)){
            $employee = new ExtraEmployeeData();
        }

        $employee->employee_id = $request->id;
        $employee->date_of_birth = $request->date_of_birth;
        $employee->present_date = $request->present_date;
        $employee->age = $request->age;
        $employee->service = $request->service;
        $employee->resignation_date = $request->resignation_date;
        $employee->service_duration = $request->service_duration;
        $employee->function_family = $request->function_family;
        $employee->work_place = $request->work_place;
        $employee->employee_group = $request->employee_group;
        $employee->employee_subgroup = $request->employee_subgroup;
        $employee->employee_category = $request->employee_category;
        $employee->position = $request->position;
        $employee->company = $request->company;
        $employee->gender = $request->gender;
        $employee->highest_education = $request->highest_education;
        $employee->highest_education_passing_year = $request->highest_education_passing_year;
        $employee->major_education = $request->major_education;
        $employee->major_education_passing_year = $request->major_education_passing_year;
        $employee->blood_group = $request->blood_group;
        $employee->nationality = $request->nationality;
        $employee->marital_status = $request->marital_status;
        $employee->religion = $request->religion;
        $employee->no_of_child = $request->no_of_child;
        $employee->national_id = $request->national_id;
        $employee->mother_name = $request->mother_name;
        $employee->home_district = $request->home_district;
        $employee->spause_name = $request->spause_name;
        $employee->spause_nid = $request->spause_nid;
        $employee->spause_mobile = $request->spause_mobile;
        $employee->father_nid = $request->father_nid;
        $employee->father_mobile_no = $request->father_mobile_no;
        $employee->mother_nid = $request->mother_nid;
        $employee->mother_mobile_no = $request->mother_mobile_no;
        $employee->son_names = $request->son_names;
        $employee->daughter_names = $request->daughter_names;
        $employee->permanent_village = $request->permanent_village;
        $employee->permanent_post_office = $request->permanent_post_office;
        $employee->permanent_upozilla = $request->permanent_upozilla;
        $employee->permanent_district = $request->permanent_district;
        $employee->permanent_post_code = $request->permanent_post_code;
        $employee->permanent_country = $request->permanent_country;
        $employee->present_village = $request->present_village;
        $employee->present_post_office = $request->present_post_office;
        $employee->present_upozilla = $request->present_upozilla;
        $employee->present_district = $request->present_district;
        $employee->present_post_code = $request->present_post_code;
        $employee->present_country = $request->present_country;
        $employee->permanent_address = $request->permanent_address;
        $employee->present_address = $request->present_address;
        $employee->emergency_contact_number = $request->emergency_contact_number;
        $employee->save();

        return response()->json(['success' => true, 'message' => 'Updates has been completed.']);

    }

}
