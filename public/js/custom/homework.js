
$(function () {

    $(".homeWorkAdd").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
    });

    $("#evaluationFilterForm").validate({
        rules: {
            class_id:"required",
            section_id:"required",
            subject_id:"required"
        }
    });
    // get timetable
    $('#evaluationFilterForm').on('submit', function (e) {
        e.preventDefault();
        var filterCheck = $("#evaluationFilterForm").valid();
        if (filterCheck === true) {
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    console.log('cs',data)
                    if (data.code == 200) {
                        $("#evaluation").show("slow");
                        $("#homework_table").html(data.table);
                    } else {
                        $("#evaluation").hide("slow");
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    $('#homework_file').change(function() {
        // var i = $(this).prev('label').clone();
        var file = $('#homework_file')[0].files[0];
        // var size = $('#homework_file')[0].files[0].size;
        if(file.size > 2097152) {
            $('#file_name').text("File greater than 2Mb");
            $("#file_name").addClass("error");
            $('#homework_file').val('');
        } else {
            $("#file_name").removeClass("error");
            $('#file_name').text(file.name);
        }
    });

    // $(document).on('change', '.student_homework_file', function () {
    //     // var i = $(this).prev('label').clone();
    //     var file = $(this)[0].files[0];
    //     // var size = $('#homework_file')[0].files[0].size;
    //     if(file.size > 2097152) {
    //         $(this).parent().text("File greater than 2Mb");
    //         $(this).parent().addClass("error");
    //         $('#homework_file').val('');
    //     } else {
    //         $(this).parent().removeClass("error");
    //         $(this).parent().text(file.name);
    //     }
    // });

    
    $(document).on('change', '.homework_file', function () {
        console.log(12343333)
        var file = $(this)[0].files[0];
        if(file.size > 2097152) {
            toastr.error("File greater than 2Mb");
            $(this).val('');
        }
    });
    
    $('#studentHomeworkFilter').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (data) {
                console.log('cs',data)
                if (data.code == 200) {
                    $("#homeworks").show("slow");
                    if(data.subject!="All")
                    {
                        var sub = homework_list_lang+' ('+data.subject+')';
                        
                    }else{
                        var sub = homework_list_lang+' ('+all_subject_lang+')';
                    }
                    $("#title").html(sub);
                    $("#homework_list").html(data.list);
                } else {
                    $("#homeworks").hide("slow");
                    toastr.error(data.message);
                }
            }
        });
    });

    

    // evaluate Homework
    $('#evaluateHomework').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (data) {
                    console.log('data',data)
                if (data.code == 200) {
                    $('.firstModal').modal('hide');
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }
            }
        });
    });

     // rules validation
     $("#addHomeworkForm").validate({
        rules: {
            title: "required",
            class_id: "required",
            section_id: "required",
            subject_id: "required",
            date_of_homework: "required",
            date_of_submission: "required",
            description: "required",
            file: "required",
            schedule_date: {
                required: {
                    publish_later: true
                }
            },
        }
    });

    // add Homework
    $('#addHomeworkForm').on('submit', function (e) {
        e.preventDefault();
        var homeworkCheck = $("#addHomeworkForm").valid();
        if (homeworkCheck === true) {
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                        // console.log('data',200)
                    if (data.code == 200) {
                        $('.addHomeworkForm').find('form')[0].reset();
                        toastr.success(data.message);
                        window.location.href = homeworkList;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // publish later
    $("#publish_later").on("change", function () {
        // alert($(this).is(":checked"));
        if ($(this).is(":checked")) {
            $("#schedule").show("slow");
        } else {
            $("#schedule").hide("slow");
        }
    });
    function formvalidate(formid){
        $("#"+formid).validate({
            rules: {
                file: "required",
                remarks: "required",
            }
        });
    }
    

    $(document).on('submit','.submitHomeworkForm', function (e) {
        e.preventDefault();
        var formid = $(this).attr("id")
        formvalidate(formid)
        var homeWork = $("#"+formid).valid();
        if (homeWork === true) {
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                        console.log('data',200)
                    if (data.code == 200) {
                        toastr.success(data.message);
                        window.location.href = homeworkList;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });


    $("#class_id").on('change', function (e) {
        e.preventDefault();
        var class_id = $(this).val();
        
        $("#section_id").empty();
        $("#section_id").append('<option value="">'+select_class+'</option>');
        
        $("#subject_id").empty();
        $("#subject_id").append('<option value="">'+select_subject+'</option>');
        $.post(sectionByClass, { class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });

    $("#section_id").on('change', function (e) {
        e.preventDefault();
        var section_id = $(this).val();
        var class_id = $("#class_id").val();
        
        $("#subject_id").empty();
        $("#subject_id").append('<option value="">'+select_subject+'</option>');
        $.post(subjectByClass, { class_id: class_id, section_id: section_id }, function (res) {
            console.log('data',res)
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#subject_id").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                });
            }
        }, 'json');
    });

    
    $('#evaluation_check').on('change', function (e) {
        e.preventDefault();
        var homework_id = $("#homework_id").val();
        var evaluation = $("#evaluation_check").val();

        var formData = new FormData(); 
        formData.append('homework_id', homework_id);
        formData.append('evaluation', evaluation);
        $.ajax({
            url: homeworkView,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (res) {
                console.log('cs',res)
                if (res.code == 200) {
                    $("#homework_modal_table").html(res.table);
                    var complete = res.complete;
                    var incomplete = res.incomplete;
                    var checked = res.checked;
                    var unchecked = res.unchecked;
    
                    callchart(complete,incomplete,checked,unchecked);
                    homeworkchart.updateSeries([complete,incomplete]);
                    homeworkevaluationchart.updateSeries([checked,unchecked]);
                    
                }
            }
        });
    });

    $('.firstModal').on('shown.bs.modal', e => {
        var $button = $(e.relatedTarget);
        var homework_id = $button.attr('data-homework_id');
        var semester_id = $("#semester_id").val();
        var session_id = $("#session_id").val();
        $("#homework_id").val(homework_id);
        $.post(homeworkView, { homework_id: homework_id,semester_id: semester_id,session_id: session_id }, function (res) {
            if (res.code == 200) {
                $("#homework_modal_table").html(res.table);
                var complete = res.complete;
                var incomplete = res.incomplete;
                var checked = res.checked;
                var unchecked = res.unchecked;

                callchart(complete,incomplete,checked,unchecked);
                homeworkchart.updateSeries([complete,incomplete]);
                homeworkevaluationchart.updateSeries([checked,unchecked]);
                
            }
        }, 'json');
    }).on('hidden.bs.modal', function (event) {

    });


    function callchart(complete,incomplete,checked,unchecked){

        colors = ["#00b19d", "#f1556c"];
        (dataColors = $("#homework-status").data("colors")) && (colors = dataColors.split(","));
        options = {
            chart: {
                height: 320,
                type: "donut"
            },
            series: [complete,incomplete],
            legend: {
                show: !0,
                position: "bottom",
                horizontalAlign: "center",
                verticalAlign: "middle",
                floating: !1,
                fontSize: "14px",
                offsetX: 0,
                offsetY: 7
            },
            labels: [ complete_lang,incomplete_lang],
            colors: colors,
            responsive: [{
                breakpoint: 600,
                options: {
                    chart: {
                        height: 240
                    },
                    legend: {
                        show: !1
                    }
                }
            }],
            fill: {
                type: "gradient"
            }
        };
        
        homeworkchart = new ApexCharts(document.querySelector("#homework-status"), options);
        homeworkchart.render();

        colors = ["#775DD0", "#FEB019"];
        (dataColors = $("#homework-checked-status").data("colors")) && (colors = dataColors.split(","));
        options = {
            chart: {
                height: 320,
                type: "donut"
            },
            series: [checked,unchecked],
            legend: {
                show: !0,
                position: "bottom",
                horizontalAlign: "center",
                verticalAlign: "middle",
                floating: !1,
                fontSize: "14px",
                offsetX: 0,
                offsetY: 7
            },
            labels: [ checked_lang, unchecked_lang],
            colors: colors,
            responsive: [{
                breakpoint: 600,
                options: {
                    chart: {
                        height: 240
                    },
                    legend: {
                        show: !1
                    }
                }
            }],
            fill: {
                type: "gradient"
            }
        };
        homeworkevaluationchart = new ApexCharts(document.querySelector("#homework-checked-status"), options);
        homeworkevaluationchart.render();
        
    }
});

