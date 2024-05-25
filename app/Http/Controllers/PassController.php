<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pass;

class PassController extends Controller
{
    //
      /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if(auth()->user()){
            $data['passwords'] = Pass::where('user_id', auth()->user()->id)->get();
        }
        return view("vault", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        $validatedData = [
            'user_id' => auth()->user()->id,
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];
        Pass::create($validatedData);
        return response()->json(['status' => 201, 'message' => 'Password created successfully!']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        $validatedData = [
            'user_id' => auth()->user()->id,
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];
        $pass = Pass::findOrFail($request->get('id'));
        $pass->update($validatedData);

        return redirect()->route('vault.index')->with('success', 'Password updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pass = Pass::findOrFail($id);
        $pass->forceDelete();
        // dd($pass);
        return redirect()->route('vault.index')->with('success', 'Order deleted successfully');
    }

}
