<?php

namespace App\Http\Controllers;

use App\Model\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index() {
        $units = Unit::all();

        return view('administrator.unit.all', compact('units'));
    }

    public function add() {
        return view('administrator.unit.add');
    }

    public function addPost(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required'
        ]);

        $unit = new Unit();
        $unit->name = $request->name;
        $unit->status = $request->status;
        $unit->save();

        return redirect()->route('unit')->with('message', 'Unit add successfully.');
    }

    public function edit(Unit $unit) {
        return view('administrator.unit.edit', compact('unit'));
    }

    public function editPost(Unit $unit, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required'
        ]);

        $unit->name = $request->name;
        $unit->status = $request->status;
        $unit->save();

        return redirect()->route('unit')->with('message', 'Unit edit successfully.');
    }
}
