$(function () {        
           // replies command insert 
    $('#getbranchid').on('change', function () {
        var id = $("#getbranchid").val();        
        console.log(id);
        $("#filter").find("#Rolls").empty();
        $("#filter").find("#Rolls").append('<option value="">'+select+'</option>');
        $.post(getuserid, { token:token,id:id }, function (res) {
            if(res.code == 200) {
                //toastr.success(res.message);                
                // $.each(res.data, function (key, val) {
                //     $("#filter").find("#Rolls").append('<option value="' + val.id + '">' + val.name + '</option>');
                // });
            } else {
                toastr.error(res.message);
            }
        }, 'json');
    });

    });

