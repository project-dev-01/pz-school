$(function () {
    // change child
    $('.allChild').on('change', '#changeChildren', function (event) {
        event.preventDefault();
        var childID = $(this).val();
        console.log("childID");
        console.log(childID);
        $.ajax({
            type: "POST",
            url: updateChildSessionID,
            data: { student_id: childID },
            success: function (res) {
                // console.log("--------")
                // console.log(res)
                location.reload();
            }
            // , error: function (err) {
            //     console.log("--------")
            //     console.log(err)
            // }
        });

    });
    // responsiveAllChild
    $('.responsiveAllChild').on('click', function (event) {
        event.preventDefault();
        var childID = $(this).data('id');
        console.log(childID);
        $.ajax({
            type: "POST",
            url: updateChildSessionID,
            // data: { student_id: childID },
            data: {
                student_id: childID,
                _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
            },
            success: function (res) {
                // console.log("--------")
                // console.log(res)
                location.reload();
            }
            // , error: function (err) {
            //     console.log("--------")
            //     console.log(err)
            // }
        });
    });

});

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
