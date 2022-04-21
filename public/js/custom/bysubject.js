var globel_gradecount = [];
var reasonChart;
$(function () {

    // change classroom
    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        console.log(class_id);
        if (class_id != "All") {
            $("#bysubjectfilter").find("#sectionID").empty();
            $("#bysubjectfilter").find("#sectionID").append('<option value="">Select Section</option>');

            $.post(sectionByClass, { class_id: class_id }, function (res) {
                if (res.code == 200) {
                    $("#section_drp_div").show();
                    $.each(res.data, function (key, val) {
                        $("#bysubjectfilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                    });
                }
            }, 'json');
        }
        else if (class_id == "All") {
            $("#bysubjectfilter").find("#examnames").empty();
            $("#bysubjectfilter").find("#examnames").append('<option value="">Select Exam</option>');
            $.post(Allexams, { token: token, branch_id: branchID }, function (res) {
                if (res.code == 200) {
                    $("#section_drp_div").hide();
                    $.each(res.data, function (key, val) {
                        $("#bysubjectfilter").find("#examnames").append('<option value="' + val.id + '">' + val.name + '</option>');
                    });
                }
            }, 'json');
        }

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
                    $("#bysubjectfilter").find("#examnames").append('<option value="' + val.id + '" data-full="' + marks.full + '" data-pass="' + marks.pass + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    $("#bysubjectfilter").validate({
        rules: {
            class_id: "required",
            //  section_id: "required",
            exam_id: "required"
        }
    });
    $('#bysubjectfilter').on('submit', function (e) {
        e.preventDefault();
        var byclass = $("#bysubjectfilter").valid();
        if (byclass === true) {
            globel_gradecount = [];

            var class_id = $("#changeClassName").val();
            var Selected_classname = $('#changeClassName :selected').text();
            var section_id = $("#sectionID").val();
            var exam_id = $("#examnames").val();
            if (class_id != "All") {
                var fmark = $('option:selected', '#examnames').attr('data-full');
                var pmark = $('option:selected', '#examnames').attr('data-pass');
                $("#fullmark").val(fmark);
                $("#passmark").val(pmark);
                console.log('enterd');
                // list mode
                $.get(getbySubject, { token: token, branch_id: branchID, exam_id: exam_id, class_id: class_id, section_id: section_id }, function (response) {
                    if (response.code == 200) {
                        if (response.code == 200) {
                            if (response.data.length > 0) {
                                var datasetnew = response.data;
                                bysubjectdetails_class(datasetnew);
                                console.log(globel_gradecount);

                                //byclass_chart(class_id, section_id, exam_id);
                                console.log('end');
                            } else {

                                toastr.info('No records are available');
                            }
                        } else {
                            toastr.error(data.message);
                        }
                    }
                });
            }
            else if (class_id == "All") {
                $.get(getbySubjectAllstd, { token: token, branch_id: branchID, exam_id: exam_id }, function (response) {

                    if (response.code == 200) {
                        console.log(response.data);
                        if (response.data.length > 0) {
                            var datasetnew = response.data;
                            bysubjectdetails_all(datasetnew);


                        } else {

                            toastr.info('No records are available');
                        }
                    } else {
                        toastr.error(data.message);
                    }

                });
            }

        };
    });


});

function bysubjectdetails_class(datasetnew) {

    $('#bysubjectTableAppend').empty();
    var passcount = 0;
    var failcount = 0;
    var pass_percentage = 0;
    var fail_percentage = 0;
    var sno = 0;
    //var attendance_pass_fail = [];
    var bysubjectAllTable = "";
    console.log(datasetnew);
    datasetnew.forEach(function (res) {
        var subname = res.subject_name;
        var techname = res.teacher_name;
        var grade_count_master = res.grad_count_master;
        globel_gradecount=res.grad_count_master;
        console.log(subname);
        var std_count = res.totalstudentcount;

        // std count and names
        std_count.forEach(function (tot) {
            //  console.log(tot.totalStudentCount);
            if (tot.totalStudentCount > 0) {
                var attendance_con = res.attendance_list;
                attendance_con.forEach(function (attCondition) {

                    if (attCondition.pass != null && attCondition.fail != null) {
                        sno++;
                        bysubjectAllTable += '<tr>' +
                            '<td class="text-center" rowspan="2">';
                        bysubjectAllTable += sno +
                            '</td>';
                        // console.log(tot.totalStudentCount);

                        bysubjectAllTable += '<td class="text-left" rowspan="2">' +
                            '<label for="clsname">' + tot.name + '</label>' +
                            '</td>';
                        bysubjectAllTable += '<td class="text-center" rowspan="2">' +
                            '<label for="stdcount"> ' + tot.section_name + '</label>' +
                            '</td>';
                        bysubjectAllTable += '<td class="text-center" rowspan="2">' +
                            '<label for="stdcount"> ' + subname + '</label>' +
                            '</td>';
                        bysubjectAllTable += '<td class="text-center" rowspan="2">' +
                            '<label for="stdcount"> ' + tot.totalStudentCount + '</label>' +
                            '</td>';
                        // Attendance present and absent column
                        var attendance_percentage = [];
                        var attendance_list = res.attendance_list;
                        attendance_list.forEach(function (att) {
                            bysubjectAllTable += '<td class="text-left">' +
                                '<label for="clsname">' + att.absent + '</label>' +
                                '</td>';
                            bysubjectAllTable += '<td class="text-center">' +
                                '<label for="stdcount"> ' + att.present + '</label>' +
                                '</td>';

                        });
                        bysubjectAllTable += '<td class="text-left" rowspan="2">' +
                            '<label for="clsname">' + techname + '</label>' +
                            '</td>';
                        // grade list count
                        var grade_count_list = res.grade_count_list;
                        var grade_list_count = grade_count_list.length;
                     //   globel_gradecount.push(res.grade_count_list);
                        console.log(grade_list_count);
                        var gradepercentage = [];
                        $('#tblbycls > thead  > tr >th').each(function (index, tr) {
                            var th = $('#tblbycls  thead  > tr >th').eq($(this).index());
                            var nineindex = grade_count_master;
                            var endgradeindex = (8 + nineindex);

                            if (index >= 8 && endgradeindex > index) {
                                var i = 0;
                                grade_count_list.forEach(function (res) {
                                    if (res.gname == th.text()) {
                                        i++;
                                        bysubjectAllTable += '<td class="text-right">' + res.gradecount + '</td>';

                                        //       console.log('matched' + i);
                                        // passcount += res.pass;
                                        // failcount += res.fail;
                                        var getval = res.gradecount / tot.totalStudentCount
                                        var gper = getval * 100;
                                        var gradeper = parseFloat(gper, 10).toFixed(2);
                                        gradepercentage.push(gradeper);
                                    }
                                });
                                if (i == 0) {
                                    bysubjectAllTable += '<td class="text-right">0</td>'
                                    gradepercentage.push(0);
                                }

                            }
                        });
                        //    console.log(attendance_pass_fail.length);
                        attendance_list.forEach(function (res) {
                            console.log(' test test');
                            console.log(res);
                            passcount = res.pass;
                            failcount = res.fail;
                            pass_percentage = (passcount / tot.totalStudentCount) * 100;
                            fail_percentage = (failcount / tot.totalStudentCount) * 100;
                            pass_percentage = parseFloat(pass_percentage, 10).toFixed(2);
                            fail_percentage = parseFloat(fail_percentage, 10).toFixed(2);
                            bysubjectAllTable += '<td class="text-center">' + passcount + '</td>' +
                                '<td class="text-center">' + failcount + '</td>' +
                                '<td class="text-center" rowspan="2">-</td>' +
                                '<td class="text-center" rowspan="2">' + pass_percentage + '</td>' +
                                '</tr>';

                            // }

                        });

                        bysubjectAllTable += '<tr>';

                        attendance_list.forEach(function (att_percentage) {
                            var absent_persentage = att_percentage.absent / tot.totalStudentCount
                            var ab_per = absent_persentage * 100;
                            var absent_per = parseFloat(ab_per, 10).toFixed(2);
                            //
                            var present_persentage = att_percentage.present / tot.totalStudentCount
                            var pre_per = present_persentage * 100;
                            var present_per = parseFloat(pre_per, 10).toFixed(2);
                            console.log(present_per);

                            bysubjectAllTable += '<td class="text-right">' + absent_per + '</td>' +
                                '<td class="text-right">' + present_per + '</td>';
                        });
                        gradepercentage.forEach(function (response) {

                            bysubjectAllTable += '<td class="text-right">' + response + '</td>'
                        });
                        bysubjectAllTable += '<td class="text-right">' + pass_percentage + '</td>' +
                            '<td class="text-right">' + fail_percentage + '</td>';
                        bysubjectAllTable += '</tr>';
                    }
                    else {
                        console.log('else print')
                    }
                });
            }
        });
    });

    $("#bysubjectTableAppend").append(bysubjectAllTable);
}
function bysubjectdetails_all(datasetnew) {

    $('#bysubjectTableAppend').empty();
    var passcount = 0;
    var failcount = 0;
    var pass_percentage = 0;
    var fail_percentage = 0;
    var sno = 0;
    //var attendance_pass_fail = [];
    var bysubjectAllTable = "";
    console.log(datasetnew);
    datasetnew.forEach(function (res) {
        var subname = res.subject_name;
        var techname = res.teacher_name;
        var grade_count_master = res.grad_count_master;
        console.log(subname);
        var std_count = res.totalstudentcount;

        // std count and names
        std_count.forEach(function (tot) {
            //  console.log(tot.totalStudentCount);
            if (tot.totalStudentCount > 0) {
                var attendance_con = res.attendance_list;
                attendance_con.forEach(function (attCondition) {

                    if (attCondition.pass != null && attCondition.fail != null) {
                        sno++;
                        bysubjectAllTable += '<tr>' +
                            '<td class="text-center" rowspan="2">';
                        bysubjectAllTable += sno +
                            '</td>';
                        // console.log(tot.totalStudentCount);

                        bysubjectAllTable += '<td class="text-left" rowspan="2">' +
                            '<label for="clsname">' + tot.name + '</label>' +
                            '</td>';
                        bysubjectAllTable += '<td class="text-center" rowspan="2">' +
                            '<label for="stdcount"> ' + tot.section_name + '</label>' +
                            '</td>';
                        bysubjectAllTable += '<td class="text-center" rowspan="2">' +
                            '<label for="stdcount"> ' + subname + '</label>' +
                            '</td>';
                        bysubjectAllTable += '<td class="text-center" rowspan="2">' +
                            '<label for="stdcount"> ' + tot.totalStudentCount + '</label>' +
                            '</td>';
                        // Attendance present and absent column
                        var attendance_percentage = [];
                        var attendance_list = res.attendance_list;
                        attendance_list.forEach(function (att) {
                            bysubjectAllTable += '<td class="text-left">' +
                                '<label for="clsname">' + att.absent + '</label>' +
                                '</td>';
                            bysubjectAllTable += '<td class="text-center">' +
                                '<label for="stdcount"> ' + att.present + '</label>' +
                                '</td>';

                        });
                        bysubjectAllTable += '<td class="text-left" rowspan="2">' +
                            '<label for="clsname">' + techname + '</label>' +
                            '</td>';
                        // grade list count
                        var grade_count_list = res.grade_count_list;
                        var grade_list_count = grade_count_list.length;
                        console.log(grade_list_count);
                        var gradepercentage = [];
                        $('#tblbycls > thead  > tr >th').each(function (index, tr) {
                            var th = $('#tblbycls  thead  > tr >th').eq($(this).index());
                            var nineindex = grade_count_master;
                            var endgradeindex = (8 + nineindex);

                            if (index >= 8 && endgradeindex > index) {
                                var i = 0;
                                grade_count_list.forEach(function (res) {
                                    if (res.gname == th.text()) {
                                        i++;
                                        bysubjectAllTable += '<td class="text-right">' + res.gradecount + '</td>';
                                        //       console.log('matched' + i);
                                        // passcount += res.pass;
                                        // failcount += res.fail;
                                        var getval = res.gradecount / tot.totalStudentCount
                                        var gper = getval * 100;
                                        var gradeper = parseFloat(gper, 10).toFixed(2);
                                        gradepercentage.push(gradeper);
                                    }
                                });
                                if (i == 0) {
                                    bysubjectAllTable += '<td class="text-right">0</td>'
                                    gradepercentage.push(0);
                                }

                            }
                        });
                        //    console.log(attendance_pass_fail.length);
                        attendance_list.forEach(function (res) {
                            passcount = res.pass;
                            failcount = res.fail;
                            pass_percentage = (passcount / tot.totalStudentCount) * 100;
                            fail_percentage = (failcount / tot.totalStudentCount) * 100;
                            pass_percentage = parseFloat(pass_percentage, 10).toFixed(2);
                            fail_percentage = parseFloat(fail_percentage, 10).toFixed(2);
                            bysubjectAllTable += '<td class="text-center">' + passcount + '</td>' +
                                '<td class="text-center">' + failcount + '</td>' +
                                '<td class="text-center" rowspan="2">-</td>' +
                                '<td class="text-center" rowspan="2">' + pass_percentage + '</td>' +
                                '</tr>';

                            // }

                        });

                        bysubjectAllTable += '<tr>';
                        attendance_list.forEach(function (att_percentage) {
                            var absent_persentage = att_percentage.absent / tot.totalStudentCount
                            var ab_per = absent_persentage * 100;
                            var absent_per = parseFloat(ab_per, 10).toFixed(2);
                            //
                            var present_persentage = att_percentage.present / tot.totalStudentCount
                            var pre_per = present_persentage * 100;
                            var present_per = parseFloat(pre_per, 10).toFixed(2);
                            console.log(present_per);

                            bysubjectAllTable += '<td class="text-right">' + absent_per + '</td>' +
                                '<td class="text-right">' + present_per + '</td>';
                        });
                        gradepercentage.forEach(function (response) {

                            bysubjectAllTable += '<td class="text-right">' + response + '</td>'
                        });
                        bysubjectAllTable += '<td class="text-right">' + pass_percentage + '</td>' +
                            '<td class="text-right">' + fail_percentage + '</td>';
                        bysubjectAllTable += '</tr>';
                    }
                    else {
                        console.log('else print')
                    }
                });
            }
        });
    });

    $("#bysubjectTableAppend").append(bysubjectAllTable);
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


