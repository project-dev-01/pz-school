$(function () {
    $('#emp-table').DataTable({
        processing: true,
        info: true,
        bDestroy: true,
        // dom: 'lBfrtip',
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
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 14, 15, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32]
                },


                customize: function (doc) {
                    doc.pageMargins = [50, 50, 50, 50];
                    doc.defaultStyle.fontSize = 7;
                    doc.styles.tableHeader.fontSize = 8;
                    doc.styles.title.fontSize = 12;
                    doc.pageSize = 'A3';
                    doc.pageOrientation = 'landscape';
                    // Remove spaces around page title
                    doc.content[0].text = doc.content[0].text.trim();
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
        ajax: retireEmployeeList,
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
                data: 'emp_name',
                name: 'emp_name'
            },
            {
                data: 'english_emp_name',
                name: 'english_emp_name',
                visible: false
            },
            {
                data: 'furigana_emp_name',
                name: 'furigana_emp_name',
                visible: false
            },
            {
                data: 'email',
                name: 'email',
                visible: false
            },
            {
                data: 'city',
                name: 'city',
                visible: false
            },
            {
                data: 'state',
                name: 'state',
                visible: false
            },
            {
                data: 'country',
                name: 'country',
                visible: false
            },
            {
                data: 'post_code',
                name: 'post_code',
                visible: false
            },
            {
                data: 'present_address',
                name: 'present_address',
                visible: false
            },
            {
                data: 'permanent_address',
                name: 'permanent_address',
                visible: false
            },
            {
                data: 'nric_number',
                name: 'nric_number',
                visible: false
            },
            {
                data: 'visa_number',
                name: 'visa_number',
                visible: false
            },
            {
                data: 'passport',
                name: 'passport',
                visible: false
            },
            {
                data: 'mobile_no',
                name: 'mobile_no',
                visible: false
            },
            {
                data: 'gender',
                name: 'gender',
                visible: false
            },
            {
                data: 'height',
                name: 'height',
                visible: false
            }, {
                data: 'weight',
                name: 'weight',
                visible: false
            },
            {
                data: 'allergy',
                name: 'allergy',
                visible: false
            },
            {
                data: 'blood_group',
                name: 'blood_group',
                visible: false
            },
            {
                data: 'nationality',
                name: 'nationality',
                visible: false
            },
            {
                data: 'religion_name',
                name: 'religion_name',
                visible: false
            },
            {
                data: 'birthday',
                name: 'birthday'
            },
            {
                data: 'joining_date',
                name: 'joining_date',
                visible: false
            },
            {
                data: 'tenure',
                name: 'tenure'
            },
            {
                data: 'department_name',
                name: 'department_name'
            },
            {
                data: 'designation_name',
                name: 'designation_name',
                render: function (data, type, row) {
                    if (data) {
                        return data.replace(/,/g, ' => '); // Replace all commas with arrows
                    } else {
                        return ''; // Return an empty string if data is null
                    }
                }
            },
            {
                data: 'staff_position_name',
                name: 'staff_position_name',
                visible: false
            },
            {
                data: 'staff_category_name',
                name: 'staff_category_name',
                visible: false
            },
            {
                data: 'employment_status',
                name: 'employment_status'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'designation_start_date',
                name: 'designation_start_date',
                visible: false,  // Hide this column
                render: function (data, type, row) {
                    if (data) {
                        return data.replace(/,/g, ' => '); // Replace all commas with arrows
                    } else {
                        return ''; // Return an empty string if data is null
                    }
                }
            },
            {
                data: 'designation_end_date',
                name: 'designation_end_date',
                visible: false,  // Hide this column
                render: function (data, type, row) {
                    if (data) {
                        var modifiedData = data.replace(/,/g, ' => '); // Replace commas with arrows
                        console.log(modifiedData);

                        if (modifiedData.includes('=>')) {
                            var parts = modifiedData.split(' => ');
                            if (parts[1].trim() === '') {
                                parts[1] = 'Present';
                                modifiedData = parts.join(' => ');
                            }
                        }
                        return modifiedData;
                    } else {
                        return ''; // Return an empty string if data is null
                    }
                }
            },

            // {
            //     data: 'actions',
            //     name: 'actions',
            //     orderable: false,
            //     searchable: false
            // },
        ],
        // columnDefs: [
        //     {
        //         "targets": 1,
        //         "className": "table-user",
        //         "render": function (data, type, row, meta) {
        //             var currentImg = studentImg + row.photo;
        //             var img = (row.photo != null) ? currentImg : defaultImg;
        //             var first_name = '<img src="' + img + '" class="mr-2 rounded-circle">' +
        //                 '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
        //             return first_name;
        //         }
        //     },

        // ]
    });
});
