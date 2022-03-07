$(function () {

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

     // rules validation
     $("#addHomeworkForm").validate({
        rules: {
            class_id: "required",
            section_id: "required",
            subject_id: "required",
            date_of_homework: "required",
            date_of_submission: "required",
            description: "required",
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
        console.log('sd',123)
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
                        console.log('data',200)
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


    $("#class_id").on('change', function (e) {
        e.preventDefault();
        var class_id = $(this).val();
        $("#section_id").empty();
        $("#section_id").append('<option value="">Select Class Name</option>');
        $.post(sectionByClass, { class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#section_id").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
        $.post(subjectByClass, { class_id: class_id }, function (res) {
            console.log('data',res)
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#subject_id").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });
});


$('.firstModal').on('shown.bs.modal', function (event) {

    Apex.grid = {
        padding: {
            right: 0,
            left: 0
        }
    }, Apex.dataLabels = {
        enabled: !1
    };
    var randomizeArray = function (e) {
        for (var o, t, a = e.slice(), r = a.length; 0 !== r;) t = Math.floor(Math.random() * r), o = a[--r], a[r] = a[t], a[t] = o;
        return a
    },
        sparklineData = [47, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46],
        colorPalette = ["#00D8B6", "#008FFB", "#FEB019", "#FF4560", "#775DD0"],

        colors = ["#00b19d", "#f1556c"];
    (dataColors = $("#homework-status").data("colors")) && (colors = dataColors.split(","));
    options = {
        chart: {
            height: 320,
            type: "donut"
        },
        series: [1, 2],
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
        labels: [ "Complete", "Incomplete"],
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
    (chart = new ApexCharts(document.querySelector("#homework-status"), options)).render();
    // checked and unchecked
    colors = ["#FEB019", "#775DD0"];
    (dataColors = $("#homework-checked-status").data("colors")) && (colors = dataColors.split(","));
    options = {
        chart: {
            height: 320,
            type: "donut"
        },
        series: [2, 1],
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
        labels: [ "Checked", "Unchecked"],
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
    (chart = new ApexCharts(document.querySelector("#homework-checked-status"), options)).render();


}).on('hidden.bs.modal', function (event) {

});

