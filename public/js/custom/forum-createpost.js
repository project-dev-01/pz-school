$(function () {   
    var selectedtopic;
    $("#createpostForum").validate({
        rules: {
            inputTopicTitle: "required",
            inputTopicHeader:"required",
            tpbody: "required",
            category: "required"
        }
    });
    // create post forum
    $("#createpostForum").on('submit', function (e) {
        e.preventDefault();

        var cpostCheck = $("#createpostForum").valid();
        if (cpostCheck === true) {
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    // console.log("------")
                    console.log(data)
                    if (data.code == 200) {
                     
                        toastr.success(data.message);
                        location.reload();
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
});
(function () {
    var ttJsActiveBtn = $('#tt-pageContent .tt-js-active-btn');
    if (ttJsActiveBtn.length) {
        ttJsActiveBtn.on('click', '.tt-button-icon', function (e) {
            selectedtopic = $(this).text();
            $("#topictype").val(selectedtopic);
            return false;
        });
    };
})();


