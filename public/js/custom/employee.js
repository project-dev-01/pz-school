$(function () {
    // joining date
    $("#joiningDate").datepicker({
        dateFormat: 'dd-mm-yy'
    });
    // emp DOB
    $("#empDOB").datepicker({
        dateFormat: 'dd-mm-yy'
    });
    // empDepartment
    // $("#empBranchName").on("change",function(){
    //     // alert("test");
    // });
    $('#empBranchName').on('change', function (e) {
        e.preventDefault();
        var branchId = $(this).val();
        
        var Selector = '#addEmployeeForm';
        $(Selector).find("#empDesignation").empty();
        $(Selector).find("#empDesignation").append('<option value="">Choose Designation</option>');
        $(Selector).find("#empDepartment").empty();
        $(Selector).find("#empDepartment").append('<option value="">Choose Department</option>');
        $.post(empDesignation, { branch_id: branchId, token: token }, function (res) {
            console.log('res',res)
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
    $("#addEmployeeForm").validate({
        rules: {
            role: "required",
            joining_date: "required",
            email: {
                required: true,
                email: true
            },
            designation: "required",
            department: "required",
            qualification: "required",

            name: "required",
            gender: "required",
            religion: "required",
            blood_group: "required",
            birthday: "required",
            mobile_no: "required",
            present_address: "required",
            permanent_address: "required",
            password: "required",
            confirm_password: "required",
            facebook_url: "required",
            twitter_url: "required",
            linkedin_url: "required"
        }
    });
    // save assign teacher
    $('#addEmployeeForm').on('submit', function(e){
        e.preventDefault();
        console.log('id',"chd")
        var employeeCheck = $("#addEmployeeForm").valid();
        if (employeeCheck === true) {
        var form = this;
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:new FormData(form),
                processData:false,
                dataType:'json',
                contentType:false,
                success: function(data){
                    if (data.code == 200) {
                        $('.addEmployeeForm').find('form')[0].reset();
                        toastr.success(data.message);
                        window.location.href = employeeShow;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
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