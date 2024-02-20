var table; // Declare the variable in a wider scope
var buttonEnable;
$(function () {
    $("#download_department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#promoteDownloadForm';
        var department_id = $(this).val();
        var classID = "";
        $(Selector).find('select[name="download_class_id"]').empty();
        $(Selector).find('select[name="download_class_id"]').append('<option value="">' + select_grade + '</option>');
        if (department_id) {
            $.post(getGradeByDepartmentUrl,
                {
                    branch_id: branchID,
                    department_id: department_id
                }, function (res) {
                    if (res.code == 200) {
                        $.each(res.data, function (key, val) {
                            $(Selector).find('select[name="download_class_id"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                        if (classID != '') {
                            $(Selector).find('select[name="download_class_id"]').val(classID);
                        }
                    }
                }, 'json');
        }
    });
    $("#downloadListClassID").on('change', function (e) {
        e.preventDefault();
        var Selector = '#promoteDownloadForm';
        var class_id = $(this).val();
        console.log(class_id);
        $(Selector).find('select[name="download_section_id"]').empty();
        $(Selector).find('select[name="download_section_id"]').append('<option value="">' + select_class + '</option>');

        $.post(sectionByClass, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
            console.log(res);
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $(Selector).find('select[name="download_section_id"]').append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    $("#promote_list_department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#promoteStudentListForm';
        var department_id = $(this).val();
        var classID = "";
        $(Selector).find('select[name="promote_list_class_id"]').empty();
        $(Selector).find('select[name="promote_list_class_id"]').append('<option value="">' + select_grade + '</option>');
        if (department_id) {
            $.post(getGradeByDepartmentUrl,
                {
                    branch_id: branchID,
                    department_id: department_id
                }, function (res) {
                    if (res.code == 200) {
                        $.each(res.data, function (key, val) {
                            $(Selector).find('select[name="promote_list_class_id"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                        if (classID != '') {
                            $(Selector).find('select[name="promote_list_class_id"]').val(classID);
                        }
                    }
                }, 'json');
        }
    });
    $("#promoteListClassID").on('change', function (e) {
        e.preventDefault();
        var class_id = $(this).val();
        console.log(class_id);
        $("#promoteListSectionID").empty();
        $("#promoteListSectionID").append('<option value="">' + select_class + '</option>');
        $.post(sectionByClass, { class_id: class_id }, function (res) {
            console.log(res);
            if (res.code == 200) {
                $.each(res.data, function (key, val) {

                    $("#promoteListSectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });

        // delete form
        $(document).on('click', '#saveDataBtn', function() {
            swal.fire({
                title: "Are you sure want to proceed?",
                html: "",
                showCancelButton: true,
                showCloseButton: true,
                cancelButtonText: "cancel",
                confirmButtonText: "confirm",
                cancelButtonColor: '#d33',
                confirmButtonColor: '#556ee6',
                width: 400,
                allowOutsideClick: false
            }).then(function(result) {
                if (result.isConfirmed) {
                    var updatedData = [];
                    var uniqueAttendances = []; 
                    var duplicateFound = false;
                        $('table tbody tr').each(function() {
                            var rowData = {};
                            
                            // Find the hidden input field
                            var hiddenInput = $(this).find('input[name="id"]');
                            
                            // Check if the hidden input exists
                            if (hiddenInput.length) {
                                rowData['id'] = hiddenInput.val();
                            }
                           // console.log(rowData['id']);
                            // Find the td element with the data-cell class
                            var dataCell = $(this).find('.data-cell');
                            
                            // Check if the data-cell td element exists
                            if (dataCell.length) {
                                var key = dataCell.data('field');
                                var value = dataCell.find('.attendance-td').text().trim();
                                                        // Check if the attendance value is unique
                                if (uniqueAttendances.includes(value)) {
                                    duplicateFound = true;
                                    return false; // Stop further processing
                                } else {
                                    uniqueAttendances.push(value); // Add attendance to the unique list
                                    rowData[key] = value;
                                }
                            }

                            updatedData.push(rowData);
                            console.log(updatedData);
                        });
                        if (duplicateFound) {
                            swal.fire("Error", "Duplicate attendance values found. Please correct and try again.", "error");
                        } else {
                            // Send an AJAX request to the server
                            $.ajax({
                                url: promotionImportUrl, // replace with your actual server endpoint
                                type: 'POST',
                                data: { updatedData: updatedData },
                                success: function(response) {
                                    // Handle success response from the server
                                    // Clear the existing table content
                                    $('#promotionBulkData tbody').empty();
                                    console.log('Data saved successfully:', response);
                                    swal.fire("Success", "Your data has been saved.", "success");
                                },
                                error: function(error) {
                                    // Handle error response from the server
                                    console.error('Error saving data:', error);
                                    swal.fire("Error", "There was an error saving your data.", "error");
                                }
                            });
                        }
                } else {
                    // User canceled
                    swal.fire("Cancelled", "Your data is safe.", "info");
                }
            });
        });
       

        $("#uploadFile").validate({
            rules: {
                file: "required"
            }
        });
        // Add click event listener to the new button
        $('#downloadSampleButton').on('click', function () {
            // Manually trigger form submission
            $('#promoteDownloadForm').submit();
        });
           // Initialize form validation
           $('#promoteDownloadForm').validate({
            rules: {
                download_department_id: {
                    required: true,
                },
                download_class_id: {
                    required: true,
                },
            },
            messages: {
                download_department_id: {
                    required: 'Please select a department.',
                },
                download_class_id: {
                    required: 'Please select a grade.',
                },
            },
            submitHandler: function (form) {
                console.log('Serialized Form Data:', $(form).serialize());
                // Form is valid, submit Ajax request to download CSV
                $.ajax({
                    url: $(form).attr('action'),
                    method: 'POST',
                    data: $(form).serialize(),
                    dataType: 'json', // Specify that the expected response is JSON
                    success: function (response) {
                        // Check if the request was successful and has the expected structure
                        if (response && response.success && response.data) {
                            // Extract CSV content from the 'data' property
                            var csvContent = "#,Student Name,Student Number,Current Attendance No,Current Academic Year,Current Department,Current Grade,Current Class,Current Semester,Current Session,Promoted Academic Year,Promoted Department,Promoted Grade,Promoted Class,Promoted Semester,Promoted Session\n" +
                            response.data.map(function (item) {
                                return [
                                    1,
                                    '',
                                    '',
                                    '',
                                    '',
                                    item.name,
                                    item.class_name,
                                    item.section_name,
                                    '', // Placeholder for AdditionalColumn1 (no data provided)
                                    '', // Placeholder for AdditionalColumn2 (no data provided)
                                    '',  // Placeholder for AdditionalColumn3 (no data provided)
                                    '',
                                    '',
                                    '',
                                    '',
                                    ''
                                ].join(',');
                            }).join('\n');                        

                            // You can log the CSV content if needed
                            console.log('CSV file content:', csvContent);

                            // Open the content in a new window
                            window.open('data:text/csv;charset=utf-8,' + encodeURIComponent(csvContent));
                        } else {
                            console.error('Unexpected response structure:', response);
                            alert('Unexpected response structure. Please try again.');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error generating CSV file. Status Code:', xhr.status);
                        console.error('Error Details:', xhr.responseText);
                        alert('Error generating CSV file. Please try again.');
                    }
                });
            }
        });

        $("#promoteStudentListForm").validate({
            rules: {
                promote_list_department_id: "required",
                promote_list_class_id: "required"
            }
        });
        $('#sort').on('change', function() {
            // Trigger form validation on dropdown change
            $("#promoteStudentListForm").valid();
            var selectedDepartment = $('#promote_list_department_id').val();
            var selectedGrade = $('#promoteListClassID').val();
            var selectedSection = $('#promoteListSectionID').val();
            var selectedSort = $(this).val();
            promotionDataStudentList(selectedDepartment,selectedGrade,selectedSection,selectedSort);
            unassignedStudentList(selectedDepartment,selectedGrade,selectedSection);
            terminationStudentList(selectedDepartment,selectedGrade,selectedSection);

        });
        promotionDataStudentList(selectedDepartment = "All",selectedGrade = "All",selectedSection = "All",selectedSort = "All");
        function promotionDataStudentList(selectedDepartment,selectedGrade,selectedSection,selectedSort) {
            if ($.fn.DataTable.isDataTable('#promotionDataStudentList')) {
                $('#promotionDataStudentList').DataTable().destroy();
            }
           
             table = $('#promotionDataStudentList').DataTable({
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
                            doc.pageMargins = [50, 50, 50, 50];
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
    
                            doc['footer'] = (function (page, pages) {
                                return {
                                    columns: [
                                        { alignment: 'left', text: [footer_txt], width: 400 },
                                        {
                                            // This is the right column
                                            alignment: 'right',
                                            text: ['page ', { text: page.toString() }, ' of ', { text: pages.toString() }],
                                            width: 100
    
                                        }
                                    ],
                                    margin: [50, 0, 0, 0]
                                }
                            });
    
                        }
                    }
                ],
                "ajax": {
                    url: studentListBulk,
                    cache: false,
                    dataType: "json",
                    // data: { month:getSelectedMonth },
                    // data: formData,
                    data: {
                        department: selectedDepartment,
                        grade: selectedGrade,
                        section: selectedSection,
                        sort: selectedSort,
                    },
                    type: "GET",
                    // contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    // processData: true, // NEEDED, DON'T OMIT THIS
                    // headers: {
                    // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // },
                    "dataSrc": function (json) {
                        console.log( json.data);
                        // Check if any row has termination date and show warning symbol accordingly
                            var hasTerminationDate = json.data.some(function (row) {
                                return row.date_of_termination !== null;
                            });

                            // Show/hide the warning symbol based on the presence of termination date
                            $('#warningSymbol').toggle(hasTerminationDate);
                        return json.data;
                    },
                    error: function (error) {
                        // console.log("error")
                        // console.log(error)
                        // noDataAvailable(error);
                    }
                },
                "pageLength": 10,
                "aLengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                columns: [
                    {
                        "targets": 0,
                        "render": function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'id',
                        visible: false
                    },
                    {
                        data: 'attendance_no'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'roll'
                    },
                    {
                        data: 'deptName'
                    },
                    {
                        data: 'className'
                    },
                    {
                        data: 'sectionName'
                    },
                    {
                        data: 'deptPromotionName'
                    },
                    {
                        data: 'classPromotionName'
                    },
                    {
                        data: 'sectionPromotionName'
                    },
                    {
                        data: 'status',
                        visible: false
                    }      
                ]
            }).on('draw', function () {
                toggleButton();
            });
        }
        // Check if every row has status 3
        function checkStatus3ForAllRows() {
            var allRowsStatus3 = true;

            table.rows().every(function (index, element) {
                var rowData = this.data();
                if (rowData.status === 1 || rowData.status !== 4) {
                    allRowsStatus3 = false;
                    return false; // Stop iterating if any row doesn't have status 3
                }
            });

            return allRowsStatus3;
        }

        // Enable/disable the button based on the status of all rows
        function toggleButton() {
            var button = $('#savePreparedDataBtn');
            var enableButton = checkStatus3ForAllRows();

            button.prop('disabled', !enableButton);
        }

        // Call the toggleButton function initially to set the button state
        toggleButton();
         // Assuming you have a button with id "saveButton"
         $('#savePreparedDataBtn').on('click', function () {
             swal.fire({
                 title: "Are you sure want to proceed?",
                 html: "",
                 showCancelButton: true,
                 showCloseButton: true,
                 cancelButtonText: "cancel",
                 confirmButtonText: "confirm",
                 cancelButtonColor: '#d33',
                 confirmButtonColor: '#556ee6',
                 width: 400,
                 allowOutsideClick: false
             }).then(function(result) {
                 if (result.isConfirmed) {
                      // Get the data of all rows in the DataTable
                        var allRowsData = table.rows().data().toArray();
                    
                        // Extract the 'id' values from allRowsData
                        var selectedIds = allRowsData.map(function (row) {
                            return row.id;
                        });
                    
                        // Log the selectedIds array
                        console.log('Selected IDs on button click:', selectedIds);
        
                         // Send an AJAX request to the server
                         $.ajax({
                             url: promotionImportPreparedUrl, // replace with your actual server endpoint
                             type: 'POST',
                             data: { updatedData: selectedIds },
                             success: function(response) {
                                 
                                 console.log('Data saved successfully:', response);
                                 swal.fire("Success", "Your data has been saved.", "success");
                             },
                             error: function(error) {
                                 // Handle error response from the server
                                 console.error('Error saving data:', error);
                                 swal.fire("Error", "There was an error saving your data.", "error");
                             }
                         });
                 } else {
                     // User canceled
                     swal.fire("Cancelled", "Your data is safe.", "info");
                 }
             });
         });
         unassignedStudentList(selectedDepartment = "All",selectedGrade = "All",selectedSection = "All");
        function unassignedStudentList(selectedDepartment,selectedGrade,selectedSection) {
            if ($.fn.DataTable.isDataTable('#unassignedStudentList')) {
                $('#unassignedStudentList').DataTable().destroy();
            }
            $('#unassignedStudentList').DataTable({
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
                "ajax": {
                    url: getUnassignedStudentList,
                    cache: false,
                    dataType: "json",
                    // data: { month:getSelectedMonth },
                    // data: formData,
                    data: {
                        department: selectedDepartment,
                        grade: selectedGrade,
                        section: selectedSection,
                    },
                    type: "GET",
                    // contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    // processData: true, // NEEDED, DON'T OMIT THIS
                    // headers: {
                    // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // },
                    "dataSrc": function (json) {
                        return json.data;
                    },
                    error: function (error) {
                        // console.log("error")
                        // console.log(error)
                        // noDataAvailable(error);
                    }
                },
                "pageLength": 10,
                "aLengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                columns: [
                    {
                        "targets": 0,
                        "render": function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'attendance_no'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'roll'
                    },
                    {
                        data: 'deptName'
                    },
                    {
                        data: 'className'
                    },
                    {
                        data: 'sectionName'
                    },
                    {
                        data: 'admission_date'
                    },
                    {
                        data: 'status', 
                        render: function (data, type, row, meta) {
                                if (data === 1) {
                                    // Your custom rendering logic for status 1
                                    return "InActive"; // Return the data for status 1
                                } else {
                                    // Your custom rendering logic for other statuses
                                    return 'Active'; // Return an empty string or any other value for other statuses
                                }
                            }
                    },
                    
                ]
            }).on('draw', function () {
            });
        }
        terminationStudentList(selectedDepartment = "All",selectedGrade = "All",selectedSection = "All");
        function terminationStudentList(selectedDepartment,selectedGrade,selectedSection) {
            if ($.fn.DataTable.isDataTable('#terminationStudentList')) {
                $('#terminationStudentList').DataTable().destroy();
            }
            $('#terminationStudentList').DataTable({
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
                "ajax": {
                    url: getTerminationStudentList,
                    cache: false,
                    dataType: "json",
                    // data: { month:getSelectedMonth },
                    // data: formData,
                    data: {
                        department: selectedDepartment,
                        grade: selectedGrade,
                        section: selectedSection,
                    },
                    type: "GET",
                    // contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    // processData: true, // NEEDED, DON'T OMIT THIS
                    // headers: {
                    // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // },
                    "dataSrc": function (json) {
                        return json.data;
                    },
                    error: function (error) {
                        // console.log("error")
                        // console.log(error)
                        // noDataAvailable(error);
                    }
                },
                "pageLength": 10,
                "aLengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                columns: [
                    {
                        "targets": 0,
                        "render": function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'attendance_no'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'roll'
                    },
                    {
                        data: 'deptName'
                    },
                    {
                        data: 'className'
                    },
                    {
                        data: 'sectionName'
                    },
                    {
                        data: 'date_of_termination'
                    },
                    
                ]
            }).on('draw', function () {
            });
        }
});


