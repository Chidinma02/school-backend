<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\AssignmentSubmission;
use Illuminate\Support\Facades\Gate;

class StudentController extends Controller
{
    //
    public function viewAssignments()
    {
        // return response()->json(['status' => 'success'], 200);
        if (Gate::allows('view-assignment')) {
            $assignments = Assignment::all();
            return response()->json($assignments, 200);
        } else {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    }

    public function submitAssignment(Request $request)
    {
        if (Gate::allows('submit-assignment')) {
            $submission = AssignmentSubmission::create([
                'student_id' => auth()->id(),
                'assignment_id' =>  $request->assignment_id,
                'answer' => $request->answer,
                // 'assignment_id'=> $request->student_id,
            ]);
            return response()->json(['message' => 'Assignment submitted successfully'], 201);
        } else {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    }

}


