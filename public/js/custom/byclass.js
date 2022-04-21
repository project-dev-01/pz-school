$(function () {

    // change classroom
    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        console.log(class_id);
        if (class_id != "All") {
            $("#byclassfilter").find("#sectionID").empty();
            $("#byclassfilter").find("#sectionID").append('<option value="">Select Subject</option>');

            $.post(getbySubjectnames, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
                if (res.code == 200) {
                    $("#section_drp_div").show();
                    $.each(res.data, function (key, val) {
                        $("#byclassfilter").find("#sectionID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                    });
                }
            }, 'json');
        }
        else if (class_id == "All") {
            $("#byclassfilter").find("#sectionID").empty();
            $("#byclassfilter").find("#sectionID").append('<option value="">Select Subject</option>');
            // $.post(Allexams, { token: token, branch_id: branchID }, function (res) {
            //     if (res.code == 200) {
            //       //  $("#section_drp_div").hide();
            //         $.each(res.data, function (key, val) {
            //             $("#byclassfilter").find("#examnames").append('<option value="' + val.id + '">' + val.name + '</option>');
            //         });
            //     }
            // }, 'json');
            $.get(getbysubjectnamesall, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
                if (res.code == 200) {
                    $("#section_drp_div").show();
                    $.each(res.data, function (key, val) {
                        $("#byclassfilter").find("#sectionID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                    });
                }
            }, 'json');
        }

    });
    // change section
    $('#sectionID').on('change', function () {
        var subject_id = $(this).val();
        var class_id = $("#changeClassName").val();
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = yyyy + '/' + mm + '/' + dd;
        $("#byclassfilter").find("#examnames").empty();
        $("#byclassfilter").find("#examnames").append('<option value="">Select exams</option>');
        if (class_id != "All") {
            $.get(examsByclassandsubject, {
                token: token,
                branch_id: branchID,
                class_id: class_id,
                subject_id: subject_id,
                today: today
            }, function (res) {
                if (res.code == 200) {
                    $.each(res.data, function (key, val) {
                        var marks = JSON.parse(val.marks);
                        $("#byclassfilter").find("#examnames").append('<option value="' + val.id + '" data-full="' + marks.full + '" data-pass="' + marks.pass + '">' + val.name + '</option>');
                    });
                }
            }, 'json');
        }
        else if (class_id == "All") {
            $("#byclassfilter").find("#examnames").empty();
            $("#byclassfilter").find("#examnames").append('<option value="">Select exams</option>');
           
            $.post(Allexams, { token: token, branch_id: branchID }, function (res) {
                if (res.code == 200) {
                    //  $("#section_drp_div").hide();
                    $.each(res.data, function (key, val) {
                        $("#byclassfilter").find("#examnames").append('<option value="' + val.id + '">' + val.name + '</option>');
                    });
                }
            }, 'json');
        }
    });
    $("#byclassfilter").validate({
        rules: {
            class_id: "required",
            //  section_id: "required",
            exam_id: "required"
        }
    });
    $('#byclassfilter').on('submit', function (e) {
        e.preventDefault();

        var byclass = $("#byclassfilter").valid();
        if (byclass === true) {
            var class_id = $("#changeClassName").val();
            var Selected_classname = $('#changeClassName :selected').text();
            var subject_id = $("#sectionID").val();

            var exam_id = $("#examnames").val();
            if (class_id != "All") {
                var fmark = $('option:selected', '#examnames').attr('data-full');
                var pmark = $('option:selected', '#examnames').attr('data-pass');
                $("#fullmark").val(fmark);
                $("#passmark").val(pmark);

                // list mode
                $.get(getbyClass, { token: token, branch_id: branchID, exam_id: exam_id, class_id: class_id, subject_id: subject_id }, function (response) {

                    if (response.code == 200) {
                        if (response.data.length > 0) {
                            var datasetnew = response.data;
                            bysubjectdetails(datasetnew);
                            // console.log('end');
                            // console.log(response.data);
                            // var std_count = response.data[0].getstudentcount;
                            // var techarary = response.data[0].getteachername;
                            // var mastergradelist = response.data[0].getmastergrade;
                            // var examattendance = response.data[0].getexamattendance;
                            // var gradecount = response.data[1];
                            // console.log(gradecount);
                            // byclassdetails(std_count, techarary, gradecount, Selected_classname, mastergradelist, examattendance);
                            // $("#testexecution").hide();
                            // $("#listModeClassID").val(class_id);
                            // $("#listModeSectionID").val(section_id);
                            // $("#listModeSubjectID").val(subject_id);
                            // $("#listModeexamID").val(exam_id);
                            console.log('end');
                        } else {

                            toastr.info('No records are available');
                        }
                    } else {
                        toastr.error(data.message);
                    }

                });
            }
            else if (class_id == "All") {
                console.log(subject_id);
                $.get(getbyClassAllstd, { token: token, branch_id: branchID, exam_id: exam_id,subject_id:subject_id }, function (response) {

                    if (response.code == 200) {
                        //   console.log(response.data);
                        if (response.data.length > 0) {
                            //  console.log(response.data);
                            var datasetnew = response.data;
                            byclass_all_details(datasetnew);
                            // $("#testexecution").hide();
                            // $("#listModeClassID").val(class_id);
                            // $("#listModeSectionID").val(section_id);
                            // $("#listModeSubjectID").val(subject_id);
                            // $("#listModeexamID").val(exam_id);
                            console.log('end');
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
function byclass_all_details(datasetnew) {


    $('#byclassTableAppend').empty();

    var passcount = 0;
    var failcount = 0;
    var pass_percentage = 0;
    var fail_percentage = 0;
    var sno = 0;
    //var attendance_pass_fail = [];
    var byclassAllTable = "";

    datasetnew.forEach(function (res) {

        var std_count = res.totalstudentcount;

        // std count and names
        std_count.forEach(function (tot) {
            //  console.log(tot.totalStudentCount);
            if (tot.totalStudentCount > 0) {
                var attendance_con = res.attendance_list;
                attendance_con.forEach(function (attCondition) {

                    if (attCondition.pass != null && attCondition.fail != null) {
                        sno++;
                        byclassAllTable += '<tr>' +
                            '<td class="text-center" rowspan="2">';
                        byclassAllTable += sno +
                            '</td>';
                        // console.log(tot.totalStudentCount);

                        byclassAllTable += '<td class="text-left" rowspan="2">' +
                            '<label for="clsname">' + tot.name + "(" + tot.section_name + ")" + '</label>' +
                            '</td>';
                        byclassAllTable += '<td class="text-center" rowspan="2">' +
                            '<label for="stdcount"> ' + tot.totalStudentCount + '</label>' +
                            '</td>';
                        // Attendance present and absent column
                        var attendance_list = res.attendance_list;
                        attendance_list.forEach(function (att) {
                            byclassAllTable += '<td class="text-left" rowspan="2">' +
                                '<label for="clsname">' + att.absent + '</label>' +
                                '</td>';
                            byclassAllTable += '<td class="text-center" rowspan="2">' +
                                '<label for="stdcount"> ' + att.present + '</label>' +
                                '</td>';                       
                        });
                        // teacher names
                        var teachers_list = res.teachers_list;
                        teachers_list.forEach(function (tech) {
                            byclassAllTable += '<td class="text-left" rowspan="2">' +
                                '<label for="clsname">' + tech.teachername + '</label>' +
                                '</td>';
                        });
                        // grade list count
                        var grade_count_list = res.grade_count_list;

                        var gradepercentage = [];
                        $('#tblbycls > thead  > tr >th').each(function (index, tr) {
                            var th = $('#tblbycls  thead  > tr >th').eq($(this).index());
                            var nineindex = 9;
                            var endgradeindex = (6 + nineindex);

                            if (index >= 6 && endgradeindex > index) {
                                var i = 0;
                                grade_count_list.forEach(function (res) {
                                    if (res.gname == th.text()) {
                                        i++;
                                        byclassAllTable += '<td class="text-right">' + res.gradecount + '</td>';
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
                                    byclassAllTable += '<td class="text-right">0</td>'
                                    gradepercentage.push(0);
                                }

                            }
                        });
                        //    console.log(attendance_pass_fail.length);

                        attendance_list.forEach(function (res) {

                            // console.log('pass before' + res.pass);

                            // if (res.pass != 0 && res.fail != 0) {
                            //          console.log("pass after " + res.pass);
                            passcount = res.pass;
                            failcount = res.fail;
                            pass_percentage = (passcount / tot.totalStudentCount) * 100;
                            fail_percentage = (failcount / tot.totalStudentCount) * 100;
                            pass_percentage = parseFloat(pass_percentage, 10).toFixed(2);
                            fail_percentage = parseFloat(fail_percentage, 10).toFixed(2);
                            byclassAllTable += '<td class="text-center">' + passcount + '</td>' +
                                '<td class="text-center">' + failcount + '</td>' +
                                '<td class="text-center" rowspan="2">-</td>' +
                                '<td class="text-center" rowspan="2">' + pass_percentage + '</td>' +
                                '</tr>';
                            // }
                        });

                        byclassAllTable += '<tr>';
                        gradepercentage.forEach(function (response) {

                            byclassAllTable += '<td class="text-right">' + response + '</td>'
                        });
                        byclassAllTable += '<td class="text-right">' + pass_percentage + '</td>' +
                            '<td class="text-right">' + fail_percentage + '</td>';
                        byclassAllTable += '</tr>';
                    }
                    else {
                        console.log('else print')
                    }
                });

            }
        });



    });

    $("#byclassTableAppend").append(byclassAllTable);


}
///
function bysubjectdetails(datasetnew) {

    $('#byclassTableAppend').empty();
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
        console.log('student count' + std_count);
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
                            '<label for="clsname">' + tot.section_name + '</label>' +
                            '</td>';
                        bysubjectAllTable += '<td class="text-center" rowspan="2">' +
                            '<label for="stdcount"> ' + tot.totalStudentCount + '</label>' +
                            '</td>';
                        // Attendance present and absent column
                        var attendance_percentage = [];
                        var attendance_list = res.attendance_list;
                        attendance_list.forEach(function (att) {
                            bysubjectAllTable += '<td class="text-left" rowspan="2">' +
                                '<label for="clsname">' + att.absent + '</label>' +
                                '</td>';
                            bysubjectAllTable += '<td class="text-center" rowspan="2">' +
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
                            var endgradeindex = (6 + nineindex);

                            if (index >= 6 && endgradeindex > index) {
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




                        // //    console.log(attendance_pass_fail.length);
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
                        gradepercentage.forEach(function (res) {
                            bysubjectAllTable += '<td class="text-right">' + res + '</td>'
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

    $("#byclassTableAppend").append(bysubjectAllTable);
}
