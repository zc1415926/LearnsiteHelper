@extends('layouts.default')
@section('content')

    <script>
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
            $("#class-button").text(Sclass + "班 ")
                    .append('<span class="am-icon-caret-down"></span>');

            $.ajax({
                type: "get",
                url: "http://10.1.44.111/api/students_gradeclass/" + Sgrade + "/" + Sclass,
                success: function(data){

                    $('#students-table-tbody tr').remove();

                    data.forEach(function(e){

                        $('#students-table-tbody').append('<tr><td>' + e["Snum"]
                                + '</td><td>' + e["Sname"]
                                + '</td><td>操作选项</td></tr>');
                    });
                },
                error: function(data){
                    console.log("get an error when request students");
                    console.log(data);
                }
            });
        }
    </script>

    <div class="about">
        <div class="am-g am-container">
            <div class="am-u-lg-12">
                <h2 class="about-title about-color">把上课调皮的学生记到这里来！</h2>

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
                    </div>
                </div>

                <div class="students">
                    <br>
                    <table class="am-table am-table-striped am-table-hover about-color">
                        <thead>
                        <tr><th>学号</th>
                            <th>姓名</th>
                            <th>创建时间</th>
                        </tr></thead>
                        <tbody id="students-table-tbody">

                        </tbody>
                    </table></div>
            </div>
        </div>
    </div>


@endsection