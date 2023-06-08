<?php

namespace App\Services;

use App\Imports\AttendanceImport;
use App\Models\Attendance;
use Excel;

class AttendanceService
{
    public function uploadAttendance($file)
    {
        \Log::info($file);
        $data = Excel::import(new AttendanceImport, $file);

        \log::info($data);
        // Store the data in the database
        foreach ($data as $row) {
            Attendance::create([
                'user_id' => $row['employee_id'],
                'checkin' => $row['checkin'],
                'checkout' => $row['checkout'],
            ]);
        }

        return response()->json(['message' => 'Attendance data uploaded successfully']);
    }

    public function getAttendanceInfo($employeeId)
    {

        // Retrieve the attendance data for the specified employee
        $attendance = Attendance::where('user_id', $employeeId)->get();
        // Calculate the total working hours

        return $attendance;
    }
}
