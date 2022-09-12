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
            if (studentID) {
                student_id = studentID;
            } else {
                student_id = ref_user_id;
            }

            var selected_year = $('#selected_year :selected').text();
            var exam_name = $('#examnames :selected').text();
            var exam_id = $("#examnames").val();
            console.log("-----");
            console.log(selected_year);
            console.log(student_id);
            console.log(exam_id);
            // list mode
            $.get(getbyreportcard, { token: token, branch_id: branchID, student_id: student_id, exam_id: exam_id, selected_year: selected_year }, function (response) {

                if (response.code == 200) {
                    if (response.data.length > 0) {
                        var datasetnew = response.data;

                        if (datasetnew[0].subjectreport.length > 0) {
                            $("#reportlist").show();
                            $("#exam_name_header").text(exam_name + ' - ' + selected_year);
                            $("#exam_name_header_div").text(exam_name + ' - ' + selected_year);
                            datasetnew = datasetnew[0].subjectreport;
                            reportdetails(datasetnew);
                            $("#reportlist_norecords").hide();
                        } else {
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
    var sno = 0;
    //var attendance_pass_fail = [];
    var reportcardtbl = "";
    let totalmarks = 0;
    var get_subjectcount = 0;
    var subject_count = 0;
    datasetnew.forEach(function (stdmks) {
        sno++;
        // var student_marks = res.subjectreport;
        // console.log(subject_division.length);
        var pass_fail_stdmrk = "pass";
        var subject_name = stdmks.subject_name + '(' + stdmks.paper_name + ')';
        get_subjectcount++;
        reportcardtbl += '<tr>' +
            '<th scope="row">';
        reportcardtbl += subject_name +
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
            '<td scope="row">';
        reportcardtbl += stdmks.pass_fail +
            '</td>' +
            '</tr>';
        totalmarks += stdmks.score ? parseFloat(stdmks.score) : 0;
        if (stdmks.pass_fail === "Pass") {
            pass_fail_stdmrk = "pass"
        }
        else {
            pass_fail_stdmrk = "fail"
        }
    });

    // console.log("get_subjectcount");
    // console.log(get_subjectcount);
    // console.log(totalmarks);
    // subject_count += get_subjectcount;
    // var avarage = totalmarks / subject_count;
    // var avarage_round = parseFloat(avarage, 10).toFixed(2);
    // console.log(avarage_round);

    // reportcardtbl += '<tr>' +
    //     '<th scope="row">' +
    //     'Total' +
    //     '</th>' +
    //     '<td scope="row">' +
    //     totalmarks +
    //     '</td>' +
    //     '<th scope="row">' +
    //     'Average' +
    //     '</th>' +
    //     '<td scope="row">' +
    //     avarage_round +
    //     '</td>' +
    //     '</tr>';
    // reportcardtbl += '<tr>' +
    //     '<th scope="row">Result</th>' +
    //     '<td>' +
    //     pass_fail_stdmrk
    // '</td>' +
    //     '</tr>';
    $("#tbl_bdy_reportcard").append(reportcardtbl);
}
$(document).ready(function (e) {
    $('.yrselectdesc').yearselect({
        start: 2000,
        end: 2022,
        order: 'desc'
    });
});