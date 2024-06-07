var pathname = window.location.pathname;

pathname=pathname.replace('school-management-system/public/','');
pathname=pathname.substring(1);
//alert(pathname);
$.post(checkpermissions, { menu_id:pathname }, function (data) {
    
    if (data.data !== '' && data.data !== null) 
    {
        var addbtn = '';
        if (data && data.data && typeof data.data.add !== "undefined" && data.data.add !== null) {
            addbtn = data.data.add;
        }
        var editbtn = '';
        if (data && data.data && typeof data.data.updates !== "undefined" && data.data.updates !== null) {
            editbtn = data.data.updates;
        }
        var deletebtn = '';
        if (data && data.data && typeof data.data.deletes !== "undefined" && data.data.deletes !== null) {
            deletebtn = data.data.deletes;
        }
        var exportbtn = '';
        if (data && data.data && typeof data.data.export !== "undefined" && data.data.export !== null) {
            exportbtn = data.data.export;
        }
            
        if(addbtn=='Access')
        {
            $('.add-btn').show();
                    
        }
        else
        {
            $('.add-btn').hide();    
        }   
        if(editbtn=='Access')
        {
            setTimeout(function () {
                $('a.btn-blue').removeClass('d-none');
                }, 1000);     
        }
        else
        {
            setTimeout(function () {
                $('a.btn-blue').addClass('d-none');
                }, 1000);  
        }
        if(deletebtn=='Access')
        {
            setTimeout(function () {
                $('.btn-danger').removeClass('d-none');
                }, 1000);      
        }
        else
        {
            setTimeout(function () {
            $('.btn-danger').addClass('d-none');
            }, 1000);   
        }
        if(exportbtn=='Access')
        {
            setTimeout(function () {
                $('button.dt-button').removeClass('d-none');
                }, 1000);      
        }
        else
        {
            // disabled
            setTimeout(function () {
                $('button.dt-button').addClass('d-none');
                }, 1000);   
            
        }
    }
    else
    {
        
    }
}, 'json');

