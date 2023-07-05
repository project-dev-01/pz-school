$(function () {
    // change classes
    $("#class_id").on('change', function (e) {
        e.preventDefault();
        var class_id = $(this).val();
        $("#section_id").empty();
        $("#section_id").append('<option value="">'+select_class+'</option>');
        $.post(sectionByClass, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    // rules validation
    $("#feesAllocation").validate({
        rules: {
            class_id: "required",
            section_id: "required",
            group_id: "required"
        }
    });
    //
    $('#feesAllocation').on('submit', function (e) {
        e.preventDefault();
        var valid = $("#feesAllocation").valid();
        if (valid === true) {
            var classID = $("#class_id").val();
            var sectionID = $("#section_id").val();
            var groupID = $("#group_id").val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', classID);
            formData.append('section_id', sectionID);
            formData.append('fees_group_id', groupID);
            formData.append('academic_session_id', academic_session_id);
            $("#overlay").fadeIn(300);
            $.ajax({
                url: feesAllocatedStudentsList,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    $('#selectAllchkbox').prop('checked', false); // Unchecks it
                    if (response.code == 200) {
                        var dataSetNew = response.data;
                        if (dataSetNew.length > 0) {
                            $(".feesAllocationStudHideShow").show("slow");
                            // set group id
                            $("#feesAllocationStudGroupID").val(groupID);
                            $("#feesAllocationStudClassID").val(classID);
                            $("#feesAllocationStudSectionID").val(sectionID);
                            getFeesAllocation(dataSetNew);
                        } else {
                            $(".feesAllocationStudHideShow").hide();
                            toastr.info('No students are available');
                        }
                        $("#overlay").fadeOut(300);
                    } else {
                        toastr.error(response.message);
                        $("#overlay").fadeOut(300);
                    }
                }
            });

        }
    });
    // get payment mode list
    var paymentList = [];
    $.get(paymentModeList, {
        token: token,
        branch_id: branchID
    }, function (res) {
        if (res.code == 200) {
            var res_data = res.data;
            if (res_data.length > 0) {
                $.each(res_data, function (k, val) {
                    var obj = {};
                    obj['id'] = val.id;
                    obj['name'] = val.name;
                    paymentList.push(obj);
                });
            }
        }
    }, 'json');


    function getFeesAllocation(dataSetNew) {
        $('#feesAllocationStud').DataTable().clear().destroy();
        $('#feesAllocationStud td').empty();
        listTable = $('#feesAllocationStud').DataTable({
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
            paging: false,
            "bSort": false,
            buttons: [],
            data: dataSetNew,
            "pageLength": 10,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                {
                    data: 'id'
                },
                {
                    data: 'allocation_id'
                },
                {
                    data: 'name'
                },
                {
                    "render": function (d, t, r) {
                        var $select = $("<select class='form-control' name='student_operations[" + r.id + "][payment_mode_id]'></select>", {
                            "id": r.id + "start",
                            "value": d
                        });
                        $.each(paymentList, function (k, v) {
                            var pay_name = "";
                            if (v.id == "1") {
                                pay_name = yearly_lang;
                            }
                            if (v.id == "2") {
                                pay_name = semester_lang;
                            }
                            if (v.id == "3") {
                                pay_name = monthly_lang;
                            }
                            var $option = $("<option></option>", {
                                "text": pay_name,
                                "value": v.id
                            });
                            if (r.payment_mode_id === v.id) {
                                $option.attr("selected", "selected")
                            }
                            $select.append($option);
                        });
                        return $select.prop("outerHTML");
                    }
                },
                {
                    data: 'gender'
                },
                {
                    data: 'register_no'
                },
                {
                    data: 'email'
                }
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "className": "checked-area",
                    "render": function (data, type, row, meta) {
                        var student_remarks =
                            '<input type="checkbox" class="currentCheckbox" name="student_operations[' + row.id + '][student_id]" ' + (row.allocation_id != null ? "checked" : "") + ' value="' + row.id + '">' +
                            '<input type="checkbox" class="hiddenCheckbox' + row.id + '" style="visibility: hidden;" name="delete_student_operations[]" ' + (row.allocation_id != null ? "checked" : "") + ' value="' + row.id + '">';
                        return student_remarks;
                    }
                },
                {
                    "targets": 1,
                    "render": function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 2,
                    "className": "table-user",
                    "render": function (data, type, row, meta) {
                        var img = "";
                        if (row.photo) {
                            img = studentImg + '/' + row.photo;
                        } else {
                            img = defaultImg;
                        }
                        var first_name = '<img src="' + img + '" class="mr-2 rounded-circle">' +
                            '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                        return first_name;
                    }
                }
            ]
        }).on('draw', function () {
        });
    }

    $('#addFeesAllocationStud').on('submit', function (e) {
        e.preventDefault();
        var form = this;

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    toastr.success(response.message);
                    // $('#addDailyReport')[0].reset();
                } else {
                    toastr.error(response.message);
                }
            }
        });
    });
    $('#selectAllchkbox').prop('checked', false); // Unchecks it
    // script for all checkbox checked / unchecked
    $("#selectAllchkbox").on("change", function (ev) {
        var $chcks = $(".checked-area input[type='checkbox']");
        if ($(this).is(':checked')) {
            $chcks.prop('checked', true).trigger('change');
        } else {
            $chcks.prop('checked', false).trigger('change');
        }
    });
    $(document).on('change', '.currentCheckbox', function () {
        var checkedValue = $(this).val();
        var ischecked = $(this).is(':checked');
        if (ischecked == true) {
            $('.hiddenCheckbox' + checkedValue).prop('checked', true);
            $('.hiddenCheckbox' + checkedValue).val(checkedValue);
        } else {
            $('.hiddenCheckbox' + checkedValue).prop('checked', false);
            $('.hiddenCheckbox' + checkedValue).val(checkedValue);
        }
    });

});