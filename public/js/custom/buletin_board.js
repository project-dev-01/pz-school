$(function () {

    $(document).ready(function () {
        // Get today's date
        var today = new Date();
        // Set tomorrow's date
        var tomorrow = new Date(today);
        tomorrow.setDate(today.getDate() + 1);
        $('#addBuletinModal').on('shown.bs.modal', function () {
            $("#date").flatpickr({
               // enableTime: !0,
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                minDate: tomorrow,
                container: '#addBuletinModal modal-body'
            });
            $("#end_date").flatpickr({
                // enableTime: !0,
                 enableTime: true,
                 dateFormat: "Y-m-d H:i",
                 minDate: tomorrow,
                 container: '#addBuletinModal modal-body'
             });
        });

        $('#editBuletinModal').on('shown.bs.modal', function () {
            $("#publish_dates").flatpickr({
                // enableTime: !0,
                enableTime: true,
                dateFormat: "Y-m-d H:i", // last hundred years
                minDate: tomorrow,
                container: '#editBuletinModal modal-body'
            });
            $("#publish_end_dates").flatpickr({
                // enableTime: !0,
                enableTime: true,
                minDate: tomorrow,
                dateFormat: "Y-m-d H:i", // last hundred years
                container: '#editBuletinModal modal-body'
            });
        });

    });
    buletinTable();

    $("#buletinForm").validate({
        rules: {
            title: "required",
            discription: "required",
            target_user: "required",
            file: "required",
        }
    });
    $('#buletinForm').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        var fileName = $("#file").val();
        var ext = fileName.split('.').pop().toLowerCase();

        if ($.inArray(ext, ['pdf']) === -1) {
            $(form).find('span.file_error').text('Please select a PDF file.');
            
        }
        if ($('#publish').is(":checked")) {
            var date = $("#date").val().trim(); // Trim to remove leading/trailing spaces
            if (date.length === 0) {
                $(form).find('span.date_error').text("Publish date is required.");
                return false;
            } else {
                $(form).find('span.date_error').text("");
            }
        }
           //Date validate
           var startDate = $("#date").val();
           if (endDate !== "" && startDate > endDate) {
            $(form).find('span.end_date_error').text("End Date should be greater than Start Date.");
            $("#end_date").val("");
            return false;
            } else {
                $(form).find('span.end_date_error').text("");
            }
        var eventCheck = $("#buletinForm").valid();
        if (eventCheck === true) {
            var form = this;
            var title = $("#title").val();
            var discription = $("#discription").val();
            var file = $('#file')[0].files[0];
            console.log(file);
            var publish = $("#publish").val();
            var add_to_dash = $("#add_to_dash").val();
            var date = $("#date").val();
            var endDate = $("#end_date").val();
            var class_id = $("#changeClassName").val();
            var section_id = $("#filtersectionID").val();
            var student_id = $("#student_id").val();
            var parent_id = $("#parent_id").val();
            var empDepartment = $("#empDepartment").val();
            var target_user = [];
            $('#target_user option').each(function(i) {
                if (this.selected == true) {
                    target_user.push(this.value);
                }
            });
            console.log(target_user);
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('title', title);
            formData.append('discription', discription);
            formData.append('target_user', target_user);
            formData.append('publish', publish);
            formData.append('add_to_dash', add_to_dash);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('student_id', student_id);
            formData.append('parent_id', parent_id);
            formData.append('empDepartment', empDepartment);
            formData.append('date', date);
            formData.append('endDate', endDate);
            formData.append('file', file);
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data:formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function () {
                    $(form).find('span.error-text').text('');
                },
                success: function (data) {
                    console.log(data)
                    if (data.code == 200) {
                        //$('#buletin-table').DataTable().ajax.reload(null, false);
                        $('.addBuletin').find('form')[0].reset();
                        window.location.href = bulletin;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    $(".add_class_name").on('change', function (e) {
        e.preventDefault();
        var Selector = '.buletinForm';
        var class_id = $(this).val();
        var sectionID = "";
        if (class_id) {
            sectionsAllocation(class_id, sectionID);
        }
    });
    function sectionsAllocation(class_id, sectionID)
    {
        $("#buletinForm").find("#filtersectionID").empty();
        $("#buletinForm").find("#filtersectionID").append('<option value="">'+select_class+'</option>');
        $.post(sectionByClassUrl, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#buletinForm").find("#filtersectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                    //console.log(val);
                });
                if (sectionID != '') {
                    $("#buletinForm").find('select[name="section_id"]').val(sectionID);
                }
            }
        }, 'json');
    }
    function sectionAllocation(class_id, Selector, sectionID) {
    
        $("#buletinEditForm").find("#filtersectionIDs").empty();
        $("#buletinEditForm").find("#filtersectionIDs").append('<option value="">'+select_class+'</option>');
        $.post(sectionByClassUrl, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#buletinEditForm").find("#filtersectionIDs").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                    //console.log(val);
                });
                if (sectionID != '') {
                    $("#buletinEditForm").find('select[name="section_ids"]').val(sectionID);
                }
            }
        }, 'json');
    }
    function parentAllocation(class_id, sectionID, parent_id) {
        $("#buletinEditForm").find("#parent_ids").empty();
        $("#buletinEditForm").find("#parent_ids").append('<option value="">Select Parent</option>');
        $.post(getParentList, { token: token, branch_id: branchID, class_id: class_id, section_id: sectionID }, function (res) {
            console.log(res);
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#parent_ids").append('<option value="' + val.id + '">' + val.parent_name + '</option>');
                });
                if (parent_id != '') {
                    $("#buletinEditForm").find('select[name="parent_ids"]').val(parent_id);
                }
            }
        }, 'json');

    }
    function studentAllocation(class_id, sectionID, student_id){
        $("#buletinEditForm").find("#student_ids").empty();
        $("#buletinEditForm").find("#student_ids").append('<option value="">'+select_student+'</option>');
        $.post(getStudentList, { token: token, branch_id: branchID, class_id: class_id, section_id: sectionID }, function (res) {
            console.log(res);
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#student_ids").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
                if (student_id != '') {
                    $("#buletinEditForm").find('select[name="student_ids"]').val(student_id);
                }
            }
        }, 'json');
    }
    $("#buletinEditForm").validate({
        rules: {
            rules: {
                titles: "required",
                discription: "required",
                target_user: "required",
            }
        }
    });
    $('#buletinEditForm').on('submit', function (e) {
        e.preventDefault();

        var eventCheck = $("#buletinEditForm").valid();
        if (eventCheck === true) {
            var id =  $('#id').val();
           // console.log(id);
            var title = $("#titles").val();
            var discription = $("#descriptions").val();
            var file = $('#files')[0].files[0];
            //console.log(file);
            var publish = $("#publishs").val();
            var date = $("#publish_dates").val();
            var publish_end_dates = $("#publish_end_dates").val();
            var target_user = [];
            $('#target_users option').each(function(i) {
                if (this.selected == true) {
                    target_user.push(this.value);
                }
            });
           // console.log(target_user);
            console.log($('#oldfile').text());
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('id', id);
            formData.append('title', title);
            formData.append('discription', discription);
            formData.append('target_user', target_user);
            formData.append('publish', publish);
            formData.append('date', date);
            formData.append('publish_end_dates',publish_end_dates);
            formData.append('oldfile', $('#oldfile').text());
            formData.append('file', file);
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function () {
                    $(form).find('span.error-text').text('');
                },
                success: function (data) {
                    console.log(data);
                    if (data.code == 0) {
                        $.each(data.error, function (prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        if (data.code == 200) {
                            $('#buletin-table').DataTable().ajax.reload(null, false);
                            window.location.href = bulletin;
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    function buletinTable() {
        $('#buletin-table').DataTable({
            processing: true,
            info: true,
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            //dom: 'lBfrtip',
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
            buttons: [
                {
                    extend: 'csv',
                    text: downloadcsv,
                    extension: '.csv',
                    charset: 'utf-8',
                    bom: true,
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: downloadpdf,
                    extension: '.pdf',
                    charset: 'utf-8',
                    bom: true,
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    },
                    customize: function (doc) {
                        doc.pageMargins = [50,50,50,50];
                        doc.defaultStyle.fontSize = 10;
                        doc.styles.tableHeader.fontSize = 12;
                        doc.styles.title.fontSize = 14;
                        // Remove spaces around page title
                        doc.content[0].text = doc.content[0].text.trim();
                        /*// Create a Header
                        doc['header']=(function(page, pages) {
                            return {
                                columns: [
                                    
                                    {
                                        // This is the right column
                                        bold: true,
                                        fontSize: 20,
                                        color: 'Blue',
                                        fillColor: '#fff',
                                        alignment: 'center',
                                        text: header_txt
                                    }
                                ],
                                margin:  [50, 15,0,0]
                            }
                        });*/
                        // Create a footer
                        
                        doc['footer']=(function(page, pages) {
                            return {
                                columns: [
                                    { alignment: 'left', text: [ footer_txt ],width:400} ,
                                    {
                                        // This is the right column
                                        alignment: 'right',
                                        text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }],
                                        width:100
    
                                    }
                                ],
                                margin: [50, 0,0,0]
                            }
                        });
                        
                    }

                }
            ],
            ajax: buletinBoardList,
            "pageLength": 10,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                //  {data:'id', name:'id'},
                // {
                //     data: 'checkbox',
                //     name: 'checkbox',
                //     orderable: false,
                //     searchable: false
                // },
                {
                    searchable: false,
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'discription',
                    name: 'discription'
                },
                {
                    data: 'file',
                    name: 'file'
                },
                {
                    data: 'target_user',
                    name: 'target_user'
                },
                {
                    data: 'publish_date',
                    name: 'publish_date'
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
    }


    // Publish Event 
    $(document).on('click', '#publishEventBtn', function () {
        var event_id = $(this).data('id');
        if ($(this).prop('checked') == true) {
            var value = 1;
            var text = "Publish";
        } else {
            var value = 0;
            var text = "UnPublish";
        }
        swal.fire({
            title: deleteTitle + '?',
            html: deleteHtml,
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: deletecancelButtonText,
            confirmButtonText: deleteconfirmButtonText,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#556ee6',
            width: 400,
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                $.post(eventPublish, { id: event_id, status: value }, function (data) {
                    if (data.code == 200) {
                        $('#buletin-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });


    $(document).on('click', '#viewBuletinBtn', function () {
        var buletin_id = $(this).data('id');
        $('.viewBuletin').find('span.error-text').text('');
        $.post(buletinBoardDetails, { id: buletin_id }, function (data) {
            console.log(data);
            $('.viewBuletin').find('.title').text(data.data.title);
            $('.viewBuletin').find('.file').text(data.data.file);
            $('.viewBuletin').find('.publish_date').text(data.data.publish_date);
           
            var targetUserValues = data.data.target_user.split(',');
            if (targetUserValues.includes('5')) {
                $('.viewBuletin').find('.target_user').html(data.data.name+"<br> Grade: " +data.data.grade_name+" <br> Class: " + data.data.section_name+" <br> Parent: " + data.data.parent_name);
              
            } else if (targetUserValues.includes('4')) {
                $('.viewBuletin').find('.target_user').html(data.data.name+"<br> Department: " +data.data.department_name);
            }else{
               
                $('.viewBuletin').find('.target_user').html(data.data.name+"<br> Grade: " +data.data.grade_name+" <br> Class: " + data.data.section_name+" <br> Student: "+ data.data.student_name);
                
            }
            
            $('.viewBuletin').find('.description').text(data.data.discription);
            $('.viewBuletin').modal('show');
        }, 'json');
    });

    // delete Event Type
    $(document).on('click', '#deleteBuletin_boardBtn', function () {
        var buletin_id = $(this).data('id');
        swal.fire({
            title: deleteTitle + '?',
            html: deleteHtml,
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: deletecancelButtonText,
            confirmButtonText: deleteconfirmButtonText,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#556ee6',
            width: 400,
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                $.post(buletinBoardDelete, { id: buletin_id }, function (data) {
                    if (data.code == 200) {
                        $('#buletin-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    $('#class').hide();  // Initially disable the multi-select
    $('#department').hide();
    $('#student').hide();
    $('#parentss').hide();
    $('#target_user').change(function () {
        var selectedOptions = $(this).val();

        if (selectedOptions && selectedOptions.includes('4') && selectedOptions.includes('5') && selectedOptions.includes('6')
        ) {
            // Hide class dropdown and show the other dropdown
            $('#class').show();
            $('#department').show();
            $('#student').show();
            $('#parentss').show();
        }else if (selectedOptions && selectedOptions.includes('4') && selectedOptions.includes('5')){
            $('#class').show();
            $('#department').show();
            $('#parentss').show();
            $('#student').hide();
        }else if (selectedOptions && selectedOptions.includes('5') && selectedOptions.includes('6')){
            $('#class').show();
            $('#student').show();
            $('#parentss').show();
            $('#department').hide();
        }else if (selectedOptions && selectedOptions.includes('4')) {
            // Hide the other dropdown and show class dropdown
            $('#department').show();
            $('#class').hide();
            $('#student').hide();
            $('#parentss').hide();
        }else if (selectedOptions && selectedOptions.includes('5')) {
            // Hide the other dropdown and show class dropdown
            $('#department').hide();
            $('#class').show();
            $('#student').hide();
             $('#parentss').show();
        }else if (selectedOptions && selectedOptions.includes('6')) {
            // Hide the other dropdown and show class dropdown
            $('#department').hide();
            $('#class').show();
            $('#student').show();
            $('#parentss').hide();
        }else {
            // Show class dropdown and hide the other dropdown
            $('#class').hide();
            $('#department').hide();
        }
    });
  
    $("#target_user").on('change', function (e) {
        e.preventDefault();
        var target_user = $("#target_user").val();
        var class_id = $("#changeClassName").val();
        var section_id = $("#filtersectionID").val();
       
      // console.log('Active div data-value:', activeDivDataValue);  // Use the stored data-value
        console.log(target_user);
       if(target_user.includes('6') && target_user.includes('5'))
       {
            $("#student_id").empty();
            $("#student_id").append('<option value="">'+select_student+'</option>');
            $.post(getStudentList, { token: token, branch_id: branchID, class_id: class_id, section_id: section_id }, function (res) {
                console.log(res);
                if (res.code == 200) {
                    $.each(res.data, function (key, val) {
                        $("#student_id").append('<option value="' + val.id + '">' + val.name + '</option>');
                    });
                }
            }, 'json');
            $("#parent_id").empty();
            $("#parent_id").append('<option value="">Select Parent</option>');
            $.post(getParentList, { token: token, branch_id: branchID, class_id: class_id, section_id: section_id }, function (res) {
                console.log(res);
                if (res.code == 200) {
                    $.each(res.data, function (key, val) {
                        $("#parent_id").append('<option value="' + val.id + '">' + val.parent_name + '</option>');
                    });
                }
            }, 'json');
       }else if(target_user.includes('5'))
       {
            $("#parent_id").empty();
            $("#parent_id").append('<option value="">Select Parent</option>');
            $.post(getParentList, { token: token, branch_id: branchID, class_id: class_id, section_id: section_id }, function (res) {
                console.log(res);
                if (res.code == 200) {
                    $.each(res.data, function (key, val) {
                        $("#parent_id").append('<option value="' + val.id + '">' + val.parent_name + '</option>');
                    });
                }
            }, 'json');
       }else {

        $("#student_id").empty();
        $("#student_id").append('<option value="">'+select_student+'</option>');
        $.post(getStudentList, { token: token, branch_id: branchID, class_id: class_id, section_id: section_id }, function (res) {
            console.log(res);
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#student_id").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
       }
       
    });
    
    $('#edit_class').hide();  // Initially disable the multi-select
    $('#departments').hide();
    $('#students').hide();
    $('#parents').hide();
    $('#target_users').change(function () {
        var selectedOptions = $(this).val();

        if (selectedOptions && selectedOptions.includes('4') && selectedOptions.includes('5') && selectedOptions.includes('6')
        ) {
            // Hide class dropdown and show the other dropdown
            $('#edit_class').show();
            $('#departments').show();
            $('#students').show();
            $('#parents').show();
        }else if (selectedOptions && selectedOptions.includes('4') && selectedOptions.includes('5')){
            $('#edit_class').show();
            $('#departments').show();
            $('#parents').show();
            $('#students').hide();
        }else if (selectedOptions && selectedOptions.includes('5') && selectedOptions.includes('6')){
            $('#edit_class').show();
            $('#students').show();
            $('#parents').show();
            $('#departments').hide();
        }else if (selectedOptions && selectedOptions.includes('4')) {
            // Hide the other dropdown and show class dropdown
            $('#departments').show();
            $('#edit_class').hide();
            $('#students').hide();
            $('#parents').hide();
        }else if (selectedOptions && selectedOptions.includes('5')) {
            // Hide the other dropdown and show class dropdown
            $('#departments').hide();
            $('#edit_class').show();
            $('#students').hide();
             $('#parents').show();
        }else if (selectedOptions && selectedOptions.includes('6')) {
            // Hide the other dropdown and show class dropdown
            $('#departments').hide();
            $('#edit_class').show();
            $('#students').show();
            $('#parents').hide();
        }else {
            // Show class dropdown and hide the other dropdown
            $('#edit_class').hide();
            $('#departments').hide();
            $('#parents').hide();
            $('#students').hide();
        }
    });
     // change classroom
   
    
    $(document).on('click', '#editBuletinBtn', function () {
        var buletin_id = $(this).data('id');
        // console.log(buletin_id);
        $('.editBuletin').find('form')[0].reset();
        $.post(buletinBoardDetails, { id: buletin_id }, function (data) {
            // console.log("data")
            console.log(data);
            // console.log(data.data.section_id);
            $('.editBuletin').find('input[name="id"]').val(data.data.id);
            $('.editBuletin').find('input[name="titles"]').val(data.data.title);
            $('.editBuletin').find('input[name="publish_dates"]').val(data.data.publish_date);
            $('.editBuletin').find('input[name="publish_end_dates"]').val(data.data.publish_end_date);
            $('#descriptions').html(data.data.discription);
            $('.editBuletin').find('.oldfile').text(data.data.file);
            var targetUserValues = data.data.target_user.split(',');
            $('#target_users').val(targetUserValues).trigger('change');
            // Set class_id and trigger its change event
            $('#changeClassNames').val(data.data.class_id);
    
            if (data.data.class_id != "") {
                var class_id = data.data.class_id;
                var Selector = '.buletinForm';
                var sectionID = data.data.section_id;
                sectionAllocation(class_id, Selector, sectionID);
            }
            if(data.data.class_id != "" && data.data.section_id != "" && data.data.parent_id != "")
            {
                var class_id = data.data.class_id;
                var sectionID = data.data.section_id;
                var parent_id  = data.data.parent_id;
                parentAllocation(class_id, sectionID, parent_id);
            }
            if(data.data.class_id != "" && data.data.section_id != "" && data.data.student_id != "")
            {
                var class_id = data.data.class_id;
                var sectionID = data.data.section_id;
                var student_id  = data.data.student_id;
               studentAllocation(class_id, sectionID, student_id);
            }
            var department_idValues = [];

            if (data.data.department_id) {
                if (typeof data.data.department_id === 'string' && data.data.department_id.includes(',')) {
                    // Split the values if there's a comma
                    department_idValues = data.data.department_id.split(',');
                } else {
                    // Convert the single value to an array
                    department_idValues = [data.data.department_id];
                }
            }
    
            // Populate and set the selected values for department_id dropdown
            $('#empDepartments').val(department_idValues).trigger('change');
            
            // Check the checkbox based on the database value
            if (data.data.publish === 1) {
                $('#publishs').prop('checked', true);
            } else {
                $('#publishs').prop('checked', false);
            }
            $('.editBuletin').modal('show');
        }, 'json');
        //console.log(id);
    });
   

    // change branch id in add class,section and type in evvent 
    $("#branch_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#eventForm';
        var branch_id = $(this).val();
        if (branch_id) {
            branchEvent(branch_id, Selector);
        }
    });
    // branch Event
    function branchEvent(branch_id, Selector) {

        $(Selector).find("#type").empty();
        $(Selector).find("#type").append('<option value="">'+select_type+'</option>');
        $(Selector).find("#class_name").empty();
        $(Selector).find("#class_name").append('<option value="">'+select_class+'</option>');
        $(Selector).find("#section_name").empty();
        $(Selector).find("#section_name").append('<option value="">'+select_section+'</option>');
        $.post(branchByEvent, { branch_id: branch_id, token: token }, function (res) {
            if (res.code == 200) {
                $.each(res.data.eventType, function (key, val) {
                    $(Selector).find("#type").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
                $.each(res.data.class, function (key, val) {
                    $(Selector).find("#class_name").append('<option value="' + val.id + '">' + val.name + '</option>');
                    $(Selector).find("#section_name").append('<optgroup label="Class ' + val.name + '">');
                    $.each(res.data.section, function (key, sec) {
                        if (sec.class_id == val.id) {
                            $(Selector).find("#section_name").append('<option value="' + sec.section_id + '">' + sec.section_name + '</option>');
                        }
                    });
                    $(Selector).find("#section_name").append('</optgroup>');
                });
            }
        }, 'json');
    }

});