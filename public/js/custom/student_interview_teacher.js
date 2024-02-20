
$(function () {

    $("#changeClassName").on('change', function (e) {
        e.preventDefault();
        var Selector = '#studentInterviewTeacherForm';
        var class_id = $(this).val();
        console.log(class_id);
        var sectionID = "";
        if (class_id) {
            sectionAllocation(class_id,Selector, sectionID);
        }
    });
    $("#changeClassNameAdd").on('change', function (e) {
        e.preventDefault();
        var Selector = '#addStudentInterviewTeacherForm';
        var class_id = $(this).val();
        console.log(class_id);
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
        var Selector = '#studentInterviewTeacherForm';
        var class_id = $("#changeClassName").val();
        var sectionID = $(this).val();
        var student_id ="";
        if (class_id) {
            studentAllocation(class_id, sectionID, Selector, student_id);
        }
    });
    $("#sectionIDAdd").on('change', function (e) {
        e.preventDefault();
        var Selector = '#addStudentInterviewTeacherForm';
        var class_id = $("#changeClassNameAdd").val();
        var sectionID = $(this).val();
        var student_id ="";
        if (class_id) {
            studentAllocation(class_id, sectionID, Selector, student_id);
        }
    });
    function studentAllocation(class_id, sectionID, Selector, student_id){
        //console.log(class_id, sectionID, Selector, student_id);
        $(Selector).find('select[name="student_id"]').empty();
        $(Selector).find('select[name="student_id"]').append('<option value="">'+select_student+'</option>');
        $.post(getStudentList, { token: token, branch_id: branchID, class_id: class_id, section_id: sectionID }, function (res) {
          //  console.log(res);
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
    $("#addStudentInterviewTeacherForm").validate({
        rules: {
            class_id: "required",
            section_id: "required",
            student_id: "required",

        }
    });

    // add Homework
    $('#addStudentInterviewTeacherForm').on('submit', function (e) {
        e.preventDefault();
      console.log("jhgcfxz");
        var studentInterviewCheck = $("#addStudentInterviewTeacherForm").valid();

        if (studentInterviewCheck === true) {
            var form = this;
            var formData = new FormData(form);
            var class_id = $('#changeClassNameAdd').val(); // Get the date value
            var section_id = $('#sectionIDAdd').val(); // Get the date value
            var student_id = $('#student_id').val(); // Get the date value
            var interview_type = $('#interview_type').val(); // Get the date value
            var title = $('#title').val(); // Get the date value
            var interview_file = $('#interview_file')[0].files[0]; // Get the date value
            var description = $('#description').val(); // Get the date value
            
            formData.set('class_id', class_id); // Set the date in the FormData
            formData.set('section_id', section_id); // Set the date in the FormData
            formData.set('student_id', student_id); // Set the date in the FormData
            formData.set('interview_type', interview_type); // Set the date in the FormData
            formData.set('title', title); // Set the date in the FormData
            formData.set('interview_file', interview_file); // Set the date in the FormData
            formData.set('description', description); // Set the date in the FormData
console.log(formData);

            $.ajax({
                url: addStudentInterview,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                     console.log(data)
                    if (data.code == 200) {
                        toastr.success(data.message);
                        $('#addStudentInterviewTeacherForm').find('form')[0].reset();
                       
                        //studentInterviewTable(data.data);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    // rules validation
    $("#studentInterviewTeacherForm").validate({
        rules: {
            class_id: "required",
            section_id: "required",
            student_id: "required",

        }
    });
     // add Homework
     $('#studentInterviewTeacherForm').on('submit', function (e) {
        e.preventDefault();
      
        var studentInterviewCheck = $("#studentInterviewTeacherForm").valid();

        if (studentInterviewCheck === true) {
            $(".studentInterviewShow").show("slow");
            var form = this;
            var formData = new FormData(form);
            var class_id = $('#changeClassName').val(); // Get the date value
            var section_id = $('#sectionID').val(); // Get the date value
            var student_id = $('#student_id').val(); // Get the date value
          
             console.log(student_id);
            formData.set('class_id', class_id); // Set the date in the FormData
            formData.set('section_id', section_id); // Set the date in the FormData
            formData.set('student_id', student_id); // Set the date in the FormData
          
            console.log(formData);
            $.ajax({
                url: getStudentInterviewList,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                     console.log(data)
                    if (data.code == 200) {
                        console.log(data.data);
                       
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
                        '<a href="javascript:void(0)" class="btn btn-blue btn-sm waves-effect waves-light" data-id="' + row.id + '"  id="editPartCBtn"><i class="fe-eye"></i></a>' +
                        '</div>';

                        
                    }
                }
            ]
        }).on('draw', function () {
        });
    }
  
    $(document).on('click', '#editPartCBtn', function () {
        var id = $(this).data('id');
        console.log(id);
    
        $.post(editStudentInterview, { id: id, token: token, branch_id: branchID }, function (data) {
            console.log(data);
    
            // Update modal content dynamically
            updateModalContent(data.data);
    
            // Show the modal
            $('#editModal').modal('show');
        }, 'json');
    });
      // Event handler for edit button click
    $(document).on('click', '.editStudentRemarksBtn', function () {
        // Find the closest comment wrapper within the same row
        var commentWrapper = $(this).closest('tr').find('.comment-wrapper');

        // Enable editing for the comment textarea
        commentWrapper.find('.editable-comment').prop('readonly', false);
    });
    var commentsToSave = [];
    $(document).on('click', '.saveStudentRemarksBtn', function () {
        // Find the closest comment wrapper within the same row
        var commentWrapper = $(this).closest('tr').find('.comment-wrapper');
    
        // Disable editing for the comment textarea
        commentWrapper.find('.editable-comment').prop('readonly', ture);
    
        // Check if commentWrapper has elements
        if (commentWrapper.length > 0) {
            // If there's at least one comment
            commentWrapper.each(function () {
                var commentId = $(this).find('.editable-comment').data('comment-id');
                var editedComment = $(this).find('.editable-comment').val();
                commentsToSave.push({
                    id: commentId,
                    comment: editedComment,
                });
            });
        } else {
            // If there's only one comment
            var singleCommentId = $('.editable-comment').data('comment-id');
            var singleEditedComment = $('.editable-comment').val();
            commentsToSave.push({
                id: singleCommentId,
                comment: singleEditedComment,
            });
        }
    
        // Log the array for debugging
        console.log(commentsToSave);
    
        // Perform additional actions if needed, e.g., save the comments
        // saveCommentToServer(commentsToSave);
    });
    
    function updateModalContent(comments) {
        // Update modal content with the provided comment
        var modalBody = $('#editModal').find('.modal-body');
        
    
        // Iterate through the comments array
        for (var i = 0; i < comments.length; i++) {
            var commentData = comments[i];
            var counter = i + 1; // Incrementing the counter for each comment
            var commentHtml = `<tbody>
            <tr>  
            <td>${counter}</td>
            <td>
                <div class="comment-wrapper">
                    <textarea class="form-control editable-comment" readonly name="comment" id="comment" data-comment-id="${commentData.id}">${commentData.comment}</textarea>
                </div>
            </td> 
            <td>${commentData.created_date}</td>
            <td>${commentData.register_name}</td>
            <td>${commentData.updated_name}</td>
            <td>${commentData.updated_date}</td>
            <td>
                <button type="button" class="btn btn-blue btn-sm waves-effect waves-light editStudentRemarksBtn" data-comment-id="${commentData.id}" data-comment-type="${commentData.type}" style="border-radius: 15px;width: 50px;"><i class="fe-edit"></i></button>
            </td>
        </tr></tbody>
            `;
            var commentTable = modalBody.find('#commentTable');
     
            commentTable.append(commentHtml);
        
        }
    }
    
    
    function saveCommentToServer(commentsToSave) {
        console.log(commentsToSave);
    
        // Make an AJAX request to save the comment
        $.ajax({
            url: updateStudentInterviewComment,
            method: 'POST',
            data: {
                id: commentId,
                comment: comment,
                type: type
            },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.code == 200) {
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }
            },
            error: function (error) {
                console.error('Error saving comment:', error);
            }
        });
    }
    
});

