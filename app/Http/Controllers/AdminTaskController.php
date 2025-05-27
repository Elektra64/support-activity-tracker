<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\User;

class AdminTaskController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $department = $request->department;

        $activities = Activity::with(['author', 'assignedUsers'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhereHas('author', function ($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      })
                      ->orWhereHas('assignedUsers', function ($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      });
                });
            })
            ->when($department, function ($query) use ($department) {
                $query->whereHas('author', function ($q) use ($department) {
                    $q->where('department', $department);
                });
            })
            ->latest()
            ->paginate(10);

        $departments = ['Technical Support', 'Customer Service', 'Management'];

        return view('admin.users.tasks', compact('activities', 'departments'));
    }
}

