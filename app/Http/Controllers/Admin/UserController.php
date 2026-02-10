<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function updateStatus(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $user->update([
            'status' => $request->status,
        ]);

        $statusText = $request->status == 1 ? 'approved' : 'set to pending';
        return back()->with('success', "User account has been {$statusText} successfully.");
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,agent',
        ]);

        if ($user->role === 'admin') {
            return back()->with('error', 'Admin role cannot be changed.');
        }

        $user->update([
            'role' => $request->role,
        ]);

        return back()->with('success', "User role has been updated to {$request->role}.");
    }

    public function destroy(User $user)
    {
        if ($user->role === 'admin') {
            return back()->with('error', 'Admin accounts cannot be deleted.');
        }

        $user->delete();
        return back()->with('success', 'User account deleted successfully.');
    }
}
