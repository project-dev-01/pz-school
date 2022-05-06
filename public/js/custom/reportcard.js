$(function () {
    $("#reportcart_filter").validate({
        rules: {
            selectedyear: "required",
            exam_id: "required"
        }
    });
    $('#reportcart_filter').on('submit', function (e) {
        e.preventDefault();

        var reportcard = $("#reportcart_filter").valid();
        if (reportcard === true) {

            $("#overlay").fadeIn(300);
            var student_id = null;
            // it come only parent and student
            if(studentID){
                student_id = studentID;
            }else{
                student_id = ref_user_id;
            }

            var selected_year = $('#selected_year :selected').text();
            var exam_name = $('#examnames :selected').text();
            var exam_id = $("#examnames").val();
            console.log(exam_id);
            // list mode
            $.get(getbyreportcard, { token: token, branch_id: branchID, student_id: student_id, exam_id: exam_id, selected_year: selected_year }, function (response) {

                if (response.code == 200) {
                    if (response.data.length > 0) {
                        var datasetnew = response.data;
                        console.log(datasetnew);
                       
                        if(datasetnew[0].subjectreport.length>0)
                        {                 
                            $("#reportlist").show();
                            $("#exam_name_header").text(exam_name +' - '+selected_year);
                            $("#exam_name_header_div").text(exam_name +' - '+selected_year );           
                            reportdetails(datasetnew); 
                            $("#reportlist_norecords").hide(); 
                        }
                        else{
                            $("#reportlist").hide();
                            $("#reportlist_norecords").show();
                        }
                        $("#overlay").fadeOut(300);
                    } else {
                        $("#reportlist").hide();
                        $("#overlay").fadeOut(300);
                        toastr.info('No records are available');
                    }
                } else {
                    toastr.error(data.message);
                }

            });
        };
    });
});
function reportdetails(datasetnew) {

    $('#tbl_bdy_reportcard').empty();
    $('#tbl_subjectdivision_body').empty();
    var sno = 0;
    //var attendance_pass_fail = [];
    var bysubjectAllTable = "";
    var reportcardtbl = "";
    var reportcardtbl_div = "";
    $totalmarks = 0;
    $totalmarks_division = 0;
    console.log(datasetnew);
    datasetnew.forEach(function (res) {
        sno++;
        var student_marks = res.subjectreport;
        var subject_division = res.subjectreport_div;      
        console.log(subject_division.length);
        $subject_count = 0;
        $subject_count_div = 0;
        var get_subjectcount = 0;
        var get_subjectcount_div = 0;
        var pass_fail_stdmrk = "pass";
        var pass_fail_stdmrk_div = "pass";
        if (sno === 1) {
            student_marks.forEach(function (stdmks) {

                get_subjectcount++;
                reportcardtbl += '<tr>' +
                    '<th scope="row">';
                reportcardtbl += stdmks.subject_name +
                    '</th>' +
                    '<td scope="row">';
                reportcardtbl += stdmks.score +
                    '</td>' +
                    '<td scope="row">';
                reportcardtbl += stdmks.grade +
                    '</td>' +
                    '<td scope="row">';
                reportcardtbl += stdmks.ranking +
                    '</td>' +
                    '</tr>';
                $totalmarks += stdmks.score;
                if (stdmks.pass_fail === "pass") {
                    pass_fail_stdmrk = "pass"
                }
                else {
                    pass_fail_stdmrk = "fail"
                }

            });
            $subject_count += get_subjectcount;
            var avarage = $totalmarks / $subject_count;
            var avarage_round = parseFloat(avarage, 10).toFixed(2);

            reportcardtbl += '<tr>' +
                '<th scope="row">' +
                'Total' +
                '</th>' +
                '<td scope="row">' +
                $totalmarks +
                '</td>' +
                '<th scope="row">' +
                'Average' +
                '</th>' +
                '<td scope="row">' +
                avarage_round +
                '</td>' +
                '</tr>';
            reportcardtbl += '<tr>' +
                '<th scope="row">Result</th>' +
                '<td>' +
                pass_fail_stdmrk
            '</td>' +
                '</tr>';
            $("#tbl_bdy_reportcard").append(reportcardtbl);
        }
        // subject division tbl
        var sub_div_sno = 0;
        if (subject_division.length > 0) {
            $("#tbl_subject_division").show();
            if (sno === 1) {
                sub_div_sno++;
                subject_division.forEach(function (stdmks_division) {
                    var std_count = stdmks_division.totalstudentcount;

                    // subject division marks split
                    var split_submarks = stdmks_division.subjectdivision_scores;
                    let arr_marks = split_submarks.split(',');
                    var split_subnam = stdmks_division.subject_division;
                    let arr = split_subnam.split(',');
                    var subject_marks_names = arr_marks.map((e, i) => e + ':' + arr[i]);
                    console.log("newArray");
                    console.log(subject_marks_names);

                    // 1st time data full bind so brake the loop
                    if (sub_div_sno === 1) {
                        console.log(sub_div_sno);
                        subject_marks_names.forEach(function (sbnam_marks) {
                            var split_submarks = sbnam_marks;
                            var arr_marks = split_submarks.split(':');
                            console.log(arr_marks);
                            reportcardtbl_div += '<tr>';

                            //  console.log(sbnam);
                            reportcardtbl_div += '<th scope="row">' +
                                arr_marks[1] +
                                '</th>';
                            reportcardtbl_div += '<td scope="row">' +
                                arr_marks[0] +
                                '</td>';
                            reportcardtbl_div += '<td scope="row">' +
                                stdmks_division.grade +
                                '</td>';
                            reportcardtbl_div += '<td scope="row">' +
                                stdmks_division.ranking +
                                '</td>';
                            reportcardtbl_div += '</tr>';
                            get_subjectcount_div++;
                            if (stdmks_division.pass_fail === "pass") {
                                pass_fail_stdmrk_div = "pass"
                            }
                            else {
                                pass_fail_stdmrk_div = "fail"
                            }
                        });

                        reportcardtbl_div += '</tr>';
                        $totalmarks_division += stdmks_division.total_score;
                    }


                });
                $subject_count_div += get_subjectcount_div;
                var avarage = $totalmarks_division / $subject_count_div;
                var avarage_round = parseFloat(avarage, 10).toFixed(2);
                reportcardtbl_div += '<tr>' +
                    '<th scope="row">' +
                    'Total' +
                    '</th>' +
                    '<td scope="row">' +
                    $totalmarks_division +
                    '</td>' +
                    '<th scope="row">' +
                    'Average' +
                    '</th>' +
                    '<td scope="row">' +
                    avarage_round +
                    '</td>' +
                    '</tr>';
                reportcardtbl_div += '<tr>' +
                    '<th scope="row">Result</th>' +
                    '<td>'+pass_fail_stdmrk_div+'</td>' +
                    '</tr>';
                $("#tbl_subjectdivision_body").append(reportcardtbl_div);
            }
        }
        else {
            $("#tbl_subject_division").hide();
        }

    });
}
$(document).ready(function (e) {
    $('.yrselectdesc').yearselect({
        start: 2000,
        end: 2022,
        order: 'desc'
    });
});