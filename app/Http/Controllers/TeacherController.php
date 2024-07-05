<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Attendance;
use Illuminate\Http\Request;

use App\Models\AssignmentSubmission;
use Illuminate\Support\Facades\Gate;


class TeacherController extends Controller
{
   
    public function markAttendance(Request $request){
        if (Gate::allows('mark-attendance')) {

        Attendance::create($request->all());
        return response()->json(['message'=>'Attendance marked sucessfully'],201);}
        else{
           
            return response()->json(['message'=>'unauthorised'],403);
        }
    }


    public function postAssignment(Request $request)
    {
        if (Gate::allows('post-assignment')) {
            Assignment::create([
                'teacher_id' => auth()->id(),
                'subject_id' => $request->subject_id,
                'title' => $request->title,
                'description' => $request->description,
                'due_date'=> $request->due_date,
            ]);
            return response()->json(['message' => 'Assignment posted successfully'], 201);
        } else {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    }

    public function giveScore(Request $request, $assignment_id, $student_id)
    {
        if (Gate::allows('give-score')) {
            $submission = AssignmentSubmission::where('assignment_id', $assignment_id)
                                               ->where('student_id', $student_id)
                                               ->firstOrFail();
            $submission->score = $request->score;
            $submission->save();
            return response()->json(['message' => 'Score given successfully'], 200);
        } else {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
       
    }


    // public function giveScore()
    // {
       
    //      return response()->json(['status'=>'success']);
    // }
}
