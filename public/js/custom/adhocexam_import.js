$(function () {
    $("#exam_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-3:+6", // last hundred years
    });
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
        
        $("#resultsByPaper").find("#subjectID").empty();
        $("#resultsByPaper").find("#subjectID").append('<option value="">'+select_subject+'</option>');
       
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
        var subject_id = $("#subjectID").val();
        $("#resultsByPaper").find("#subjectID").empty();
       
        $.post(getAssignClassSubjUrl, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            section_id: section_id,
            academic_session_id: academic_session_id
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#resultsByPaper").find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                });
                if (subject_id) {
                    $("#resultsByPaper").find('select[name="subject_id"]').val(subject_id);
                }
            }
        }, 'json');
    });
    
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
      });
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
    $(document).ready(function(){
    $("#resultsByPaper").validate({
        rules: {
            department_id: "required",
            class_id: "required",
            section_id: "required",
            subject_id: "required",
            paper_id: "required",
            semester_id: "required"
        }
    });
    $(document).ready(function(){
        $('#fileInput').change(function(){
            var fileName = $(this).val().split('\\').pop();		
            
                //$('#submitbtn').removeAttr("type").attr("type", "submit");	
                $('#submitbtn').show();	
                
                   $('#resultsByPaper').attr('action', newRoute);	
                $('#downloadexcel1').hide();	   		
            
        });
    });
    $(document).on('click', '#savestudentmarks', function (e) {
        e.preventDefault(); // Prevent the default form submission
       
        // Get values from form fields
        var department_id = $("#department_id").val();
        var class_id = $("#changeClassName").val();
        var section_id = $("#sectionID").val();       
        var subject_id = $("#subjectID").val();
        var exam_id = $("#examnames").val();
        var exam_date = $("#exam_date").val();
        var score_type = $("#score_type").val();
        
        
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('department_id', department_id);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('subject_id', subject_id);
            formData.append('exam_id', exam_id);
            formData.append('exam_date', exam_date);
            formData.append('score_type', score_type);
            formData.append('file', $('input[type=file]')[0].files[0]);
            formData.append('academic_session_id', academic_session_id);
            //$("#overlay").fadeIn(300);
            $.ajax({
                url: savemarks,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                Accept: 'application/json',
                success: function (data) {
                    if(data.result=='success')
                    {
                        $('#markModal').modal('hide');
                        toastr.success(data.message);
                        setTimeout(function() {
                            window.location.href = window.location;
                         }, 3000);
                    }
                    else

                    {
                        toastr.error(data.message);
                    }
                }
            });
        });
    $(document).on('click', '#submitbtn', function (e) {
        e.preventDefault(); // Prevent the default form submission
        $('#exammark_preview').hide();
        // Get values from form fields
        var department_id = $("#department_id").val();
        var class_id = $("#changeClassName").val();
        var section_id = $("#sectionID").val();
        var exam_id = $("#examnames").val();
        var subject_id = $("#subjectID").val();
        var exam_date = $("#exam_date").val();
        var score_type = $("#score_type").val();
        
        // Validate the form
        var isValid = $("#resultsByPaper").valid();
        var marklist=0;
        // Check if the form is valid
        if (isValid) {
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('department_id', department_id);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('subject_id', subject_id);
            formData.append('exam_id', exam_id);
            formData.append('exam_date', exam_date);
            formData.append('score_type', score_type);
            formData.append('file', $('input[type=file]')[0].files[0]);
            formData.append('academic_session_id', academic_session_id);
            //$("#overlay").fadeIn(300);
            $.ajax({
                url: newRoute,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                Accept: 'application/json',
                success: function (data) {
                    if(data.result=='error')
                    {
                        toastr.error(data.message);
                    }
                    if(data.result=='Success')
                    {
                        
                        
                        $('#exammark_preview').show();
                        appendDataToTable(data.studentlist,data.headerdata);
                        $.each(data.headerdata, function(index, item) {
                            if(item=='Wrong')
                            {
                                marklist++;
                            }
                          
                        });
                        if(marklist==0)
                        {
                            toastr.success(data.message);
                            $('.studentmark').show();
                            appendDataToTablemark(data.studentmarks,data.studentlist);
                            
                        }
                        else
                        {
                            $('.studentmark').hide();
                            toastr.error("Check Your Excel datas");
                        }
                        
                    }
                }
            });
        }
    });
    function appendDataToTable(data1,data2) {
        var headerdata1 = $("#headerdata1");
        // Clear existing table rows
        headerdata1.empty();
        // Loop through data and append rows to table
       
        $.each(data1, function(index, item) {
            if(index<7)
                {
                var btncolor= (data2[index] =='Matched')?'success':'danger';
                var row = "<tr ><td>" + item[0] + "</td><td>" + item[1] + "</td><td class='btn btn-" + btncolor + "'>" + data2[index] + "</td></tr>";
                headerdata1.append(row);
                }
          
        });
        
    }
    function appendDataToTablemark(data1,data2) {
        var markdatas = $("#markdatas");
        // Clear existing table rows
        markdatas.empty();
        // Loop through data and append rows to table
        
        $.each(data1, function(index, item) {
            if(item!='')
            {
                var btncolor= (item['oldmark']['mark_id'] !='')?'warning':'success';
                var markbtn=(item['oldmark']['mark'] !='' && item['oldmark']['mark']!=item[3])?'danger':'success';
                var markmsg=(item['oldmark']['mark'] !='')?'Previous Data : '+item['oldmark']['mark'] :'New Data';
                
               
                
                var memobtn=(item['oldmark']['memo'] !='' && item['oldmark']['memo']!=item[5])?'danger':'success';
                var memomsg=(item['oldmark']['memo'] !='')?'Previous Data : '+item['oldmark']['memo'] :'New Data';
                var row = "<tr><td>" + item[0] + "</td><td class='btn btn-" + btncolor + "'>" + item[1] + "</td><td>" + item[2] + "</td><td class='text-" + markbtn + "' title='" + markmsg + "'>" + item[3] + "</td>  </tr>";
                //var row = "<tr><td>" + item[0] + "</td><td class='btn btn-" + btncolor + "'>" + item[1] + "</td><td>" + item[2] + "</td><td class='text-" + markbtn + "' title='" + markmsg + "'>" + mark + "</td><td class='text-" + attbtn + "'  title='" + attmsg + "' >" + item[4] + "</td><td class='text-" + memobtn + "' title='" + memomsg + "' >" + item[5] + "</td></tr>";
                markdatas.append(row);
            }            
        
        });
       
        
    }
      
});
});