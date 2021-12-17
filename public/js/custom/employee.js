$(function () {
    // joining date
    $("#joiningDate").datepicker({
        dateFormat: 'dd-mm-yy'
    });
    // emp DOB
    $("#empDOB").datepicker({
        dateFormat: 'dd-mm-yy'
    });
    // empDepartment
    // $("#empBranchName").on("change",function(){
    //     // alert("test");
    // });
    $('#empBranchName').on('change', function (e) {
        e.preventDefault();
        var branchId = $(this).val();
        alert(branchId);
        // var form = this;
        // var foraData = new FormData();
        // foraData.append('token',token);
        // foraData.append('branch_id',token);
        // $.ajax({
        //     url: empDepartment,
        //     method: "post",
        //     data: new FormData(form),
        //     processData: false,
        //     dataType: 'json',
        //     contentType: false,
        //     beforeSend: function () {
        //         $(form).find('span.error-text').text('');
        //     },
        //     success: function (data) {
        //         console.log("----------")
        //         console.log(data)
        //     }
        // });
    });
});