$(function () {
    // joining date
    $("#joiningDate").datepicker({
        dateFormat: 'dd-mm-yy',
        autoclose: true
    });
    // emp DOB
    $("#empDOB").datepicker({
        dateFormat: 'dd-mm-yy',
        autoclose: true
    });
    // skipped employee bank details
    $("#skip_bank_details").on("change", function () {
        // alert($(this).is(":checked"));
        if ($(this).is(":checked")) {
            $("#bank_details_form").hide("slow");
        } else {
            $("#bank_details_form").show("slow");
        }
    });
    // reverse dob
    function convertDigitIn(str){
        return str.split('-').reverse().join('-');
     }
    // empDepartment
    $('#empBranchName').on('change', function (e) {
        e.preventDefault();
        var branchId = $(this).val();

        var Selector = '#addEmployeeForm';
        $(Selector).find("#empDesignation").empty();
        $(Selector).find("#empDesignation").append('<option value="">Choose Designation</option>');
        $(Selector).find("#empDepartment").empty();
        $(Selector).find("#empDepartment").append('<option value="">Choose Department</option>');
        $.post(empDesignation, { branch_id: branchId, token: token }, function (res) {
            console.log('res', res)
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $(Selector).find("#empDesignation").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
        $.post(empDepartment, { branch_id: branchId, token: token }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $(Selector).find("#empDepartment").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });

    // rules validation
    // $("#addEmployeeForm").validate({
    //     rules: {
    //         role_id: "required",
    //         joining_date: "required",
    //         email: {
    //             required: true,
    //             email: true
    //         },
    //         designation_id: "required",
    //         department_id: "required",
    //         qualification: "required",

    //         name: "required",
    //         gender: "required",
    //         religion: "required",
    //         blood_group: "required",
    //         birthday: "required",
    //         mobile_no: "required",
    //         present_address: "required",
    //         permanent_address: "required",
    //         // password : {
    //         //     minlength : 5
    //         // },
    //         // confirm_password : {
    //         //     minlength : 5,
    //         //     equalTo : "#password"
    //         // }
    //         password: {
    //             required: true,
    //             minlength: 5
    //         },
    //         confirm_password: {
    //             required: true,
    //             minlength: 5
    //         },
    //         bank_name:"required",
    //         holder_name:"required",
    //         bank_branch:"required",
    //         bank_address:"required",
    //         ifsc_code:"required",
    //         account_no:"required"
    //     }
    // });
    // save assign teacher
    $('#addEmployeeForm').on('submit', function (e) {
        e.preventDefault();
        console.log('id', "chd")
        // if($("#skip_bank_details").prop('checked') == false){
        //     console.log("fdfs")
        //     $("#addEmployeeForm").validate({
        //         rules: {
        //             bank_name: "required",
        //             holder_name: "required",
        //             bank_branch: "required",
        //             bank_address: "required",
        //             ifsc_code: "required",
        //             account_no: "required",
        //         }
        //     });
        // }
        // var employeeCheck = $("#addEmployeeForm").valid();
        // if (employeeCheck === true) {
            var skip_bank_details = 1;
            if($("#skip_bank_details").prop('checked') == true){
                skip_bank_details = 0;
            }

            var formData = new FormData();
            formData.append('role_id', $('#role_id').val());
            formData.append('joining_date', convertDigitIn($('#joiningDate').val()));
            formData.append('designation_id', $('#empDesignation').val());
            formData.append('department_id', $('#empDepartment').val());
            formData.append('qualification', $('#empQuatification').val());
            formData.append('name', $('#userName').val());
            formData.append('gender', $('#gender').val());
            formData.append('religion', $('#religion').val());
            formData.append('blood_group', $('#blood_group').val());
            formData.append('birthday', convertDigitIn($('#empDOB').val()));
            formData.append('mobile_no', $('#mobile_no').val());
            formData.append('present_address', $('#present_address').val());
            formData.append('permanent_address', $('#permanent_address').val());
            formData.append('email', $('#email').val());
            formData.append('password', $('#password').val());
            formData.append('confirm_password', $('#confirm_password').val());
            formData.append('facebook_url', $('#facebook_url').val());
            formData.append('twitter_url', $('#twitter_url').val());
            formData.append('linkedin_url', $('#linkedin_url').val());
            formData.append('skip_bank_details', skip_bank_details);
            formData.append('bank_name', $('#bank_name').val());
            formData.append('holder_name', $('#holder_name').val());
            formData.append('bank_branch', $('#bank_branch').val());
            formData.append('bank_address', $('#bank_address').val());
            formData.append('ifsc_code', $('#ifsc_code').val());
            formData.append('account_no', $('#account_no').val());

            // Attach file
            formData.append('photo', $('input[type=file]')[0].files[0]);
            // Display the key/value pairs
            for (var pair of formData.entries()) {
                console.log(pair[0] + ', ' + pair[1]);
            }
            // return false;


            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('.addEmployeeForm').find('form')[0].reset();
                        toastr.success(data.message);
                        window.location.href = employeeListShow;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        // }
    });

    // get all Employee table
    var table = $('#employee-table').DataTable({
        processing: true,
        info: true,
        ajax: employeeList,
        "pageLength": 5,
        "aLengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'branch_name',
                name: 'branch_name'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'mobile_no',
                name: 'mobile_no'
            },
            {
                data: 'birthday',
                name: 'birthday'
            },
            {
                data: 'joining_date',
                name: 'joining_date'
            },
            {
                data: 'department_name',
                name: 'department_name'
            },
            {
                data: 'designation_name',
                name: 'designation_name'
            },
            {
                data: 'present_address',
                name: 'present_address'
            },
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false
            },
        ]
    }).on('draw', function () {
    });
});