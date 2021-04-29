<?php

namespace App\Imports;

use App\Model\EmployeeAttendance;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
class AttendanceImport implements ToCollection
{
//    public function collection(Collection $rows)
//    {
//
//        //dd($rows);
//        if (!$rows[0]){
//            //dd($rows);
//        foreach ($rows as $key => $row)
//        {
//            //dd($row);
//
//
//                EmployeeAttendance::create([
//                    'employee_id' => $row[0],
//                    'present_or_absent' => $row[1],
//                    'present_time' => $row[2],
//                    'late' => $row[3],
//                    'late_time' => $row[4],
//                    'note' => $row[5],
//                    'date' => $row[6],
//                ]);
//
//
//        }
//        }
//    }

    public function collection(Collection $collection)
    {
        foreach($collection as $key => $data)
        {
            if($key != 0)
            {
                //dd($data[6]);


                 EmployeeAttendance::create([
                     'employee_id' => $data[0],
                     'present_or_absent' => $data[1],
                     'present_time' => date('H:i:s', strtotime($data[2])),
                     'late' => $data[3],
                     'late_time' => date('H:i:s', strtotime($data[4])),
                     'note' => $data[5],
                     'date' => date('Y-m-d', strtotime(str_replace('/','-',$data[6]))),
                ]);

            }
        }
    }

}

