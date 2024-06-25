$(function () {
    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#attendanceFilter';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    function classAllocation(department_id, Selector, classID) {
        $(Selector).find('select[name="class_id"]').empty();
        $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
        $(Selector).find('select[name="section_id"]').empty();
        $(Selector).find('select[name="section_id"]').append('<option value="">' + select_class + '</option>');
        if (department_id) {
            $.post(getGradeByDepartmentUrl,
                {
                    branch_id: branchID,
                    department_id: department_id,
                    teacher_id: ref_user_id
                }, function (res) {
                    if (res.code == 200) {
                        $.each(res.data, function (key, val) {
                            $(Selector).find('select[name="class_id"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                        if (classID != '' || classID != null) {
                            $(Selector).find('select[name="class_id"]').val(classID);
                        }
                    }
                }, 'json');
        }
    }
    // change classroom
    $('#changeClassName').on('change', function () {
        $(".attendanceReport").hide();
        var class_id = $(this).val();
        $("#attendanceFilter").find("#sectionID").empty();
        $("#attendanceFilter").find("#sectionID").append('<option value="">' + select_class + '</option>');

        $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#attendanceFilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    $("#toggle-btn").click(function () {
        $("#toggle-example").collapse('toggle'); // toggle collapse
    });
    var i = 1;
    var i = parseInt(countHideUnhide) + 1;
    $(document).on('click', '.move-up', function () {
        moveWidget($(this), 'up');
    });

    $(document).on('click', '.move-down', function () {
        moveWidget($(this), 'down');
    });

    // $(document).on('click', '.remove-widget', function () {
    //     removeWidget($(this));
    // });
    function moveWidget(button, direction) {
        var row = button.closest('tr');
        var currentOrder = parseInt(row.attr('data-order'));

        if (direction === 'up') {
            var prevRow = row.prev('tr');
            if (prevRow.length !== 0) {
                row.insertBefore(prevRow);
                updateOrderValues();
            }
        } else if (direction === 'down') {
            var nextRow = row.next('tr');
            if (nextRow.length !== 0) {
                row.insertAfter(nextRow);
                updateOrderValues();
            }
        }
    }
    function removeWidget(button) {
        var row = button.closest('tr');
        row.remove();
        updateOrderValues();
        // Check if all widgets are deleted and show message
        // if ($('.widget').length === 0) {
        //     toastr.error('Please add a widget.');
        // }
    }
    function updateOrderValues() {
        $('.widget').each(function (index) {
            $(this).attr('data-order', index + 1);
            $(this).find('[id^="orderNo"]').val(index + 1);
        });
    }

    $("#add").click(function () {
        var temp = '<tr class="widget" id="' + i + '" data-id="' + i + '" data-order="' + i + '">' +
            '<td class="col-md-9">' +
            '<input type="hidden" name="unhide_data[' + i + '][order_no]" id="orderNo' + i + '" value="' + i + '">' +
            '<input type="hidden" name="unhide_data[' + i + '][widget_name]" id="widgetName' + i + '">' +
            '<input type="hidden" name="unhide_data[' + i + '][widget_value]" id="widgetValue' + i + '">' +
            '<input type="hidden" name="unhide_data[' + i + '][visibility]" id="visibility' + i + '">' +
            '<input type="hidden" name="unhide_data[' + i + '][department_id]" id="departmentID' + i + '">' +
            '<input type="hidden" name="unhide_data[' + i + '][class_id]" id="classID' + i + '">' +
            '<input type="hidden" name="unhide_data[' + i + '][section_id]" id="sectionID' + i + '">' +
            '<input type="hidden" name="unhide_data[' + i + '][pattern]" id="patternName' + i + '">' +
            '<button type="button" data-widget="' + i + '" id="WidgetLabelName' + i + '" class="form-control name_list addWidget" style="height: 45px;border-radius: 10px;border: 1px solid #18161652;background-color: transparent;font-weight: bold;font-family: Open Sans;font-size: 13px;">' + addWidgetH + '</button>' +
            '</td>' +
            // '<td class="col-md-3" style="padding:15px;">' +
            // '<button type="button" class="fe-arrow-up move-up" style="background-color: transparent;border: 1px solid #18161652;height: 50px;border-radius: 10px;width: 45px;margin-right:10px;"><i class="fe-arrow-up"></i></button>' +
            // '<button type="button" class="fe-arrow-down move-down" style="background-color: transparent;border: 1px solid #18161652;height: 50px;border-radius: 10px;width: 45px;margin-right:10px;"><i class="fe-arrow-down"></i></button>' +
            // '<button type="button" class="fe-remove remove-widget" style="background-color: transparent;border: 1px solid #18161652;height: 50px;border-radius: 10px;width: 45px;margin-right:10px;"><i class="fe-trash"></i></button>' +
            // '</td>' +
            '<td class="col-md-3" style="padding:15px;">' +
            '<a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light move-up" style="margin-right:3px;"><i class="fe-arrow-up"></i></a>' +
            '<a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light move-down" style="margin-right:3px;"><i class="fe-arrow-down"></i></a>' +
            '<a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light remove-widget"><i class="fe-trash-2"></i></a>' +
            '</td>' +
            '</tr>';

        $('#dynamic_field').append(temp);
        updateOrderValues();
        i++;
    });

    $(document).on('click', '.addWidget', function () {
        var widgetID = $(this).data('widget');
        enableDisableWidget();
        $("#widgetDynamicID").val(widgetID);
        $('#standard-modal').modal('show');
    });
    $(document).on('click', '.addToWidget', function () {
        var widgetname = $(this).data('widgetname');
        var widgetvalue = $(this).data('widgetvalue');
        var visibility = 0; // default zero
        var widgetvalues = messages[widgetvalue];
        enableDisableWidget();
        var widgetDynamicID = $("#widgetDynamicID").val();
        $("#widgetName" + widgetDynamicID).val(widgetname);
        $("#widgetValue" + widgetDynamicID).val(widgetvalue);
        $("#visibility" + widgetDynamicID).val(visibility);
        $("#WidgetLabelName" + widgetDynamicID).html(widgetvalues);
        $('#standard-modal').modal('hide');
    });

    $('#addDynamicFilter').on('submit', function (e) {
        e.preventDefault();
        var isValid = true;  // To track if all widgetValues are valid
        var form = this;
        var button = $('.addWidget'); // Get the button
        // if (button.length === 0) {
        //     toastr.error('Please add a widget.');
        //     isValid = false;
        // } else {
        var buttonText = button.text(); // Get the button text
        if (buttonText.includes(messages.add_widget)) {
            toastr.error('Please fill in all widget values.');
            isValid = false;
        }
        // }

        if (isValid) {
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    if (response.code == 200) {
                        console.log(response);
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        }
    });

    // rules validation
    $("#attendanceFilter").validate({
        rules: {
            att_widget_name: "required"
        }
    });
    $('#attendanceFilter').on('submit', function (e) {
        e.preventDefault();
        var employeeCheck = $("#attendanceFilter").valid();
        if (employeeCheck === true) {
            var widgetDynamicID = $("#widgetDynamicID").val();
            var att_widget_name = $("#att_widget_name").val();
            var department_id = $("#department_id").val();
            var class_id = $("#changeClassName").val();
            var section_id = $("#sectionID").val();
            var pattern = $("#pattern").val();
            var atOrderNo = $("#atOrderNo").val();
            var attwidgetValue = $("#attwidgetValue").val();
            var department_name = $("#department_id option:selected").text();
            var class_name = $("#changeClassName option:selected").text();
            var section_name = $("#sectionID option:selected").text();
            var pattern_name = $("#pattern option:selected").text();
            var visibility = 0; // default zero
            var addAttText = AttendanceReportLabel;
            var combinetext = att_widget_name;
            // var combinetext = "";
            var combinetextValues = "";
            if (department_name && (department_id != "")) {
                combinetext += "," + department_name;
                combinetextValues += department_name;
            }

            if (class_name && (class_id != "")) {
                combinetext += "," + class_name;
                combinetextValues += "," + class_name;
            }

            if (section_name && (section_id != "")) {
                combinetext += "," + section_name;
                combinetextValues += "," + section_name;
            }

            if (pattern_name && (pattern != "")) {
                combinetext += "," + pattern_name;
                combinetextValues += "," + pattern_name;
            }
            addAttText += '(' + combinetext + ')';
            var attRepValues = [];

            // Iterate over each row in the table with id 'dynamic_field'
            $('#dynamic_field tr.widget').each(function () {
                var orderno = $(this).data('order');
                var widgetValueID = "#widgetName" + orderno;
                var widgetValue = $(widgetValueID).val();
                // Check if widgetValue contains braces
                if (/\[|\]|\(|\)|\{|\}/.test(widgetValue)) {
                    attRepValues.push(widgetValue);
                }
            });
            var matches = [];

            attRepValues.forEach(function (item) {
                if (item.includes(combinetextValues)) {
                    matches.push(item);
                }
            });
            if (matches.length > 0) {
                toastr.error('Already Exist This Attendance');
                return false;
            }
            $("#WidgetLabelName" + widgetDynamicID).html(addAttText);
            // $("#orderNo" + widgetDynamicID).val(atOrderNo);
            $("#widgetName" + widgetDynamicID).val(addAttText);
            $("#widgetValue" + widgetDynamicID).val(attwidgetValue);
            $("#visibility" + widgetDynamicID).val(visibility);

            $("#departmentID" + widgetDynamicID).val(department_id);
            $("#classID" + widgetDynamicID).val(class_id);
            $("#sectionID" + widgetDynamicID).val(section_id);
            $("#patternName" + widgetDynamicID).val(pattern);
            $('#standard-modal').modal('hide');
            $('#attendance-modal').modal('hide');
        }
    });

    // delete form
    $(document).on('click', '.remove-widget', function () {
        var $clickedButton = $(this);

        swal.fire({
            title: deleteTitle + '?',
            html: deleteHtml,
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: deletecancelButtonText,
            confirmButtonText: deleteconfirmButtonText,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#556ee6',
            width: 400,
            allowOutsideClick: false
        }).then(function (result) {
            if (result.isConfirmed) {
                removeWidget($clickedButton); // Call removeWidget with the saved reference
                enableDisableWidget();
            }
        });
    });

    function enableDisableWidget() {
        var removeordernoValues = [];
        // Iterate over each row in the table with id 'dynamic_field'
        $('#dynamic_field tr.widget').each(function () {
            var orderno = $(this).data('order');
            var widgetValueID = "#widgetValue" + orderno;
            var widgetValue = $(widgetValueID).val();
            removeordernoValues.push(widgetValue);
        });
        console.log(removeordernoValues);
        // Disable buttons with data-widgetvalue matching any value in ordernoValues
        $('.addToWidget').each(function () {
            var buttonValue = $(this).data('widgetvalue');
            if (!removeordernoValues.includes(buttonValue)) {
                $(this).prop('disabled', false);
            } else {
                $(this).prop('disabled', true); // Optionally disable the matching buttons
            }
        });
        return true;
    }
});