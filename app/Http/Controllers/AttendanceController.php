<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //
    public function index()
    {
        $attendances = Attendance::all();
        return response()->json($attendances, 200);
    }

}
