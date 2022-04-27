var globel_gradecount = [];
var reasonChart;
$(function () {
    $('#exam_details_div').hide();

    // change classroom
    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        console.log(class_id);

        $("#byexamfilter").find("#sectionID").empty();
        $("#byexamfilter").find("#sectionID").append('<option value="">Select Section</option>');

        $.post(sectionByClass, { class_id: class_id }, function (res) {
            if (res.code == 200) {
                $("#section_drp_div").show();
                $.each(res.data, function (key, val) {
                    $("#byexamfilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
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
        $("#byexamfilter").find("#examnames").empty();
        $("#byexamfilter").find("#examnames").append('<option value="">Select exams</option>');
        $.get(examsByclassandsection, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            section_id: section_id,
            today: today
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    var marks = JSON.parse(val.marks);
                    $("#byexamfilter").find("#examnames").append('<option value="' + val.id + '" data-full="' + marks.full + '" data-pass="' + marks.pass + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    $("#byexamfilter").validate({
        rules: {
            class_id: "required",
            section_id: "required",
            exam_id: "required",
            registerno: "required"
        }
    });
    $('#byexamfilter').on('submit', function (e) {
        e.preventDefault();
        var byresult = $("#byexamfilter").valid();
        if (byresult === true) {
            $('#exam_details_div').show();
            globel_gradecount = [];

            var class_id = $("#changeClassName").val();
            var class_name = $('#changeClassName :selected').text();
            var section_name = $('#sectionID :selected').text();
            var section_id = $("#sectionID").val();
            var exam_id = $("#examnames").val();
            var registerno = $("#registerno").val();
            console.log(class_name);
            // list mode            
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('exam_id', exam_id);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('registerno', registerno);

            $.ajax({
                url: getbyresult,
                method: "POST",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    if (response.code == 200) {

                        var datasetnew = response.data;
                        console.log(datasetnew);
                        examresult_details(datasetnew, registerno, class_name, section_name);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });



        };
    });


});
function examresult_details(datasetnew, registerno, class_name, section_name) {


    // table 1 start 
    $('#tbl_general_details_header').empty();
    var sno = 0;
    var examresult_generalTable = "";
    // table 1 check null
    var student_id = datasetnew[2].student_general_details;
    console.log(student_id);
    var checknull_student_id = student_id.id;

    // table 2 check null
    var marks_count = datasetnew[0].student_marks_details;
    var checknull_student_marks = marks_count[0].grade;
    // table 3 check null
    var subdivision_count = datasetnew[1].student_marks_subdivision_details;
    var checknull_division = subdivision_count[0].subjectdivision_scores;

    var tblgeneral_details = datasetnew[2].student_general_details;
    console.log(checknull_student_marks , checknull_division);

    if (checknull_student_marks || checknull_division) {
        datasetnew.forEach(function (res) {

            sno++;
            if (sno === 1) {
                console.log(sno);
                //tblgeneral_details.forEach(function (tbl_gen) {
                    examresult_generalTable += '<tr>' +
                        '<th>Roll No</th>' +
                        '<td>' + registerno + '</td>' +
                        '</tr>';
                    examresult_generalTable += '<tr>' +
                        '<th>Name</th>' +
                        '<td>' + tblgeneral_details.first_name + '</td>' +
                        '</tr>';
                    examresult_generalTable += '<tr>' +
                        '<th>DOB</th>' +
                        '<td>' + tblgeneral_details.birthday + '</td>' +
                        '</tr>';
                    examresult_generalTable += '<tr>' +
                        '<th>Standard</th>' +
                        '<td>' + class_name + '</td>' +
                        '</tr>';
                    examresult_generalTable += '<tr>' +
                        '<th>Class Name</th>' +
                        '<td>' + section_name + '</td>' +
                        '</tr>';

               // });
                $("#tbl_general_details_header").append(examresult_generalTable);
            }
        });
        // table 2 start

        $('#tbl_std_subject_marks_header').empty();
        $('#tbl_std_subject_marks_body').empty();
        var sno_tbl1 = 0;
        var sno_bdy = 0;
        var sno_bdy_main = 0;
        var subject_name_header = "";
        var resultscore = "";
        console.log(datasetnew);
        // header start 
        datasetnew.forEach(function (res) {
            sno_tbl1++;
            if (sno_tbl1 === 1) {
                subject_name_header += '<tr>' +
                    '<th class="align-middle">S.no.</th>' +
                    '<th class="align-middle">Student Name</th>';
                var subject_headers = res.student_marks_details;
                if (subject_headers.length > 0) {
                    console.log(subject_headers);
                    var split_subnam = subject_headers[0].subject_names;
                    console.log(split_subnam);
                    let subject_names = split_subnam.split(',');
                    console.log(subject_names);
                    subject_names.forEach(function (sub_name) {
                        subject_name_header += '<th class="text-center" data-id="' + sub_name + '">' + sub_name + '</th>';
                    });
                    subject_name_header += '<th class="align-middle">Total Grade point</th>';
                }
            }
        });
        subject_name_header += '</tr>';
        $('#tbl_std_subject_marks_header').append(subject_name_header);

        // body tag start 
        datasetnew.forEach(function (response) {
            //console.log(response);
            sno_bdy++;
            if (sno_bdy == 1) {
                var subject_marks_others = response.student_marks_details;
                console.log(subject_marks_others);
                resultscore += '<tr>' +
                    '<td class="align-middle">' + sno_bdy + '</td>' +
                    '<td class="align-middle">' + subject_marks_others[0].first_name + '</td>';
                var subject_grade = subject_marks_others[0].grade;
                if (subject_grade.length > 0) {
                    console.log(subject_grade);
                    var split_subnam = subject_grade;
                    console.log(split_subnam);
                    let grade = split_subnam.split(',');
                    console.log(grade);
                    grade.forEach(function (sub_grade) {
                        resultscore += '<td class="text-center">' + sub_grade + '</td>';
                    });
                    resultscore += '<td class="align-middle">' + subject_marks_others[0].gradepoint + '</td>';
                }
            }
        });
        $("#tbl_std_subject_marks_body").append(resultscore);



        // table 3 start
        if (checknull_division) {
            console.log(checknull_division);
            $('#tbl_std_subject_marks_division').show();
            $('#tbl_std_subject_marks_division_header').empty();
            $('#tbl_std_subject_marks_division_body').empty();
            var sno_tbl2 = 0;
            var sno_bdy = 0;
            var sno_bdy_main = 0;
            var subject_division_name_header = "";
            var resultscore_division = "";
            console.log(datasetnew);
            // header start 
            datasetnew.forEach(function (res) {
                sno_tbl2++;
                if (sno_tbl2 === 2) {
                    subject_division_name_header += '<tr>' +
                        '<th class="align-middle">S.no.</th>' +
                        '<th class="align-middle">Student Name</th>';
                    console.log(res);
                    var subject_headers = res.student_marks_subdivision_details;
                    if (subject_headers.length > 0) {
                        console.log(subject_headers);
                        var split_subnam = subject_headers[0].subject_division;
                        console.log(split_subnam);
                        let subject_names = split_subnam.split(',');
                        console.log(subject_names);
                        subject_names.forEach(function (sub_name) {
                            subject_division_name_header += '<th class="text-center">' + sub_name + '</th>';
                        });
                        // division master name 
                        var split_subnam = subject_headers[0].subject_names_division;
                        console.log(split_subnam);
                        let subject_names_ms = split_subnam.split(',');
                        console.log(subject_names);
                        subject_names_ms.forEach(function (sub_name) {
                            subject_division_name_header += '<th class="text-center">Subject division (' + sub_name + ' )</th>';
                        });
                        //  subject_division_name_header += '<th class="align-middle">Total Marks</th>';
                    }
                }
            });
            subject_name_header += '</tr>';
            $('#tbl_std_subject_marks_division_header').append(subject_division_name_header);

            // body tag start 
            datasetnew.forEach(function (response) {
                //console.log(response);
                sno_bdy++;
                if (sno_bdy == 2) {
                    var subject_marks_others = response.student_marks_subdivision_details;
                    console.log(subject_marks_others);
                    resultscore_division += '<tr>' +
                        '<td class="align-middle">1</td>' +
                        '<td class="align-middle">' + subject_marks_others[0].first_name + '</td>';
                    var subject_grade = subject_marks_others[0].subjectdivision_scores;
                    console.log(subject_grade);
                    if (subject_grade.length > 0) {
                        console.log(subject_grade);
                        var split_subnam = subject_grade;
                        console.log(split_subnam);
                        let marks = split_subnam.split(',');
                        console.log(marks);
                        marks.forEach(function (sub_marks) {
                            resultscore_division += '<td class="text-center">' + sub_marks + '</td>';
                        });
                        resultscore_division += '<td class="align-middle">' + subject_marks_others[0].total_score_division + '</td>';
                    }
                }
            });
            $("#tbl_std_subject_marks_division_body").append(resultscore_division);
        }
        else {
            $('#tbl_std_subject_marks_division').hide();
        }
    }
    else{
        $("#tbl_general_details").empty();
        $("#tbl_std_subject_marks").empty();
        $("#tbl_std_subject_marks_division").empty();
    }


}
// studentDetails
function byclass_chart(class_id, section_id, exam_id) {

    $.post(getgradeBysubject, { token: token, branch_id: branchID, exam_id: exam_id, class_id: class_id, section_id: section_id }, function (response) {
        if (response.code == 200) {
            console.log('res');
            console.log(response.data);

            var late_details = response.data;
            var stdmarks_grade = late_details.getgradecount_nosubj_studmarks;
            var stdmarks_subjdiv_grade = late_details.getgradecount_nosubj_division;
            // var result= compatrearray(stdmarks_grade,stdmarks_subjdiv_grade);
            console.log(stdmarks_grade);
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
            console.log(result);


            //     compare_gradecount=[];
            // $('#tblbycls > thead  > tr >th').each(function (index, tr) {
            //     var th = $('#tblbycls  thead  > tr >th').eq($(this).index());
            //     var nineindex = globel_gradecount;
            //     var endgradeindex = (8 + nineindex);

            //     if (index >= 8 && endgradeindex > index) {
            //         var i = 0;
            //         console.log(th.text()+"aa");
            //         stdmarks_grade.forEach(function (res) {
            //             if (res.gname == th.text()) {
            //                 i++;
            //                     stdmarks_subjdiv_grade.forEach(function (subjdiv) {
            //                     if(res.gname==subjdiv.gname)
            //                     {
            //                         var gradename;
            //                         var gradecount=0;
            //                         gradecount =res.gradecount + subjdiv.gradecount;
            //                         compare_gradecount.push(res.gname,gradecount);
            //                     }
            //                     else{
            //                         compare_gradecount.push(res.gname,res.gradecount);
            //                     }
            //                 });

            //             }
            //         });

            //         if (i == 0) {

            //         }
            //         console.log(compare_gradecount);

            //     }
            // });

            var labels = [];
            var resonsCount = [];
            if (late_details.length > 0) {
                $.each(late_details[0], function (key, value) {

                    labels.push(key);
                    resonsCount.push(value);
                });
            }
            console.log(labels, resonsCount);
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


