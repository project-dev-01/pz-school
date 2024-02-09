
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
    $('#saveButton').on('click', function (e) {
        e.preventDefault();
     // Validate the form
     if (!validateForm()) {
        // If validation fails, do not proceed with the form submission
        return;
    }
        // Gather data from healthLogBookForm
    var formData = new FormData($('#healthLogBookForm')[0]);
    var temp = $('#temp').val();
    var weather = $('#weather').val();
    var humidity = $('#humidity').val();
    var event_notes_a = $('#description').val();
    var event_notes_b = $('#remarks').val();
    var date = $('#date_of_homework').val(); // Get the date value

    formData.set('temp', temp);
    formData.set('weather', weather);
    formData.set('humidity', humidity);
    formData.set('event_notes_a', event_notes_a);
    formData.set('event_notes_b', event_notes_b);
    formData.set('date', date); // Set the date in the FormData

    // // Log the entire FormData object using entries()
    // for (var pair of formData.entries()) {
    //     console.log(pair[0] + ': ' + pair[1]);
    // }

        // Submit the save form
        $.ajax({
            url: saveHealthLogBooksList,
            method: "post",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
               toastr.success(data.message);
            },
            error: function (xhr, status, error) {
                // Handle error if needed
                toastr.error("Error: " + xhr.status + ": " + xhr.statusText);
            }
        });
    });
    function validateForm() {
        // Check each field one by one
    if ($('#temp').val() === '') {
        $('#temp_error').text('Please enter temperature.');
        return false;
    }

    if ($('#weather').val() === '') {
        $('#weather_error').text('Please enter weather.');
        return false;
    }

    if ($('#humidity').val() === '') {
        $('#humidity_error').text('Please enter humidity.');
        return false;
    }

    if ($('#description').val() === '') {
        $('#description_error').text('Please enter event notes a.');
        return false;
    }

    if ($('#remarks').val() === '') {
        $('#remarks_error').text('Please enter event notes b.');
        return false;
    }

    return true;
    }
    $('#addButton').on('click', function (e) {
        e.preventDefault();
        console.log("hugygv");
           // Gather data from healthLogBookForm
            var formData = new FormData($('#healthLogBookForm')[0]);
            var healthlogID = $('#healthlogID').val();
            console.log(healthlogID);
            var department_id = $('#department_id').val();
            var changeClassName = $('#changeClassName').val();
            var sectionID = $('#sectionID').val();
            var student_id = $('#student_id').val();
            var time = $('#time').val();
            var event_notes_c = $('#descriptions').val();
            var date = $('#date_of_homework').val(); // Get the date value
            var selectedInjuryName = $('#injury_name').val();
            var selectedPlace = $('#place').val();
            var selectedInjuryTreatment = $('#injury_treatment').val();
            var selectedPart = $('#part').val();
            var selectedIllness = $('#illness_name').val();
            var selectedIllnessTreatment = $('#illness_treatment').val();
            var selectedReasonTemp = $('#reasonTemp').val();
            var selectedMeal = $('#meal').val();
            var selectedDefecation = $('#defecation').val();
            var selectedTarget = $('#target').val();
            var selectedSlept_time = $('#slept_time').val();
            var selectedHealth_treatment = $('#health_treatment').val();
            var health_consult = $('#health_consult').val();
            var illness = $('#illness').val();
            var injury = $('#injury').val();
            var Attend_to_heatlthcare_room = $('#Attend_to_heatlthcare_room').val();
            var tabs = injury + ', ' + illness  + ', ' + health_consult + ', ' + Attend_to_heatlthcare_room;
            var selectedText = {
                InjuryName: getSelectedText('#injury_name'),
                Place: getSelectedText('#place'),
                InjuryTreatment: getSelectedText('#injury_treatment'),
                Part: getSelectedText('#part'),
                Illness: getSelectedText('#illness_name'),
                IllnessTreatment: getSelectedText('#illness_treatment'),
                ReasonTemp: $('#reasonTemp').val(),
                Meal: getSelectedText2('#meal'),
                Defecation: getSelectedText2('#defecation'),
                Target: getSelectedText('#target'),
                SleptTime: getSelectedText2('#slept_time'),
                HealthTreatment: getSelectedText('#health_treatment')
            };

           var mainReasonText = Object.values(selectedText).filter(value => value !== '').join(', ');
            formData.set('healthlogID', healthlogID);
            formData.set('department_id', department_id);
            formData.set('changeClassName', changeClassName);
            formData.set('sectionID', sectionID);
            formData.set('student_id', student_id);
            formData.set('time', time);
            formData.set('event_notes_c', event_notes_c);
            formData.set('tab', tabs);
            formData.set('tab_details', mainReasonText);
            formData.set('selectedInjuryName', selectedInjuryName);
            formData.set('selectedPlace', selectedPlace);
            formData.set('selectedInjuryTreatment', selectedInjuryTreatment);
            formData.set('selectedPart', selectedPart);
            formData.set('selectedIllness', selectedIllness);
            formData.set('selectedIllnessTreatment', selectedIllnessTreatment);
            formData.set('selectedReasonTemp', selectedReasonTemp);
            formData.set('selectedMeal', selectedMeal);
            formData.set('selectedDefecation', selectedDefecation);
            formData.set('selectedTarget', selectedTarget);
            formData.set('selectedSlept_time', selectedSlept_time);
            formData.set('selectedHealth_treatment', selectedHealth_treatment);
            formData.set('date', date); // Set the date in the FormData

        // Submit the form
        $.ajax({
            url: addHealthLogBooksListPartC,  // Replace with your actual save endpoint
            method: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                // Handle success if needed
                toastr.success(data.message);
                updateDataTable(date)
            },
            error: function (error) {
                // Handle error if needed
                console.error('Error submitting form');
            }
        });
    });
    // deleteToDoList
    $(document).on('click', '#deletePartCBtn', function () {
        var id = $(this).data('id');
        var url = deletePartCList;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this list',
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes, Delete',
            cancelButtonColor: '#d33',
            confirmButtonColor: '#556ee6',
            width: 400,
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                $.post(url, {
                    id: id,
                    token: token,
                    branch_id: branchID
                }, function (data) {
                    if (data.code == 200) {
                        var table = $('#healthLogbooksTable').DataTable();

                        // Assuming 'id' is correctly defined and holds the ID you want to delete
                        var ids = id;
                        console.log(ids);
                        
                        // Find the row index based on the ID
                        var rowIndexToDelete = -1;
                        
                        table.rows().eq(0).each(function (rowIdx) {
                            var rowData = table.row(rowIdx).data();
                            console.log(rowData);
                            if (rowData && rowData.partc_id === ids) { // Assuming 'id' is the property in your data
                                console.log(rowIdx);
                                rowIndexToDelete = rowIdx;
                                return false; // Exit the loop when the row is found
                            }
                        });
                        
                        // // Check if the row exists before trying to delete
                        if (rowIndexToDelete !== -1) {
                            // Remove the specific row
                            table.row(rowIndexToDelete).remove().draw(false); // 'false' to prevent table redrawing
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                        
                    }else {
                        toastr.error(data.message);
                    }
                        
                }, 'json');
            }
        });
    });
    $(document).on('click', '#editPartCBtn', function () {
        var id = $(this).data('id');
        console.log(id);
        $('.editModal').find('form')[0].reset();
        $.post(editHealthLogBooksListPartC, { id: id, token: token, branch_id: branchID }, function (data) {
            console.log("---");
            console.log(data);
             $('.editModal').find('input[name="id"]').val(data.data.id);
             $('#editdepartment_id').val(data.data.department_id).trigger('change');
             if (data.data.department_id != "") {
                var department_id =  data.data.department_id;
                var Selector = '#edit-health-form';
                var classID = data.data.class_id;
                classAllocation(department_id, Selector, classID)
                }
                if (data.data.class_id != "") {
                    var class_id = data.data.class_id;
                    var Selector = '#edit-health-form';
                    var sectionID = data.data.section_id;
                    sectionAllocation(class_id, Selector, sectionID);
                }
                if(data.data.class_id != "" && data.data.section_id != "" && data.data.student_id != "")
                {
                    var class_id = data.data.class_id;
                    var sectionID = data.data.section_id;
                    var student_id  = data.data.student_id;
                    var Selector = '#edit-health-form';
                studentAllocation(class_id, sectionID, Selector, student_id);
                }
                $('#edit_injury_name').val(data.data.injury_id.split(',')).trigger('change');
                $('#edit_place').val(data.data.place_id).trigger('change');
                $('#edit_injury_treatment').val(data.data.injury_treatment_id).trigger('change');
                $('#edit_part').val(data.data.part_id).trigger('change');
                $('#edit_illness_name').val(data.data.illness_id).trigger('change');
                $('#edit_illness_treatment').val(data.data.illness_treatment_id).trigger('change');
                $('#edit_meal').val(data.data.meal_id).trigger('change');
                $('#edit_defecation').val(data.data.defecation_id).trigger('change');
                $('#edit_slept_time').val(data.data.slept_time_id).trigger('change');
                $('#edit_target').val(data.data.target_id).trigger('change');
                $('#edit_health_treatment').val(data.data.health_treatment_id).trigger('change');
                $('.editModal').find('input[name="edit_reasonTemp"]').val(data.data.reasonTemp);
             $('.editModal').find('input[name="time"]').val(data.data.time);
             $('#editdescriptions').html(data.data.event_notes_c);

            $('#editModal').modal('show');
        }, 'json');
    });
    $("#edit-health-form").validate({
        rules: {
            rules: {
                editdepartment_id: "required",
                student_id: "required",
                gender: "required",
            }
        }
    });
    $('#edit-health-form').on('submit', function (e) {
        e.preventDefault();

        var formData = new FormData($('#healthLogBookForm')[0]);
            var healthlogID = $('#id').val();
            console.log(healthlogID);
            var department_id = $('#editdepartment_id').val();
            var changeClassName = $('#changeClassName').val();
            var sectionID = $('#editsectionID').val();
            var student_id = $('#editstudent_id').val();
            var time = $('#time').val();
            var event_notes_c = $('#editdescriptions').val();
            var date = $('#date_of_homework').val(); // Get the date value
            var selectedInjuryName = $('#edit_injury_name').val();
            var selectedPlace = $('#edit_place').val();
            var selectedInjuryTreatment = $('#edit_injury_treatment').val();
            var selectedPart = $('#edit_part').val();
            var selectedIllness = $('#edit_illness_name').val();
            var selectedIllnessTreatment = $('#edit_illness_treatment').val();
            var selectedReasonTemp = $('#edit_reasonTemp').val();
            var selectedMeal = $('#edit_meal').val();
            var selectedDefecation = $('#edit_defecation').val();
            var selectedTarget = $('#edit_target').val();
            var selectedSlept_time = $('#edit_slept_time').val();
            var selectedHealth_treatment = $('#edit_health_treatment').val();
            var health_consult = $('#health_consult').val();
            var illness = $('#illness').val();
            var injury = $('#injury').val();
            var Attend_to_heatlthcare_room = $('#Attend_to_heatlthcare_room').val();
            var tabs = injury + ', ' + illness  + ', ' + health_consult + ', ' + Attend_to_heatlthcare_room;
            var selectedText = {
                InjuryName: getSelectedText('#edit_injury_name'),
                Place: getSelectedText('#edit_place'),
                InjuryTreatment: getSelectedText('#edit_injury_treatment'),
                Part: getSelectedText('#edit_part'),
                Illness: getSelectedText('#edit_illness_name'),
                IllnessTreatment: getSelectedText('#edit_illness_treatment'),
                ReasonTemp: $('#edit_reasonTemp').val(),
                Meal: getSelectedText2('#edit_meal'),
                Defecation: getSelectedText2('#edit_defecation'),
                Target: getSelectedText('#edit_target'),
                SleptTime: getSelectedText2('#edit_slept_time'),
                HealthTreatment: getSelectedText('#edit_health_treatment')
            };

           var mainReasonText = Object.values(selectedText).filter(value => value !== '').join(', ');

            formData.set('healthlogID', healthlogID);
            formData.set('department_id', department_id);
            formData.set('changeClassName', changeClassName);
            formData.set('sectionID', sectionID);
            formData.set('student_id', student_id);
            formData.set('time', time);
            formData.set('event_notes_c', event_notes_c);
            formData.set('tab', tabs);
            formData.set('tab_details', mainReasonText);
            formData.set('selectedInjuryName', selectedInjuryName);
            formData.set('selectedPlace', selectedPlace);
            formData.set('selectedInjuryTreatment', selectedInjuryTreatment);
            formData.set('selectedPart', selectedPart);
            formData.set('selectedIllness', selectedIllness);
            formData.set('selectedIllnessTreatment', selectedIllnessTreatment);
            formData.set('selectedReasonTemp', selectedReasonTemp);
            formData.set('selectedMeal', selectedMeal);
            formData.set('selectedDefecation', selectedDefecation);
            formData.set('selectedTarget', selectedTarget);
            formData.set('selectedSlept_time', selectedSlept_time);
            formData.set('selectedHealth_treatment', selectedHealth_treatment);
            formData.set('date', date); // Set the date in the FormData
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
                                $('#editModal').modal('hide');
                                updateDataTable(date);
                                toastr.success(data.message);
                        }else {
                            toastr.error(data.message);
                        }
                    }
                }
            });
    });
    function updateDataTable(updateDate) {
        console.log(updateDate);
        $.ajax({
            url: getHealthLogBooksList,
            method: "post",
            data: { date_of_homework: updateDate },
            dataType: 'json',
            success: function (data) {
                 console.log(data)
                if (data.code == 200) {
                    console.log(data.data);
                   
                   healthLogbooksTable(data.data);
                } else {
                    toastr.error(data.message);
                }
            }
        });
    }
    $(document).ready(function () {
        $('#mainReasonBtn').click(function () {
          $('#mainReasonModal').modal('show');
        });
      });
      
      $('#mainReasonModal').on('click', '#saveMainReasonButton', function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();
       
        var injuryName = getSelectedText('#injury_name');
        if (injuryName === '') {
            $('#injury_name_error').text("Injure name is required."); 
            return false;
        }else{
            $('#injury_name_error').text("");
        }
       
        var place = getSelectedText('#place');
        if (place === '') {
            $('#place_error').text(" Place is required."); 
            return false;
        }else{
            $('#place_error').text("");
        }
        
        var injurytreatment = getSelectedText('#injury_treatment');
        if (injurytreatment === '') {
            $('#injury_treatment_error').text("Injure Treatment is required."); 
            return false;
        }else{
            $('#injury_treatment_error').text("");
        }
       
        var part = getSelectedText('#part');
        if (part === '') {
            $('#part_error').text("Part is required."); 
            return false;
        }else{
            $('#part_error').text("");
        }
       
        var illnessName = getSelectedText('#illness_name');
        if (illnessName === '') {
            $('#illness_name_error').text("Illness name is required."); 
            return false;
        }else{
            $('#illness_name_error').text("");
        }
      
        var illnesstreatment = getSelectedText('#illness_treatment');
        if (illnesstreatment === '') {
            $('#illness_treatment_error').text("Illness Treatment is required."); 
            return false;
        }else{
            $('#illness_treatment_error').text("");
        }
        var reasontemp = $('#reasonTemp').val();
        if (reasontemp === '') {
            $('#reasonTemp_error').text("Temperature is required."); 
            return false;
        }else{
            $('#reasonTemp_error').text("");
        }
        
        var target = getSelectedText('#target');
        if (target === '') {
            $('#target_error').text("Target is required."); 
            return false;
        }else{
            $('#target_error').text("");
        }
       
        var healthtreatment = getSelectedText('#health_treatment');
        if (healthtreatment === '') {
            $('#health_treatment_error').text("Health Treatment is required."); 
            return false;
        }else{
            $('#health_treatment_error').text("");
        }
        // Get the selected text from the dropdowns
        var selectedText = {
            InjuryName: injuryName,
            Place: place,
            InjuryTreatment: injurytreatment ,
            Part: part,
            Illness: illnessName,
            IllnessTreatment: illnesstreatment,
            ReasonTemp: reasontemp,
            Meal: getSelectedText2('#meal'),
            Defecation: getSelectedText2('#defecation'),
            Target:target,
            SleptTime: getSelectedText2('#slept_time'),
            HealthTreatment: healthtreatment,
            AttendToHealthcareRoom: $('#Attend_to_heatlthcare_room').val()
        };
    
        console.log('Selected Text:', selectedText);
    
        // Construct the main reason text based on selected text
        var mainReasonText = Object.values(selectedText).filter(value => value !== '').join(', ');
    
        // Update the main reason button text
        $('#mainReasonBtn').text(mainReasonText);
    
        // Close the modal (if needed)
        $('#mainReasonModal').modal('hide');
    });
    
    // Function to get selected text, excluding default options
    function getSelectedText2(selector) {
        var selectedOption = $(selector + ' option:selected');
        return selectedOption.val() ? selectedOption.text() : '';
    }
    function getSelectedText(selector) {
        // Get an array of selected options
        var selectedOptions = $(selector).select2('data');
    
        // Check if anything is selected
        if (selectedOptions && selectedOptions.length > 0) {
            // If multiple values are selected, return an array of selected texts
            if (selectedOptions.length > 1) {
                var selectedTextArray = selectedOptions.map(function(option) {
                    return option.text;
                });
                return selectedTextArray;
            } else {
                // If only one value is selected, return its text
                return selectedOptions[0].text;
            }
        } else {
            // If nothing is selected, return an empty string or handle accordingly
            return '';
        }
    }
});

