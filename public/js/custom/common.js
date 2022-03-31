$(function () {
    // add daterangepicker
    $('input[name="daterange"]').daterangepicker({
        opens: 'left'
    }, function (start, end, label) {
        // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });

    // $('input[name="birthday"]').daterangepicker({
    //     singleDatePicker: true,
    //     showDropdowns: true,
    //     minYear: 1901,
    //     maxYear: parseInt(moment().format('YYYY'), 20)
    // }, function (start, end, label) {
    //     var years = moment().diff(start, 'years');
    //     console.log("You are " + years + " years old!");
    //     console.log(start + "====" +parseInt(moment().format('YYYY'), 10));
    // });

    // addDatePicker
    $("#leaveFrom").datepicker({
        dateFormat: 'dd-mm-yy'
    });
    $("#leaveTo").datepicker({
        dateFormat: 'dd-mm-yy'
    });
    $("#postingDate").datepicker({
        dateFormat: 'dd-mm-yy'
    });
    //
    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();
    
        if (month.length < 2) 
            month = '0' + month;
        if (day.length < 2) 
            day = '0' + day;
    
        return [year, month, day].join('-');
    }
});