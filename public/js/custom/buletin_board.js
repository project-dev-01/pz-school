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
    // Function to handle file input change event
    document.getElementById('file').addEventListener('change', function(e) {
        var files = e.target.files;
        var fileList = document.getElementById('file-list');
        var maxSizeInBytes = 10 * 1024 * 1024;
        var totalSize = 0; 

        // Clear existing file list
        fileList.innerHTML = '';

        var errorText = document.querySelector('.file_error');

        if (files.length > 5) {
            errorText.textContent = 'You can only select up to 5 files.';
            this.value = ''; // Clear the file input to prevent selection of more files
            return;
        } else {
            errorText.textContent = ''; // Clear error message if within limit
        }
         // Calculate total size of all selected files
            for (var i = 0; i < files.length; i++) {
                totalSize += files[i].size;
            }

            // Check if total size exceeds the 20 MB limit
            if (totalSize > maxSizeInBytes) {
                var errorText = document.querySelector('.file_error');
                errorText.textContent = 'Total files size should not exceed 10 MB.';
                this.value = ''; // Clear the file input to prevent selection of more files
                return;
            }

        // Iterate over selected files
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var listItem = document.createElement('div');
           
            // Display file name
            listItem.textContent = file.name;

              // Check if file size exceeds the limit
            if (file.size > maxSizeInBytes) {
                errorText.textContent = 'File size should not exceed 20 MB.';
                this.value = ''; // Clear the file input to prevent selection of more files
                return;
            } else {
                errorText.textContent = ''; // Clear error message if within limit
            }

            // Add remove button
            var removeButton = document.createElement('button');
            removeButton.textContent = 'X';
            removeButton.setAttribute('type', 'button');
            removeButton.classList.add('btn', 'btn-sm', 'btn-danger', 'ml-2');
            removeButton.addEventListener('click', removeFile.bind(null, file));
            listItem.appendChild(removeButton);

            // Append file item to list
            fileList.appendChild(listItem);
        }
    });

    // Function to handle remove file button click
    function removeFile(file) {
        var input = document.getElementById('file');
        var files = Array.from(input.files);
        var index = files.indexOf(file);
        if (index !== -1) {
            files.splice(index, 1);
            var dataTransfer = new DataTransfer();
            files.forEach(function(file) {
                dataTransfer.items.add(file);
            });
            input.files = dataTransfer.files;
            input.dispatchEvent(new Event('change'));
        }
    }
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
       // var fileName = $("#file").val();

        // Check if fileName is not empty
        // if (fileName.trim() !== '') {
        //     var ext = fileName.split('.').pop().toLowerCase();
        
        //     // Validate file extension only if fileName is not empty and is a PDF file
        //     if ($.inArray(ext, ['pdf']) === -1) {
        //         $(form).find('span.file_error').text('Please select a PDF file.');
        //         // You can optionally return false here to prevent form submission
        //     }
        // }
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
            var files = $("#file").get(0).files;
            // var file = $('#file')[0].files[0];
            // console.log(file);
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
          //  formData.append('file', file);
            // Append each file to FormData
            for (var i = 0; i < files.length; i++) {
                formData.append('file[]', files[i]);
            }

            $('#loaderOverlay').show();
            
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
                       
                        $('#buletin-table').DataTable().ajax.reload(null, false);
                        // Redirect after a delay
                        setTimeout(function() {
                            window.location.href = bulletin;
                        }, 500); // Redirect after 1 second
                        $('#loaderOverlay').hide();
                        toastr.success(data.message);

                        
                       
                    } else {
                        toastr.error(data.message);
                        $('#loaderOverlay').hide();
                    }
                }
            });
        }
    });
    document.getElementById('files').addEventListener('change', function(e) {
        var files = e.target.files;
        var fileList = document.getElementById('file-lists');

        // Clear existing file list
        fileList.innerHTML = '';

        var errorText = document.querySelector('.file_error');

        if (files.length > 5) {
            errorText.textContent = 'You can only select up to 5 files.';
            this.value = ''; // Clear the file input to prevent selection of more files
            return;
        } else {
            errorText.textContent = ''; // Clear error message if within limit
        }

        // Iterate over selected files
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var listItem = document.createElement('div');

            // Display file name
            listItem.textContent = file.name;

            // Add remove button
            var removeButton = document.createElement('button');
            removeButton.textContent = 'X';
            removeButton.setAttribute('type', 'button');
            removeButton.classList.add('btn', 'btn-sm', 'btn-danger', 'ml-2');
            removeButton.addEventListener('click', removeFiles.bind(null, file));
            listItem.appendChild(removeButton);

            // Append file item to list
            fileList.appendChild(listItem);
        }
    });

    // Function to handle remove file button click
    function removeFiles(file) {
        var input = document.getElementById('files');
        var files = Array.from(input.files);
        var index = files.indexOf(file);
        if (index !== -1) {
            files.splice(index, 1);
            var dataTransfer = new DataTransfer();
            files.forEach(function(file) {
                dataTransfer.items.add(file);
            });
            input.files = dataTransfer.files;
            input.dispatchEvent(new Event('change'));
        }
    }
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
           // var file = $('#files')[0].files[0];
           var files = $("#files").get(0).files;
            //console.log(file);
            var class_id = $("#changeClassNames").val();
            var section_id = $("#filtersectionIDs").val();
            var student_id = $("#student_ids").val();
            var parent_id = $("#parent_ids").val();
            var empDepartment = $("#empDepartments").val();
            var date = $("#publish_dates").val();
            var publish_end_dates = $("#publish_end_dates").val();
            var add_to_dash = $("#add_to_dashs").val();
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
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('student_id', student_id);
            formData.append('parent_id', parent_id);
            formData.append('empDepartment', empDepartment);
           // formData.append('publish', publish);
           formData.append('add_to_dash', add_to_dash);
            formData.append('date', date);
            formData.append('publish_end_dates',publish_end_dates);
            formData.append('oldfile', $('#oldfile').text());
            //formData.append('file', file);
            // Append each file to FormData
            for (var i = 0; i < files.length; i++) {
                formData.append('file[]', files[i]);
            }
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
            console.log("testing");
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
            $('#selectionLegends').text('Parent Student Section');
        }else if (selectedOptions && selectedOptions.includes('4') && selectedOptions.includes('5')){
            $('#edit_class').show();
            $('#departments').show();
            $('#parents').show();
            $('#selectionLegends').text('Parent Section');
            $('#students').hide();
        }else if (selectedOptions && selectedOptions.includes('5') && selectedOptions.includes('6')){
            $('#edit_class').show();
            $('#students').show();
            $('#parents').show();
            $('#selectionLegends').text('Parent Student Section');
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
             $('#selectionLegends').text('Parent Section');
        }else if (selectedOptions && selectedOptions.includes('6')) {
            // Hide the other dropdown and show class dropdown
            $('#departments').hide();
            $('#edit_class').show();
            $('#students').show();
            $('#parents').hide();
            $('#selectionLegends').text('Student Section');
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
          //  $('#changeClassNames').val(data.data.class_id);
            var class_idValues = [];

            if (data.data.class_id) {
                if (typeof data.data.class_id === 'string' && data.data.class_id.includes(',')) {
                    // Split the values if there's a comma
                    class_idValues = data.data.class_id.split(',');
                } else {
                    // Convert the single value to an array
                    class_idValues = [data.data.class_id];
                }
            }
    
            // Populate and set the selected values for department_id dropdown
            $('#changeClassNames').val(class_idValues).trigger('change');
    
            if (data.data.class_id != "") {
                var class_id = data.data.class_id;
                var sectionID = data.data.section_id;
                sectionAllocation(class_id, sectionID);
            }
            if(data.data.class_id != "" && data.data.section_id != "" && data.data.parent_id != "")
            {
                var class_idValues = [];
                if (typeof data.data.class_id === 'string' && data.data.class_id.includes(',')) {
                    // Split the values if there's a comma
                    class_idValues = data.data.class_id.split(',');
                } else {
                    // Convert the single value to an array
                    class_idValues = [data.data.class_id];
                }
                var sectionID = data.data.section_id;
                var parent_id  = data.data.parent_id;
                parentAllocation(class_idValues, sectionID, parent_id);
            }
            if(data.data.class_id != "" && data.data.section_id != "" && data.data.student_id != "")
            {
                var class_idValues = [];
                if (typeof data.data.class_id === 'string' && data.data.class_id.includes(',')) {
                    // Split the values if there's a comma
                    class_idValues = data.data.class_id.split(',');
                } else {
                    // Convert the single value to an array
                    class_idValues = [data.data.class_id];
                }
                
                var sectionID = data.data.section_id;
                var student_id  = data.data.student_id;
               studentAllocation(class_idValues, sectionID, student_id);
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
             if (data.data.add_dashboard === 1) {
                $('#add_to_dashs').prop('checked', true);
            } else {
                $('#add_to_dashs').prop('checked', false);
            }
            $('.editBuletin').modal('show');
        }, 'json');
        //console.log(id);
    });
  
    $(".add_class_names").on('change', function (e) {
        e.preventDefault();
       
        
        var selectedClassIds = $(this).val();
        
        if (selectedClassIds && selectedClassIds.length > 0) {
            // Loop through each selected class ID
            $.each(selectedClassIds, function(index, class_id) {
                var sectionID = ""; // Initialize section ID (you can customize this based on your needs)
                sectionAllocation(class_id, sectionID);
            });
        }
    });
    function sectionAllocation(class_id, sectionID) {
    
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
    
    $("#filtersectionIDs").on('change', function (e) {
        e.preventDefault();
        var target_user = $("#target_users").val();
        var class_id = $("#changeClassNames").val();
        var section_id = $("#filtersectionIDs").val();
       
      // console.log('Active div data-value:', activeDivDataValue);  // Use the stored data-value
        //console.log(target_user,class_id,section_id);
       if(target_user.includes('6') && target_user.includes('5'))
       {
            $("#student_ids").empty();
            $("#student_ids").append('<option value="">'+select_student+'</option>');
            $.post(getStudentList, { token: token, branch_id: branchID, class_id: class_id, section_id: section_id }, function (res) {
                console.log(res);
                if (res.code == 200) {
                    $.each(res.data, function (key, val) {
                        $("#student_ids").append('<option value="' + val.id + '">' + val.name + '</option>');
                    });
                }
            }, 'json');
            $("#parent_ids").empty();
            $("#parent_ids").append('<option value="">Select Parent</option>');

            $.post(getParentList, { token: token, branch_id: branchID, class_id: class_id, section_id: section_id }, function (res) {
                console.log(res);
                if (res.code == 200) {
                    $.each(res.data, function (key, val) {
                        $("#parent_ids").append('<option value="' + val.id + '">' + val.parent_name + '</option>');
                    });
                }
            }, 'json');
       }else if(target_user.includes('5'))
       {
            $("#parent_ids").empty();
            $("#parent_ids").append('<option value="">Select Parent</option>');
            console.log(target_user,class_id,section_id);
            console.log("testing");
            $.post(getParentList, { token: token, branch_id: branchID, class_id: class_id, section_id: section_id }, function (res) {
                console.log(res);
                if (res.code == 200) {
                    $.each(res.data, function (key, val) {
                        $("#parent_ids").append('<option value="' + val.id + '">' + val.parent_name + '</option>');
                    });
                }
            }, 'json');
       }else {

        $("#student_ids").empty();
        $("#student_ids").append('<option value="">'+select_student+'</option>');
        $.post(getStudentList, { token: token, branch_id: branchID, class_id: class_id, section_id: section_id }, function (res) {
            console.log(res);
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#student_ids").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
       }
       
    });
   
});