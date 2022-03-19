$(function () {
    $('.threadapproved').on('click', function (e) {
        e.preventDefault();
        var id =$(this).data("id");
        console.log(id);
        var threads_status=2;
        $.post(threadstatusupd, { token: token, id: id, user_id: user_id,branch_id: branch_id,threads_status:threads_status}, function (res) {

            if (res.code == 200) {
                toastr.success(res.message);
                console.log(res);
                location.reload();
            }
        }, 'json');
    });
    $('.threaddecline').on('click', function (e) {
        e.preventDefault();
        var id =$(this).data("id");
        console.log(id);
        var threads_status=3;
        $.post(threadstatusupd, { token: token, id: id, user_id: user_id,branch_id: branch_id,threads_status:threads_status}, function (res) {

            if (res.code == 200) {
                toastr.success(res.message);
                console.log(res);
                location.reload();
            }
        }, 'json');
    });
});

