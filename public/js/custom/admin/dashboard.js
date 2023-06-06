$(function () {
    $(".flatpickr-hour").keypress(function () {
        console.log(123)
        if (!`${event.target.value}${event.key}`.match(/^[0-9]{0,2}$/)) {
            // block the input if result does not match
            event.preventDefault();
            event.stopPropagation();
            return false;
        }
    });
    $(".flatpickr-minute").keypress(function () {
        console.log(123)
        if (!`${event.target.value}${event.key}`.match(/^[0-9]{0,2}$/)) {
            // block the input if result does not match
            event.preventDefault();
            event.stopPropagation();
            return false;
        }
    });
    var getOldComCount = 0;
    // mark as read
    $(".admintaskListDashboard").on('click', function () {
        getOldComCount = 0;
        var to_do_list_id = $(this).data("id");
        $(this).prop("checked", true);
        $.post(readUpdateTodoUrl, {
            token: token,
            branch_id: branchID,
            to_do_list_id: to_do_list_id,
            user_id: userID
        }, function (res) {

            if (res.code == 200) {
                var to_do_list = res.data.to_do_list;
                var allcomments = res.data.comments;
                // get assign class 
                var assign_to = to_do_list.assign_to;
                var get_assign_class = assign_to.split(",");
                $('#assignClsAppend').empty();

                $.post(getAssignClassUrl, {
                    token: token,
                    branch_id: branchID,
                    get_assign_class: get_assign_class
                }, function (classes) {
                    if (classes.code == 200) {
                        $('#assignClsAppend').empty();
                        var getClases = classes.data;
                        var assignClassDetails = "";
                        var assignCls = [];
                        $.each(getClases, function (key, val) {
                            var classsec = val.class_name + ' (' + val.section_name + ')';
                            assignCls.push(classsec);
                        });
                        var assignClsAppend = assignCls.join(",");
                        $("#assignClsAppend").append(assignClsAppend);

                    }
                }, 'json');
                // getAssignClassUrl
                // title
                var check_list = to_do_list.check_list;
                var files = to_do_list.file;

                var myCheckList = check_list.split(",");
                var allFileList = files.split(",");
                $('#dashCheckList').empty();
                $('#dashAttachments').empty();
                $('#dashComments').empty();

                var date = changeFormateDate(to_do_list.due_date);
                $('.toDoListModel').find('#dashTitle').html(to_do_list.title);
                $('.toDoListModel').find('#dashDueDate').html(date);
                $('.toDoListModel').find('#toDoListId').val(to_do_list.id);
                // task description start
                var taskDesc = '<ul>' +
                    '<li>' + to_do_list.task_description + '</li>' +
                    '</ul>';
                $("#dashTaskDesc").append(taskDesc);
                // task description end
                // checklist start
                var dashCheckList = '<ol>';
                $.each(myCheckList, function (key, val) {
                    dashCheckList += '<li>' + val + '</li>';

                });
                dashCheckList += '</ol>';
                $("#dashCheckList").append(dashCheckList);
                // checklist end
                // Attachments starts
                var attachemts = "";
                if (files != '') {
                    $.each(allFileList, function (key, val) {
                        attachemts += '<div class="card mb-1 shadow-none border">' +
                            '<div class="p-2">' +
                            '<div class="row align-items-center">' +
                            '<div class="col-auto">' +
                            '<div class="avatar-sm">' +
                            '<span class="avatar-title badge-soft-primary text-primary rounded">' +
                            val.split('.').pop() +
                            '</span>' +
                            '</div>' +
                            '</div>' +
                            '<div class="col pl-0">' +
                            '<a href="' + pathDownloadFileUrl + "/" + val + '" download class="text-muted font-weight-bold">' + val + '</a>' +
                            '</div>' +
                            '<div class="col-auto">' +
                            '<a href="' + pathDownloadFileUrl + "/" + val + '" download class="btn btn-link font-16 text-muted">' +
                            '<i class="dripicons-download"></i>' +
                            '</a>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';

                    });
                } else {
                    attachemts += "<p>No attachements available</p>";
                }

                $("#dashAttachments").append(attachemts);


                // attachements end
                // comments start

                // var dashComments = '<div class="media mt-3 p-1">' +
                //     '<div class="media-body">' +
                //     '<h5 class="mt-0 mb-0 font-size-14">' +
                //     '<span class="float-right text-muted font-12">4:30am</span>' +
                //     'James' +
                //     '</h5>' +
                //     '<p class="mt-1 mb-0 text-muted">' +
                //     'Is it Compulsory To wears Sport Dress?' +
                //     '</p>' +
                //     '</div>' +
                //     '</div>' +
                //     '<hr>';
                var dashComments = "";
                dashComments += '<div class="row mt-3">' +
                    '<div class="col">' +
                    '<h5 class="mb-2 font-size-16">Comments</h5>';
                if (allcomments.length > 0) {
                    $.each(allcomments, function (key, val) {
                        var date = changeFormateDate(val.created_at);

                        dashComments += '<div class="media mt-3 p-1">' +
                            '<div class="media-body">' +
                            '<h5 class="mt-0 mb-0 font-size-14">' +
                            '<span class="float-right text-muted font-12">' + date + '</span>' +
                            val.name +
                            '</h5>' +
                            '<p class="mt-1 mb-0 text-muted">' +
                            val.comment +
                            '</p>' +
                            '</div>' +
                            '</div>' +
                            ' <hr style="border-top: 2px dotted #1abc9c;"/>';
                    });

                }
                dashComments += '</div>' +
                    '</div>';
                $("#dashComments").append(dashComments);

                // comments end
                var ComCount = $("#comments" + to_do_list.id).text().trim();
                getOldComCount = parseInt(ComCount);

                $('#right-modal-dashboard').modal('show');
            }
        }, 'json');

    });

    function changeFormateDate(dt) {
        var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        var d = new Date(dt);
        var day = days[d.getDay()];
        var hr = d.getHours();
        var min = d.getMinutes();
        if (min < 10) {
            min = "0" + min;
        }
        var ampm = "am";
        if (hr > 12) {
            hr -= 12;
            ampm = "pm";
        }
        var date = d.getDate();
        var month = months[d.getMonth()];
        var year = d.getFullYear();
        // var x = document.getElementById("time");
        return hr + ":" + min + ampm + "-" + date + " " + month + " " + year;
    }
    //

    $("#submitComment").validate({
        rules: {
            comment: "required"
        }
    });
    //
    $('#submitComment').on('submit', function (e) {
        e.preventDefault();
        var submitCom = $("#submitComment").valid();
        if (submitCom === true) {
            var toDoListId = $("#toDoListId").val();
            var comment = $("textarea#replyComment").val();

            $.post(toDoCommentsUrl, {
                token: token,
                branch_id: branchID,
                comment: comment,
                to_do_list_id: toDoListId,
                user_id: userID
            }, function (res) {
                var current = new Date();
                var date = changeFormateDate(current);
                var dashComments = '<div class="media mt-3 p-1">' +
                    '<div class="media-body">' +
                    '<h5 class="mt-0 mb-0 font-size-14">' +
                    '<span class="float-right text-muted font-12">' + date + '</span>' +
                    UserName +
                    '</h5>' +
                    '<p class="mt-1 mb-0 text-muted">' +
                    comment +
                    '</p>' +
                    '</div>' +
                    '</div>' +
                    '<hr />';
                $("#dashComments").append(dashComments);
                // data-comments
                // var getOldComCount = $("#comments"+toDoListId).text();
                var commentIcon = "<i class='mdi mdi-comment-text-multiple-outline font-16 mr-1'></i>" + (++getOldComCount);
                $("#comments" + toDoListId).html(commentIcon);

                $('#submitComment')[0].reset();
            });
        }
    });

});