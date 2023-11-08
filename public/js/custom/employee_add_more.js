$(document).ready(function () {
    console.log("emp_department_list");
    console.log(emp_department_list);
    console.log("emp_designation_list");
    console.log(emp_designation_list);
    console.log("employee_type_list");
    console.log(employee_type_list);
    // designation
    $(".designationDatepicker").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
    });
    // department add start
    var department_increment = 1;
    $("#add_department").click(function () {
        department_increment++;
        var departmentAppend = '<tr id="row_department' + department_increment + '">' +
            '<td>' +
            '<select class="form-control" name="department[]">' +
            '<option value="">' + select_department + '</option>';
        emp_department_list.forEach(function (value, index) {
            departmentAppend += '<option value="' + value.id + '">' + value.name + '</option>';
        });
        departmentAppend += '</select>' +
            '</td>' +
            '<td>' +
            '<div class="input-group input-group-merge">' +
            '<div class="input-group-prepend">' +
            '<div class="input-group-text">' +
            '<span class="fas fa-calendar"></span>' +
            '</div>' +
            '</div>' +
            '<input type="text" class="form-control designationDatepicker" name="department_start[]" placeholder="' + yyyy_mm_dd + '">' +
            '</div>' +
            '</td>' +
            '<td>' +
            '<div class="input-group input-group-merge">' +
            '<div class="input-group-prepend">' +
            '<div class="input-group-text">' +
            '<span class="fas fa-calendar"></span>' +
            '</div>' +
            '</div>' +
            '<input type="text" class="form-control designationDatepicker" name="department_end[]" placeholder="' + yyyy_mm_dd + '">' +
            '</div>' +
            '</td>' +
            '<td>' +
            '<button type="button" name="remove_department" id="' + department_increment + '" class="btn btn-danger btn_remove_department">X</button>' +
            '</td>' +
            '</tr>';

        var appendHtml = $('#dynamic_field_one').append(departmentAppend);
        // Initialize datepicker for the new field
        appendHtml.find('.designationDatepicker').datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            autoclose: true,
            yearRange: "-100:+50", // last hundred years
        });

    });

    $(document).on('click', '.btn_remove_department', function () {
        var button_id = $(this).attr("id");
        $('#row_department' + button_id + '').remove();
    });
    // department add end
    // designation add start
    var designation_increment = 1;
    $("#add_designation").click(function () {
        designation_increment++;
        var designationAppend = '<tr id="row_designation' + designation_increment + '">' +
            '<td>' +
            '<select class="form-control" name="designation[]">' +
            '<option value="">' + select_designation + '</option>';
        emp_designation_list.forEach(function (value, index) {
            designationAppend += '<option value="' + value.id + '">' + value.name + '</option>';
        });
        designationAppend += '</select>' +
            '</td>' +
            '<td>' +
            '<div class="input-group input-group-merge">' +
            '<div class="input-group-prepend">' +
            '<div class="input-group-text">' +
            '<span class="fas fa-calendar"></span>' +
            '</div>' +
            '</div>' +
            '<input type="text" class="form-control designationDatepicker" name="designation_start[]" placeholder="' + yyyy_mm_dd + '">' +
            '</div>' +
            '</td>' +
            '<td>' +
            '<div class="input-group input-group-merge">' +
            '<div class="input-group-prepend">' +
            '<div class="input-group-text">' +
            '<span class="fas fa-calendar"></span>' +
            '</div>' +
            '</div>' +
            '<input type="text" class="form-control designationDatepicker" name="designation_end[]" placeholder="' + yyyy_mm_dd + '">' +
            '</div>' +
            '</td>' +
            '<td>' +
            '<button type="button" name="remove_designation" id="' + designation_increment + '" class="btn btn-danger btn_remove_designation">X</button>' +
            '</td>' +
            '</tr>';

        var appendDesHtml = $('#dynamic_field_two').append(designationAppend);
        // Initialize datepicker for the new field
        appendDesHtml.find('.designationDatepicker').datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            autoclose: true,
            yearRange: "-100:+50", // last hundred years
        });

    });

    $(document).on('click', '.btn_remove_designation', function () {
        var button_id = $(this).attr("id");
        $('#row_designation' + button_id + '').remove();
    });
    // designation add end
    // employee type add start
    var emp_type_increment = 1;
    $("#add_employee_type").click(function () {
        emp_type_increment++;
        var empTypeAppend = '<tr id="row_emp_type' + emp_type_increment + '">' +
            '<td>' +
            '<select class="form-control" name="employee_type[]">' +
            '<option value="">' + select_employee_type + '</option>';
        employee_type_list.forEach(function (value, index) {
            empTypeAppend += '<option value="' + value.id + '">' + value.name + '</option>';
        });
        empTypeAppend += '</select>' +
            '</td>' +
            '<td>' +
            '<div class="input-group input-group-merge">' +
            '<div class="input-group-prepend">' +
            '<div class="input-group-text">' +
            '<span class="fas fa-calendar"></span>' +
            '</div>' +
            '</div>' +
            '<input type="text" class="form-control designationDatepicker" name="employee_type_start[]" placeholder="' + yyyy_mm_dd + '">' +
            '</div>' +
            '</td>' +
            '<td>' +
            '<div class="input-group input-group-merge">' +
            '<div class="input-group-prepend">' +
            '<div class="input-group-text">' +
            '<span class="fas fa-calendar"></span>' +
            '</div>' +
            '</div>' +
            '<input type="text" class="form-control designationDatepicker" name="employee_type_end[]" placeholder="' + yyyy_mm_dd + '">' +
            '</div>' +
            '</td>' +
            '<td>' +
            '<button type="button" name="remove_emp_type" id="' + emp_type_increment + '" class="btn btn-danger btn_remove_emp_type">X</button>' +
            '</td>' +
            '</tr>';

        var appendEmpTypeHtml = $('#dynamic_field_three').append(empTypeAppend);
        // Initialize datepicker for the new field
        appendEmpTypeHtml.find('.designationDatepicker').datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            autoclose: true,
            yearRange: "-100:+50", // last hundred years
        });

    });

    $(document).on('click', '.btn_remove_emp_type', function () {
        var button_id = $(this).attr("id");
        $('#row_emp_type' + button_id + '').remove();
    });
    // employee type add end
    // $("#submit").on('click', function (event) {
    //     var formdata = $("#add_name").serialize();
    //     console.log(formdata);

    //     event.preventDefault()

    //     $.ajax({
    //         url: "action.php",
    //         type: "POST",
    //         data: formdata,
    //         cache: false,
    //         success: function (result) {
    //             alert(result);
    //             $("#add_name")[0].reset();
    //         }
    //     });

    // });
});