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

        function onGradeDropdownClicked(grade)
        {
            $("#grade-button").text(grade + "年级 ")
                    .append('<span class="am-icon-caret-down"></span>');
            $("#class-button").text("请选择班级 ")
                    .append('<span class="am-icon-caret-down"></span>');

            $.ajax({
                type: "get",
                url: "http://10.1.44.111/api/class/" + grade,
                success: function(data){

                    $("#class-ul li").remove();
                    data.forEach(function(e){
                        $("#class-ul").append(
                                '<li><a href="#" onclick="onClassDropdownClicked(' + e["Sclass"] + ')"> ' + e["Sclass"] + '班</a></li>'
                        );
                    });
                },
                error: function(data){
                    console.log("get an error when request gradeclassdata");
                    console.log(data);
                }
            });
        }

        function onClassDropdownClicked(Sclass)
        {
            $("#class-button").text(Sclass + "班 ")
                    .append('<span class="am-icon-caret-down"></span>');
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

                    <div class="am-u-lg-6 am-u-md-4 am-u-sm-12">
                        <form class="am-form">
                            <label for="name" class="about-color">你的姓名</label>
                            <input id="name" type="text">
                            <br>
                            <label for="email" class="about-color">你的邮箱</label>
                            <input id="email" type="email">
                            <br>
                            <label for="message" class="about-color">你的留言</label>
                            <textarea id="message"></textarea>
                            <br>
                            <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="am-icon-check"></i> 提 交</button>
                        </form>
                        <hr class="am-article-divider am-show-sm-only">
                    </div>

                    <div class="am-u-lg-6 am-u-md-8 am-u-sm-12">
                        <h4 class="about-color">关于我们</h4>

                        <p>AllMobilize Inc (美通云动科技有限公司)
                            由前微软美国总部IE浏览器核心研发团队成员及移动互联网行业专家在美国西雅图创立，旨在解决网页在不同移动设备屏幕上的适配问题。基于国际专利技术并结合最前沿的HTML5技术，云适配解决方案可以帮助企业快速将桌面版网站适配到各种移动设备终端的屏幕上，不仅显著地提高了企业网站的用户体验以及销售转化率，而且大幅度地节省了企业开发和维护移动网站的费用。</p>
                        <h4 class="about-color">团队介绍</h4>

                        <p>AllMobilize Inc 获得了微软创投孵化器的支持，其领先科技已得到全球多家企业及机构的认可与信赖，客户包括全球500强企业、美国政府、国内政府机关、国内外上市公司、以及互联网标准化组织W3C。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection