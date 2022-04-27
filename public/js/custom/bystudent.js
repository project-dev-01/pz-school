var globel_gradecount = [];
var reasonChart;
$(function () {
    // $('#bystudent_bodycontent').hide();
    $('#bystudent_analysis').hide();
    // change classroom
    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        console.log(class_id);
        if (class_id != "All") {
            $("#bystudentfilter").find("#sectionID").empty();
            $("#bystudentfilter").find("#sectionID").append('<option value="">Select Section</option>');
            $("#bystudentfilter").find("#examnames").empty();
            $("#bystudentfilter").find("#examnames").append('<option value="">Select Exam</option>');
            
            $.post(sectionByClass, { class_id: class_id }, function (res) {
                if (res.code == 200) {
                    console.log(res);
                    $("#section_drp_div").show();
                    $.each(res.data, function (key, val) {
                        $("#bystudentfilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                    });
                }
            }, 'json');
        }
        else if (class_id == "All") {
            $("#bystudentfilter").find("#sectionID").empty();
            $("#bystudentfilter").find("#sectionID").append('<option value="">Select Section</option>');
           
            $("#bystudentfilter").find("#examnames").empty();
            $("#bystudentfilter").find("#examnames").append('<option value="">Select Exam</option>');
            $.post(Allexams, { token: token, branch_id: branchID }, function (res) {
                if (res.code == 200) {
                    $("#section_drp_div").hide();
                    $.each(res.data, function (key, val) {
                        $("#bystudentfilter").find("#examnames").append('<option value="' + val.id + '">' + val.name + '</option>');
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
        $("#bystudentfilter").find("#examnames").empty();
        $("#bystudentfilter").find("#examnames").append('<option value="">Select exams</option>');
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
                    $("#bystudentfilter").find("#examnames").append('<option value="' + val.id + '" data-full="' + marks.full + '" data-pass="' + marks.pass + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    $("#bystudentfilter").validate({
        rules: {
            class_id: "required",
            //  section_id: "required",
            exam_id: "required"
        }
    });
    $('#bystudentfilter').on('submit', function (e) {
        e.preventDefault();
        var byclass = $("#bystudentfilter").valid();
        if (byclass === true) {
            $("#overlay").fadeIn(300);
            $("#bystudent_body").show("slow");
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
                // console.log('enterd');
                // list mode
                $.get(getbyStudent, { token: token, branch_id: branchID, exam_id: exam_id, class_id: class_id, section_id: section_id }, function (response) {

                    if (response.code == 200) {
                        if (response.data.length > 0) {
                            var datasetnew = response.data;
                         
                            bystudentdetails_class(datasetnew);
                            console.log(datasetnew);

                            $('#bystudent_bodycontent').show();
                    
                            $("#bystudent_analysis").show("slow");
                            $("#overlay").fadeOut(300);
                        } else {
                            $("#overlay").fadeOut(300);
                            toastr.info('No records are available');
                        }
                    } else {
                        toastr.error(data.message);
                    }

                });
                // check subject division table
                $.get(getbyStudent_subjectdivision, { token: token, branch_id: branchID, exam_id: exam_id, class_id: class_id, section_id: section_id }, function (response_div) {

                    if (response_div.code == 200) {
                        if (response_div.data.length > 0) {
                            var datasetnew = response_div.data;
                            console.log(datasetnew);
                            bystudentdetails_subdiv_class(datasetnew);
                            console.log(datasetnew);

                            //byclass_chart(class_id, section_id, exam_id);
                            // $("#bysubject_body").show("slow");
                            // $("#bysubject_analysis").show("slow");
                            // $("#overlay").fadeOut(300);
                        } else {
                            $("#overlay").fadeOut(300);
                            toastr.info('No records are available');
                        }
                    } else {
                        toastr.error(data.message);
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


function bystudentdetails_class(datasetnew) {
    $('#bystudent_header').empty();
    $('#bystudent_body').empty();
    var sno = 0;
    var sno_bdy = 0;
    var sno_bdy_main = 0;
    var subject_name_header = "";
    var bysubjectAllTable = "";
    console.log(datasetnew);
    // header start 
    datasetnew.forEach(function (res) {
        sno++;
        if (sno === 1) {
            console.log(res.total_subject_count);
            var headercount = res.total_subject_count * 2;
            console.log(headercount);
            subject_name_header += '<tr>' +
                '<th class="align-middle" rowspan="3">S.no.</th>' +
                '<th class="align-middle" rowspan="3">Student Name</th>' +
                '<th class="text-center" colspan="' + headercount + '">Subject Name</th>' +
                '</tr>';
            subject_name_header += '<tr>';
            var subject_headers = res.sub_header;
            console.log(subject_headers);
            var split_subnam = subject_headers.subject_name;
            console.log(split_subnam);
            let subject_names = split_subnam.split(',');
            console.log(subject_names);
            subject_names.forEach(function (sub_name) {
                subject_name_header += '<th colspan="2" class="text-center" data-id="' + sub_name + '">' + sub_name + '</th>';
            });
            subject_name_header += '</tr>';
            subject_name_header += '<tr>';
            subject_names.forEach(function (snm) {
                subject_name_header += '  <th class="text-center">Mark</th>' +
                    '<th class="text-center">Grade</th>';
            });

        }

    });
    subject_name_header += '</tr>';
    $('#bystudent_header').append(subject_name_header);

    // body tag start 
    var globel_subjectname;
    datasetnew.forEach(function (response) {
        //console.log(response);
        sno_bdy++;

        if (sno_bdy > 1) {
            var total_subject_count = response.total_subject_count;
            //console.log(sno_bdy);
            var marks_grade = response.both_exam_marksgrade;

            //console.log(marks_grade);
            // std count and names
            marks_grade.forEach(function (mg) {
                //    console.log(mg.student_id);
                //if (mg.student_id > 0) {
                sno_bdy_main++;
                bysubjectAllTable += '<tr>' +
                    '<td class="text-center">';
                bysubjectAllTable += sno_bdy_main +
                    '</td>';
                bysubjectAllTable += '<td class="text-left">' + mg.first_name + '</td>';
                var split_subnam = mg.scoremarks;
                let arr = split_subnam.split(',');
                //console.log(arr);
                arr.forEach(function (sbnam) {
                    //  console.log(sbnam);
                    bysubjectAllTable += '<td class="text-center">' + sbnam + '</td>';

                });
                // console.log('loop exit');
                // '<td class="align-top">' + mg.score + '</td>' +
                // '<td class="align-top">' + mg.grade + '</td>'+

                bysubjectAllTable += '</tr>';

            });
        }
    });
    $("#bystudent_body").append(bysubjectAllTable);
}
function bystudentdetails_subdiv_class(datasetnew) {
    $('#bystudent_subdiv_header').empty();
    $('#bystudent_subdiv_body').empty();
    var sno = 0;
    var sno_bdy = 0;
    var sno_bdy_main = 0;
    var subject_name_header = "";
    var bysubjectAllTable = "";
    console.log(datasetnew);
    // header start 
    datasetnew.forEach(function (res) {
        sno++;
        if (sno === 1) {
            console.log(res.total_subject_count);
            var sub_division_count = res.both_exam_marksgrade;
            var subject_headers = res.sub_header;
            var split_subnamdiv = subject_headers.subject_division;

            let sub_divisioncount = split_subnamdiv.split(',');
            var sub_divcount = sub_divisioncount.length;
            console.log(sub_divcount);
            var headercount = res.total_subject_count * 2;
            console.log(headercount);
            subject_name_header += '<tr>' +
                '<th class="align-middle" rowspan="3">S.no.</th>' +
                '<th class="align-middle" rowspan="3">Student Name</th>' +
                '<th class="text-center" colspan="' + sub_divcount + '">Subject Division Names</th>' +
                '<th class="text-center" colspan="' + headercount + '">Subject Master Name</th>' +
                '</tr>';
            subject_name_header += '<tr>';

            // subject division name start
            var split_subnamdiv = subject_headers.subject_division;

            let subjectdiv_names = split_subnamdiv.split(',');

            subjectdiv_names.forEach(function (subdiv_name) {
                subject_name_header += '<th class="text-center" data-id="' + subdiv_name + '">' + subdiv_name + '</th>';
            });
            // subject name start 
            var split_subnam = subject_headers.subject_name;

            let subject_names = split_subnam.split(',');

            subject_names.forEach(function (sub_name) {
                subject_name_header += '<th colspan="2" class="text-center" data-id="' + sub_name + '">' + sub_name + '</th>';
            });
            subject_name_header += '</tr>';
            subject_name_header += '<tr>';
            subjectdiv_names.forEach(function (snm) {
                subject_name_header += '  <th class="text-center">Mark</th>';
                //  '<th class="text-center">Grade</th>';
            });
            // subject name start 
            subject_names.forEach(function (snm) {
                subject_name_header += '  <th class="text-center">Mark</th>' +
                    '<th class="text-center">Grade</th>';
            });

        }

    });
    subject_name_header += '</tr>';
    $('#bystudent_subdiv_header').append(subject_name_header);

    // body tag start 
    var globel_subjectname;
    datasetnew.forEach(function (response) {
        //console.log(response);
        sno_bdy++;

        if (sno_bdy > 1) {
            var total_subject_count = response.total_subject_count;
            //console.log(sno_bdy);
            var marks_grade = response.both_exam_marksgrade;
            marks_grade.forEach(function (mg) {
                sno_bdy_main++;
                bysubjectAllTable += '<tr>' +
                    '<td class="text-center">';
                bysubjectAllTable += sno_bdy_main +
                    '</td>';
                bysubjectAllTable += '<td class="text-left">' + mg.first_name + '</td>';
                var split_subdivnam = mg.subjectdivision_scores;
                let arr_subdivname = split_subdivnam.split(',');
                //console.log(arr);
                arr_subdivname.forEach(function (sbnam_div) {
                    //  console.log(sbnam);
                    bysubjectAllTable += '<td class="text-right">' + sbnam_div + '</td>';

                });
                // total subject mark and grade
                var split_subnam = mg.scoremarks;
                let arr = split_subnam.split(',');
                //console.log(arr);
                arr.forEach(function (sbnam) {
                    //  console.log(sbnam);
                    bysubjectAllTable += '<td class="text-right">' + sbnam + '</td>';

                });

                bysubjectAllTable += '</tr>';

            });
        }
    });
    $("#bystudent_subdiv_body").append(bysubjectAllTable);
}


