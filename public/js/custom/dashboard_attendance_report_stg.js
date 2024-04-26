$(function () {
    // if (deptIDs) {
    //     var Selector = '#attendanceFilter';
    //     var department_id = deptIDs;
    //     var classID = classIDS;
    //     classAllocation(department_id, Selector, classID);
    // }
    // if (deptIDs && classIDS) {
    //     $("#attendanceFilter").find("#sectionID").empty();
    //     $("#attendanceFilter").find("#sectionID").append('<option value="">' + select_class + '</option>');
    //     $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: classIDS }, function (res) {
    //         if (res.code == 200) {
    //             $.each(res.data, function (key, val) {
    //                 $("#attendanceFilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
    //             });
    //             if (secIDs != '' || secIDs != null) {
    //                 $("#attendanceFilter").find('select[name="section_id"]').val(secIDs);
    //             }
    //         }
    //     }, 'json');
    // }
    // $("#department_id").on('change', function (e) {
    //     e.preventDefault();
    //     var Selector = '#attendanceFilter';
    //     var department_id = $(this).val();
    //     var classID = "";
    //     classAllocation(department_id, Selector, classID);
    // });
    // function classAllocation(department_id, Selector, classID) {
    //     $(Selector).find('select[name="class_id"]').empty();
    //     $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
    //     $(Selector).find('select[name="section_id"]').empty();
    //     $(Selector).find('select[name="section_id"]').append('<option value="">' + select_class + '</option>');
    //     if (department_id) {
    //         $.post(getGradeByDepartmentUrl,
    //             {
    //                 branch_id: branchID,
    //                 department_id: department_id,
    //                 teacher_id: ref_user_id
    //             }, function (res) {
    //                 if (res.code == 200) {
    //                     $.each(res.data, function (key, val) {
    //                         $(Selector).find('select[name="class_id"]').append('<option value="' + val.id + '">' + val.name + '</option>');
    //                     });
    //                     if (classID != '' || classID != null) {
    //                         $(Selector).find('select[name="class_id"]').val(classID);
    //                     }
    //                 }
    //             }, 'json');
    //     }
    // }
    // // if (deptIDs || classIDS || secIDs) {
    // //     absentDetails(deptIDs, classIDS, secIDs, patternNames);
    // // }
    // // change classroom
    // $('#changeClassName').on('change', function () {
    //     $(".attendanceReport").hide();
    //     var class_id = $(this).val();
    //     $("#attendanceFilter").find("#sectionID").empty();
    //     $("#attendanceFilter").find("#sectionID").append('<option value="">' + select_class + '</option>');

    //     $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: class_id }, function (res) {
    //         if (res.code == 200) {
    //             $.each(res.data, function (key, val) {
    //                 $("#attendanceFilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
    //             });
    //         }
    //     }, 'json');
    // });
    // rules validation
    // $("#attendanceFilter").validate({
    //     rules: {
    //         class_id: "required",
    //         class_id: "required",
    //         section_id: "required",
    //         subject_id: "required",
    //         pattern: "required",
    //         class_date: "required",
    //     }
    // });
    // function absentDetails(deptID, classID, secID, patternN) {

    //     var department_id = deptID;
    //     var class_id = classID;
    //     var section_id = secID;
    //     var pattern = patternN;
    //     var formData = new FormData();
    //     formData.append('branch_id', branchID);
    //     formData.append('department_id', department_id);
    //     formData.append('class_id', class_id);
    //     formData.append('section_id', section_id);
    //     formData.append('staff_id', ref_user_id);
    //     formData.append('pattern', pattern);
    //     formData.append('academic_session_id', academic_session_id);
    //     $.ajax({
    //         url: absent_attendance_reportUrl,
    //         method: "POST",
    //         data: formData,
    //         processData: false,
    //         dataType: 'json',
    //         contentType: false,
    //         success: function (response) {
    //             console.log("response");
    //             console.log(response);
    //             var type = response.data.type;
    //             if (response.code == 200) {
    //                 var absentCount = "";
    //                 if (response.data.absent_details.length > 0) {
    //                     // absentCount = response.data.absent_details['absentCount'];
    //                     absent = response.data.absent_details[0].absentCount;
    //                     if (absent === null || absent === undefined || absent === '') {
    //                         // The value is either null, undefined, or an empty string
    //                         absentCount = '-';

    //                     } else {
    //                         // The value is not null, undefined, or an empty string
    //                         absentCount = absent;
    //                     }
    //                 }
    //                 $('#attendanceInfo').empty();
    //                 var myvar = '<div class="col-12">' +
    //                     '<div class="row">' +
    //                     '<div class="col-4">' +
    //                     '</div>' +
    //                     '<div class="col-4">' +
    //                     '<div class="card">' +
    //                     '<div class="card-body">' +
    //                     '<p style="text-align:center;">' + type + ' Absence</p>' +
    //                     '<div class="widget-rounded-circle">' +
    //                     '<div class="card-widgets">' +
    //                     '</div>' +
    //                     '<div class="row">' +
    //                     '<div class="col-12">' +
    //                     '<div class="">' +
    //                     '<div class="greetingCntRing" style="transform: translate(224%, 0%);">' +
    //                     '<p>' + absentCount + '</p>' +
    //                     '</div>' +
    //                     '</div>' +
    //                     '</div>' +
    //                     '</div>' +
    //                     '</div>' +
    //                     '</div>' +
    //                     '</div>' +
    //                     '</div>' +
    //                     '</div>' +
    //                     '</div>';
    //                 $("#attendanceInfo").append(myvar);

    //             }
    //         }
    //     });
    // }
    $.ajax({
        url: studentPlanToLeaveListUrl, // Replace with your API endpoint
        method: 'GET',
        dataType: 'json',
        data: {
            branch_id: branchID
        },
        success: function (response) {
            // dataSetNew
            var dataSetNew = response.data;
            studentTerminationList(dataSetNew);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // console.error('Example 2 Error:', textStatus, errorThrown);
            studentTerminationList([]);
        }
    });
    $.ajax({
        url: studentTransferListUrl, // Replace with your API endpoint
        method: 'GET',
        dataType: 'json',
        data: {
            branch_id: branchID
        },
        success: function (response) {
            // dataSetNew
            var dataSetNew = response.data;
            studentTrasnferList(dataSetNew);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // console.error('Example 2 Error:', textStatus, errorThrown);
            studentTrasnferList([]);
        }
    });
    $.ajax({
        url: studentNewJoiningListUrl, // Replace with your API endpoint
        method: 'post',
        data: {
            branch_id: branchID,
            academic_session_id: academic_session_id
        },
        dataType: 'json',
        success: function (response) {
            //console.log("response");
            // console.log(response);
            // dataSetNew
            var dataSetNew = response.data;
            studentJoiningList(dataSetNew);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // console.error('Example 2 Error:', textStatus, errorThrown);
            studentJoiningList([]);
        }
    });
    function studentTerminationList(dataSetNew) {
        // clear old data in datatable
        $('#student-termination-list').DataTable().clear().destroy();
        $('#student-termination-list td').empty();

        $('#student-termination-list').DataTable({
            processing: true,
            bDestroy: true,
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
            data: dataSetNew,
            "pageLength": 10,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'gender',
                    name: 'gender'
                },
                {
                    data: 'class_name',
                    name: 'class_name'
                },
                {
                    data: 'section_name',
                    name: 'section_name'
                },
                {
                    data: 'schedule_date_of_termination',
                    name: 'schedule_date_of_termination'
                },
                {
                    data: 'termination_status',
                    name: 'termination_status'
                },
                {
                    data: 'date_of_termination',
                    name: 'date_of_termination'
                },
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                }
            ]
        }).on('draw', function () {
        });
    }
    function studentTrasnferList(dataSetNew) {
        // clear old data in datatable
        $('#student-transfer-list').DataTable().clear().destroy();
        $('#student-transfer-list td').empty();

        $('#student-transfer-list').DataTable({
            processing: true,
            bDestroy: true,
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
            data: dataSetNew,
            "pageLength": 10,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'gender',
                    name: 'gender'
                },
                {
                    data: 'class_name',
                    name: 'class_name'
                },
                {
                    data: 'section_name',
                    name: 'section_name'
                },
                {
                    data: 'schedule_date_of_termination',
                    name: 'schedule_date_of_termination'
                },
                {
                    data: 'termination_status',
                    name: 'termination_status'
                },
                {
                    data: 'date_of_termination',
                    name: 'date_of_termination'
                },
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                }
            ]
        }).on('draw', function () {
        });
    }
    function studentJoiningList(dataSetNew) {
        // clear old data in datatable
        $('#student-new-joining-list').DataTable().clear().destroy();
        $('#student-new-joining-list td').empty();

        $('#student-new-joining-list').DataTable({
            processing: true,
            bDestroy: true,
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
            data: dataSetNew,
            "pageLength": 5,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'student_name',
                    name: 'student_name'
                },
                // {
                //     data: 'dept_name',
                //     name: 'dept_name'
                // },
                {
                    data: 'class_name',
                    name: 'class_name'
                },
                {
                    data: 'section_name',
                    name: 'section_name'
                },
                {
                    data: 'gender',
                    name: 'gender'
                },
                // {
                //     data: 'email',
                //     name: 'email'
                // },
                {
                    data: 'admission_date',
                    name: 'admission_date'
                },
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                }
            ]
        }).on('draw', function () {
        });
    }
});