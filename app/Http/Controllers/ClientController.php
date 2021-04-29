<?php

namespace App\Http\Controllers;

use App\Model\Client;
use App\Model\SisterConcern;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index() {
        $clients = Client::all();

        return view('administrator.client.all', compact('clients'));
    }

    public function add() {
        $sisterConcerns = SisterConcern::orderBy('name')->get();

        return view('administrator.client.add', compact('sisterConcerns'));
    }

    public function addPost(Request $request) {
        $request->validate([
            'sister_concern' => 'required',
            'name' => 'required|string|max:255',
            'mobile_no' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'status' => 'required'
        ]);

        $client = new Client();
        $client->sister_concern_id = $request->sister_concern;
        $client->name = $request->name;
        $client->mobile_no = $request->mobile_no;
        $client->address = $request->address;
        $client->email = $request->email;
        $client->status = $request->status;
        $client->save();

        return redirect()->route('client')->with('message', 'Client add successfully.');
    }

    public function edit(Client $client) {
        $sisterConcerns = SisterConcern::orderBy('name')->get();

        return view('administrator.client.edit', compact('sisterConcerns', 'client'));
    }

    public function editPost(Client $client, Request $request) {
        $request->validate([
            'sister_concern' => 'required',
            'name' => 'required|string|max:255',
            'mobile_no' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'status' => 'required'
        ]);

        $client->sister_concern_id = $request->sister_concern;
        $client->name = $request->name;
        $client->mobile_no = $request->mobile_no;
        $client->address = $request->address;
        $client->email = $request->email;
        $client->status = $request->status;
        $client->save();

        return redirect()->route('client')->with('message', 'Client edit successfully.');
    }
}
