var pathname = window.location.pathname;

pathname=pathname.replace('school-management-system/public/','');
pathname=pathname.substring(1);
//alert(pathname);
$.post(checkpermissions, { menu_id:pathname }, function (data) {
    
    if(data.data!='' || data.data!=null)
    {
        var addbtn=data.data.add;
        var editbtn=data.data.updates;
        var deletebtn=data.data.deletes;
        var exportbtn=data.data.export;
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

