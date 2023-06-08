<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AttendanceImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection($rows)
    {
        $data = [];

        foreach ($rows as $row) {
            $data[] = [
                'user_id' => $row['employee_id'],
                'checkin' => $row['checkin'],
                'checkout' => $row['checkout'],
            ];
        }

        return $data;
    }
}
