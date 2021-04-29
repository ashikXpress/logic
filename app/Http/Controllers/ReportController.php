<?php

namespace App\Http\Controllers;

use App\Model\CandidateInterviewEvalution;
use App\Model\Employee;
use App\Model\TransactionLog;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function ledger(Request $request) {
        $incomes = null;
        $expenses = null;

        if ($request->start && $request->end) {
            $incomes = TransactionLog::where('transaction_type', 1)->whereBetween('date', [$request->start, $request->end])->get();
            $expenses = TransactionLog::whereIn('transaction_type', [3, 2])->whereBetween('date', [$request->start, $request->end])->get();
        }

        return view('report.ledger', compact('incomes', 'expenses'));
    }

    public function employeeList(Request $request) {
        if ($request->category!='') {
            $employees=CandidateInterviewEvalution::with('designation','department')
                ->where('category_id',$request->category)
                ->get();
        }else {
            $employees=CandidateInterviewEvalution::with('designation','department')->get();
        }

        return view('report.employee_list',compact('employees'));
    }
}
