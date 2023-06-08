<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AttendanceImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    protected $data = [];

    public function collection($rows)
    {
        $this->data = [];
        $headers = $rows->first();
        $employeeIdIndex = $headers->search('employee_id');
        $checkinIndex = $headers->search('checkin');
        $checkoutIndex = $headers->search('checkout');

        foreach ($rows as $key => $row) {
            if ($key != 0) {
                $this->data[] = [
                    'employee_id' => $row[$employeeIdIndex],
                    'checkin' => $row[$checkinIndex],
                    'checkout' => $row[$checkoutIndex],
                ];
            }
        }

    }

    public function getData()
    {
        return $this->data;
    }
    
}
