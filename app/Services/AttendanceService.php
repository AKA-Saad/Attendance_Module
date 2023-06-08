<?php

namespace app\Services;

use App\Models\attendances;

class AttendanceService
{
    public function uploadAttendance($file)
    {
        // Process the file and extract the data

        // Store the attendance data in the database using the Attendance model
    }

    public function getAttendanceInfo($employeeId)
    {

        // Retrieve the attendance data for the specified employee

        \Log::info('one step');
        $attendance = attendances::where('employee_id', $employeeId)->get();

        // Calculate the total working hours

        return $attendance;
    }
}
