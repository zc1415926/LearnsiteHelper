<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

use App\StudentsInfo;

class StudentsController extends Controller
{
    public function students_gradeclass($grade,$class)
    {
        $studentsArray = array();

        $students = DB::table('students_info')->select('Sid', 'Sname')
            ->where('Sgrade', '=', $grade)->where('Sclass', '=', $class)->get();

        foreach($students as $value)
        {
            array_push($studentsArray, ["Snum" => $value->Snum, "Sname" => iconv('GBK','UTF-8', $value->Sname)]);
        }

        return response()->json($studentsArray);
    }

    public function sync_students(Request $request)
    {
        $grade = $request['Sgrade'];
        $class = $request['Sclass'];
        $students = $request['Sstudents'];

        foreach($students as $student)
        {
            $students = StudentsInfo::create([
                'Sid' => $student['Snum'],
                'Sgrade' => $grade,
                'Sclass' => $class,
                'Sname' => $student['Sname'],
            ]);


        }

        return "sync";
    }

    public static function getStudentsByGradeClass($grade,$class){


    }
}
