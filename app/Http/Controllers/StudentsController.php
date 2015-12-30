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
            array_push($studentsArray, ['Snum' => $value->Sid, 'Sname' => $value->Sname]);
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
            if(count(StudentsInfo::where('Sid', $student['Snum'])->get()) == 0)
            {
                StudentsInfo::create([
                    'Sid' => $student['Snum'],
                    'Sgrade' => $grade,
                    'Sclass' => $class,
                    'Sname' => $student['Sname'],
                ]);
            }
        }

        return "sync";
    }

    public static function getStudentsByGradeClass($grade,$class){


    }
}
