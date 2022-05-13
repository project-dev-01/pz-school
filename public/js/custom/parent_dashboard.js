$(function () {
    $("#frm_ldate").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        minDate: 0
    });
    $("#to_ldate").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        minDate: 0
    });
    var radar;
    StudentLeave_tabel();
    callradarchart();
    function callradarchart() {

        $.post(getTestScore, {
            token: token,
            branch_id: branchID,
            student_id: studentID,
        }, function (response) {
            console.log('res', response)
            if (response.code == 200) {
                var marks = response.data.marks;
                var subjects = response.data.subjects;
                var data = [];
                var label = [];
                if (subjects.length > 0) {
                    subjects.forEach(function (res) {
                        label.push(res.subject_name);

                    });
                    $.each(marks, function (key, value) {
                        var randcol = getRandomColor();
                        var obj = {};
                        var score = [];
                        obj["label"] = key;
                        obj["backgroundColor"] = hexToRGB(randcol, 0.3);
                        obj["borderColor"] = randcol;
                        obj["pointBackgroundColor"] = randcol;
                        obj["pointBorderColor"] = "#fff";
                        obj["pointHoverBackgroundColor"] = "#fff";
                        obj["pointHoverBorderColor"] = randcol;
                        $.each(value, function (key, val) {
                            score.push(val.score);
                        });
                        obj["data"] = score;
                        data.push(obj);
                    });
                    radarChart(label, data);
                }
            }
        }, 'json');
    }
    radarChart();
    function radarChart(labels, obj) {

        if (radar) {
            radar.data.labels = labels;
            radar.data.datasets = obj;
            radar.update();
        } else {
            var ctx = document.getElementById("radar-chart-test-marks").getContext('2d');
            var defaultColors = ["#1abc9c", "#f1556c", "#4a81d4", "#e3eaef"];
            var colors = dataColors ? dataColors.split(",") : defaultColors.concat();

            radar = new Chart(ctx, {
                type: 'radar',
                data: {

                    labels: labels,
                    // labels: labels,
                    datasets: obj
                },
            });
        }

    }

    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
    function hexToRGB(hex, alpha) {
        var r = parseInt(hex.slice(1, 3), 16),
            g = parseInt(hex.slice(3, 5), 16),
            b = parseInt(hex.slice(5, 7), 16);

        if (alpha) {
            return "rgba(" + r + ", " + g + ", " + b + ", " + alpha + ")";
        } else {
            return "rgb(" + r + ", " + g + ", " + b + ")";
        }
    }
    // reverse dob
    function convertDigitIn(str) {
        return str.split('-').reverse().join('-');
    }
    // jQuery.validator.addMethod("greaterThan",
    //     function (value, element, params) {
    //         console.log(value);
    //         if (!/Invalid|NaN/.test(new Date(value))) {
    //             return new Date(value) >= new Date($(params).val());
    //         }

    //         return isNaN(value) && isNaN($(params).val())
    //             || (Number(value) >= Number($(params).val()));
    //     }, 'Must be greater than leave from.');
    jQuery.validator.addMethod("greaterThanDt",
        function (value, element, params) {

            if (!/Invalid|NaN/.test(new Date(value))) {
                return new Date(value) > new Date($(params).val());
            }

            return isNaN(value) && isNaN($(params).val())
                || (Number(value) > Number($(params).val()));
        }, 'Must be greater than {0}.');

    $("#stdGeneralDetails").validate({
        rules: {
            changeStdName: "required",
            to_ldate: "required",
            frm_ldate: "required",
            changelevReasons: "required"
        }
    });

    $('#stdGeneralDetails').on('submit', function (e) {
        e.preventDefault();
        var start = convertDigitIn($("#frm_ldate").val());
        var end = convertDigitIn($("#to_ldate").val());
        let startDate = new Date(start);
        let endDate = new Date(end);
        if (startDate > endDate) {
            toastr.error("To date should be greater than leave from");
            $("to_ldate").val("");
            return false;
        }
        var std_details = $("#stdGeneralDetails").valid();

        if (std_details === true) {
            var form = this;
            var class_id = $('option:selected', '#changeStdName').attr('data-classid');
            var section_id = $('option:selected', '#changeStdName').attr('data-sectionid');
            var student_id = $("#changeStdName").val();
            var frm_leavedate = $("#frm_ldate").val();
            var to_leavedate = $("#to_ldate").val();
            var reason = $("#changelevReasons").val();
            var reason_text = $('option:selected', '#changelevReasons').text();
            var remarks = $("#remarks").val();
            var file = $("#file").val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('student_id', student_id);
            formData.append('frm_leavedate', frm_leavedate);
            formData.append('to_leavedate', to_leavedate);
            formData.append('reason', reason);
            formData.append('remarks', remarks);
            formData.append('file', file);
            $("#listModeClassID").val(class_id);
            $("#listModeSectionID").val(section_id);
            $("#listModestudentID").val(student_id);
            $("#listModereason").val(reason);
            $("#listModereasontext").val(reason_text);
            //
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    if (response.code == 200) {
                        $('#studentleave-table').DataTable().ajax.reload(null, false);
                        toastr.success('Leave apply sucessfully');
                        $('#stdGeneralDetails')[0].reset();

                        // $("#changeStdName").val('');
                        // $("#frm_ldate").val('');
                        // $("#to_ldate").val('');
                        // $("#message").val('');
                        // $("#post_ldate").val('');
                        // $("#remarks").val();
                        $("#remarks_div").hide();
                    } else {
                        toastr.error(response.message);
                        $("#remarks_div").hide();
                    }
                }
            });
        };
    });
    // student leaves details
    $('#changelevReasons').on('change', function () {
        var Reasons = $("#changelevReasons").val();
        console.log(Reasons);
        if (Reasons == 3) {
            $("#remarks_div").show();
        }
        else {
            $("#remarks_div").hide();
        }

    });
    $(".datepick").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    // get student leave apply
    function StudentLeave_tabel() {
        $('#studentleave-table').DataTable({
            processing: true,
            info: true,
            ajax: stutdentleaveList,
            "pageLength": 5,
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
                }
                ,
                {
                    data: 'first_name',
                    name: 'first_name'
                },
                {
                    data: 'from_leave',
                    name: 'from_leave'
                },
                {
                    data: 'to_leave',
                    name: 'to_leave'
                },
                {
                    data: 'reason',
                    name: 'reason'
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: false,
                    searchable: false
                },
            ],
            columnDefs: [
                {
                    "targets": 5,
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
            ]
        }).on('draw', function () {
        });
    }


});