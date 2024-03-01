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


});

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
