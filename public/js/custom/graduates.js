$(function () {

    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#editadmission';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    $("#department_id_filter").on('change', function (e) {
        e.preventDefault();
        var Selector = '#StudentFilter';
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
    $(".number_validation").keypress(function () {
        var regex = new RegExp("^[0-9-+]");
        var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
    $("#student").hide();
    var father_id = $("#father_id").val();
    if (father_id) {
        father(father_id);
    }

    var mother_id = $("#mother_id").val();
    if (mother_id) {
        mother(mother_id);
    }

    var guardian_id = $("#guardian_id").val();
    if (guardian_id) {
        guardian(guardian_id);
    }

    $("#admission_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-3:+6", // last hundred years
    });
    
    $("#passport_expiry_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-3:+6", // last hundred years
    });

    $("#visa_expiry_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-3:+6", // last hundred years
    });
    
    $('#passport_photo').change(function() {
        // var i = $(this).prev('label').clone();
        var file = $('#passport_photo')[0].files[0];
        if(file.size > 2097152) {
            $('#passport_photo_name').text("File greater than 2Mb");
            $("#passport_photo_name").addClass("error");
            $('#passport_photo').val('');
        } else {
            $("#passport_photo_name").removeClass("error");
            $('#passport_photo_name').text(file.name);
        }
    });
    
    $('#visa_photo').change(function() {
        // var i = $(this).prev('label').clone();
        var file = $('#visa_photo')[0].files[0];
        if(file.size > 2097152) {
            $('#visa_photo_name').text("File greater than 2Mb");
            $("#visa_photo_name").addClass("error");
            $('#visa_photo').val('');
        } else {
            $("#visa_photo_name").removeClass("error");
            $('#visa_photo_name').text(file.name);
        }
    });
    $("#dob").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-60:+1", // last hundred years
        maxDate: 0
    });

    $("#StudentFilter").validate({
        rules: {
            department_id_filter: "required",
            class_id: "required",
            section_id: "required",
            session_id: "required"
        }
    });
    // get student list
    $('#StudentFilter').on('submit', function (e) {
        e.preventDefault();
        var StudentFilter = $("#StudentFilter").valid();
        if (StudentFilter === true) {
            var department_id = $('#department_id_filter').val();
            var student_name = $('#student_name').val();
            var class_id = $('#class_id').val();
            var section_id = $('#section_id').val();
            var session_id = $('#session_id').val();

            var classObj = {
                department_id:department_id,
                student_name: student_name,
                classID: class_id,
                sectionID: section_id,
                sessionID: session_id,
                userID: userID,
            };
            //setLocalStorageForStudentList(classObj);

            var formData = {
                student_name: student_name,
                department_id: department_id,
                class_id: class_id,
                section_id: section_id,
                session_id: session_id,
            };
            getStudentList(formData);
        } else {
            $("#student").hide("slow");
        }

    });
    function getStudentList(formData) {
        $("#student").show("slow");
        setTimeout(function () {
            $('.btn-danger').removeClass('d-none');
            }, 5000);   
        var table = $('#student-table').DataTable({
            processing: true,
            info: true,
            bDestroy: true,
            // dom: 'lBfrtip',
            dom: 'Blfrtip',

            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "language": {
            
            "emptyTable": no_data_available,
            "infoFiltered": filter_from_total_entries,
            "zeroRecords": no_matching_records_found,
            "infoEmpty": showing_zero_entries,
            "info": showing_entries,
            "lengthMenu": show_entries,
            "search": datatable_search,
            "paginate": {
                "next": next,
                "previous": previous
            },
        },
            // exportOptions: { rows: ':visible' },
            serverSide: true,
            ajax: {
                url: studentList,
                data: function (d) {
                    d.student_name = formData.student_name,
                    d.department_id = formData.department_id,
                    d.class_id = formData.class_id,
                    d.section_id = formData.section_id,
                    d.session_id = formData.session_id,
                    d.session_id = formData.session_id
                }
            },
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
                }
                ,
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'register_no',
                    name: 'register_no'
                },
                {
                    data: 'roll_no',
                    name: 'roll_no'
                },
                {
                    data: 'gender',
                    name: 'gender'
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
                        var currentImg = studentImg + row.photo;
                        // var existUrl = UrlExists(currentImg);
                        // console.log(currentImg);
                        var img = (row.photo != null) ? currentImg : defaultImg;
                        var first_name = '<img src="' + img + '" class="mr-2 rounded-circle">' +
                            '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                        return first_name;
                    }
                },
            ]
        });
        
    }

    $("#class_id").on('change', function (e) {
        e.preventDefault();
        var class_id = $(this).val();
        $("#section_id").empty();
        $("#section_id").append('<option value="">' + select_class + '</option>');
        $.post(sectionByClass, { class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });


    $("#editadmission").validate({
        rules: {
            session_id: "required",
            year: "required",
            txt_regiter_no: "required",
            txt_emailid: {
                required: true,
                email: true
            },
            txt_roll_no: "required",
            admission_date: "required",
            classnames: "required",
            department_id: "required",
            class_id: "required",
            section_id: "required",
            // categy: "required",
            fname: "required",
            txt_mobile_no: "required",
            present_address: "required",
            // txt_pwd: {
            //     minlength: 6
            // },
            // txt_retype_pwd: {
            //     minlength: 6,
            //     equalTo: "txt_pwd"
            // },  
            password: {
                // required: $("#password").val().length > 0,
                minlength: 6
            },
            confirm_password: {
                // required: $("#confirm_password").val().length > 0,
                minlength: 6,
                equalTo: "#password"
            }
        }
    });

    $('#editadmission').on('submit', function (e) {
        e.preventDefault();
        var admissionCheck = $("#editadmission").valid();
        if (admissionCheck === true) {
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        toastr.success(data.message);
                        window.location.href = indexStudent;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    
});
