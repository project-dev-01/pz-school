
$(function () {

    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#studentInterviewForm';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    function classAllocation(department_id, Selector, classID) {
        $(Selector).find('select[name="class_id"]').empty();
        $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
        $(Selector).find('select[name="section_id"]').empty();
        $(Selector).find('select[name="section_id"]').append('<option value="">' + select_class + '</option>');
       console.log("first time");
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
    $("#changeClassName").on('change', function (e) {
        e.preventDefault();
        var Selector = '#studentInterviewForm';
        var class_id = $(this).val();
        var sectionID = "";
        if (class_id) {
            sectionAllocation(class_id,Selector, sectionID);
        }
    });
    function sectionAllocation(class_id, Selector, sectionID) {
       
        $(Selector).find('select[name="section_id"]').empty();
        $(Selector).find('select[name="section_id"]').append('<option value="">' + select_class + '</option>');

        $.post(sectionByClass, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $(Selector).find('select[name="section_id"]').append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
                if (sectionID != '') {
                    $(Selector).find('select[name="section_id"]').val(sectionID);
                }
            }
        }, 'json');
    }
    $("#sectionID").on('change', function (e) {
        e.preventDefault();
        var Selector = '#studentInterviewForm';
        var class_id = $("#changeClassName").val();
        var sectionID = $(this).val();
        var student_id ="";
        if (class_id) {
            studentAllocation(class_id, sectionID, Selector, student_id);
        }
    });
    function studentAllocation(class_id, sectionID, Selector, student_id){
        console.log(class_id, sectionID, Selector, student_id);
        $(Selector).find('select[name="student_id"]').empty();
        $(Selector).find('select[name="student_id"]').append('<option value="">'+select_student+'</option>');
        $.post(getStudentList, { token: token, branch_id: branchID, class_id: class_id, section_id: sectionID }, function (res) {
            console.log(res);
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $(Selector).find('select[name="student_id"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                });
                if (student_id != '') {
                    $(Selector).find('select[name="student_id"]').val(student_id);
                }
            }
        }, 'json');
    }


    // rules validation
    $("#studentInterviewForm").validate({
        rules: {
            department_id: "required",
            class_id: "required",
            section_id: "required",
           // student_id: "required",

        }
    });

    // add Homework
    $('#studentInterviewForm').on('submit', function (e) {
        e.preventDefault();
      
        var studentInterviewCheck = $("#studentInterviewForm").valid();

        if (studentInterviewCheck === true) {
            $(".studentInterviewShow").show("slow");
            var form = this;
            var formData = new FormData(form);
            var department_id = $('#department_id').val(); // Get the date value
            var class_id = $('#changeClassName').val(); // Get the date value
            var section_id = $('#sectionID').val(); // Get the date value
            var student_id = $('#student_id').val(); // Get the date value
        console.log(department_id);
        console.log(class_id);
        console.log(section_id);
        console.log(student_id);

            formData.set('department_id', department_id); // Set the date in the FormData
            formData.set('class_id', class_id); // Set the date in the FormData
            formData.set('section_id', section_id); // Set the date in the FormData
            formData.set('student_id', student_id); // Set the date in the FormData

            $.ajax({
                url: getStudentInterviewList,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    // console.log(data)
                    if (data.code == 200) {
                        console.log(data.data);
                      //  $('#studentInterviewForm').find('form')[0].reset();
                       
                        studentInterviewTable(data.data);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
   
    function studentInterviewTable(dataSetNew) {
        
        $('#studentInterviewTable').DataTable({
            processing: true,
            bDestroy: true,
            info: true,
            dom: 'lrt',
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
            paging: false,
            searching: false,
            data: dataSetNew,
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
                    data: 'department_name'
                },
                {
                    data: 'class_name'
                },
                {
                    data: 'section_name'
                },
                {
                    data: 'student_name'
                },
                {
                    data: 'type'
                },
                {
                    data: 'title'
                }, 
                {
                    data: 'latest_type'
                },{
                    data: null,
                    render: function (data, type, row) {
                        // Add edit and delete buttons
                        return '<div class="button-list">' +
                        '<a href="javascript:void(0)" class="btn btn-blue btn-sm waves-effect waves-light" data-id="' + row.id + '"  id="editPartCBtn"><i class="fe-edit"></i></a>' +
                        '<a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' + row.id + '"  id="deletePartCBtn"><i class="fe-trash-2"></i></a>' +
                        '</div>';

                        
                    }
                }
            ]
        }).on('draw', function () {
        });
    }
   
});

