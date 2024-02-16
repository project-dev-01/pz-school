var reasonChart;
$(function () {
    
    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#bystudentfilter';
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
        var class_id = $(this).val();
        $("#bystudentfilter").find("#sectionID").empty();
        $("#bystudentfilter").find("#sectionID").append('<option value="">'+select_class+'</option>');
        $("#bystudentfilter").find("#examnames").empty();
        $("#bystudentfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');
        $("#bystudentfilter").find("#student_id").empty();
        $("#bystudentfilter").find("#student_id").append('<option value="">'+select_student+'</option>');
        $.post(sectionByClass, { token: token, branch_id: branchID, class_id: class_id, teacher_id: teacher_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#bystudentfilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    // change section
    $('#sectionID').on('change', function () {
        var section_id = $(this).val();
        var class_id = $("#changeClassName").val();
        var student_id = "";
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '/' + mm + '/' + dd;
        $("#bystudentfilter").find("#student_id").empty();
        $("#bystudentfilter").find("#student_id").append('<option value="">'+select_student+'</option>');
       
        var year = $("#btwyears").val();
        getbyStudentDetails(year, class_id, section_id,student_id);
    });
    function getbyStudentDetails(year, class_id, section_id,student_id){
        console.log('tets')
        // var year = $("#btwyears").val();
        $("#student_id").empty();
        $("#student_id").append('<option value="">'+select_student+'</option>');
        $.post(getStudentList, { token: token, branch_id: branchID, class_id: class_id, academic_session_id: year, section_id: section_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#student_id").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
                $("#student_id").val(student_id);
            }
        }, 'json');
    }
    $('#student_id').on('change', function () {
        var student_id = $(this).val();
        var year = $("#btwyears").val();
        var department_id = $("#department_id").val();
        var class_id = $("#changeClassName").val();
        var section_id = $("#sectionID").val();
        var semester_id = $("#semester_id").val();
        var interview_date = $("#interview_date").val();        
            $("#question_situation").val('');                
            $("#question_improved").val('');                
            $("#question_tried").val('');                
            $("#question_future").val('');
            $("#question_parent").val('');
            $("#question_feedback").val('');
            $("#id").val('');
        $.post(getInterviewData, { token: token, branch_id: branchID, department_id: department_id,class_id: class_id,  academic_year: year, section_id: section_id,semester_id:semester_id,interview_date:interview_date, student_id:student_id }, function (res) {
            if(res.code == 200) {  
                toastr.info(res.message);              
                $("#question_situation").val(res.data.question_situation);                
                $("#question_improved").val(res.data.question_improved);                
                $("#question_tried").val(res.data.question_tried);                
                $("#question_future").val(res.data.question_future);
                $("#question_parent").val(res.data.question_parent);
                $("#question_feedback").val(res.data.question_feedback);
                $("#id").val(res.data.id);
                
            }
            else
            {
                toastr.info('Please Fill Informations');    
            }

        }, 'json');
    });
    
});