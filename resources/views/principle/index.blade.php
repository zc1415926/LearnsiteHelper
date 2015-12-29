@extends('layouts.default')
@section('content')

    <script>
       /// var currentGradeClassLearnsiteStudents;
        var currentGrade, currentClass;
        $(function() {
            var $grade_dropdown = $('#grade-dropdown'),
                    data = $grade_dropdown.data('amui.dropdown');

            $('#grade-ul').on('click', function(e){
                $grade_dropdown.dropdown('close')
            });

            var $class_dropdown = $('#class-dropdown'),
                    data = $class_dropdown.data('amui.dropdown');

            $('#class-ul').on('click', function(e){
                $class_dropdown.dropdown('close')
            });
        });

        getGradeClass();


        function getGradeClass()
        {
            $.ajax({
                type: "get",
                url: "http://10.1.44.111/api/grade",

                beforeSend: function(){

                },

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

        function onGradeDropdownClicked(Sgrade)
        {
            currentGrade = Sgrade;

            $("#grade-button").text(Sgrade + "年级 ")
                    .append('<span class="am-icon-caret-down"></span>');
            $("#class-button").text("请选择班级 ")
                    .append('<span class="am-icon-caret-down"></span>');

            $.ajax({
                type: "get",
                url: "http://10.1.44.111/api/class/" + Sgrade,
                success: function(data){

                    $("#class-ul li").remove();
                    data.forEach(function(e){
                        $("#class-ul").append(
                                '<li><a href="#" onclick="onClassDropdownClicked(' + Sgrade + ',' + e["Sclass"] + ')"> ' + e["Sclass"] + '班</a></li>'
                        );
                    });
                },
                error: function(data){
                    console.log("get an error when request gradeclassdata");
                    console.log(data);
                }
            });
        }

        function onClassDropdownClicked(Sgrade, Sclass)
        {
            currentClass = Sclass;

            $("#class-button").text(Sclass + "班 ")
                    .append('<span class="am-icon-caret-down"></span>');

            $.ajax({
                type: "get",
                url: "http://10.1.44.111/api/students_gradeclass/" + Sgrade + "/" + Sclass,
                success: function(data){

                    //currentGradeClassLearnsiteStudents = data;
                    $('#students-table-tbody tr').remove();

                    data.forEach(function(e){

                        $('#students-table-tbody').append('<tr><td>' + e["Snum"]
                                + '</td><td>' + e["Sname"]
                                + '</td></tr>');
                    });
                },
                error: function(data){
                    console.log("get an error when request students");
                    console.log(data);
                }
            });

            $.ajax({
                type: "get",
                url: "http://10.1.44.112/students_gradeclass/" + Sgrade + "/" + Sclass,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){


                    if(0 == data.length)
                    {
                        $('#no-local-students-note').append('<h3 class="about-title about-color">空空如也</h3>');
                    }
                    //$('#students-table-tbody tr').remove();

                    /*data.forEach(function(e){

                        $('#students-table-tbody').append('<tr><td>' + e["Snum"]
                                + '</td><td>' + e["Sname"]
                                + '</td></tr>');
                    });*/
                },
                error: function(data){
                    console.log("get an error when request students");
                    console.log(data);
                }
            });
        }

        function onSyncFromLearnsiteWholeClassClicked()
        {
            $.ajax({
                type: "put",
                url: "http://10.1.44.112/sync_students",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                //datatype: "json",
                data: {'Sgrade': currentGrade, 'Sclass': currentClass},
                success: function(data){
                    console.log("sync");
                    document.write(data);
                },
                error: function(data){
                    console.log("get an error when sync students");
                    console.log(data);
                }
            });
        }
    </script>

    <div class="about">
        <div class="am-g am-container">
            <div class="am-u-lg-12">
                <h1 class="about-title about-color">把上课调皮的学生记到这里来！</h1>

                <div class="am-g">
                    <div class="am-u-lg-12">
                        <div class="am-dropdown" data-am-dropdown id="grade-dropdown">
                            <button id="grade-button" class="am-btn am-btn-primary am-dropdown-toggle" data-am-dropdown-toggle>请选择年级 <span class="am-icon-caret-down"></span></button>
                            <ul id="grade-ul" class="am-dropdown-content">

                            </ul>
                        </div>

                        <div class="am-dropdown" data-am-dropdown id="class-dropdown">
                            <button id="class-button" class="am-btn am-btn-primary am-dropdown-toggle" data-am-dropdown-toggle>请选择班级 <span class="am-icon-caret-down"></span></button>
                            <ul id="class-ul" class="am-dropdown-content">

                            </ul>
                        </div>

                        <div class="am-dropdown" >
                            <form class="am-form">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <button id="sync-from-learnsite-whole-class" type="button" class="am-btn am-btn-primary"
                                    onclick="onSyncFromLearnsiteWholeClassClicked()">从学生网同步本班学生数据</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="am-u-md-6">

                    <table class="am-table am-table-striped am-table-hover about-color ">
                        <thead>
                        <tr><th>学号</th><th>姓名</th>
                        </tr></thead>
                        <tbody id="students-table-tbody">

                        </tbody>
                    </table>

                </div>
                <div class="am-u-md-6">
                    <table class="am-table am-table-striped am-table-hover about-color">
                        <thead>
                        <tr>
                            <th>学号</th><th>姓名</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <div id="no-local-students-note" ></div>
                </div>
            </div>

            <div id="students-sync-descritpion"><h1 class="about-title about-color">请选择年级、班级</h1></div>
        </div>
    </div>


@endsection