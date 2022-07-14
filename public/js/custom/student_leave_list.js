$(function () {

    // change class name
    $('#changeClassName').on('change', function () {
        $(".studentLeaveShow").hide();
        var class_id = $(this).val();
        $("#studentLeaveList").find("#sectionID").empty();
        $("#studentLeaveList").find("#sectionID").append('<option value="">Select Section</option>');

        $.post(sectionByClassUrl, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
            if (res.code == 200) {
                console.log(res)
                $.each(res.data, function (key, val) {
                    $("#studentLeaveList").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    // applyFilter
    // rules validation
    $("#studentLeaveList").validate({
        rules: {
            class_id: "required",
            section_id: "required"
        }
    });
    // data bind 
    $('#studentLeaveList').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        var classRoom = $("#studentLeaveList").valid();
        if (classRoom === true) {

            var class_id = $("#changeClassName").val();
            var section_id = $("#sectionID").val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            // // subject division
            $.ajax({
                url: allStutdentLeaveList,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    if (response.code == 200) {
                        var dataSet = response.data;
                        allStudentLeave(dataSet);
                        $(".studentLeaveShow").show("slow");
                    } else {
                        toastr.error(response.message);
                    }
                }
            });

        };
    });

    function allStudentLeave(dataSetNew) {
        
        $('#student-leave-table').DataTable({
            processing: true,
            bDestroy: true,
            info: true,
            // dom: 'lBfrtip',
            dom:"<'row'<'col-sm-2'l><'col-sm-2'B><'col-sm-8'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                {
                    extend: 'csv',
                    text: 'Download CSV',
                    extension: '.csv',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
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
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'name'
                },
                {
                    data: 'class_name'
                },
                {
                    data: 'section_name'
                },
                {
                    data: 'from_leave'
                },
                {
                    data: 'to_leave'
                },
                {
                    data: 'status'
                },
                {
                    data: 'reason'
                },
                {
                    data: 'document'
                },
                {
                    data: 'teacher_remarks'
                }
            ],
            columnDefs: [
                {

                    "targets": 1,
                    "className": "table-user",
                    "render": function (data, type, row, meta) {
                        var first_name = '<img src="' + defaultImg + '" class="mr-2 rounded-circle">' +
                            '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                        return first_name;
                    }
                },
                {
                    "targets": 6,
                    "render": function (data, type, row, meta) {
                        var badgeColor = "";
                        if (data == "Approve") {
                            badgeColor = "badge-success";
                        }
                        if (data == "Reject") {
                            badgeColor = "badge-danger";
                        }
                        if (data == "Pending") {
                            badgeColor = "badge-warning";
                        }
                        var status = '<span class="badge ' + badgeColor + ' badge-pill">' + data + '</span>';
                        return status;
                    }
                },
                {
                    "targets": 8,
                    "render": function (data, type, row, meta) {
                        var document = '<a href="' + studentDocUrl + '/' + data + '" download ><i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i></a>';
                        return document;
                    }
                }
            ]
        }).on('draw', function () {
        });
    }

});