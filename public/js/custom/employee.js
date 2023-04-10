$(function () {

    $(".number_validation").keypress(function(){
        console.log(123)
        var regex = new RegExp("^[0-9-+]");
        var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
    // joining date
    $("#joiningDate").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
    });
    // emp DOB
    $("#empDOB").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred year
        maxDate: 0
    });
    //
    function selectRefresh() {
        $('.main .select2').select2({
            //-^^^^^^^^--- update here
            tags: true,
            placeholder: "Select an Option",
            allowClear: true,
            width: '100%'
        });
    }
    $('.add').click(function () {
        $('.main').append($('.new-wrap').html());
        selectRefresh();
    });
    selectRefresh();

    // skipped employee bank details
    $("#skip_bank_details").on("change", function () {
        // alert($(this).is(":checked"));
        if ($(this).is(":checked")) {
            $("#bank_details_form").hide("slow");
        } else {
            $("#bank_details_form").show("slow");
        }
    });
    // skip_medical_history
    $("#skip_medical_history").on("change", function () {
        if ($(this).is(":checked")) {
            $("#medical_history_form").hide("slow");
        } else {
            $("#medical_history_form").show("slow");
        }
    });
    // 
    $(".shortNameChange").on("change", function () {
        var firstName = $("#firstName").val();
        var lastName = $("#lastName").val();
        var nameString = firstName + " " + lastName;
        var matches = nameString.match(/\b(\w)/g); // array
        var shortname = matches.join(''); // join
        console.log(shortname)
        $("#shortName").val(shortname.toUpperCase());
    });
    // change file
    // $("#photo").on("change", function () {
    //     var file = $("input[type=file]").get(0).files[0];
    //     if (file) {
    //         var reader = new FileReader();
    //         reader.onload = function () {
    //             $("#previewImg").attr("src", reader.result);
    //         }
    //         reader.readAsDataURL(file);
    //     }
    // });
    // $('#photo').ijaboCropTool({
    //     preview: '.image-previewer',
    //     setRatio: 1,
    //     allowedExtensions: ['jpg', 'jpeg', 'png'],
    //     processUrl: ijaboCropTool,
    //     withCSRF: ['<?= csrf_token() ?>', '<?= csrf_hash() ?>'],
    //     onSuccess: function (message, element, status) {
    //         alert(message);
    //     },
    //     onError: function (message, element, status) {
    //         alert(message);
    //     }
    // });
    $('.file-input').change(function () {
        var curElement = $('.image');
        console.log(curElement);
        var reader = new FileReader();

        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            curElement.attr('src', e.target.result);
        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });

    // reverse dob
    function convertDigitIn(str) {
        return str.split('-').reverse().join('-');
    }
    // empDepartment
    $('#empBranchName').on('change', function (e) {
        e.preventDefault();
        var branchId = $(this).val();

        var Selector = '#addEmployeeForm';
        $(Selector).find("#empDesignation").empty();
        $(Selector).find("#empDesignation").append('<option value="">'+select_designation+'</option>');
        $(Selector).find("#empDepartment").empty();
        $(Selector).find("#empDepartment").append('<option value="">'+select_department+'</option>');
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
    $("#addEmployeeForm").validate({
        rules: {
            first_name: "required",
            role_id: "required",
            // joining_date: "required",
            email: {
                required: true,
                email: true
            },
            // designation_id: "required",
            // department_id: "required",
            // qualification: "required",
            // race: "required",
            // name: "required",
            // gender: "required",
            // religion: "required",
            // blood_group: "required",
            // birthday: "required",
            // mobile_no: "required",
            // present_address: "required",
            // permanent_address: "required",
            password: {
                required: true,
                minlength: 5
            },
            confirm_password: {
                required: true,
                minlength: 5,
                equalTo: "#password"
            },
            bank_name: "required",
            holder_name: "required",
            bank_branch: "required",
            bank_address: "required",
            ifsc_code: "required",
            account_no: "required",
            // city: "required",
            // state: "required",
            // country: "required",
            // post_code: "required"
        }
    });
    // save employee
    $('#addEmployeeForm').on('submit', function (e) {
        e.preventDefault();
        var employeeCheck = $("#addEmployeeForm").valid();
        if (employeeCheck === true) {
            var skip_bank_details = 1;
            if ($("#skip_bank_details").prop('checked') == true) {
                skip_bank_details = 0;
            }
            var skip_medical_history = 1;
            if ($("#skip_medical_history").prop('checked') == true) {
                skip_medical_history = 0;
            }
            var status = $('#status:checked').val();
            var formData = new FormData();
            formData.append('role_id', $('#role_id').val());
            formData.append('joining_date', convertDigitIn($('#joiningDate').val()));
            formData.append('designation_id', $('#empDesignation').val());
            formData.append('department_id', $('#empDepartment').val());
            // formData.append('name', $('#userName').val());
            formData.append('first_name', $('#firstName').val());
            formData.append('last_name', $('#lastName').val());
            formData.append('short_name', $('#shortName').val());
            formData.append('employment_status', $('#employment_status').val());
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
            formData.append('salary_grade', $('#salaryGrade').val());
            formData.append('staff_position', $('#staffPosition').val());
            formData.append('staff_category', $('#staffCategory').val());
            formData.append('nric_number', $('#nricNumber').val());
            formData.append('passport', $('#Passport').val());
            formData.append('staff_qualification_id', $('#staffQualification').val());
            formData.append('stream_type_id', $('#streamType').val());
            formData.append('race', $('#addRace').val());
            formData.append('skip_medical_history', skip_medical_history);
            formData.append('height', $('#height').val());
            formData.append('weight', $('#weight').val());
            formData.append('allergy', $('#allergy').val());
            formData.append('city', $('#City').val());
            formData.append('state', $('#State').val());
            formData.append('country', $('#Country').val());
            formData.append('post_code', $('#postCode').val());
            formData.append('status', status);
            // Attach file
            formData.append('photo', $('input[type=file]')[0].files[0]);

            // for (var pair of formData.entries()) {
            //     console.log(pair[0] + ', ' + pair[1]);
            // }
            // return false;
            $("#overlay").fadeIn(300);
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
                        $("#overlay").fadeOut(300);
                        $('.addEmployeeForm').find('form')[0].reset();
                        toastr.success(data.message);
                        setTimeout(function () {
                            window.location.href = employeeListShow;
                        }, 1000);
                    } else {
                        $("#overlay").fadeOut(300);
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    $("#overlay").fadeOut(300);
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });

    // rules validation
    $("#editEmployeeForm").validate({
        rules: {
            role_id: "required",
            // joining_date: "required",
            email: {
                required: true,
                email: true
            },
            // designation_id: "required",
            // department_id: "required",
            // qualification: "required",
            // race: "required",
            // name: "required",
            // gender: "required",
            // religion: "required",
            // blood_group: "required",
            // birthday: "required",
            // mobile_no: "required",
            // present_address: "required",
            // permanent_address: "required",
            // password: {
            //     required: true,
            //     minlength: 5
            // },
            // confirm_password: {
            //     required: true,
            //     minlength: 5,
            //     equalTo: "#password"
            // },
            bank_name: "required",
            holder_name: "required",
            bank_branch: "required",
            bank_address: "required",
            ifsc_code: "required",
            account_no: "required",
            // city: "required",
            // state: "required",
            // country: "required",
            // post_code: "required"
        }

    });
    // edit Employee
    $('#editEmployeeForm').on('submit', function (e) {
        e.preventDefault();
        var employeeCheck = $("#editEmployeeForm").valid();
        if (employeeCheck === true) {
            var skip_bank_details = 1;
            if ($("#skip_bank_details").prop('checked') == true) {
                skip_bank_details = 0;
            }
            var skip_medical_history = 1;
            if ($("#skip_medical_history").prop('checked') == true) {
                skip_medical_history = 0;
            }
            var status = $('#edit_status:checked').val();
            var formData = new FormData();
            formData.append('id', $('#id').val());
            formData.append('role_id', $('#role_id').val());
            formData.append('joining_date', convertDigitIn($('#joiningDate').val()));
            formData.append('designation_id', $('#empDesignation').val());
            formData.append('department_id', $('#empDepartment').val());
            // formData.append('name', $('#userName').val());
            formData.append('first_name', $('#firstName').val());
            formData.append('last_name', $('#lastName').val());
            formData.append('short_name', $('#shortName').val());
            formData.append('employment_status', $('#employment_status').val());

            formData.append('gender', $('#gender').val());
            formData.append('religion', $('#religion').val());
            formData.append('blood_group', $('#blood_group').val());
            formData.append('birthday', convertDigitIn($('#empDOB').val()));
            formData.append('mobile_no', $('#mobile_no').val());
            formData.append('email', $('#email').val());
            formData.append('password', $('#password').val());
            formData.append('role_user_id', $('#role_user_id').val());
            formData.append('present_address', $('#present_address').val());
            formData.append('permanent_address', $('#permanent_address').val());
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
            formData.append('salary_grade', $('#salaryGrade').val());
            formData.append('staff_position', $('#staffPosition').val());
            formData.append('staff_category', $('#staffCategory').val());
            formData.append('nric_number', $('#nricNumber').val());
            formData.append('passport', $('#Passport').val());
            formData.append('staff_qualification_id', $('#staffQualification').val());
            formData.append('stream_type_id', $('#streamType').val());
            formData.append('race', $('#addRace').val());
            formData.append('old_photo', $('#oldPhoto').val());
            formData.append('skip_medical_history', skip_medical_history);
            formData.append('height', $('#height').val());
            formData.append('weight', $('#weight').val());
            formData.append('allergy', $('#allergy').val());
            formData.append('city', $('#City').val());
            formData.append('state', $('#State').val());
            formData.append('country', $('#Country').val());
            formData.append('post_code', $('#postCode').val());
            formData.append('status', status);
            // Attach file
            formData.append('photo', $('input[type=file]')[0].files[0]);

            // formData.append('photo', $('input[type=file]')[0].files[0]);
            // Attach file
            // formData.append('photo', $('input[type=file]')[0].files[0]);
            $("#overlay").fadeIn(300);
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
                        $("#overlay").fadeOut(300);
                        $('.editEmployeeForm').find('form')[0].reset();
                        toastr.success(data.message);
                        setTimeout(function () {
                            window.location.href = employeeListShow;
                        }, 1000);
                    } else {
                        $("#overlay").fadeOut(300);
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    $("#overlay").fadeOut(300);
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });

    // get all designation table for admin
    if (employeeList) {
        var table = $('#employee-table').DataTable({
            processing: true,
            info: true,
            // dom: 'lBfrtip',
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "language": {
                "infoEmpty": showing_zero_entries,
                "info": showing_entries,
                "lengthMenu": show_entries,
                "search": datatable_search,
                "paginate": {
                    "next": next,
                    "previous": previous
                },
            },
            buttons: [
                {
                    extend: 'csv',
                    text: downloadcsv,
                    extension: '.csv',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: downloadpdf,
                    extension: '.pdf',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }

                }
            ],
            ajax: employeeList,
            // "paging": false,
            // "searching": false,
            // language: {
            //     searchPlaceholder: "Search..."
            // },
            // "ordering": false,
            "pageLength": 10,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                {
                    searchable: false,
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'short_name',
                    name: 'short_name'
                },
                {
                    data: 'salary_grade',
                    name: 'salary_grade'
                },
                {
                    data: 'stream_type',
                    name: 'stream_type'
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
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                },
            ],
            columnDefs: [
                {
                    "targets": 1,
                    "className": "table-user",
                    "render": function (data, type, row, meta) {
                        var img = (row.photo != null) ? employeeImg + '/' + row.photo : defaultImg;
                        var first_name = '<img src="' + img + '" class="mr-2 rounded-circle">' +
                            '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                        return first_name;
                    }
                },
            ]
        }).on('draw', function () {
        });
    }

    // delete Employee
    $(document).on('click', '#deleteEmployeeBtn', function () {
        var id = $(this).data('id');
        var url = employeeDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>Delete</b> this Employee',
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes, Delete',
            cancelButtonColor: '#d33',
            confirmButtonColor: '#556ee6',
            width: 400,
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                $.post(url, {
                    id: id
                }, function (data) {
                    if (data.code == 200) {
                        $('#employee-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});