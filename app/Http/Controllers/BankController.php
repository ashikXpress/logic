<?php

namespace App\Http\Controllers;

use App\Model\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index() {
        $banks = Bank::all();

        return view('bank_n_account.bank.all', compact('banks'));
    }

    public function add() {
        return view('bank_n_account.bank.add');
    }

    public function addPost(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required'
        ]);

        $bank = new Bank();
        $bank->name = $request->name;
        $bank->status = $request->status;
        $bank->save();

        return redirect()->route('bank')->with('message', 'Bank add successfully.');
    }

    public function edit(Bank $bank) {
        return view('bank_n_account.bank.edit', compact('bank'));
    }

    public function editPost(Bank $bank, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required'
        ]);

        $bank->name = $request->name;
        $bank->status = $request->status;
        $bank->save();

        return redirect()->route('bank')->with('message', 'Bank edit successfully.');
    }
}
