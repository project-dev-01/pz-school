
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
            console.log(res);
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
        console.log(class_id, sectionID, Selector, student_id);
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
                    data: 'message_count'
                },{
                    data: null,
                    render: function (data, type, row) {
                        // Add edit and delete buttons
                        return '<div class="button-list">' +
                        '<a href="javascript:void(0)" class="btn btn-blue btn-sm waves-effect waves-light" data-id="' + row.id + '"  id="editCommentCBtn"><i class="fe-eye"></i></a>' +
                        '<a href="javascript:void(0)" class="btn btn-green btn-sm waves-effect waves-light" data-id="' + row.student_interviewId + '" data-type="' + row.type + '" id="addCommentBtn"><i class="fe-plus"></i></a>' +
                        '</div>';

                        
                    }
                }
            ], columnDefs: [{
                targets: 6, // Index of the 'type' column
                type: 'num-fmt', // Use numeric formatting for this column
                render: function(data, type, row) {
                    // Check the value of 'type' and return the appropriate display
                    if (data === 1) {
                        return 'Three-parties interview';
                    } else if (data === 2) {
                        return 'Awareness';
                    } else {
                        return ''; // Return an empty string for other values
                    }
                }
            }]
        }).on('draw', function () {
        });
    }
  
    $(document).on('click', '#editCommentCBtn', function () {
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
   
   
    
    function updateModalContent(comments) {
        // Update modal content with the provided comment
    var modalBody = $('#editModal').find('.modal-body');
    var commentTable = modalBody.find('#commentTable');
    var tableBody = commentTable.find('tbody');
    tableBody.empty();
    // Create the tbody element outside the loop
    var tbodyHtml = '<tbody>';

    // Iterate through the comments array
    for (var i = 0; i < comments.length; i++) {
        var commentData = comments[i];
       
        var counter = i + 1; // Incrementing the counter for each comment
        var editButtonHtml = ''; // Initialize the edit button HTML

        // Check if the current user created the comment
        if (commentData.created_by == currentUserId) {
            // If the comment was created by the current user, show the edit button
            editButtonHtml = `
                <button type="button" class="btn btn-blue btn-sm waves-effect waves-light editStudentRemarksBtn" 
                        data-comment-id="${commentData.id}" data-comment-type="${commentData.type}" 
                        style="border-radius: 15px;width: 50px;">
                    <i class="fe-edit"></i>
                </button>`;
        }
        var commentRowHtml = `
            <tr>  
                <td>${counter}</td>
                <td>
                    <div class="comment-wrapper">
                        <textarea class="form-control editable-comment" readonly name="comment" id="comment" data-comment-id="${commentData.id}">${commentData.comment}</textarea>
                    </div>
                </td> 
                <td>${commentData.created_date ? commentData.created_date : ''}</td>
                <td>${commentData.register_name ? commentData.register_name : ''}</td>
                <td>${commentData.updated_name ? commentData.updated_name : ''}</td>
                <td>${commentData.updated_date ? commentData.updated_date : ''}</td>
                <td>${editButtonHtml}</td> 
            </tr>
        `;
        
        // Append each comment row HTML to the tbody HTML
        tbodyHtml += commentRowHtml;
    }

        // Close the tbody element
        tbodyHtml += '</tbody>';

        // Append the tbody HTML to the comment table
       
        commentTable.append(tbodyHtml);
    }
    var editedCommentRows = []; // Array to store references to rows with edited comments

    // Event handler for edit button click
    $(document).on('click', '.editStudentRemarksBtn', function () {
        // Store a reference to the parent row containing the edited comment
        var editedCommentRow = $(this).closest('tr');
        
        // Enable editing for the comment textarea
        editedCommentRow.find('.editable-comment').prop('readonly', false);

        // Add the edited row to the array
        editedCommentRows.push(editedCommentRow);
    });

    // Event handler for save button click
    $(document).on('click', '.saveStudentRemarksBtn', function () {
        // Iterate over each edited row
        editedCommentRows.forEach(function(editedCommentRow) {
            // Retrieve the edited comment and its ID from the row
            var editedCommentTextarea = editedCommentRow.find('.editable-comment');
            var commentId = editedCommentTextarea.data('comment-id');
            var editedComment = editedCommentTextarea.val();

            // Log the retrieved comment and its ID for debugging
            console.log("Retrieved comment ID:", commentId);
            console.log("Retrieved comment:", editedComment);
            $.ajax({
                url: updateStudentInterviewComment,
                method: 'POST',
                data: {
                    id: commentId,
                    comment: editedComment
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
        });

        // Clear the array after saving all edited comments
        editedCommentRows = [];
    });

    $(document).on('click', '#addCommentBtn', function() {
        var commentId = $(this).data('id');
        var type = $(this).data('type');
        // Populate modal with relevant data
        $('#addCommentModal').modal('show');
  
        // Submit comment form
        $('#commentForm').off('submit').on('submit', function(e) {
          e.preventDefault();
          var commentText = $('#commentText').val();
  
          // Send AJAX request to save the comment
          $.ajax({
            url: addStudentInterviewComment,
            method: 'POST',
            data: {
              id: commentId,
              comment: commentText,
              type: type
            },
            success: function(data) {
              // Handle success response
              if (data.code == 200) {
                toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }
              // Close the modal
              $('#addCommentModal').modal('hide');
            },
            error: function(xhr, status, error) {
              // Handle error
              console.error('Error adding comment:', error);
            }
          });
        });
      });
    
});

