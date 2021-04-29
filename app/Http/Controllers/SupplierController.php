<?php

namespace App\Http\Controllers;

use App\Model\SisterConcern;
use App\Model\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index() {
        $suppliers = Supplier::all();

        return view('purchase.supplier.all', compact('suppliers'));
    }

    public function add() {
        $sisterConcerns = SisterConcern::orderBy('name')->get();

        return view('purchase.supplier.add', compact('sisterConcerns'));
    }

    public function addPost(Request $request) {
        $request->validate([
            'sister_concern' => 'required',
            'name' => 'required|string|max:255',
            'opening_due' => 'nullable|numeric',
            'company_name' => 'nullable|string|max:255',
            'mobile_no' => 'required|digits:11',
            'address' => 'required|string|max:255',
            'status' => 'required'
        ]);

        $supplier = new Supplier();
        $supplier->sister_concern_id = $request->sister_concern;
        $supplier->name = $request->name;
        $supplier->company_name = $request->company_name;
        $supplier->mobile = $request->mobile_no;
        $supplier->address = $request->address;
        $supplier->status = $request->status;
        $supplier->save();

        return redirect()->route('supplier')->with('message', 'Supplier add successfully.');
    }

    public function edit(Supplier $supplier) {
        $sisterConcerns = SisterConcern::orderBy('name')->get();

        return view('purchase.supplier.edit', compact('supplier', 'sisterConcerns'));
    }

    public function editPost(Supplier $supplier, Request $request) {
        $request->validate([
            'sister_concern' => 'required',
            'name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'opening_due' => 'nullable|numeric',
            'mobile_no' => 'required|digits:11',
            'address' => 'required|string|max:255',
            'status' => 'required'
        ]);

        $supplier->sister_concern_id = $request->sister_concern;
        $supplier->name = $request->name;
        $supplier->company_name = $request->company_name;
        $supplier->mobile = $request->mobile_no;
        $supplier->address = $request->address;
        $supplier->status = $request->status;
        $supplier->save();

        return redirect()->route('supplier')->with('message', 'Supplier edit successfully.');
    }
}
