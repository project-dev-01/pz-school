var table; // Declare the variable in a wider scope
var buttonEnable;
$(function () {
        $('#promoteStudentListForm').on('submit', function (e) {
            e.preventDefault();
            var status = $("#promote_list_status_id").val();
            console.log(status);
            promotionDataFreezedStudentList(status);
        });
        promotionDataFreezedStudentList("All");
        function promotionDataFreezedStudentList(status) {
             // Check if DataTable instance exists, and destroy it if it does
    if ($.fn.DataTable.isDataTable('#promotionDataFreezedStudentList')) {
        $('#promotionDataFreezedStudentList').DataTable().destroy();
    }
             buttonEnable =  $('#promotionDataFreezedStudentList').DataTable({
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
                    url: studentListFreezed,
                    cache: false,
                    dataType: "json",
                    // data: { month:getSelectedMonth },
                    // data: formData,
                    data: {
                        status: status,
                    },
                    type: "GET",
                    // contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    // processData: true, // NEEDED, DON'T OMIT THIS
                    // headers: {
                    // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // },
                    "dataSrc": function (json) {
                        console.log(json.data);
                        return json.data;
                    },
                    error: function (error) {
                         console.log("error")
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
                        searchable: false,
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'id',
                        name: 'id',
                        visible: false
                    },
                    {
                        data: 'deptName',
                        name:'deptName'
                    },
                    {
                        data: 'className',
                        name:'className'
                    },
                    {
                        data: 'status',
                        name: 'status', 
                        render: function (data, type, row, meta) {
                            if (data === 1) {
                                // Your custom rendering logic for status 1
                                return data_preparing; // Return the data for status 1
                            } else if(data === 3){
                                return data_freezed;
                            }else if(data === 4){
                                return temporary_unlock;
                            }else {
                                // Your custom rendering logic for other statuses
                                return data_prepared ; // Return an empty string or any other value for other statuses
                            }
                        }
                    },
                    {
                        data: 'actions',
                        name:'actions'
                    }
                    
                ],
                initComplete: function (settings, json) {
                    console.log(json);
                
                    // Check if the data array is empty or has no records
                    if (json.data.length === 0 || json.recordsTotal === 0) {
                        $('#saveFinalPromotionDataBtn').prop('disabled', true);
                    }
                },
            }).on('draw', function () {
                toggleButton();
            });
        }
        // Check if every row has status 3
        function checkStatus3ForAllRows() {
            var allRowsStatus3 = true;

            buttonEnable.rows().every(function (index, element) {
                var rowData = this.data();
                if (rowData.status !== 3) {
                    allRowsStatus3 = false;
                    return false; // Stop iterating if any row doesn't have status 3
                }
            });

            return allRowsStatus3;
        }

        // Enable/disable the button based on the status of all rows
        function toggleButton() {
            var button = $('#saveFinalPromotionDataBtn');
            var enableButton = checkStatus3ForAllRows();

            button.prop('disabled', !enableButton);
        }

        // Call the toggleButton function initially to set the button state
        toggleButton();
        $(document).on('click', '#saveStatusDataBtn', function () {
            var selectedData = [];
            var statusSelected = false;
            buttonEnable.rows().every(function () {
                var rowData = this.data();
                var selectedStatus = $(this.node()).find('select').val();
        
                // Check if at least one row is selected
                if (selectedStatus !== '' && selectedStatus !== '0' && selectedStatus !== null) {
                    statusSelected = true;
                 }// else {
                //     // If selectedStatus is empty or null, use the column value 'status'
                //     selectedStatus = rowData.status;
                // }
        
                // Assuming 'id' is a unique identifier for each row
                selectedData.push({
                    id: rowData.id,
                    selectedStatus: selectedStatus,
                });
            });
        
            // Now 'selectedData' array contains the selected status for each row
            console.log(selectedData);
            if (!statusSelected) {
                // Show a message indicating that status needs to be selected
                Swal.fire({
                    title: error,
                    text: valid_status,
                    icon: 'warning',
                    confirmButtonColor: '#556ee6'
                });
                return; // Exit the function without sending the AJAX request
            }
            // Send an AJAX request to the server
            $.ajax({
                url: savestatusFreezed, // replace with your actual server endpoint
                type: 'POST',
                data: { statusData: selectedData },
                success: function(response) {
                    $('#promotionDataFreezedStudentList').DataTable().ajax.reload(null, false);
                    console.log('Data saved successfully:', response);
                    Swal.fire({
                        title: successButtonText,
                        text: student_promoted_status,
                        icon: 'success',
                        confirmButtonColor: '#556ee6'
                    });
                },
                error: function(error) {
                    // Handle error response from the server
                    console.error('Error saving data:', error);
                    Swal.fire({
                        title: error,
                        text: promotion_message_error,
                        icon: 'error',
                        confirmButtonColor: '#556ee6'
                    });
                }
            });
        });
        
        // Add a click event listener to the "Save Final Promotion Data" button
        $(document).on('click', '#saveFinalPromotionDataBtn', function() {
            var promotionData = [];
            // Get all data from the DataTable
            var allData  = buttonEnable.rows().data().toArray();

                        // Iterate through each row in the DataTable
                $.each(allData, function(index, rowData) {
                    // Extract the necessary data for each row
                    var id = rowData.id;
                    var selectedStatus = rowData.status; // Assuming the column name is 'status'

                    // Push the data to the array
                    promotionData.push({
                        id: id
                    });
                });
            console.log(promotionData);
            // Send the data to the server using AJAX
            $.ajax({
                url: promotionFinalData, // Replace with your actual server endpoint
                type: 'POST',
                data: {
                    promotionData: promotionData // Replace with the actual branch ID
                },
                success: function(response) {
                    $('#promotionDataFreezedStudentList').DataTable().ajax.reload(null, false);
                    console.log('Data saved successfully:', response);
                    Swal.fire({
                        title: successButtonText,
                        text: student_promoted_message,
                        icon: 'success',
                        confirmButtonColor: '#556ee6'
                    });
                },
                error: function(error) {
                     // Handle error response from the server
                     console.error('Error saving data:', error);
                     Swal.fire({
                        title: error,
                        text: promotion_message_error,
                        icon: 'error',
                        confirmButtonColor: '#556ee6'
                    });
                }
            });
        });
        unassignedPromotionStudentList();
        function unassignedPromotionStudentList() {
            $('#unassignedPromotionStudentList').DataTable({
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
                ajax: studentListUnassignedFreezed,
                "pageLength": 10,
                "aLengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                columns: [
                    {
                        data: 'attendance_no',
                        name: 'attendance_no'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'register_no',
                        name: 'register_no'
                    },
                    {
                        data: 'deptName',
                        name: 'deptName'
                    },
                    {
                        data: 'className',
                        name: 'className'
                    },
                    {
                        data: 'sectionName',
                        name: 'sectionName'
                    },
                    {
                        data: 'admission_date',
                        name: 'admission_date'
                    },
                    {
                        data: 'status',
                        name: 'status', 
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
});


