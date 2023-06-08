<?php

namespace App\Http\Controllers;

use App\Models\attendances;
use App\Services\AttendanceService;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

    protected $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }
    public function uploadAttendance(Request $request)
    {
        // Validate the uploaded file

        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Call the corresponding method from the AttendanceService

        $this->attendanceService->uploadAttendance($request->file('file'));
        return response()->json(['message' => 'Attendance uploaded successfully']);
    }

    public function getAttendanceInfo($employeeId)
    {
        // Call the corresponding method from the AttendanceService

        $attendance = $this->attendanceService->getAttendanceInfo($employeeId);

        return response()->json($attendance);
    }
}
