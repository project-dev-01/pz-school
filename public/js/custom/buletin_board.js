$(function () {

    $(document).ready(function () {
        // Get today's date
        var today = new Date();
        $('#addBuletinModal').on('shown.bs.modal', function () {
            $("#date").flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                minDate: today,
                defaultDate : today,
                container: '#addBuletinModal modal-body',
                defaultHour : today.getHours(),
                defaultMinute : today.getMinutes(),
                minuteIncrement : 1,
               
            });
            $("#end_date").flatpickr({
                // enableTime: !0,
                 enableTime: true,
                 dateFormat: "Y-m-d H:i",
                 minDate: today,
                 defaultHour : today.getHours(),
                 defaultMinute : today.getMinutes(),
                 container: '#addBuletinModal modal-body',
                 minuteIncrement: 1 
             });
        });

        $('#editBuletinModal').on('shown.bs.modal', function () {
            $("#publish_dates").flatpickr({
                // enableTime: !0,
                enableTime: true,
                dateFormat: "Y-m-d H:i", // last hundred years
                minDate: today,
                container: '#editBuletinModal modal-body'
            });
            $("#publish_end_dates").flatpickr({
                // enableTime: !0,
                enableTime: true,
                minDate: today,
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
            
        }
    });
    $('#buletinForm').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        var fileName = $("#file").val();

        // Check if fileName is not empty
        if (fileName.trim() !== '') {
            var ext = fileName.split('.').pop().toLowerCase();
        
            // Validate file extension only if fileName is not empty and is a PDF file
            if ($.inArray(ext, ['pdf']) === -1) {
                $(form).find('span.file_error').text('Please select a PDF file.');
                // You can optionally return false here to prevent form submission
            }
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
           var startDate = $("#date").val();
           var selectedDateTime =flatpickr.parseDate(startDate, "Y-m-d H:i");
           var now = new Date();
           // Extract time part only for comparison
           if (now.toDateString() === selectedDateTime.toDateString() && now >= selectedDateTime) {
            // Check if the selected date is today and the selected time is in the past
            $(form).find('span.date_error').text("Publish time should be in the future.");
            return false;
            }
           //Date validate
           
           var endDate = $("#end_date").val();
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
           // var publish = $("#publish").val();
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
           // formData.append('publish', publish);
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
        
        var selectedClassIds = $(this).val();
        
        if (selectedClassIds && selectedClassIds.length > 0) {
            // Loop through each selected class ID
            $.each(selectedClassIds, function(index, class_id) {
                var sectionID = ""; // Initialize section ID (you can customize this based on your needs)
                sectionsAllocation(class_id, sectionID);
            });
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
            //var publish = $("#publishs").val();
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
           // formData.append('publish', publish);
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
                    },
                    enabled: false, // Initially disable CSV button
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
                    enabled: false, // Initially disable PDF button
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
            initComplete: function () {
                var table = this;
                $.ajax({
                    url: buletinBoardList,
                    success: function(data) {
                        console.log(data.data.length);
                        if (data && data.data.length > 0) {
                            console.log('ok');
                            $('#buletin-table_wrapper .buttons-csv').removeClass('disabled');
                            $('#buletin-table_wrapper .buttons-pdf').removeClass('disabled');  // Enable all buttons if at least one record exists
                        } else {
                            console.log(data);
                            $('#buletin-table_wrapper .buttons-csv').addClass('disabled');
                            $('#buletin-table_wrapper .buttons-pdf').addClass('disabled');               
                        }
                    },
                    error: function() {
                        console.log('error');
                        // Handle error if necessary
                    }
                });
            },
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
                    name: 'discription',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            if (data && data.length > 50) {
                                // If data is longer than 50 characters, show initial text followed by "View More" button
                                var initialText = data.substring(0, 50); // Get the first 50 characters of the description
                                return initialText + '... <button class="btn btn-sm btn-info view-description" data-toggle="modal" data-target="#descriptionModal" data-description="' + data + '">View More</button>';
                            } else {
                                return data; // If data is null/undefined or shorter than 50 characters, display it directly
                            }
                        }
                        return data;
                    }
                },
                {
                    data: 'file',
                    name: 'file',
                    render: function(data, type, full, meta) {
                        // Check if data is not null and not empty
                        if (data && data.trim() !== '') {
                            // Assuming 'image_url' contains the base URL for file links
                            var fileLink = image_url + data;
                            return '<a href="' + fileLink + '" target="_blank">' + data + '</a>';
                        } else {
                            // Return empty string if data is null or empty
                            return '';
                        }
                    }
                },
                {
                    data: 'target_user',
                    name: 'target_user'
                },{
                    data: 'publish_date',
                    name: 'publish_date',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            // Split the datetime string into date and time parts
                            var parts = data.split(' ');
                            // Display only the date part (assuming it's the first part of the split string)
                            return parts[0];
                        }
                        return data;
                    }
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
    $('#buletin-table').on('click', '.view-description', function() {
        // Get the full description from the data-description attribute of the button
        var fullDescription = $(this).data('description');

        // Update modal body with full description
        $('#descriptionModalBody').text(fullDescription);
    });
