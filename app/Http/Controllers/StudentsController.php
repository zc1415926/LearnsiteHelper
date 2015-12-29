<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class StudentsController extends Controller
{
    public function students_gradeclass($grade,$class)
    {

        $students = DB::table('students_info')->select('Sid', 'Sname')
            ->where('Sgrade', '=', $grade)->where('Sclass', '=', $class)->get();

        $studentsArray = array();

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

        dd($grade . " ". $class);
    }
}
