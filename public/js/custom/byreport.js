var reasonChart;
$(function () {
    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        $("#bysubjectfilter").find("#examnames").empty();
        $("#bysubjectfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');

        $("#bysubjectfilter").find("#sectionID").empty();

        $("#bysubjectfilter").find("#sectionID").append('<option value="">'+select_class+'</option>');


        $.post(sectionByClass, { token: token, branch_id: branchID, class_id: class_id, teacher_id: teacher_id }, function (res) {
            if (res.code == 200) {
                $("#section_drp_div").show();
                $.each(res.data, function (key, val) {
                    $("#bysubjectfilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');

    });
    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#bysubjectfilter';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    function classAllocation(department_id, Selector, classID) {
        $(Selector).find('select[name="class_id"]').empty();
        $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
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
    // change section
    $('#sectionID').on('change', function () {
        var section_id = $(this).val();
        var class_id = $("#changeClassName").val();
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '/' + mm + '/' + dd;
        $("#bysubjectfilter").find("#examnames").empty();
        $("#bysubjectfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');
        $.post(examsByclassandsection, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            section_id: section_id,
            academic_session_id: academic_session_id,
            today: today
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#bysubjectfilter").find("#examnames").append('<option value="' + val.id + '" >' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    $("#bysubjectfilter").validate({
        rules: {
            department_id: "required",
            year: "required",
            class_id: "required",
            section_id: "required",
            examnames: "required",
            report_type: "required"
        }
    });
    $('#bysubjectfilter').on('submit', function (e) {
        e.preventDefault();
        var byclass = $("#bysubjectfilter").valid();
        if (byclass === true) {
            var year = $("#btwyears").val();
            var department_id = $("#department_id").val();
            var semester_id = $("#semester_id").val();
            var session_id = $("#session_id").val();
            var class_id = $("#changeClassName").val();
            var section_id = $("#sectionID").val();
            var exam_id = $("#examnames").val();
            var report_type = $("#report_type").val();

            var classObj = {
                year: year,
                department_id: department_id,
                classID: class_id,
                sectionID: section_id,
                semesterID: semester_id,
                sessionID: session_id,
                examID: exam_id,
                userID: userID,
            };
           // setLocalStorageForExamResultBySubject(classObj);

            // download set start
            $(".downExamID").val(exam_id);
            $(".downDepartmentID").val(department_id);			
            $(".downClassID").val(class_id);
            $(".downSemesterID").val(semester_id);
            $(".downSessionID").val(session_id);
            $(".downSectionID").val(section_id);
            $(".downAcademicYear").val(year);
            
            $(".downReport_type").val(report_type);
            // download set end

            var formData = new FormData();			
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('department_id', department_id);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('exam_id', exam_id);
            formData.append('semester_id', semester_id);
            formData.append('session_id', session_id);
            formData.append('academic_year', year);
            formData.append('report_type', report_type);
            examResultBySubject(formData);
			var formData1 = {
                student_name: "",
				department_id:department_id,
                class_id: class_id,
                section_id: section_id,
				exam_id:exam_id,
				semester_id:semester_id,
                session_id: session_id,
				academic_year:year,
				report_type:report_type,
            };
			//getStudentList(formData1);
        }
		else {
            $("#student").hide("slow");
        }
    });
    function examResultBySubject(formData){

        $("#overlay").fadeIn(300);
            // list mode
            var report_type= $("#report_type").val();
            var department_id= $("#department_id").val();
            var class_id=$("#changeClassName option:selected" ).text();
            //alert(class_id);
            $.ajax({
                url: getbySubject,
                method: "Post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    if (response.code == 200) {
                        if (response.data.grade_list_master.length > 0) {
                            var datasetnew = response.data;
                            //bysubjectdetails_class(datasetnew);
                            $("#overlay").fadeOut(300);
                            if(report_type=='english_communication')
                            {
                                $("#byec_body").show("slow");
                                $("#byreport_body").hide("slow");                                       
                                $("#bypersonal_body").hide("slow");
                            }
                            else if(report_type=='report_card')
                            {
                                $("#byec_body").hide("slow");
                                $("#byreport_body").show("slow");                                       
                                $("#bypersonal_body").hide("slow");
                                    
                                
                                
                            }
                            else
                            {
                                $("#byec_body").hide("slow"); 
                                $("#byreport_body").hide("slow");                                      
                                $("#bypersonal_body").show("slow");
                                if(department_id=='2')
                                {
                                    
                                    $("#secondary_personal").show("slow");
                                    $("#primary_personal").hide("slow"); 
                                }
                                else
                                {
                                    $("#secondary_personal").hide("slow");
                                    $("#primary_personal").show("slow"); 
                                }
                            }
                            
                        } else {
                            $("#overlay").fadeOut(300);
                            toastr.info('No records are available');
                        }
                    } else {
                        toastr.error(data.message);
                        $('#byec_body').hide();
                        $('#byreport_body').hide();					                                     
                        $("#bypersonal_body").hide("slow");
                    }
                }
            });
    }



    $(document).on('click', '.exportToExcel', function (e) {
        // var table = $(this).prev('.table2excel');
        var table = $('.table2excel');
        if (table && table.length) {
            var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
            $(table).table2excel({
                // exclude: ".noExl",
                name: "By Subject",
                filename: downloadFileName + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true,
                preserveColors: preserveColors
            });
        }
    });

});

// find matched
function isKey(key, obj) {
    var keys = Object.keys(obj).map(function (x) {
        return x;
    });
    return keys.indexOf(key) !== -1;
}
function getStudentList(formData) {
        //$("#student").show("slow");
		///alert(2);
        setTimeout(function () {
            $('.btn-danger').removeClass('d-none');
            }, 5000);   
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
            // "language": {

            //     "emptyTable": no_data_available,
            //     "infoFiltered": filter_from_total_entries,
            //     "zeroRecords": no_matching_records_found,
            //     "infoEmpty": showing_zero_entries,
            //     "info": showing_entries,
            //     "lengthMenu": show_entries,
            //     "search": datatable_search,
            //     "paginate": {
            //         "next": next,
            //         "previous": previous
            //     },
            // },
            // exportOptions: { rows: ':visible' },
            serverSide: true,
            ajax: {
                url: studentList,
                data: function (d) {
                    d.student_name = "",
                        d.class_id = formData.class_id,
                        d.section_id = formData.section_id,
                        d.session_id = formData.session_id,
                        d.semester_id = formData.semester_id,
                        d.department_id = formData.department_id,
                        d.exam_id = formData.exam_id,
                        d.academic_year = formData.academic_year,
                        d.report_type = formData.report_type
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