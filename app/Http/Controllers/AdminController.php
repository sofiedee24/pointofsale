<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::where('role', 'admin')->latest()->get();

        return view('adminview', compact('admins'));
    }


    public function demote(Request $request, User $user)
    {
        Log::info('Attempting to demote user ID: ' . $user->id);

        if ($request->user()->is($user)) {
            Log::warning('Blocked self-demotion for user ID: ' . $user->id);
            return back()->with('error', 'You cannot demote yourself.');
        }

        $user->role = 'user';
        $user->save();

        Log::info('Demotion success for user ID: ' . $user->id);

        return back()->with('success', 'Admin demoted to user.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addadmin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $admin)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required',
            'role' => 'required|string',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
