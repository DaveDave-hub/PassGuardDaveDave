<?php

namespace App\Http\Controllers;

use App\Models\Pass;
use Illuminate\Http\Request;

class PassController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $passwords = Pass::where('user_id', auth()->user()->id)
                ->where(function($q) use ($query) {
                    $q->where('platform', 'LIKE', "%{$query}%")
                        ->orWhere('email_username', 'LIKE', "%{$query}%")
                        ->orWhere('password', 'LIKE', "%{$query}%");
                })
                ->paginate(10);
        } else {
            $passwords = Pass::where('user_id', auth()->user()->id)->paginate(10);
        }

        return view('vault.index', compact('passwords'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'platform' => 'required|string',
            'email_username' => 'required|string',
            'password' => 'required|string',
        ]);

        Pass::create([
            'user_id' => auth()->user()->id,
            'platform' => $request->platform,
            'email_username' => $request->email_username,
            'password' => $request->password,
        ]);

        return redirect()->route('vault.index')->with('success', 'Password created successfully!');
    }

    public function edit($id)
    {
        $password = Pass::findOrFail($id);
        return view('vault.edit', compact('password'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'platform' => 'required|string',
            'email_username' => 'required|string',
            'password' => 'required|string',
        ]);

        $password = Pass::findOrFail($id);
        $password->update([
            'platform' => $request->platform,
            'email_username' => $request->email_username,
            'password' => $request->password,
        ]);

        return redirect()->route('vault.index')->with('success', 'Password updated successfully!');
    }

    public function destroy($id)
    {
        $password = Pass::findOrFail($id);
        $password->delete();

        return redirect()->route('vault.index')->with('success', 'Password deleted successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $passwords = Pass::where('user_id', auth()->user()->id)
            ->where(function($q) use ($query) {
                $q->where('platform', 'LIKE', "%{$query}%")
                    ->orWhere('email_username', 'LIKE', "%{$query}%")
                    ->orWhere('password', 'LIKE', "%{$query}%");
            })
            ->paginate(10);

        return view('vault.index', compact('passwords'));
    }
}
