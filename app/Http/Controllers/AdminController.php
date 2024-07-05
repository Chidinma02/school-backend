<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function addTeacher(Request $request)
    {
        Log::info('User attempting to add teacher', ['user' => auth()->user()]);
        if (Gate::allows('add-teacher')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'Teacher',
            ]);

            return response()->json(['message' => 'Teacher added successfully'], 201);
        } else {
            Log::warning('Unauthorized attempt to add teacher', ['user' => auth()->user()]);
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    }

    public function deleteTeacher($id)
    {
        Log::info('User attempting to delete teacher', ['user' => auth()->user()]);
        if (Gate::allows('delete-teacher')) {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['message' => 'Teacher deleted successfully'], 200);
        } else {
            Log::warning('Unauthorized attempt to delete teacher', ['user' => auth()->user()]);
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    }


    public function alladmin(){
        $admin = User::where('role','admin')->get();
        // $admin=DB::select('select * from users where role = Admin');
        return response()->json($admin);
    }

    public function postNews(Request $request)
    {
        // Log::info('User attempting to post news', ['user' => auth()->user()]);
        if (Gate::allows('post-news')) {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
            ]);

            $news = News::create([
                'admin_id' => auth()->id(),
                'title' => $request->title,
                'content' => $request->content,
            ]);

            return response()->json(['message' => 'News posted successfully'], 201);
        } else {
            // Log::warning('Unauthorized attempt to post news', ['user' => auth()->user()]);
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    }
}


