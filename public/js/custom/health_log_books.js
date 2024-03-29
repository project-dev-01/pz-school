
$(function () {

    $(".homeWorkAdd").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
    });
    $("#time").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "h:i K", // 12-hour format with AM/PM
    });

    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#healthLogBookForm';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    function classAllocation(department_id, Selector, classID) {
        $(Selector).find('select[name="class_id"]').empty();
        $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
        $(Selector).find('select[name="section_id"]').empty();
        $(Selector).find('select[name="section_id"]').append('<option value="">' + select_class + '</option>');
       // console.log("first time");
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
        var Selector = '#healthLogBookForm';
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
        var Selector = '#healthLogBookForm';
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
    

    // $('#studentHomeworkFilter').on('submit', function (e) {
    //     e.preventDefault();
    //     var form = this;
    //     var formstatus = $('input[name="status"]:checked').val();

    //     var formsubject = $('#subject').val();
    //     $.ajax({
    //         url: $(form).attr('action'),
    //         method: $(form).attr('method'),
    //         data: new FormData(form),
    //         processData: false,
    //         dataType: 'json',
    //         contentType: false,
    //         success: function (data) {
    //             console.log('cs', data)
    //             if (data.code == 200) {
    //                 $("#homeworks").show("slow");
    //                 if (data.subject != "All") {
    //                     var sub = homework_list_lang + ' (' + data.subject + ')';

    //                 } else {
    //                     var sub = homework_list_lang + ' (' + all_subject_lang + ')';
    //                 }
    //                 $("#title").html(sub);
    //                 $("#homework_list").html(data.list);
    //             } else {
    //                 $("#homeworks").hide("slow");
    //                 toastr.error(data.message);
    //             }
    //         }
    //     });
    // });
    // rules validation
    $("#employeeHealthLogFilter").validate({
        rules: {
            date_of_homework: "required"
        }
    });

    // add Homework
    $('#employeeHealthLogFilter').on('submit', function (e) {
        e.preventDefault();
      
        var homeworkCheck = $("#employeeHealthLogFilter").valid();

        if (homeworkCheck === true) {
            $(".classRoomHideSHow").show("slow");
            var dateDownload = $('#date_of_homework').val(); // Get the date value
            
            console.log(dateDownload);
            $("#downDateID").val(dateDownload);
            var form = this;
            var formData = new FormData(form);
            var date = $('#date_of_homework').val(); // Get the date value
        
            formData.set('date_of_homework', date); // Set the date in the FormData

            $.ajax({
                url: getHealthLogBooksList,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    // console.log(data)
                    if (data.code == 200) {
                        console.log(data.data);
                        $('#healthLogBookForm').find('form')[0].reset();
                        // Update the health logbook form with fetched data
                       updateHealthLogBookForm(data.data);
                       
                       healthLogbooksTable(data.data);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    function updateHealthLogBookForm(data) {
        // Assuming data is an array of health logbooks
        if (data && data.length > 0) {

            // Assuming you have fields in your form to display health logbook data
            // Replace the following lines with your logic to update the form fields
            console.log(data[0].id);
            console.log(data[0].student_id);
            $("#healthlogID").val(data[0].id);
            $('#date_of_homework').val(data[0].date);
            $('#gender').val(data[0].gender);
            //$('#time').val(data[0].time);
           // $('#descriptions').val(data[0].event_notes_c);
            $('#temp').val(data[0].temp);
            // $('#department_id').val(data[0].department_id);
            // if (data[0].department_id != "") {
            // var department_id =  data[0].department_id;
            // var Selector = '#healthLogBookForm';
            // var classID = data[0].class_id;
            // classAllocation(department_id, Selector, classID)
            // }
            // if (data[0].class_id != "") {
            //     var class_id = data[0].class_id;
            //     var Selector = '#healthLogBookForm';
            //     var sectionID = data[0].section_id;
            //     sectionAllocation(class_id, Selector, sectionID);
            // }
            // if(data[0].class_id != "" && data[0].section_id != "" && data[0].student_id != "")
            // {
            //     console.log("hgfxfghh");
            //     var class_id = data[0].class_id;
            //     var Selector = '#healthLogBookForm';
            //     var sectionID = data[0].section_id;
            //     var studentId = data[0].student_id;
            //     studentAllocation(class_id, sectionID, Selector, studentId);
            // }
            $('#weather').val(data[0].weather);
            $('#humidity').val(data[0].humidity);
            $('#description').val(data[0].event_notes_a);
            $('#remarks').val(data[0].event_notes_b);
            // Update other fields as needed
        }
    }
    function healthLogbooksTable(dataSetNew) {
        
        $('#healthLogbooksTable').DataTable({
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
                    data: 'partc_id',
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
                    data: 'gender'
                },
                {
                    data: 'time'
                }, 
                {
                    data: 'tab'
                }, 
                {
                    data: 'tab_details'
                }, 
                {
                    data: 'event_notes_c'
                },{
                    data: null,
                    render: function (data, type, row) {
                        // Add edit and delete buttons
                        return '<div class="button-list">' +
                        '<a href="javascript:void(0)" class="btn btn-blue btn-sm waves-effect waves-light" data-id="' + row.partc_id + '"  id="editPartCBtn"><i class="fe-edit"></i></a>' +
                        '<a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' + row.partc_id + '"  id="deletePartCBtn"><i class="fe-trash-2"></i></a>' +
                        '</div>';

                        
                    }
                }
            ],
            columnDefs: [
                {
                    targets: [5], 
                    width: '130px' 
                },
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
            //var event_notes_c = $('#descriptions').val();
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
            var activeTabId = $('#mainReasonTabs .nav-link.active').attr('id');
            console.log('Active Tab ID:', activeTabId);
            var reasonValue;
            var tabs;
            if (activeTabId === "reasonTab1") {
                reasonValue = $('#injury_reason').val();
                tabs = $('#injury').val();
            } else if (activeTabId === "reasonTab2") {
                reasonValue = $('#illness_reason').val();
                tabs = $('#illness').val();
            } else if (activeTabId === "reasonTab3") {
                reasonValue = $('#health_consult_reason').val();
                tabs = $('#health_consult').val();
            } else if (activeTabId === "reasonTab4") {
                reasonValue = $('#attend_to_heatlthcare_room_reason').val();
                tabs = $('#Attend_to_heatlthcare_room').val();
            }
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
            formData.set('event_notes_c', reasonValue);
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
                refreshDivContent();
            },
            error: function (error) {
                // Handle error if needed
                console.error('Error submitting form');
            }
        });
    });
    function refreshDivContent() {
        // Clear the content of the div
        $('.refresh :input').val('');
       
        
        $('#mainReasonBtn').text(' Main Reason');
    }
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
        //console.log(id);
        $('.editModal').find('form')[0].reset();
        $.post(editHealthLogBooksListPartC, { id: id, token: token, branch_id: branchID }, function (data) {
            console.log("---");
          //  console.log(data);
            $('.health-logbook-tab').removeClass('active');
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
                
                var injuryId = data.data.injury_id;
                // Check if injuryId is not empty
                if (injuryId) {
                $('#editreasonTab1').addClass('active'); // Add 'active' class to the selected tab
                // Split the value and set it
                $('#edit_injury_name').val(injuryId.split(',')).trigger('change');
                $('#edit_injury_reason').html(data.data.event_notes_c);
                $('#editreason1').addClass('show active');
                } 
                var placeId = data.data.place_id;
                if(placeId){
                    $('#edit_place').val(placeId.split(',')).trigger('change');
                }
                var injuryTreatment = data.data.injury_treatment_id;
                if(injuryTreatment){
                    $('#edit_injury_treatment').val(injuryTreatment.split(',')).trigger('change');
                }
                var partId =  data.data.part_id;
                if(partId){
                    $('#edit_part').val(partId.split(',')).trigger('change');
                }
                var illnessId = data.data.illness_id;
                if(illnessId){
                    // Activate the tab
                    $('#editreasonTab2').addClass('active'); // Add 'active' class to the selected tab
                    $('#edit_illness_name').val(illnessId.split(',')).trigger('change');
                    $('#edit_illness_reason').html(data.data.event_notes_c);
                    $('#editreason2').addClass('show active');
                    
                }
                var illnessTreatmentId = data.data.illness_treatment_id;
                if(illnessTreatmentId){
                    $('#edit_illness_treatment').val(illnessTreatmentId.split(',')).trigger('change');
                }
                var mealId = data.data.meal_id;
                if(mealId){
                    $('#edit_meal').val(mealId.split(',')).trigger('change');
                }
                var defectionId = data.data.defecation_id;
                if(defectionId){
                    $('#edit_defecation').val(defectionId.split(',')).trigger('change');
                }
                var sleptTimeId = data.data.slept_time_id;
                if(sleptTimeId){
                    $('#edit_slept_time').val(sleptTimeId.split(',')).trigger('change');
                }
               var targetId = data.data.target_id;
               if(targetId){
                $('#editreasonTab3').addClass('active'); // Add 'active' class to the selected tab
                $('#edit_target').val(targetId.split(',')).trigger('change');
                $('#edit_health_consult_reason').html(data.data.event_notes_c);
                $('#editreason3').addClass('show active');
               }
               var healthTreatmentId = data.data.health_treatment_id;
               if(healthTreatmentId){
                $('#edit_health_treatment').val(healthTreatmentId.split(',')).trigger('change');
               }
               if(data.data.tab == "Attend to heatlthcare room")
               {
                $('#editreasonTab4').addClass('active'); // Add 'active' class to the selected tab
                $('#edit_attend_to_heatlthcare_room_reason').html(data.data.event_notes_c);
                $('#editreason4').addClass('show active');
               }
            
            $('.editModal').find('input[name="edit_reasonTemp"]').val(data.data.reasonTemp);
             $('.editModal').find('input[name="time"]').val(data.data.time);
            

            $('#editModal').modal('show');
        }, 'json');
    });
   
    
    $('.editMainReasonButton').on('click', function(e) {
        e.preventDefault();
        var activeTabId = $('#mainReasonTabsEdit .nav-link.active').attr('id');

        if (activeTabId === "editreasonTab1") {
            var injuryName = getSelectedText('#edit_injury_name');
            if (injuryName === '') {
                $('#edit_injury_name_error').text("Injure name is required.");
                return false;
            } else {
                $('#edit_injury_name_error').text("");
            }

            var place = getSelectedText('#edit_place');
            if (place === '') {
                $('#edit_place_error').text(" Place is required."); 
                return false;
            }else{
                $('#edit_place_error').text("");
            }
            
            var injurytreatment = getSelectedText('#edit_injury_treatment');
            if (injurytreatment === '') {
                $('#edit_injury_treatment_error').text("Injure Treatment is required."); 
                return false;
            }else{
                $('#edit_injury_treatment_error').text("");
            }
           
            var part = getSelectedText('#edit_part');
            if (part === '') {
                $('#edit_part_error').text("Part is required."); 
                return false;
            }else{
                $('#edit_part_error').text("");
            }
            var reason = $('#edit_injury_reason').val();
            if (reason === '') {
                $('#edit_injury_reason_error').text("Reason is required."); 
                return false;
            }else{
                $('#edit_injury_reason_error').text("");
            }

        } else if (activeTabId === 'editreasonTab2') {
            var illnessName = getSelectedText('#edit_illness_name');
            if (illnessName === '') {
                $('#edit_illness_name_error').text("Illness name is required.");
                return false;
            } else {
                $('#edit_illness_name_error').text("");
            }
            var illnesstreatment = getSelectedText('#edit_illness_treatment');
            if (illnesstreatment === '') {
                $('#edit_illness_treatment_error').text("Illness Treatment is required."); 
                return false;
            }else{
                $('#edit_illness_treatment_error').text("");
            }
            var reasontemp = $('#edit_reasonTemp').val();
            if (reasontemp === '') {
                $('#edit_reasonTemp_error').text("Temperature is required."); 
                return false;
            }else{
                $('#edit_reasonTemp_error').text("");
            }
            var reason = $('#edit_illness_reason').val();
            if (reason === '') {
                $('#edit_illness_reason_error').text("Reason is required."); 
                return false;
            }else{
                $('#edit_illness_reason_error').text("");
            }

            // Add similar validation checks for other fields in tab2

        } else if (activeTabId === 'editreasonTab3') {
            var target = getSelectedText('#edit_target');
            if (target === '') {
                $('#edit_target_error').text("Target is required.");
                return false;
            }else{
                $('#edit_target_error').text("");
            }
            var healthtreatment = getSelectedText('#edit_health_treatment');
            if (healthtreatment === '') {
                $('#edit_health_treatment_error').text("Health Treatment is required."); 
                return false;
            }else{
                $('#edit_health_treatment_error').text("");
            }
            var reason = $('#edit_health_consult_reason').val();
            if (reason === '') {
                $('#edit_health_consult_reason_error').text("Reason is required."); 
                return false;
            }else{
                $('#edit_health_consult_reason_error').text("");
            }

            // Add similar validation checks for other fields in tab3

        } else if (activeTabId === 'editreasonTab4') {
            var reason = $('#edit_attend_to_heatlthcare_room_reason').val();
            if (reason === '') {
                $('#edit_attend_to_heatlthcare_room_reason_error').text("Reason is required."); 
                return false;
            }else{
                $('#edit_attend_to_heatlthcare_room_reason_error').text("");
            }
        }
        // var heathCheck = $("#edit-health-form").valid();
        // if(heathCheck === true)
        // {

          
                var healthlogID = $('#id').val();
                console.log(healthlogID);
                var department_id = $('#editdepartment_id').val();
                var changeClassName = $('#editchangeClassName').val();
                var sectionID = $('#editsectionID').val();
                var student_id = $('#editstudent_id').val();
                var time = $('#time').val();
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
                var activeTabId = $('#mainReasonTabsEdit .nav-link.active').attr('id');
                console.log('Active Tab ID:', activeTabId);
                var reasonValue;
                var tabs;
                if (activeTabId === "editreasonTab1") {
                    reasonValue = $('#edit_injury_reason').val();
                    tabs = $('#edit_injury').val();
                } else if (activeTabId === "editreasonTab2") {
                    reasonValue = $('#edit_illness_reason').val();
                    tabs = $('#edit_illness').val();
                } else if (activeTabId === "editreasonTab3") {
                    reasonValue = $('#edit_health_consult_reason').val();
                    tabs = $('#edit_health_consult').val();
                } else if (activeTabId === "editreasonTab4") {
                    reasonValue = $('#edit_attend_to_heatlthcare_room_reason').val();
                    tabs = $('#edit_Attend_to_heatlthcare_room').val();
                }
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
               var formData = new FormData($('#edit-health-form')[0]); // Using get() method to get the raw DOM element

                formData.set('id', healthlogID);
                formData.set('editdepartment_id', department_id);
                formData.set('class_id', changeClassName);
                formData.set('section_id', sectionID);
                formData.set('student_id', student_id);
                formData.set('time', time);
                formData.set('event_notes_c', reasonValue);
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
                console.log(formData);
              

                $.ajax({
                    url: $('#edit-health-form').attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false, // Important for FormData
                    contentType: false, // Important for FormData
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        if (data.code == 0) {
                            $.each(data.error, function(prefix, val) {
                                $('#' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            if (data.code == 200) {
                                $('#editModal').modal('hide');
                                updateDataTable(date);
                                toastr.success(data.message);
                            } else {
                                toastr.error(data.message);
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle AJAX errors
                        console.error(xhr.responseText);
                        toastr.error('An error occurred while processing your request.');
                    }
                });
        //}
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
        var activeTabId = $('#mainReasonTabs .nav-link.active').attr('id');
        console.log(activeTabId);
        var selectedText = {};
        if(activeTabId === "reasonTab1")
        {
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
            var reason = $('#injury_reason').val();
            if (reason === '') {
                $('#injury_reason_error').text("Reason is required."); 
                return false;
            }else{
                $('#injury_reason_error').text("");
            }
            selectedText = {
                InjuryName: injuryName,
                Place: place,
                InjuryTreatment: injurytreatment ,
                Part: part,
                Reason: $('#injury_reason').val()
                // Add other fields for tab1
            };
           
        }else if (activeTabId === 'reasonTab2') {
       
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
            var reason = $('#illness_reason').val();
            if (reason === '') {
                $('#illness_reason_error').text("Reason is required."); 
                return false;
            }else{
                $('#illness_reason_error').text("");
            }
            selectedText = {
                Illness: illnessName,
                IllnessTreatment: illnesstreatment,
                ReasonTemp: reasontemp,
                Meal: getSelectedText2('#meal'),
                Defecation: getSelectedText2('#defecation'),
                SleptTime: getSelectedText2('#slept_time'),
                Reason: $('#illness_reason').val()
                // Add other fields for tab1
            };
        }else if (activeTabId === 'reasonTab3') {
        
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
            var reason = $('#health_consult_reason').val();
            if (reason === '') {
                $('#health_consult_reason_error').text("Reason is required."); 
                return false;
            }else{
                $('#health_consult_reason_error').text("");
            }
            selectedText = {
                Target:target,
                HealthTreatment: healthtreatment,
                Reason: $('#health_consult_reason').val()
                // Add other fields for tab1
            };
        }else if (activeTabId === 'reasonTab4') { 
            var reason = $('#attend_to_heatlthcare_room_reason').val();
            if (reason === '') {
                $('#attend_to_heatlthcare_room_reason_error').text("Reason is required."); 
                return false;
            }else{
                $('#attend_to_heatlthcare_room_reason_error').text("");
            }
            selectedText = {
                AttendToHealthcareRoom: $('#Attend_to_heatlthcare_room').val(),
                Reason: $('#attend_to_heatlthcare_room_reason').val()
                // Add other fields for tab1
            };
        }
    
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

