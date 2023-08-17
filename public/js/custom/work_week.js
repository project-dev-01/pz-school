$(function () {

    // update edit-work-week-form
    $('#edit-work-week-form').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (data) {
                console.log("data");
                console.log(data);
                if (data.code == 200) { 
                    toastr.success(data.message);
                    // window.location.href = feesGroupList;
                } else {
                    toastr.error(data.message);
                }
            }
        });
    });
});