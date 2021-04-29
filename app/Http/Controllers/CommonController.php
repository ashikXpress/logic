<?php

namespace App\Http\Controllers;

use App\Model\AccountHeadSubType;
use App\Model\AccountHeadType;
use App\Model\AttendanceProcess;
use App\Model\BankAccount;
use App\Model\Branch;
use App\Model\CandidateInterviewEvalution;
use App\Model\Client;
use App\Model\Designation;
use App\Model\Employee;
use App\Model\Product;
use App\Model\Project;
use App\Model\SalaryChangeLog;
use App\Model\SalaryProcess;
use App\Model\SalesOrder;
use App\Model\TrainingBatch;
use App\Model\TrainingCourse;
use App\Model\TrainingDepartment;
use App\Model\Supplier;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function getClient(Request $request) {
        $clients = Client::where('sister_concern_id', $request->sisterConcernId)
            ->where('status', 1)
            ->orderBy('name')
            ->get()->toArray();

        return response()->json($clients);
    }

    public function getProject(Request $request) {
        $projects = Project::where('client_id', $request->clientId)
            ->orderBy('name')
            ->get()->toArray();

        return response()->json($projects);
    }

    public function getProduct(Request $request) {
        $products = Product::where('sister_concern_id', $request->sisterConcernId)
            ->where('status', 1)
            ->orderBy('name')
            ->get()->toArray();

        return response()->json($products);
    }

    public function getSupplier(Request $request) {
        $suppliers = Supplier::where('sister_concern_id', $request->sisterConcernId)
            ->where('status', 1)
            ->orderBy('name')
            ->get()->toArray();

        return response()->json($suppliers);
    }

    public function getBranch(Request $request) {
        $branches = Branch::where('bank_id', $request->bankId)
            ->where('status', 1)
            ->orderBy('name')
            ->get()->toArray();

        return response()->json($branches);
    }

    public function getBankAccount(Request $request) {
        $accounts = BankAccount::where('branch_id', $request->branchId)
            ->where('status', 1)
            ->orderBy('account_no')
            ->get()->toArray();

        return response()->json($accounts);
    }

    public function orderDetails(Request $request) {
        $order = SalesOrder::where('id', $request->orderId)->with('client')->first()->toArray();

        return response()->json($order);
    }

    public function projectDetails(Request $request) {
        $project = Project::where('id', $request->projectId)->first()->toArray();

        return response()->json($project);
    }

    public function getAccountHeadType(Request $request) {
        $types = AccountHeadType::where('transaction_type', $request->type)
            ->where('status', 1)
            ->whereNotIn('id', [1, 2, 3, 4, 5, 6])
            ->orderBy('name')
            ->get()->toArray();

        return response()->json($types);
    }

    public function getAccountHeadSubType(Request $request) {
        $subTypes = AccountHeadSubType::where('account_head_type_id', $request->typeId)
            ->where('status', 1)
            ->whereNotIn('id', [1, 2, 3, 4, 5, 6])
            ->orderBy('name')
            ->get()->toArray();

        return response()->json($subTypes);
    }

    public function getDesignation(Request $request) {
        $designations = Designation::where('department_id', $request->departmentId)
            ->where('status', 1)
            ->orderBy('name')->get()->toArray();

        return response()->json($designations);
    }

    public function getEmployeeDetails(Request $request) {
        $employee = CandidateInterviewEvalution::where('id', $request->employeeId)
            ->with('department', 'designation','employeeExtraData')->first();

        return response()->json($employee);
    }
    public function getOvertime(Request $request) {
        $employee = AttendanceProcess::where('id', $request->employeeId)->first();

        return response()->json($employee);
    }
    public function getEmployeeSalaryChangeDetails(Request $request){

        $salaryChange = SalaryChangeLog::where('employee_id', $request->employeeId)->whereMonth('for_month', $month)->whereYear('for_month', $year)->first();

        return response()->json($salaryChange);
    }
    
    public function getCourseCode(Request $request) {
        $courseCode = TrainingCourse::where('id', $request->trainingCourseId)
            ->where('status', 1)
            ->first();

        //dd($courseCode);
        return response()->json($courseCode);
    }
    public function getDepartmentCode(Request $request) {
        $departmentCode = TrainingDepartment::where('id', $request->trainingDepartmentId)
            ->where('status', 1)
            ->first();

        //dd($courseCode);
        return response()->json($departmentCode);
    }
    public function getBatchCode(Request $request) {
        $batchCode = TrainingBatch::where('id', $request->trainingBatchId)
            ->where('status', 1)
            ->first();

        //dd($courseCode);
        return response()->json($batchCode);
    }

    public function getMonth(Request $request) {
        $salaryProcess = SalaryProcess::select('month')
            ->where('year', $request->year)
            ->get();

        $proceedMonths = [];
        $result = [];

        foreach ($salaryProcess as $item)
            $proceedMonths[] = $item->month;

        for($i=1; $i <=12; $i++) {
            if (!in_array($i, $proceedMonths)) {
                $result[] = [
                    'id' => $i,
                    'name' => date('F', mktime(0, 0, 0, $i, 10)),
                ];
            }
        }

        return response()->json($result);
    }
    public function getMonthSalaryMonth(Request $request) {

        $salaryProcess = SalaryProcess::select('month')
            ->where('year', $request->year)
            ->get();

        $proceedMonths = [];
        $result = [];

        foreach ($salaryProcess as $item)
            $proceedMonths[] = $item->month;

        for($i=1; $i <=12; $i++) {
            if (in_array($i, $proceedMonths)) {
                $result[] = [
                    'id' => $i,
                    'name' => date('F', mktime(0, 0, 0, $i, 10)),
                ];
            }
        }

        return response()->json($result);
    }
}
