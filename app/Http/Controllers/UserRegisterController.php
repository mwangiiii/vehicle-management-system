<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRegisterController extends Controller
{
    public function create()
    {
        return view('User');
    }

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        
        DB::table('userss')->insert([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Redirect with success message
        return back()->with('message', 'Data submitted successfully!');
    }
}
