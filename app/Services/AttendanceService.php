<?php

namespace App\Services;

use App\Imports\AttendanceImport;
use App\Models\Attendance;
use DateTime;
use Excel;

class AttendanceService
{
    public function uploadAttendance($file)
    {
        $import = new AttendanceImport();
        Excel::import($import, $file);
        $data = $import->getData();

        // Store the data in the database
        foreach ($data as $row) {
            try {
                // checkin dattiome conversion
                $timestamp = $row['checkin'];
                $excelDateTime = ($timestamp - 25569) * 86400;
                $dateTime = DateTime::createFromFormat('U', $excelDateTime);
                $formattedDateTime = $dateTime->format('Y-m-d H:i:s');

                // checkout datetiem conversion
                $timestamp_out = $row['checkout'];
                $excelDateTime_out  = ($timestamp_out  - 25569) * 86400;
                $dateTime_out  = DateTime::createFromFormat('U', $excelDateTime_out );
                $formattedDateTime_out  = $dateTime_out ->format('Y-m-d H:i:s');


                Attendance::create([
                    'user_id' => $row['employee_id'],
                    'checkin' => $formattedDateTime,
                    'checkout' => $formattedDateTime_out,
                ]);
            } catch (\Exception $e) {
                \Log::info($e);
            }
        }

        return response()->json(['message' => 'Attendance data uploaded successfully']);
    }

    public function getAttendanceInfo($employeeId)
    {

        // Retrieve the attendance data for the specified employee
        $attendance = Attendance::where('user_id', $employeeId)->get();
        // Calculate the total working hours
        \Log::info($attendance);

        return $attendance;
    }
}
