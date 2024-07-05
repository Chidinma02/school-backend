<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\AssignmentSubmission;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function postAssignment(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'subject_id' => 'required|integer|exists:subjects,id',
            'due_date' => 'required|date',
        ]);

        $assignment = Assignment::create([
            'teacher_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'subject_id' => $request->subject_id,
            'due_date' => $request->due_date,
        ]);

        return response()->json(['message' => 'Assignment posted successfully', 'assignment' => $assignment], 201);
    }

    public function viewAssignments()
    {
        $assignments = Assignment::all();
        return response()->json(['assignments' => $assignments]);
    }

    public function submitAssignment(Request $request, $assignmentId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $submission = AssignmentSubmission::create([
            'assignment_id' => $assignmentId,
            'student_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return response()->json(['message' => 'Assignment submitted successfully', 'submission' => $submission], 201);
    }

    public function giveScore(Request $request, $assignmentId, $studentId)
    {
        $request->validate([
            'score' => 'required|integer|min:0|max:100',
        ]);

        $submission = AssignmentSubmission::where('assignment_id', $assignmentId)
                                ->where('student_id', $studentId)
                                ->firstOrFail();

        $submission->score = $request->score;
        $submission->save();

        return response()->json(['message' => 'Score given successfully', 'submission' => $submission]);
    }
}
