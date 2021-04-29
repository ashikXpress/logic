<?php

namespace App\Http\Controllers;

use App\Model\Bank;
use App\Model\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index() {
        $branches = Branch::with('bank')->get();

        return view('bank_n_account.branch.all', compact('branches'));
    }

    public function add() {
        $banks = Bank::orderBy('name')->get();

        return view('bank_n_account.branch.add', compact('banks'));
    }

    public function addPost(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'bank' => 'required',
            'status' => 'required'
        ]);

        $branch = new Branch();
        $branch->bank_id = $request->bank;
        $branch->name = $request->name;
        $branch->status = $request->status;
        $branch->save();

        return redirect()->route('branch')->with('message', 'Branch add successfully.');
    }

    public function edit(Branch $branch) {
        $banks = Bank::orderBy('name')->get();

        return view('bank_n_account.branch.edit', compact('banks', 'branch'));
    }

    public function editPost(Branch $branch, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'bank' => 'required',
            'status' => 'required'
        ]);

        $branch->bank_id = $request->bank;
        $branch->name = $request->name;
        $branch->status = $request->status;
        $branch->save();

        return redirect()->route('branch')->with('message', 'Branch edit successfully.');
    }
}
