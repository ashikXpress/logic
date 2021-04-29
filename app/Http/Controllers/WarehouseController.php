<?php

namespace App\Http\Controllers;

use App\Model\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index() {
        $warehouses = Warehouse::all();

        return view('administrator.warehouse.all', compact('warehouses'));
    }

    public function add() {
        return view('administrator.warehouse.add');
    }

    public function addPost(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'status' => 'required'
        ]);

        $warehouse = new Warehouse();
        $warehouse->name = $request->name;
        $warehouse->address = $request->address;
        $warehouse->status = $request->status;
        $warehouse->save();

        return redirect()->route('warehouse')->with('message', 'Warehouse add successfully.');
    }

    public function edit(Warehouse $warehouse) {
        return view('administrator.warehouse.edit', compact('warehouse'));
    }

    public function editPost(Warehouse $warehouse, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'status' => 'required'
        ]);

        $warehouse->name = $request->name;
        $warehouse->address = $request->address;
        $warehouse->status = $request->status;
        $warehouse->save();

        return redirect()->route('warehouse')->with('message', 'Warehouse edit successfully.');
    }
}