// Custom render function for truncating text with ellipsis
function ellipsisRender(length, isWordBreak) {
    return function(data, type, row) {
        if (type === 'display' || type === 'filter') {
            if (!data || data.length <= length) {
                return data;
            }
            // Truncate the text and add ellipsis
            var truncatedText = data.substr(0, length);
            if (isWordBreak) {
                // Find last space within the truncated text
                var lastSpaceIndex = truncatedText.lastIndexOf(' ');
                if (lastSpaceIndex !== -1) {
                    truncatedText = truncatedText.substr(0, lastSpaceIndex);
                }
            }
            return truncatedText + '...';
        }
        return data;
    };
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
            $('.viewBuletin').find('.publish_end_date').text(data.data.publish_end_date);
           
            var targetUserValues = data.data.target_user.split(',');
            if (targetUserValues.includes('5')) {
                var content = data.data.name + "<br>";

                if (data.data.grade_name !== null) {
                    content += "Grade: " + data.data.grade_name + "<br>";
                }

                if (data.data.section_name !== null) {
                    content += "Class: " + data.data.section_name + "<br>";
                }

                if (data.data.parent_name !== null) {
                    content += "Parent: " + data.data.parent_name;
                }
                $('.viewBuletin').find('.target_user').html(content);
              
            } else if (targetUserValues.includes('4')) {
                var content = data.data.name + "<br>";

                if (data.data.department_name !== null) {
                    content += "Department: " + data.data.department_name + "<br>";
                }
                $('.viewBuletin').find('.target_user').html(content);
            }else{
                var content = data.data.name + "<br>";

                if (data.data.grade_name !== null) {
                    content += "Grade: " + data.data.grade_name + "<br>";
                }

                if (data.data.section_name !== null) {
                    content += "Class: " + data.data.section_name + "<br>";
                }

                if (data.data.student_name !== null) {
                    content += "Student: " + data.data.student_name;
                }
                $('.viewBuletin').find('.target_user').html(content);
                
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
            $('#selectionLegend').text('Parent Student Section');
        }else if (selectedOptions && selectedOptions.includes('4') && selectedOptions.includes('5')){
            $('#class').show();
            $('#department').show();
            $('#parentss').show();
            $('#selectionLegend').text('Parent Section');
            $('#student').hide();
        }else if (selectedOptions && selectedOptions.includes('5') && selectedOptions.includes('6')){
            $('#class').show();
            $('#student').show();
            $('#parentss').show();
            $('#selectionLegend').text('Parent Student Section');
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
             $('#selectionLegend').text('Parent Section');
             
        }else if (selectedOptions && selectedOptions.includes('6')) {
            // Hide the other dropdown and show class dropdown
            $('#department').hide();
            $('#class').show();
            $('#student').show();
            $('#parentss').hide();
            $('#selectionLegend').text('Student Section');
        }else {
            // Show class dropdown and hide the other dropdown
            $('#class').hide();
            $('#department').hide();
        }
    });
  
    $("#filtersectionID").on('change', function (e) {
        e.preventDefault();
        var target_user = $("#target_user").val();
        var class_id = $("#changeClassName").val();
        var section_id = $("#filtersectionID").val();
       
      // console.log('Active div data-value:', activeDivDataValue);  // Use the stored data-value
        //console.log(target_user,class_id,section_id);
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
            console.log(target_user,class_id,section_id);
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
            // if (data.data.publish === 1) {
            //     $('#publishs').prop('checked', true);
            // } else {
            //     $('#publishs').prop('checked', false);
            // }
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