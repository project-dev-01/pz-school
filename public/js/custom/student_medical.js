$(function () {
    
    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#addadmission';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    function classAllocation(department_id, Selector, classID) {
        $(Selector).find('select[name="class_id"]').empty();
        $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
        $(Selector).find('select[name="section_id"]').empty();
        $(Selector).find('select[name="section_id"]').append('<option value="">' + select_class + '</option>');
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
    $('#txt_nric').mask("000000-00-0000", { reverse: true });
    // nric validation end
    $(".number_validation").keypress(function (event) {
        console.log(123)
        var regex = new RegExp("^[0-9-+]");
        var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });

    $("#date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-3:+6", // last hundred years
    });
    
    // rules validation
    $("#addstudentmedical").validate({
        rules: {
           
            normal_temp: "required",
            hospital_name: "required",
            doctor_name: "required",
            company_name: "required"
            
        }
    });
  
    

    $('#addstudentmedical').on('submit', function (e) {
        console.log("cdcds");
        e.preventDefault();
        var studentMedicalCheck = $("#addstudentmedical").valid();
        
        if (studentMedicalCheck === true) {
            var form = this;
            $('#loader').show();
            console.log(form);
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    console.log(data);
                    $('#loader').hide();
                    if (data.code == 200) {
                        toastr.success(data.message);
                         setTimeout(function() {
                        location.reload();
                    }, 2000); // 2000 milliseconds = 2 seconds
                    } else {
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                $('#loader').hide();
                    if (err.responseJSON && err.responseJSON.data && err.responseJSON.data.error) {
                        toastr.error(err.responseJSON.data.error);
                    } else {
                        toastr.error('Something went wrong');
                    }
                }
                
            });
        }
    });

   
    $("#class_id").on('change', function (e) {
        e.preventDefault();
        var class_id = $(this).val();
        getSectionByClass(class_id)
    });

    function getSectionByClass(class_id) {
        $("#section_id").empty();
        $("#section_id").append('<option value="">' + select_class + '</option>');
        $.post(sectionByClass, { class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    }

  
});