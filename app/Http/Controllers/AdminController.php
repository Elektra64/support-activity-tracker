<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class AdminController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'is_admin']);
    }

    /**
     * Display a listing of users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();
        $activities = Activity::all();
        return view('admin.users.index', compact('users', 'activities'));
    }

    /**
     * Assign activity to a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignActivity(Request $request, User $user)
    {
        $request->validate([
            'activity_id' => 'required|exists:activities,id'
        ]);

        $user->assignedActivities()->attach($request->activity_id);

        return back()->with('success', 'Activity assigned successfully');
    }

    /**
     * Promote user to admin.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function promote($id)
    {
        $user = User::findOrFail($id);
        $user->is_admin = true;
        $user->save();

        return redirect()->back()->with('success', 'User promoted to admin successfully.');
    }

    /**
     * Demote user from admin.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function demote($id)
    {
        $user = User::findOrFail($id);
        $user->is_admin = false;
        $user->save();

        return redirect()->back()->with('success', 'User demoted from admin successfully.');
    }

    public function manageUsers()
    {
        $users = User::all();
        $activities = Activity::all(); // Get all activities

        return view('admin.users.index', compact('users', 'activities'));
    }

    /**
     * Remove user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'You cannot delete yourself.');
        }

        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
