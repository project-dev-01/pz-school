
$(function () {

    $(".timepicker").flatpickr({
        enableTime: !0,
        noCalendar: !0,
        dateFormat: "H:i",
        time_24hr: !0,
        defaultDate: "08:30"
    });


    bTable();
    function bTable() {
        $('#student-bulletin-table').DataTable({
            processing: true,
            info: true,
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
                    url: studentList,
                    success: function(data) {
                        console.log(data.data.length);
                        if (data && data.data.length > 0) {
                            console.log('ok');
                            $('#student-bulletin-table_wrapper .buttons-csv').removeClass('disabled');
                            $('#student-bulletin-table_wrapper .buttons-pdf').removeClass('disabled');  // Enable all buttons if at least one record exists
                        } else {
                            console.log(data);
                            $('#student-bulletin-table_wrapper .buttons-csv').addClass('disabled');
                            $('#student-bulletin-table_wrapper .buttons-pdf').addClass('disabled');               
                        }
                    },
                    error: function() {
                        console.log('error');
                        // Handle error if necessary
                    }
                });
            },
            ajax: studentList,
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
                    data: 'file',
                    name: 'file',
                    render: function (data, type, full, meta) {
                        const starClass = full.parent_imp === '1' ? 'star-important' : 'star-not-important';
                        const itemId = full.id;
                        if (data && typeof data === 'string' && data.trim() !== '') {
                            const isPDF = data.toLowerCase().endsWith('.pdf');

                            // Create the HTML content for a file
                            const fileContent = `
                                <button class="star-button ${starClass}" data-item-id="${itemId}" data-important="${full.parent_imp}" onclick="toggleStar(${itemId}, ${full.parent_imp})"></button>
                                ${isPDF ? '<i class="fa fa-file-pdf pdf-icon" aria-hidden="true"></i>' : ''}
                                <span class="${isPDF ? 'pdf-file' : ''}">
                                    ${data}
                                </span>
                            `;

                            return `<div>${fileContent}</div>`;
                        } else {
                            // Return empty content if data is null or empty
                            return '';
                        }
                    }
                },
                {
                    data: 'actions',
                    name: 'actions'
                }
                
            ]
        }).on('draw', function () {
        });
    }
   
    
    studentBulletin();
    function studentBulletin() {
        $('#student-bulletin-imp-table').DataTable({
            processing: true,
            info: true,
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
            ajax: importantList,
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
                    data: 'file',
                    name: 'file',
                    render: function (data, type, full, meta) {
                        const starClass = full.parent_imp === '1' ? 'star-important' : 'star-not-important';
                        const itemId = full.id;
                        if (data && typeof data === 'string' && data.trim() !== '') {
                            const isPDF = data.toLowerCase().endsWith('.pdf');

                            // Create the HTML content for a file
                            const fileContent = `
                                <button class="star-button ${starClass}" data-item-id="${itemId}" data-important="${full.parent_imp}" onclick="toggleStar(${itemId}, ${full.parent_imp})"></button>
                                ${isPDF ? '<i class="fa fa-file-pdf pdf-icon" aria-hidden="true"></i>' : ''}
                                <span class="${isPDF ? 'pdf-file' : ''}">
                                    ${data}
                                </span>
                            `;

                            return `<div>${fileContent}</div>`;
                        } else {
                            // Return empty content if data is null or empty
                            return '';
                        }
                    }
                },
                {
                    data: 'actions',
                    name: 'actions'
                }
                
            ]
        }).on('draw', function () {
        });
    }
     // Handle Download action
     $('#parent-bulletin-table').on('click', '.download-link', function (e) {
        e.preventDefault();
        const fileUrl = $(this).data('file-url');
        // Redirect to the file URL for download
        window.location.href = fileUrl;
    });
    $('#pdfSearchInput').on('keyup', function () {
        const searchTerm = $(this).val().toLowerCase();
        
        // Determine which DataTable is active based on the selected tab
        const activeTabId = $('#myTabs .nav-link.active').attr('id');
        console.log(activeTabId);
        let dataTableId;

        if (activeTabId === 'tab1') {
            dataTableId = '#student-bulletin-table';
        } else if (activeTabId === 'tab2') {
            dataTableId = '#student-bulletin-imp-table';
        }

        // Filter the DataTable based on the search term
        $(dataTableId).DataTable().search(searchTerm).draw();
    });

    // Event listener for tab changes
    $('#myTabs a.nav-link').on('shown.bs.tab', function (e) {
        // Trigger the search input on tab change
        $('#pdfSearchInput').trigger('keyup');
    });

});
function openFilePopup(data) {
    const modal = document.getElementById("fileModal");
    const modalTitle = modal.querySelector(".modal-title");
    const modalBody = modal.querySelector(".modal-body");
    const fileTitle = modal.querySelector("#fileTitle");
    const fileDescriptionElement = modal.querySelector("#fileDescription");
    const downloadLink = modal.querySelector("#downloadLink");
    const filePreview = modal.querySelector("#filePreview");
    const previewLink = modal.querySelector("#previewLink");

    modalTitle.innerText = "File Details";
    fileTitle.innerText = data.title;
    
    // Set file description using innerHTML to handle HTML entities
    fileDescriptionElement.innerHTML = data.description;

    // Set the download link
    downloadLink.href = data.image_url;
    downloadLink.innerText = "Download";

    // Set the preview link to open in a new window
    previewLink.href = data.image_url;

    // Set the src of the iframe for preview
    filePreview.src = data.image_url;

    // Open the modal
    $(modal).modal("show");
}

// Function to open the file in a new window
function openFilePreview() {
    const filePreview = document.getElementById("filePreview");
    const fileUrl = filePreview.src;
    window.open(fileUrl, '_blank');
}

function openTab(tabName) {
    // Hide all content
    document.getElementById('BulletinBoard').style.display = 'none';
    document.getElementById('Important').style.display = 'none';

    // Show the selected tab content
    document.getElementById(tabName).style.display = 'block';
}
function toggleStar(itemId, parentImp) {
    const newParentImp = parentImp === 1 ? 0 : 1;
    // Send an AJAX request using FormData
    $.ajax({
        url: starRoute,
        method: 'POST',
        data: {
            token: token,
            branch_id: branchID,
            id: itemId,
            parentImp: newParentImp
        },
        success: function (response) {
            if (response.code === 200) {
                $('#student-bulletin-table').DataTable().ajax.reload(null, false);
                $('#student-bulletin-imp-table').DataTable().ajax.reload(null, false);
                toastr.success(response.message);
            } else {
                toastr.error(response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error saving data:', error);
        }
    });
}



