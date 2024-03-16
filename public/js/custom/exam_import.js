$(function () {

    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#resultsByPaper';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    function classAllocation(department_id, Selector, classID) {
        $(Selector).find('select[name="class_id"]').empty();
        $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
        if (department_id) {
            $.post(getGradeByDepartmentUrl,
                {
                    branch_id: branchID,
                    department_id: department_id
                }, function (res) {
                    if (res.code == 200) {
                        $.each(res.data, function (key, val) {
                            $(Selector).find('select[name="class_id"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                        if (classID != '') {
                            $(Selector).find('select[name="class_id"]').val(classID);
                        }
                    }
                }, 'json');
        }
    }
    // change classroom
    $('#changeClassName').on('change', function () {
        $(".testResultHideSHow").hide();
        var class_id = $(this).val();
        $("#resultsByPaper").find("#sectionID").empty();
        $("#resultsByPaper").find("#sectionID").append('<option value="">'+select_class+'</option>');
        $("#resultsByPaper").find("#examnames").empty();
        $("#resultsByPaper").find("#examnames").append('<option value="">'+select_exam+'</option>');
        $("#resultsByPaper").find("#subjectID").empty();
        $("#resultsByPaper").find("#subjectID").append('<option value="">'+select_subject+'</option>');
        $("#resultsByPaper").find("#paperID").empty();
        $("#resultsByPaper").find("#paperID").append('<option value="">'+select_paper+'</option>');
        $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#resultsByPaper").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
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
        $("#resultsByPaper").find("#examnames").empty();
        $("#resultsByPaper").find("#examnames").append('<option value="">'+select_exam+'</option>');
        $("#resultsByPaper").find("#subjectID").empty();
        $("#resultsByPaper").find("#subjectID").append('<option value="">'+select_subject+'</option>');
        $("#resultsByPaper").find("#paperID").empty();
        $("#resultsByPaper").find("#paperID").append('<option value="">'+select_paper+'</option>');
        $.post(subjectByExamNames, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            section_id: section_id,
            academic_session_id: academic_session_id,
            today: today
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#resultsByPaper").find("#examnames").append('<option value="' + val.id + '" >' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    // change subject
    $('#examnames').on('change', function () {
        var exam_id = $(this).val();
        var section_id = $("#sectionID").val();
        var class_id = $("#changeClassName").val();
        var teacher_id = teacherID;
        $("#resultsByPaper").find("#subjectID").empty();
        $("#resultsByPaper").find("#subjectID").append('<option value="">'+select_subject+'</option>');
        $("#resultsByPaper").find("#paperID").empty();
        $("#resultsByPaper").find("#paperID").append('<option value="">'+select_paper+'</option>');
        $.post(examBySubjects, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            teacher_id: teacher_id,
            section_id: section_id,
            academic_session_id: academic_session_id,
            exam_id: exam_id
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#resultsByPaper").find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                });
            }
        }, 'json');
    });
    $('#subjectID').on('change', function () {
        var subject_id = $(this).val();
        var section_id = $("#sectionID").val();
        var class_id = $("#changeClassName").val();
        var exam_id = $("#examnames").val();
        $("#resultsByPaper").find("#paperID").empty();
        $("#resultsByPaper").find("#paperID").append('<option value="">'+select_paper+'</option>');
        // paper list
        $.post(subjectByPapers, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            section_id: section_id,
            subject_id: subject_id,
            academic_session_id: academic_session_id,
            exam_id: exam_id
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#resultsByPaper").find("#paperID").append('<option value="' + val.paper_id + '" data-grade_category="' + val.grade_category + '">' + val.paper_name + '</option>');
                });
            }
        }, 'json');
    });
    $('#paperID').on('change', function () {
        var paper_id = $(this).val();
        $.post(ExamPaperDetails, {
            token: token,
            branch_id: branchID,
            id: paper_id
        }, function (res) {
            if (res.code == 200) {
                
                if(res.data.score_type=='Grade' || res.data.score_type=='Mark' )
                {
                    
                    $("#downmark").show();
                    $("#downpoints").hide();
                    $("#downfreetext").hide();
                    $("#Marktype").html('<span style="color:green;">'+marktext+'</span>'); 
                }
                else if(res.data.score_type=='Points')
                {
                    $("#downmark").hide();
                    $("#downpoints").show();
                    $("#downfreetext").hide();
                    $("#Marktype").html('<span style="color:green;">'+pointstext+'</span>'); 
                }
                else if(res.data.score_type=='Freetext')
                {
                    
                    $("#downmark").hide();
                    $("#downpoints").hide();
                    $("#downfreetext").show();
                    $("#Marktype").html('<span style="color:green;">'+freetext+'</span>'); 
                }
                else
                {
                    $("#downmark").hide();
                    $("#downpoints").hide();
                    $("#downfreetext").hide();
                    $("#Marktype").html('<span style="color:red;">'+infotext+'</span>'); 
                }
                
            }
        }, 'json');
    });
	/*$(document).ready(function(){
    $('#resultsByPaper').on('submit', function(e){
        e.preventDefault();
        
            this.submit();
        
    });
	});*/
    // by paper result
    $(document).on('click', '.exportToExcel', function (e) {
        // var table = $(this).prev('.table2excel');
        var table = $('.table2excel');
        if (table && table.length) {
            var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
            $(table).table2excel({
                // exclude: ".noExl",
                name: "By Paper Results",
                filename: downloadFileName + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true,
                preserveColors: preserveColors
            });
        }
    });
    // applyFilter
    // rules validation
    if ($('#parent-table').length) {
    $("#resultsByPaper").validate({
        rules: {
            department_id: "required",
            class_id: "required",
            section_id: "required",
            subject_id: "required",
            exam_id: "required"
        }
    });
}
    
});