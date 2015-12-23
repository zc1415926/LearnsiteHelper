@extends('layouts.default')
@section('content')
    <h1>把上课调皮的学生记到这里来！</h1>

    <script>
        getGradeClass();
        var gradeClassData;
        function getGradeClass()
        {
            $.get('http://10.1.44.111/api/gradeclass', function(data, status){

                gradeClassData = JSON.stringify(data);

                console.log("Status: " + status);
                console.log("\nData:\n" +　gradeClassData);
            })
           // console.log($.toJSON(jsonData));
            gradeClassData.forEach(function(e){
                console.log(e);
            })



        }
    </script>
@endsection