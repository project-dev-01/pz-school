var reasonChart;
$(function () {
    // change classroom
    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        $("#bysubjectfilter").find("#examnames").empty();
        $("#bysubjectfilter").find("#examnames").append('<option value="">Select Exams</option>');

        $("#bysubjectfilter").find("#sectionID").empty();

        $("#bysubjectfilter").find("#sectionID").append('<option value="">Select Section</option>');


        $.post(sectionByClass, { token: token, branch_id: branchID, class_id: class_id, teacher_id: teacher_id }, function (res) {
            if (res.code == 200) {
                $("#section_drp_div").show();
                $.each(res.data, function (key, val) {
                    $("#bysubjectfilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');

    });
    // change section
    $('#sectionID').on('change', function () {
        var section_id = $(this).val();
        var class_id = $("#changeClassName").val();
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '/' + mm + '/' + dd;
        $("#bysubjectfilter").find("#examnames").empty();
        $("#bysubjectfilter").find("#examnames").append('<option value="">Select exams</option>');
        $.post(examsByclassandsection, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            section_id: section_id,
            today: today
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#bysubjectfilter").find("#examnames").append('<option value="' + val.id + '" >' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    $("#bysubjectfilter").validate({
        rules: {
            class_id: "required",
            section_id: "required",
            examnames: "required"
        }
    });
    $('#bysubjectfilter').on('submit', function (e) {
        e.preventDefault();
        var byclass = $("#bysubjectfilter").valid();
        if (byclass === true) {
            $("#overlay").fadeIn(300);
            var class_id = $("#changeClassName").val();
            var section_id = $("#sectionID").val();
            var exam_id = $("#examnames").val();
            // list mode
            $.post(getbySubject, { token: token, branch_id: branchID, exam_id: exam_id, class_id: class_id, section_id: section_id }, function (response) {
                if (response.code == 200) {
                    if (response.data.grade_list_master.length > 0) {
                        var datasetnew = response.data;
                        bysubjectdetails_class(datasetnew);
                        $("#bysubject_body").show("slow");

                        $("#overlay").fadeOut(300);
                    } else {
                        $("#overlay").fadeOut(300);
                        toastr.info('No records are available');
                    }
                } else {
                    toastr.error(data.message);
                }

            });
        };
    });


    $(document).on('click', '.exportToExcel', function (e) {
        // var table = $(this).prev('.table2excel');
        var table = $('.table2excel');
        if (table && table.length) {
            var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
            $(table).table2excel({
                // exclude: ".noExl",
                name: "By Subject",
                filename: "by_subjects" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true,
                preserveColors: preserveColors
            });
        }
    });

});

function bysubjectdetails_class(datasetnew) {
    $('#bysubjectTableAppend').empty();
    var sno = 0;
    var bysubjectAllTable = "";
    var headers = datasetnew.headers;
    var grade_list_master = datasetnew.grade_list_master;
    bysubjectAllTable += '<div class="table-responsive">' +
        '<table id="tblbycls" class="table w-100 nowrap table-bordered table-striped table2excel" data-tableName="Test Table 1">' +
        '<thead>' +
        '<tr>' +
        '<th class="align-top" rowspan="2">S.no.</th>' +
        '<th class="align-top" rowspan="2">Standard</th>' +
        '<th class="align-top" rowspan="2">Class</th>' +
        '<th class="align-top" rowspan="2">Subject Name</th>' +
        '<th class="align-top th-sm - 6 rem" rowspan="2">Tot. Students</th>' +
        '<th class="align-top" rowspan="2">Absent</th>' +
        '<th class="align-top" rowspan="2">Present</th>' +
        '<th class="align-top" rowspan="2">Subject Teacher Name</th>';
    headers.forEach(function (resp) {
        bysubjectAllTable += '<th class="text-center">' + resp.grade + '</th>';
    });
    bysubjectAllTable += '<th class="align-middle" rowspan="2">PASS</th>' +
        '<th class="align-middle" rowspan="2">G</th>' +
        '<th class="align-middle" rowspan="2">Avg. grade of subject</th>' +
        '<th class="align-middle" rowspan="2">%</th>' +
        '</tr>';
    bysubjectAllTable += '<tr>';
    headers.forEach(function (resp) {
        bysubjectAllTable += '<td class="text-center">%</td>';
    });
    bysubjectAllTable += '</tr></thead><tbody>';
    grade_list_master.forEach(function (res) {
        sno++;
        bysubjectAllTable += '<tr>' +
            '<td class="text-center" rowspan="2">';
        bysubjectAllTable += sno +
            '</td>';
        bysubjectAllTable += '<td class="text-left" rowspan="2">' +
            '<label for="clsname">' + res.class_name + '</label>' +
            '</td>';
        bysubjectAllTable += '<td class="text-center" rowspan="2">' +
            '<label for="stdcount"> ' + res.section_name + '</label>' +
            '</td>';
        bysubjectAllTable += '<td class="text-left" rowspan="2">' +
            '<label for="clsname">' + res.subject_name + '</label>' +
            '</td>';
        bysubjectAllTable += '<td class="text-left" rowspan="2">' +
            '<label for="clsname">' + res.totalstudentcount + '</label>' +
            '</td>';
        bysubjectAllTable += '<td class="text-left">' +
            '<label for="clsname">' + res.absent_count + '</label>' +
            '</td>';
        bysubjectAllTable += '<td class="text-center">' +
            '<label for="stdcount">' + res.present_count + '</label>' +
            '</td>';
        bysubjectAllTable += '<td class="text-left" rowspan="2">' +
            '<label for="clsname">' + res.teacher_name + '</label>' +
            '</td>';
        headers.forEach(function (resp) {
            var obj = res.gradecnt;
            var exists = isKey(resp.grade, obj); // true
            if (exists) {
                Object.keys(obj).forEach(key => {
                    if (resp.grade == key) {
                        // bysubjectAllTable += '<td class="text-center">' + key, obj[key] + '</td>';
                        bysubjectAllTable += '<td class="text-center">' + obj[key] + '</td>';
                    }
                });
            } else {
                bysubjectAllTable += '<td class="text-center">0</td>';
            }
        });
        bysubjectAllTable += '<td class="text-center" rowspan="2">' + res.pass_count + '</td>' +
            '<td class="text-center" rowspan="2">' + res.fail_count + '</td>' +
            '<td class="text-center" rowspan="2">-</td>' +
            '<td class="text-center" rowspan="2">' + res.pass_percentage + '</td>';
        bysubjectAllTable += '</tr>';
        // show another row percentage
        bysubjectAllTable += '<tr>';
        var absentPer = (res.absent_count / res.totalstudentcount) * 100;
        absentPer = parseFloat(absentPer, 10).toFixed(2);
        var presentPer = (res.present_count / res.totalstudentcount) * 100;
        presentPer = parseFloat(presentPer, 10).toFixed(2);
        bysubjectAllTable += '<td class="text-left">' +
            '<label for="clsname">' + absentPer + '</label>' +
            '</td>';
        bysubjectAllTable += '<td class="text-center">' +
            '<label for="stdcount">' + presentPer + '</label>' +
            '</td>';
        headers.forEach(function (resp) {
            var obj = res.gradecnt;
            var exists = isKey(resp.grade, obj); // true
            if (exists) {
                Object.keys(obj).forEach(key => {
                    if (resp.grade == key) {
                        // bysubjectAllTable += '<td class="text-center">' + key, obj[key] + '</td>';
                        var gradepercentage = (obj[key] / res.totalstudentcount) * 100;
                        gradepercentage = parseFloat(gradepercentage, 10).toFixed(2);
                        bysubjectAllTable += '<td class="text-center">' + gradepercentage + '</td>';
                    }
                });
            } else {
                bysubjectAllTable += '<td class="text-center">0</td>';
            }
        });
        bysubjectAllTable += '</tr>';

    });

    bysubjectAllTable += '</tbody></table>' +
        '</div>';
    $("#bysubjectTableAppend").append(bysubjectAllTable);
}
// find matched
function isKey(key, obj) {
    var keys = Object.keys(obj).map(function (x) {
        return x;
    });
    return keys.indexOf(key) !== -1;
}
// studentDetails
function byclass_chart(class_id, section_id, exam_id) {

    $.post(getgradeBysubject, { token: token, branch_id: branchID, exam_id: exam_id, class_id: class_id, section_id: section_id }, function (response) {
        if (response.code == 200) {

            var late_details = response.data;
            var stdmarks_grade = late_details.getgradecount_nosubj_studmarks;
            var stdmarks_subjdiv_grade = late_details.getgradecount_nosubj_division;
            // var result= compatrearray(stdmarks_grade,stdmarks_subjdiv_grade);
            // var array1 = [["A+", 2], ["B1", 1], ["B2", 1], ["C1", 1], ["C2", 1],["D", 1],["E2", 1]];  
            // var array2 = [["A+", 1], ["C1", 3], ["E2", 1]];  
            var array1 = stdmarks_grade;
            var array2 = stdmarks_subjdiv_grade;
            var result =
                array1.concat(array2)
                    .reduce(function (ob, ar) {
                        if (!(ar[0] in ob.nums)) {
                            ob.nums[ar[0]] = ar
                            ob.result.push(ar)
                        } else {
                            ob.nums[ar[0]][1] += ar[1]
                        }
                        return ob
                    }, { nums: {}, result: [] }).result
                    .sort(function (a, b) {
                        return new Date(a[0]) - new Date(b[0]);
                    });
            var labels = [];
            var resonsCount = [];
            if (late_details.length > 0) {
                $.each(late_details[0], function (key, value) {

                    labels.push(key);
                    resonsCount.push(value);
                });
            }
            // chart
            renderChart(labels, resonsCount);

        } else {
            toastr.error(data.message);
        }
    });
}
function renderChart(labels, resonsCount) {
    if (reasonChart) {
        reasonChart.data.labels = labels;
        reasonChart.data.datasets[0].data = resonsCount;
        reasonChart.update();
    } else {
        var ctx = document.getElementById("radarcharttest-bystudentmarks").getContext('2d');
        var defaultColors = ["#1abc9c", "#f1556c", "#4a81d4", "#e3eaef"];
        var colors = dataColors ? dataColors.split(",") : defaultColors.concat();
        console.log('chart' + labels);
        reasonChart = new Chart(ctx, {
            type: 'radar',
            data: {
                // labels: ["Mathematics", "History", "Study of the Environment", "Geography", "Natural Sciences", "Civics Education", "Physical Education","English"],
                labels: labels,
                datasets: [{
                    label: "Reasons",
                    backgroundColor: hexToRGB(colors[0], 0.3),
                    borderColor: colors[0],
                    pointBackgroundColor: colors[0],
                    pointBorderColor: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: colors[0],
                    data: resonsCount
                }]
            },
        });


    }


}




