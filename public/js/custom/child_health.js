$(function () {

    

    $('#employeeReportDate').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        // autoclose: true,
        yearRange: "-100:+50", // last hundred years
        onClose: function (dateText, inst) {
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });

    $("#employeeReportDate").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });
    var student_id = [];
    // skip_mother_details
    
    $(document).on('change', '#selectAllchkbox', function () {
        
		var isChecked = $(this).prop('checked');
		$(".childCheckbox").attr('checked', isChecked);
    });
    $(document).on('change', '.childCheckbox', function () {
        var id = $(this).data('student-id');
        if ($(this).is(":checked")) {
            student_id.push(id);
        }else{
            student_id = student_id.filter(function(item) {
                return item !== id
            })
            
        }
        console.log('student_id',student_id)
        $("#student_id_pdf").val(student_id);
    });
    
    // downlad childhealth 
    // $(document).on('click', '#downloadChidlHealth', function () {
    //     var student_id = $(this).data('id');
    //     console.log('ste',student_id)
    //     $.post(childHealthReport,
    //         {
    //             branch_id: branchID,
    //             student_id: student_id
    //         }, function (res) {
    //             if (res.code == 200) {
    //                 console.log('ste')
    //             }
    //         }, 'json');
    // });
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
    $("#student").hide();
    
    // rules validation
    $("#StudentFilter").validate({
        rules: {
            session_id: "required",
        }
    });

    // get student list
    $('#StudentFilter').on('submit', function (e) {
        e.preventDefault();
        
        var StudentFilter = $("#StudentFilter").valid();
        if (StudentFilter === true) {
            var student_name = $('#student_name').val();
            var department_id = $('#department_id_filter').val();
            var class_id = $('#class_id').val();
            var section_id = $('#section_id').val();
            var session_id = $('#session_id').val();

            $('#student_name_pdf').val(student_name);
            $('#department_id_pdf').val(department_id);
            $('#class_id_pdf').val(class_id);
            $('#section_id_pdf').val(section_id);
            $('#session_id_pdf').val(session_id);

            var formData = {
                student_name: student_name,
                class_id: class_id,
                department_id: department_id,
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

        var table = $('#student-table').DataTable({
            processing: true,
            info: true,
            bDestroy: true,
            // dom: 'lBfrtip',
            dom: 'Blfrtip',

            // dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-6 col-md-6'B><'col-sm-4 col-md-4'f>>" +
            //     "<'row'<'col-sm-12'tr>>" +
            //     "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            // dom: 'C&gt;"clear"&lt;lfrtip',
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
                        d.class_id = formData.class_id,
                        d.section_id = formData.section_id,
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
                    data: '#',
                    name: '#',
                    orderable: false,
                    searchable: false
                },
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
                    "targets": 2,
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
                {
                    "targets": 0,
                    "className": "table-user",
                    "render": function (data, type, row, meta) {
                        var first_name = '<input type="checkbox" class="childCheckbox" data-student-id="'+row.id+'">';
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

    
    


});
