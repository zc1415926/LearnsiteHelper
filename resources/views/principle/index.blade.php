@extends('layouts.default')
@section('content')
    <h1>把上课调皮的学生记到这里来！</h1>

    <script>

       getGradeClass();


        function getGradeClass()
        {
            $.ajax({
                type: "get",
                url: "http://10.1.44.111/api/grade",
                success: function(data){
                    data.forEach(function(e){

                        $("#grade-ul").append(
                                '<li><a href="#" onclick="onGradeDropdownClicked(' + e["Sgrade"] + ')">'
                                + e["Sgrade"]
                                + '年级</a></li>'
                        );
                    });
                },
                error: function(data){
                    console.log("get an error when request gradeclassdata");
                    console.log(data);
                }
            });
        }

        function onGradeDropdownClicked(grade)
        {
            console.log(grade+"年级");
            $.ajax({
                type: "get",
                url: "http://10.1.44.111/api/class/" + grade,
                success: function(data){

                    $("#class-ul li").remove();
                    data.forEach(function(e){
                        console.log(e["Sclass"]);
                        $("#class-ul").append(
                                '<li><a href="#"> ' + e["Sclass"] + '班</a></li>'
                        );
                    });
                },
                error: function(data){
                    console.log("get an error when request gradeclassdata");
                    console.log(data);
                }
            });
        }
    </script>

    <div class="uk-button-dropdown" data-uk-dropdown="">
        <button class="uk-button"> 请选择年级 <i class="uk-icon-caret-down"></i></button>
        <div class="uk-dropdown">
            <ul id="grade-ul" class="uk-nav uk-nav-dropdown">

            </ul>
        </div>
    </div>

    <div class="uk-button-dropdown" data-uk-dropdown="">
        <button class="uk-button"> 请选择班级 <i class="uk-icon-caret-down"></i></button>
        <div class="uk-dropdown">
            <ul id="class-ul" class="uk-nav uk-nav-dropdown">

            </ul>
        </div>
    </div>


@endsection