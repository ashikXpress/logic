<?php

namespace App\Http\Controllers;

use App\Model\SisterConcern;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SisterConcernController extends Controller
{
    public function index() {
        $sisterConcerns = SisterConcern::all();

        return view('administrator.sister_concern.all', compact('sisterConcerns'));
    }

    public function add() {
        return view('administrator.sister_concern.add');
    }

    public function addPost(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'logo' => 'nullable|image',
        ]);

        $path = null;

        if ($request->logo) {
            $file = $request->file('logo');
            $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/sister_concern_logo';
            $file->move($destinationPath, $filename);
            $path = 'uploads/sister_concern_logo/'.$filename;
        }

        $sisterConcern = new SisterConcern();
        $sisterConcern->name = $request->name;
        $sisterConcern->address = $request->address;
        $sisterConcern->logo = $path;
        $sisterConcern->save();

        return redirect()->route('sister_concern')->with('message', 'Sister Concern add successfully.');
    }

    public function edit(SisterConcern $sisterConcern) {
        return view('administrator.sister_concern.edit', compact('sisterConcern'));
    }

    public function editPost(SisterConcern $sisterConcern, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'logo' => 'nullable|image',
        ]);

        if ($request->logo) {
            if ($sisterConcern->logo)
                unlink(public_path($sisterConcern->logo));

            $file = $request->file('logo');
            $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/sister_concern_logo';
            $file->move($destinationPath, $filename);
            $path = 'uploads/sister_concern_logo/'.$filename;
            $sisterConcern->logo = $path;
        }

        $sisterConcern->name = $request->name;
        $sisterConcern->address = $request->address;
        $sisterConcern->save();

        return redirect()->route('sister_concern')->with('message', 'Sister Concern edit successfully.');
    }
}
