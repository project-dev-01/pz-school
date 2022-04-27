$(function () {
    $("#analysis_graph").hide();
    // change classroom
    // $('#changeClassName').on('change', function () {
    //     var class_id = $(this).val();
    //     console.log(class_id);
    //     if (class_id != "All") {
    //         $("#byoverallfilter").find("#sectionID").empty();
    //         $("#byoverallfilter").find("#sectionID").append('<option value="">Select Subject</option>');

    //         $.post(getbySubjectnames, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
    //             if (res.code == 200) {
    //                 $("#section_drp_div").show();
    //                 $.each(res.data, function (key, val) {
    //                     $("#byoverallfilter").find("#sectionID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
    //                 });
    //             }
    //         }, 'json');
    //     }
    //     else if (class_id == "All") {
    //         $("#byoverallfilter").find("#sectionID").empty();
    //         $("#byoverallfilter").find("#sectionID").append('<option value="">Select Subject</option>');

    //         $.get(getbysubjectnamesall, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
    //             if (res.code == 200) {
    //                 $("#section_drp_div").show();
    //                 $.each(res.data, function (key, val) {
    //                     $("#byoverallfilter").find("#sectionID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
    //                 });
    //             }
    //         }, 'json');
    //     }

    // });
    $("#byoverallfilter").validate({
        rules: {
            class_id: "required",
            //  section_id: "required",
            exam_id: "required"
        }
    });
    $('#byoverallfilter').on('submit', function (e) {
        e.preventDefault();

        var byclass = $("#byoverallfilter").valid();
        if (byclass === true) {

            $("#overlay").fadeIn(300);
            var class_id = $("#changeClassName").val();
            var Selected_classname = $('#changeClassName :selected').text();

            var exam_id = $("#examnames").val();

            var fmark = $('option:selected', '#examnames').attr('data-full');
            var pmark = $('option:selected', '#examnames').attr('data-pass');
            $("#fullmark").val(fmark);
            $("#passmark").val(pmark);
            $("#card-body-tbl").fadeIn(300);
            $("analysis_graph").fadeIn(300);
            // list mode
            $.get(getoverall, { token: token, branch_id: branchID, exam_id: exam_id, class_id: class_id }, function (response) {

                if (response.code == 200) {
                    if (response.data.length > 0) {
                        var datasetnew = response.data;
                        overall_subject(datasetnew);
                        $("#body_content").show("slow");
                        $("#analysis_graph").show("slow");
                        $("#overlay").fadeOut(300);
                    } else {
                        toastr.info('No records are available');
                        $("#overlay").fadeOut(300);
                    }
                } else {
                    toastr.error(data.message);
                    $("#overlay").fadeOut(300);
                }

            });


        };
    });

});

function overall_subject(datasetnew) {

    $('#overall_body').empty();
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

                        // bysubjectAllTable += '<td class="text-left" rowspan="2">' +
                        //     '<label for="clsname">' + tot.name + '</label>' +
                        //     '</td>';
                        // bysubjectAllTable += '<td class="text-center" rowspan="2">' +
                        //     '<label for="stdcount"> ' + tot.section_name + '</label>' +
                        //     '</td>';
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
                        $('#tab_overall > thead  > tr >th').each(function (index, tr) {
                            var th = $('#tab_overall  thead  > tr >th').eq($(this).index());
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

    $("#overall_body").append(bysubjectAllTable);
}