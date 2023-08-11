$(function () {    
    $("#frm_ldate").datepicker({
        dateFormat: 'dd-mm-yy',
        changeDay: true,
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
        onSelect: function() {
            validateDates();
        }
        
    });
    $("#to_ldate").datepicker({
        dateFormat: 'dd-mm-yy',
        changeDay: true,
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
        onSelect: function() {
            validateDates();
        }
        
    });
    var fromDateInput = $("#frm_ldate");
    var toDateInput = $("#to_ldate");
    function validateDates() {
        
        var frm_ldate = fromDateInput.datepicker("getDate");
        var to_ldate = toDateInput.datepicker("getDate");
        
        if (frm_ldate > to_ldate) {
            var frm= $("#frm_ldate").val();
            toastr.error("To date should be greater than from Date");
            $("#to_ldate").val(frm);
            return false;
        }
        else
        {
            return true;
        }
    }

    const date = new Date();

    let day = ("0" + date.getDate()).slice(-2);
    let month = ("0" + (date.getMonth() + 1)).slice(-2);
    let year = date.getFullYear();
    var today=`${day}-${month}-${year}`;
    //console.log(today);
    $('#frm_ldate').val(today);
    $('#to_ldate').val(today);
    
    var role_id = $('#role_id').val();
    var frm_ldate = $('#frm_ldate').val();
    var to_ldate = $('#to_ldate').val();
    loghistoryTable(role_id,frm_ldate,to_ldate);
    
}); 
$('#LogHistoryFilter').on('submit', function (e) {
    e.preventDefault();  
    
    var role_id = $('#role_id').val();
    var frm_ldate = $('#frm_ldate').val();
    var to_ldate = $('#to_ldate').val();
    loghistoryTable(role_id,frm_ldate,to_ldate);
    
}); 
  // get all Login History table
function loghistoryTable(role_id,frm_ldate,to_ldate) 
{
    $('#logactivity-table').DataTable({
        
        processing: true,
        bDestroy: true,
        info: true,
        // dom: 'lBfrtip',
        dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "language": {

            "emptyTable": no_data_available,    
            "infoFiltered": filter_from_total_entries,
            "zeroRecords": no_matching_records_found,
            "infoEmpty": showing_zero_entries,
            "info": showing_entries,
            "lengthMenu": show_entries,
            "search": datatable_search,
            "paginate": {
                "next": next,
                "previous": previous
            },
        },
        buttons: [
            {
                extend: 'csv',
                text: downloadcsv,
                extension: '.csv',
                charset: 'utf-8',
                bom: true,
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            },
            {
                extend: 'pdf',
                text: downloadpdf,
                extension: '.pdf',
                charset: 'utf-8',
                bom: true,
                exportOptions: {
                    columns: 'th:not(:last-child)'
                },

            
                customize: function (doc) {
                doc.pageMargins = [50,50,50,50];
                doc.defaultStyle.fontSize = 10;
                doc.styles.tableHeader.fontSize = 12;
                doc.styles.title.fontSize = 14;
                // Remove spaces around page title
                doc.content[0].text = doc.content[0].text.trim();
                /*// Create a Header
                doc['header']=(function(page, pages) {
                    return {
                        columns: [
                            
                            {
                                // This is the right column
                                bold: true,
                                fontSize: 20,
                                color: 'Blue',
                                fillColor: '#fff',
                                alignment: 'center',
                                text: header_txt
                            }
                        ],
                        margin:  [50, 15,0,0]
                    }
                });*/
                // Create a footer
                
                doc['footer']=(function(page, pages) {
                    return {
                        columns: [
                            { alignment: 'left', text: [ footer_txt ],width:400} ,
                            {
                                // This is the right column
                                alignment: 'right',
                                text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }],
                                width:100

                            }
                        ],
                        margin: [50, 0,0,0]
                    }
                });
                
            }

            }
        ],
        //ajax: login_activityList,
        ajax: {            
            url: login_activityList,
            cache: false,
                dataType: "json",
            data: function (d) {
                d.role_id = role_id,
                d.frm_ldate =  frm_ldate,
                d.to_ldate =  to_ldate                
            },
            type: "GET",
            "dataSrc": function (json) {
                console.log("json");
                console.log(json);
                return json.data;
            },
            error: function (error) {
                // console.log("error")
                // console.log(error)
                // noDataAvailable(error);
            }
        },
        "pageLength": 10,
        "aLengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
        columns: [
            {
                searchable: false,
                data: 'id',
                name: 'id'
            },            
			{
                data: 'user_name',
                name: 'user_name'
            },
			{
                data: 'role_name',
                name: 'role_name'
            },
			
            {
                data: 'login_time',
                name: 'login_time'
            },
            {
                data: 'logout_time',
                name: 'logout_time'
            },
			{
                data: 'spend_time',
                name: 'spend_time'
            },
            {
                data: 'ip_address',
                name: 'ip_address'
            },
            {
                data: 'country',
                name: 'country'
            },
			{
                data: 'device',
                name: 'device'
            },
			{
                data: 'os',
                name: 'os'
            },
			{
                data: 'browser',
                name: 'browser'
            }
			
			
        ]
    }).on('draw', function () {
    });
}
